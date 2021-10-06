<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Str;
use File;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use App\Models\AccountNumber;

class ProfileController extends Controller
{
    public function index()
    {
        $customer = auth()->user()->load('district');
        $provinces = Province::orderBy('name', 'ASC')->get();
        $number = AccountNumber::where('user_id', auth()->user()->id)->get();
        return view('seller.profile' ,compact('provinces','number','customer'));
    }

    public function upload_image(Request $request)
    {
         $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id'
        ]);

        $user = User::where('id',auth()->user()->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'district_id' => $request->district_id,
            'password' => Hash::make($request->password),

        ]);

        if($request->hasfile(['avatar'])){
            $request->file(['avatar'])->move('asset/images/avatar/',$request->file(['avatar'])->getClientOriginalName());
            $user->avatar = $request->file(['avatar'])->getClientOriginalName();
            $user->save();
        }

        return redirect()->back();

    }

    public function seller_store(Request $request)
    {
        $number = AccountNumber::create($request->all());
        return redirect()->back()->withInput();
    }

    public function seller_update(Request $request)
    {
        $seller = Seller::where('user_id',auth()->user()->id);
        $seller->update([
            'shop_name' => $request->shop_name,
            'user_id' => $request->user_id,
            'description' => $request->description
        ]);
        return redirect()->back();
    }

    public function delete($id)
    {
        $number = AccountNumber::find($id);
        $number->delete();
        return redirect()->back();
    }
}
