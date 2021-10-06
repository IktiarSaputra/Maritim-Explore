<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Seller;
use App\Models\Order;
use PDF;
use Carbon\Carbon;
use App\Mail\VerifEmailSeller;
use Mail;

class SellerController extends Controller
{
    public function dashboard()
    {
        return view('seller.dashboard');
    }

    public function list_seller()
    {
        $seller = Seller::all();
        return view('admin.seller.index', compact('seller'));
    }

    public function index()
    {
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        return view('admin.seller.create' ,compact('provinces'));
    }

    public function store_seller(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'district_id' => $request->district_id,
            'password' => Hash::make($request->password),
        ]);

        $seller = Seller::create([
            'user_id' => $user->id,
        ]);
        return redirect(route('home.seller'))->withErrors($validated)->withInput();
    }

    public function home()
    {
        return view('seller.home');
    }

    public function confirm($id)
    {
        $seller = Seller::find($id);
        $seller->update([
            'status' => 1,
        ]);

        $user = User::find($seller->user_id);
        $user->update([
            'level' => 'seller',
        ]);
        Mail::to($user->email)->send(new VerifEmailSeller($user));
        return redirect()->back()->withInput();
    }

    public function orderReport()
    {
        //INISIASI 30 HARI RANGE SAAT INI JIKA HALAMAN PERTAMA KALI DI-LOAD
        //KITA GUNAKAN STARTOFMONTH UNTUK MENGAMBIL TANGGAL 1
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        if (request()->date != '') {
            //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        $orders = OrderDetail::with(['order'])->whereBetween('created_at', [$start, $end])->where('seller_id',auth()->user()->id)->get();
        //KEMUDIAN LOAD VIEW
        return view('report.order', compact('orders'));
    }

    public function orderReportPdf($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $orders = OrderDetail::with(['order'])->whereBetween('created_at', [$start, $end])->where('seller_id',auth()->user()->id)->get();
        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        $pdf = PDF::loadView('report.order_pdf', compact('orders', 'date'));
        //GENERATE PDF-NYA
        return $pdf->stream();
    }

    public function returnReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $orders = OrderDetail::with(['order'])->has('order.return')->whereBetween('created_at', [$start, $end])->where('seller_id',auth()->user()->id)->get();
        return view('report.return', compact('orders'));
    }

    public function returnReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $orders = OrderDetail::with(['order'])->has('order.return')->whereBetween('created_at', [$start, $end])->where('seller_id',auth()->user()->id)->get();
        $pdf = PDF::loadView('report.return_pdf', compact('orders', 'date'));
        return $pdf->stream();
    }
}
