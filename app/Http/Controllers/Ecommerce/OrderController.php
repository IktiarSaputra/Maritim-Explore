<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\OrderReturn;
use Illuminate\Support\Str;
use DB;
use PDF;
use App\Models\Province;
use App\Models\AccountNumber;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::withCount(['return'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);        
        return view('ecommerce.orders.index', compact('orders'));
    }

    public function view($invoice)
    {
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])->where('invoice', $invoice)->first();
        $detail = OrderDetail::where('order_id',$order->id)->get()->first();
        $id = $detail->product_id;
        $product = Product::where('id',$id)->get()->first();

        if (\Gate::forUser(auth()->user())->allows('order-view', $order)) {
            return view('ecommerce.orders.view', compact('order','product'));
        }
        return redirect(route('customer.orders'))->with(['error' => 'Anda Tidak Diizinkan Untuk Mengakses Order Orang Lain']);
    }

    public function paymentForm(Request $request)
    {
        $order = Order::where('invoice', $request->id)->first();
        $orderid = Order::where('id', $request->id)->get();
        $details = OrderDetail::where('order_id', $request->id)->get()->first();
        $detail = $details->product_id;
        $product = Product::where('id', $detail)->get()->first();
        $name = $product->user_id;
        $user = AccountNumber::where('user_id', $name)->get();
        $rek = $user;
        return view('ecommerce.payment',compact('rek'));
    }

    public function storePayment(Request $request)
    {
    //VALIDASI DATANYA
        $this->validate($request, [
            'invoice' => 'required|exists:orders,invoice',
            'name' => 'required|string',
            'transfer_to' => 'required|string',
            'transfer_date' => 'required',
            'amount' => 'required|integer',
            'proof' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        //DEFINE DATABASE TRANSACTION UNTUK MENGHINDARI KESALAHAN SINKRONISASI DATA JIKA TERJADI ERROR DITENGAH PROSES QUERY
        DB::beginTransaction();
        try {
            //AMBIL DATA ORDER BERDASARKAN INVOICE ID
           $order = Order::where('invoice', $request->invoice)->first();
             if ($order->subtotal + $order->cost != $request->amount) return redirect()->back()->with(['error' => 'Pembayaran Harus Sama Dengan Tagihan']); //HANYA TAMBAHKAN CODE INI
             if ($order->status == 0 && $request->hasFile(['proof'])) {
                //MAKA UPLOAD FILE GAMBAR TERSEBUT
                $file = $request->file('proof');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('payment/', $filename);
                //KEMUDIAN SIMPAN INFORMASI PEMBAYARANNYA
                Payment::create([
                    'order_id' => $order->id,
                    'name' => $request->name,
                    'transfer_to' => $request->transfer_to,
                    'transfer_date' => Carbon::parse($request->transfer_date)->format('Y-m-d'),
                    'amount' => $request->amount,
                    'proof' => $filename,
                    'status' => false
                ]);


                //DAN GANTI STATUS ORDER MENJADI 1
                $order->update(['status' => 1]);
                //JIKA TIDAK ADA ERROR, MAKA COMMIT UNTUK MENANDAKAN BAHWA TRANSAKSI BERHASIL
                DB::commit();
                //REDIRECT DAN KIRIMKAN PESAN
                return redirect(route('customer.orders'))->with(['success' => 'Pesanan Dikonfirmasi']);
            }
            //REDIRECT DENGAN ERROR MESSAGE
            return redirect()->back()->with(['error' => 'Error, Upload Bukti Transfer']);
        } catch(\Exception $e) {
            //JIKA TERJADI ERROR, MAKA ROLLBACK SELURUH PROSES QUERY
            DB::rollback();
            //DAN KIRIMKAN PESAN ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function pdf($invoice)
    {
        //GET DATA ORDER BERDASRKAN INVOICE
        $order = Order::with(['district.city.province', 'details', 'details.product', 'payment'])
            ->where('invoice', $invoice)->first();
        //MENCEGAH DIRECT AKSES OLEH USER, SEHINGGA HANYA PEMILIKINYA YANG BISA MELIHAT FAKTURNYA
        if (!\Gate::forUser(auth()->user())->allows('order-view', $order)) {
            return redirect(route('ecommerce.orders.view', $order->invoice));
        }


        $orderid = Order::where('id', $order->id)->get();
        $details = OrderDetail::where('order_id', $order->id)->get()->first();
        $detail = $details->product_id;
        $products = Product::where('id', $detail)->get()->first();
        $nam = $products->user_id;
        $user = User::where('id', $nam)->get()->first();
        $nama = $user;

        //JIKA DIA ADALAH PEMILIKNYA, MAKA LOAD VIEW BERIKUT DAN PASSING DATA ORDERS
        $pdf = PDF::loadView('ecommerce.orders.pdf', compact('order','nama'));
        //KEMUDIAN BUKA FILE PDFNYA DI BROWSER
        return $pdf->stream();
    }

    public function returnForm($invoice)
    {
        //LOAD DATA BERDASARKAN INVOICE
        $order = Order::where('invoice', $invoice)->first();
        //LOAD VIEW RETURN.BLADE.PHP DAN PASSING DATA ORDER
        return view('ecommerce.orders.return', compact('order'));
    }

    public function processReturn(Request $request, $id)
    {
        //LAKUKAN VALIDASI DATA
        $this->validate($request, [
            'reason' => 'required|string',
            'refund_transfer' => 'required|string',
            'photo' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        //CARI DATA RETURN BERDASARKAN order_id YANG ADA DITABLE ORDER_RETURNS NANTINYA
        $return = OrderReturn::where('order_id', $id)->first();
        //JIKA DITEMUKAN, MAKA TAMPILKAN NOTIFIKASI ERROR
        if ($return) return redirect()->back()->with(['error' => 'Permintaan Refund Dalam Proses']);

        //JIKA TIDAK, LAKUKAN PENGECEKAN UNTUK MEMASTIKAN FILE FOTO DIKIRIMKAN
        if ($request->hasFile('photo')) {
            //GET FILE
            $file = $request->file('photo');
            //GENERATE NAMA FILE BERDASARKAN TIME DAN STRING RANDOM
            $filename = time() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            //KEMUDIAN UPLOAD KE DALAM FOLDER STORAGE/APP/PUBLIC/RETURN
            $file->storeAs('public/return', $filename);

            //DAN SIMPAN INFORMASINYA KE DALAM TABLE ORDER_RETURNS
            OrderReturn::create([
                'order_id' => $id,
                'photo' => $filename,
                'reason' => $request->reason,
                'refund_transfer' => $request->refund_transfer,
                'status' => 0
            ]);
            //LALU TAMPILKAN NOTIFIKASI SUKSES
            return redirect()->back()->with(['success' => 'Permintaan Refund Dikirim']);
        }
        
    }

    public function rate(Request $request)
    {

        request()->validate(['rate' => 'required']);

        $post = Product::find($request->id);

        $rating = new \willvincent\Rateable\Rating;

        $rating->rating = $request->rate;

        $rating->user_id = auth()->user()->id;

        $post->ratings()->save($rating);
        return redirect()->back();

    }


}
