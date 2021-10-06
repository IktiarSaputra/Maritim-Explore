<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Province;
use App\Models\District;
use App\Models\City;
use App\Models\User;
use Cookie;
use App\Models\Order;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\OrderDetail;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use DB;

class CartController extends Controller
{

    private function getCarts()
    {
        $carts = json_decode(request()->cookie('cart-image'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function addToCart(Request $request)
    {

        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required',
        ]);

        $product = Product::find($request->product_id);
        $carts = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'associatedModel' => $product,
        ];
        
        
        \Cart::add($carts);
        
        return redirect(route('front.list_cart'))->with(['success' => 'Produk Ditambahkan ke Keranjang']);
    }

    public function listCart()
    {
        $carts = \Cart::getContent();
        $this->data['item'] = $carts;
        return view('ecommerce.cart', compact('carts'));
    }

    public function updateCart(Request $request)
    {   
        $params = $request->except('_token');
		if ($items = $params['items']) {
			foreach ($items as $cartID => $item) {
				\Cart::update($cartID, [
					'quantity' => [
						'relative' => false,
						'value' => $item['quantity'],
					],
				]);
			}
			return redirect()->back();
		}
    }

    public function checkout()
    {
        //QUERY UNTUK MENGAMBIL SEMUA DATA PROPINSI
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        $carts = \Cart::getContent();
        $this->data['item'] = $carts;

        $weight = collect($carts)->sum(function($q) {
            return $q['quantity'] * $q->associatedModel->weight;
        });

        $origin = collect($carts)->sum(function($q) {
            return $q->associatedModel->user->district->city->id;
        });

        $seller = collect($carts)->sum(function($q) {
            return $q->associatedModel->user->id;
        });

        return view('ecommerce.checkout', compact('provinces', 'carts','weight','origin','seller'));
    }

    public function getCity()
    {
        $cities = City::where('province_id', request()->province_id)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    public function processCheckout(Request $request)
    {
        $this->validate($request, [
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required',
            'email' => 'required|email',
            'customer_address' => 'required|string',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
        ]);

        DB::beginTransaction();
        try {
            $affiliate = json_decode(request()->cookie('dw-afiliasi'), true);
            $explodeAffiliate = explode('-', $affiliate);

            $customer = User::where('email', $request->email)->first();
            if (!auth()->check() && $customer) {
                return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
            }         

            $carts = \Cart::getContent();
            $this->data['item'] = $carts;

            $shipping = explode('-', $request->courier);

            if ($shipping[2] > 1) {
                $cost = $shipping[2];
            } else {
                $cost = $shipping[3];
            }

            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(),
                'user_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'district_id' => $request->district_id,
                'subtotal' => \Cart::getSubTotal(),
                'cost' => $cost,
                'shipping' => $shipping[0] . '-' . $shipping[1],
                'ref' => $affiliate != '' && $explodeAffiliate[0] != auth()->user()->id ? $affiliate:NULL
            ]);

            foreach ($carts as $row) {
                $product = Product::find($row['id']);
                OrderDetail::create([
                    'order_id' => $order->id,
                    'user_id' =>  $request->seller_id,
                    'seller_id' => $product->user_id,
                    'product_id' => $row['id'],
                    'price' => $row['price'],
                    'qty' => $row['quantity'],
                    'weight' => $product->weight
                ]);
            }

            DB::commit();

            $carts = [];
            $cookie = cookie('dw-carts', json_encode($carts), 2880);
            Cookie::queue(Cookie::forget('dw-afiliasi'));

            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkoutFinish($invoice)
    {
        $order = Order::with(['district.city'])->where('invoice', $invoice)->first();
        return view('ecommerce.checkout_finish', compact('order'));
    }

    public function getCourier(Request $request)
    {
        $this->validate($request, [
            'destination' => 'required',
            'weight' => 'required|integer'
        ]);


        $url = 'https://ruangapi.com/api/v1/shipping';
        $client = new Client();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'tu9XRDeKgaW6CjmjvNqaXKEZbPcau28xM77obN4F'
            ],
            'form_params' => [
                'origin' => 22, //ASAL PENGIRIMAN, 22 = BANDUNG
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => 'jnt,tiki,pos'
            ]
        ]);

        $body = json_decode($response->getBody(), true);
        return $body;
    }

    public function cek_ongkir()
    {
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        $carts = \Cart::getContent();
        $this->data['item'] = $carts;

        $weight = collect($carts)->sum(function($q) {
            return $q['quantity'] * $q->associatedModel->weight;
        });

        $origin = collect($carts)->sum(function($q) {
            return $q->associatedModel->user->district->city->id;
        });

        return view('ecommerce.ongkir', compact('provinces', 'carts','weight','origin'));   
    }

    public function ongkir(Request $request)
    {

        // $url = 'https://ruangapi.com/api/v1/shipping';
        // $client = new Client();
        // $response = $client->request('POST', $url, [
        //     'headers' => [
        //         'Authorization' => 'tu9XRDeKgaW6CjmjvNqaXKEZbPcau28xM77obN4F'
        //     ],
        //     'form_params' => [
        //         'origin' => 22, //ASAL PENGIRIMAN, 22 = BANDUNG
        //         'destination' => 152,
        //         'weight' => 1700,
        //         'courier' => 'jnt,tiki,pos'
        //     ]
        // ]);

        // $body = json_decode($response->getBody(), true);

        // dd($body);

        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }

    public function destroy($id)
    {
        \Cart::remove($id);
        $cookie = \Cookie::forget('cart-image');
        return redirect()->back();
    }

}
