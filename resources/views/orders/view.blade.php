@extends('layouts.master')

@section('title')
Detail Order
@endsection

@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h4>Order Details</h4>
                <!-- TOMBOL INI HANYA TAMPIL JIKA STATUSNYA 1 DARI ORDER DAN 0 DARI PEMBAYARAN -->
                @if ($order->status == 1 && $order->payment->status == 0)
                <a href="{{ route('orders.approve_payment', $order->invoice) }}" class="btn btn-primary btn-sm">receive
                    payment</a>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- BLOCK UNTUK MENAMPILKAN DATA PELANGGAN -->
                    <div class="col-md-6">
                        <h4>Customer Details</h4> <br>
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Customer Name</th>
                                <td>{{ $order->customer_name }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $order->customer_phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>
                                    @if ($order->district_id = $order->district_id)
                                    {{ $order->customer_address }}, {{ $order->district->name }} <br>
                                    {{  $order->district->city->name}} -
                                    {{ $order->district->city->province->name }}
                                    @else
                                    {{ $order->customer_address }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td>{!! $order->status_label !!}</td>
                            </tr>
                            <!-- FORM INPUT RESI HANYA AKAN TAMPIL JIKA STATUS LEBIH BESAR 1 -->
                            @if ($order->status > 1)
                            <tr>
                                <th>No Receipt</th>
                                <td>
                                    @if ($order->status == 2)
                                    <form action="{{ route('orders.shipping') }}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="text" name="tracking_number"
                                                placeholder="Enter The Receipt Number" class="form-control" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                    {{ $order->tracking_number }}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4>Payment Details</h4>
                        <br>
                        @if ($order->status != 0)
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Sender Name</th>
                                <td>{{ $order->payment->name }}</td>
                            </tr>
                            <tr>
                                <th>Destination Bank</th>
                                <td>{{ $order->payment->transfer_to }}</td>
                            </tr>
                            <tr>
                                <th>Transfer Date</th>
                                <td>{{ $order->payment->transfer_date }}</td>
                            </tr>
                            <tr>
                                <th>Proof of payment</th>
                                <td><a target="_blank" href="{{ asset('/payment/' . $order->payment->proof) }}">View</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{!! $order->payment->status_label !!}</td>
                            </tr>
                        </table>
                        @else
                        <h5 class="text-center">Not Confirmed Payment</h5>
                        @endif
                    </div>
                    <br>
                    <div class="col-12">
                        <h4>Product Details</h4> <br>
                        <div class="table-responsive">
                            <table class="table table-borderd table-hover">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Weight</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                </tr>
                                @foreach ($order->details as $row)
                                <tr>
                                    <td>{{ $row->product->name }}</td>
                                    <td>{{ $row->qty }}</td>
                                    <td>Rp {{ number_format($row->price) }}</td>
                                    <td>{{ $row->weight }}</td>
                                    <td>Rp {{ $row->qty * $row->price }}</td>
                                    <td>Rp {{ $row->price + $order->cost }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection