<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Mail\OrderMail;
use Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = OrderDetail::with(['order'])->orderBy('created_at' , 'DESC')->where('seller_id',auth()->user()->id);
        $orders = $orders->get();
        return view('orders.index', compact('orders'));
    }

    public function view($invoice)
    {
        $order = Order::with(['user.district.city.province', 'payment', 'details.product'])->where('invoice', $invoice)->first();
        return view('orders.view', compact('order'));
    }

    public function acceptPayment($invoice)
    {
        //MENGAMBIL DATA CUSTOMER BERDASARKAN INVOICE
        $order = Order::with(['payment'])->where('invoice', $invoice)->first();
        //UBAH STATUS DI TABLE PAYMENTS MELALUI ORDER YANG TERKAIT
        $order->payment()->update(['status' => 1]);
        //UBAH STATUS ORDER MENJADI PROSES
        $order->update(['status' => 2]);
        //REDIRECT KE HALAMAN YANG SAMA.
        return redirect(route('orders.view', $order->invoice));
    }

    public function acceptOrder(Request $request)
    {
    
        $order = Order::find($request->order_id);
        //VALIDASI KEPEMILIKAN
        if (!\Gate::forUser(auth()->user())->allows('order-view', $order)) {
            return redirect()->back()->with(['error' => 'Bukan Pesanan Kamu']);
        }

        //UBAH STATUSNYA MENJADI 4
        $order->update(['status' => 4]);
        //REDIRECT KEMBALI DENGAN MENAMPILKAN ALERT SUCCESS
        return redirect()->back()->with(['success' => 'Pesanan Dikonfirmasi']);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->details()->delete();
        $order->payment()->delete();
        $order->delete();
        return redirect(route('orders.index'));
    }

    public function shippingOrder(Request $request)
    {
        //MENGAMBIL DATA ORDER BERDASARKAN ID
        $order = Order::with(['user'])->find($request->order_id);
        //UPDATE DATA ORDER DENGAN MEMASUKKAN NOMOR RESI DAN MENGUBAH STATUS MENJADI DIKIRIM
        $order->update(['tracking_number' => $request->tracking_number, 'status' => 3]);
        //KIRIM EMAIL KE PELANGGAN TERKAIT
        Mail::to($order->user->email)->send(new OrderMail($order));
        //REDIRECT KEMBALI
        return redirect()->back();
    }
}
