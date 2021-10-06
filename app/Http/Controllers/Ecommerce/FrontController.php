<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('ecommerce.index', compact('products'));
    }

    public function product()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(12)->where('status', 1);
        return view('ecommerce.index', compact('products'));
    }

    public function categoryProduct($slug)
    {
        $products = Category::where('slug', $slug)->first()->product()->orderBy('created_at', 'DESC')->paginate(12);
        return view('ecommerce.product', compact('products'));
    }

    public function toko($user_id)
    {
        $user = User::where('id',$user_id)->get()->first();
        return view('ecommerce.toko',compact('user'));
    }

    public function show($slug)
    {
        $product = Product::with(['category'])->where('slug', $slug)->first();
        return view('ecommerce.show', compact('product'));
    }

    public function customerUpdateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'phone_number' => 'required|max:15',
            'address' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'password' => 'nullable|string|min:6'
        ]);

        $user = auth()->user();
        $data = $request->only('name', 'phone_number', 'address', 'district_id');
        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        }
        //TERUS UPDATE DATANYA
        $user->update($data);
        //DAN REDIRECT KEMBALI DENGAN MENGIRIMKAN PESAN BERHASIL
        return redirect()->back()->with(['success' => 'Profil berhasil diperbaharui']);
    }

    public function customerSettingForm()
    {
        //MENGAMBIL DATA CUSTOMER YANG SEDANG LOGIN
        $customer = auth()->user()->load('district');
        //GET DATA PROPINSI UNTUK DITAMPILKAN PADA SELECT BOX
        $provinces = Province::orderBy('name', 'ASC')->get();
        //LOAD VIEW setting.blade.php DAN PASSING DATA CUSTOMER - PROVINCES
        return view('ecommerce.setting', compact('customer', 'provinces'));
    }

    public function referalProduct($user, $product)
    {
        $code = $user . '-' . $product; //KITA MERGE USERID DAN PRODUCTID
        $product = Product::find($product); //FIND PRODUCT BERDASARKAN PRODUCTID
        $cookie = cookie('me-afiliasi', json_encode($code), 2880); //BUAT COOKIE DENGAN NAMA DW-AFILIASI DAN VALUENYA ADALAH CODE YANG SUDAH DI-MERGE
        //KEMUDIAN REDIRECT KE HALAMAN SHOW PRODUCT DAN MENGIRIMKAN COOKIE KE BROWSER
        return redirect(route('front.show_product', $product->slug))->cookie($cookie);
    }

    public function listCommission()
    {
        $user = auth()->user(); //AMBIL DATA USER YANG LOGIN
        //QUERY BERDASARKAN ID USER DARI DATA REF YANG ADA DIORDER DENGAN STATUS 4 ATAU SELESAI
        $orders = Order::where('ref', $user->id)->where('status', 4)->paginate(10);
        //LOAD VIEW AFFILIATE.BLADE.PHP DAN PASSING DATA ORDERS
        return view('ecommerce.affiliate', compact('orders'));
    }


}
