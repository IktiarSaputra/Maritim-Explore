@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar">
                    <div class="left_dorp">
                        <select class="sorting">
                            <option value="1">Default sorting</option>
                            <option value="2">Default sorting 01</option>
                            <option value="4">Default sorting 02</option>
                        </select>
                        <select class="show">
                            <option value="1">Show 12</option>
                            <option value="2">Show 14</option>
                            <option value="4">Show 16</option>
                        </select>
                        <a href="{{ route('front.list_cart') }}" class="btn btn-primary float-right ml-5">
                            cart
                        </a>
                    </div>
                    <div class="right_page ml-auto">
                        {{ $products->links() }}
                    </div>
                </div>
                <div class="latest_product_inner row">
        
                    <!-- PROSES LOOPING DATA PRODUK, SAMA DENGAN CODE YANG ADDA DIHALAMAN HOME -->
                    @forelse ($products as $row)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="f_p_item">
                            <div class="f_p_img">
                                <img class="img-fluid" src="{{ asset('storage/products/' . $row->image) }}"
                                    alt="{{ $row->name }}">
                                <div class="p_icon">
                                    <a href="{{ url('ecommerce/product/' . $row->slug) }}">
                                        <i class="lnr lnr-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="{{ url('ecommerce/product/' . $row->slug) }}">
                                <h4>{{ $row->name }}</h4>
                            </a>
                            <h5>Rp {{ number_format($row->price) }}</h5>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <h3 class="text-center">Tidak ada produk</h3>
                    </div>
                    @endforelse
                    <!-- PROSES LOOPING DATA PRODUK, SAMA DENGAN CODE YANG ADDA DIHALAMAN HOME -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets cat_widgets">
                        <div class="l_w_title">
                            <h3>Kategori Produk</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                @foreach ($categories as $category)
                                <li>
            
                                    <!-- MODIFIKASI BAGIAN INI -->
                                    <strong><a href="{{ url('ecommerce/category/' . $category->slug) }}">{{ $category->name }}</a></strong>
                                    <!-- MODIFIKASI BAGIAN INI -->
            
                                    @foreach ($category->child as $child)
            
                                    <!-- MODIFIKASI BAGIAN INI -->
                                    <ul class="list" style="display: block">
                                        <!-- MODIFIKASI BAGIAN INI -->
            
                                        <li>
                                            <a href="{{ url('ecommerce/category/' . $child->slug) }}">{{ $child->name }}</a>
                                        </li>
                                    </ul>
                                    @endforeach
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        
        <!-- GENERATE PAGINATION PRODUK -->
        <div class="row">
            {{ $products->links() }}
        </div>
    </div>
@endsection