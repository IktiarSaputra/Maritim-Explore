<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use File;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with(['category'])->orderBy('created_at', 'DESC')->where('user_id', auth()->user()->id);
        if (request()->q != '') {
            $product = $product->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $product = $product->get();
        return view('products.index', compact('product'));
    }

    public function create()
    {
        $category = Category::orderBy('name', 'DESC')->get();
        return view('products.create', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'min_order' => 'nullable|string',
            'weight' => 'nullable|string',
            'image' => 'required|image|mimes:png,jpeg,jpg' 
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->name,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'min_order' => $request->min_order,
            'weight' => $request->weight,
            'status' => $request->status
        ]);
        if($request->hasfile(['image'])){
            $request->file(['image'])->move('products/',$request->file(['image'])->getClientOriginalName());
            $product->image = $request->file(['image'])->getClientOriginalName();
            $product->save();
        }
        return redirect(route('product.index'))->with(['insert' => 'Produk Baru Ditambahkan']);
    }

    public function edit($id)
    {
        $product = Product::find($id); 
        $category = Category::orderBy('name', 'DESC')->get(); 
        return view('products.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
    //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'min_order' => 'nullable|string',
            'weight' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        $product = Product::find($id); //AMBIL DATA PRODUK YANG AKAN DIEDIT BERDASARKAN ID
        $filename = $product->image; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI

    //KEMUDIAN UPDATE PRODUK TERSEBUT
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'min_order' => $request->min_order,
            'weight' => $request->weight,
            'status' => $request->status,
        ]);

        if($request->hasfile(['image'])){
            $request->file(['image'])->move('products/',$request->file(['image'])->getClientOriginalName());
            $product->image = $request->file(['image'])->getClientOriginalName();
            $product->save();
        }
        return redirect(route('product.index'))->with(['update' => 'Data Produk Diperbaharui']);
    }

    public function destroy($id)
    {
        $product = Product::find($id); 
        File::delete(storage_path('app/public/products/' . $product->image));
        $product->delete();
        return redirect(route('product.index'))->with(['delete' => 'Produk Sudah Dihapus']);
    }

    public function rate(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $product = Product::find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $product->ratings()->save($rating);
        return redirect(route('ecommerce.index'))->with(['rate' => 'Produk Sudah Dihapus']);
    }

    public function showlist()
    {
        $product = Product::paginate(10);
        return view('admin.product.index', compact('product'));

    }
}
