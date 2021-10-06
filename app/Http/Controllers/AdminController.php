<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use Cache;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $orders = OrderDetail::with(['order'])->orderBy('created_at' , 'DESC')->take(5);
        $orders = $orders->get();
        $user = User::orderBy('created_at', 'DESC')->take(5)->get();
        $product = Product::with(['category'])->orderBy('created_at', 'DESC')->take(3);
        $product = $product->get();
        return view('admin.dashboard',compact('orders','user','product'));
    }

    public function listuser()
    {
        $user = User::orderBy('created_at','DESC')->get();
        return view('admin.user.index', compact('user'));
    }
}
