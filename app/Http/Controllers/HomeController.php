<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::selectRaw('COALESCE(sum(CASE WHEN status = 0 THEN subtotal + cost END), 0) as pending, 
        COALESCE(count(CASE WHEN status = 2 THEN subtotal END), 0) as process,
        COALESCE(count(CASE WHEN status = 3 THEN subtotal END), 0) as shipping,
        COALESCE(count(CASE WHEN status = 4 THEN subtotal END), 0) as completeOrder')
        ->where('user_id', auth()->user()->id)->get();

        return view('ecommerce.dashboard', compact('orders'));
    }

    public function dashboard()
    {
        $orders = OrderDetail::with(['order'])->orderBy('created_at' , 'DESC')->where('seller_id',auth()->user()->id);
        $orders = $orders->get();
        $user = User::where('id',auth()->user()->id)->get()->first();
        $rek = $user->accounts;
        if (!$rek->isEmpty()) {
            return view('seller.dashboard',compact('orders'));
        } else {
            return redirect(route('seller.profile'))->with('sukses','selesai');
        }
        
        
    }

    
}
