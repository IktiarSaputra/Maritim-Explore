@extends('layouts.sbadmin')

@section('title')
Detail Order
@endsection

@section('css')
<style>
    @font-face {
        font-family: 'Glyphicons Halflings';
        src: url('http://netdna.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot');
        src: url('http://netdna.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('http://netdna.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.woff2') format('woff2'), url('../fonts/glyphicons-halflings-regular.woff') format('woff'), url('../fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('../fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular') format('svg');
    }

    .glyphicon {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: normal;
        line-height: 1;

        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .glyphicon-star:before {
        content: "\e006";
    }

    .glyphicon-star-empty:before {
        content: "\e007";
    }

    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltiptext {
        visibility: visible;
        width: 140px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
</style>
{{-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> --}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
@endsection

@section('content')
<div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td width="30%">Nama Lengkap</td>
                        <td width="5%">:</td>
                        <th>{{ $order->customer_name }}</th>
                    </tr>
                    <tr>
                        <td>No Telp</td>
                        <td>:</td>
                        <th>{{ $order->customer_phone }}</th>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <th>{{ $order->customer_address }}, {{ $order->district->name }}
                            {{ $order->district->city->name }},
                            {{ $order->district->city->province->name }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
            </div>
            <div class="card-title mr-4 mt-3">
                @if ($order->status == 0)
                <form action="/ecommerce/payment/{{$order->invoice}}" method="get">
                    @csrf
                    <input type="hidden" name="invoice" value="{{ $order->invoice }}">
                    <input type="hidden" name="id" value="{{$order->id}}">
                    <button class="btn btn-primary btn-sm float-right" type="submit">Konfirmasi</button>
                </form>
                {{-- <a href="{{ url('ecommerce/payment?invoice=' . $order->invoice) }}"
                class="btn btn-primary btn-sm float-right">Konfirmasi</a> --}}
                @endif
            </div>
            <div class="card-body">
                @if ($order->payment)
                <table>
                    <tr>
                        <td width="30%">InvoiceID</td>
                        <td width="5%">:</td>
                        <th><a href="{{ route('customer.order_pdf', $order->invoice) }}"
                                target="_blank"><strong>{{ $order->invoice }}</strong></a></th>
                    </tr>
                    <tr>
                        <td width="30%">Nama Pengirim</td>
                        <td width="5%"></td>
                        <td>{{ $order->payment->name }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Transfer</td>
                        <td></td>
                        <td>{{ $order->payment->transfer_date }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Transfer</td>
                        <td></td>
                        <td>Rp {{ number_format($order->payment->amount) }}</td>
                    </tr>
                    <tr>
                        <td>Tujuan Transfer</td>
                        <td></td>
                        <td>{{ $order->payment->transfer_to }}</td>
                    </tr>
                    <tr>
                        <td>Bukti Transfer</td>
                        <td></td>
                        <td>
                            <img src="{{ asset('/payment/' . $order->payment->proof) }}" width="50px" height="50px"
                                alt="">
                            <a href="{{ asset('/payment/' . $order->payment->proof) }}" target="_blank">Lihat Detail</a>
                        </td>
                    </tr>
                </table>
                @else
                <h4 class="text-center">Belum ada data pembayaran</h4>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-2 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Berat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->details as $row)
                            <tr>
                                <td>{{ $row->product->name }}</td>
                                <td>{{ number_format($order->subtotal + $order->cost) }}</td>
                                <td>{{ $row->qty }} Item</td>
                                <td>{{ $row->weight }} gr</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-2 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Penilaian Produk</h6>
            </div>
            <div class="card-body">
                @if ($order->status == 4)
                <form action="{{ route('customer.orders.rate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5"
                            data-step="1" value="{{ $product->userAverageRating }}" data-size="xs">

                        <input type="hidden" name="id" required="" value="{{ $product->id }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @else
                    
                @endif
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')

@endsection