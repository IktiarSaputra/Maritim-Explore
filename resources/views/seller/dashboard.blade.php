@extends('layouts.master')

@section('css')
<link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('title')
Dashboard Seller
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>Recent Orders</h2>

            </div>

            <div class="card-body">
                @if (session('success'))
                <!-- MAKA TAMPILKAN ALERT SUCCESS -->
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <!-- KETIKA ADA SESSION ERROR  -->
                @if (session('error'))
                <!-- MAKA TAMPILKAN ALERT DANGER -->
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>InvoiceID</th>
                                <th>Customer</th>
                                <th>Subtotal</th>
                                <th>Date</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $row)
                            <tr>
                                <td><strong>{{ $row->order->invoice }}</strong></td>
                                <td>
                                    <strong>Name :</strong> {{ $row->order->customer_name }} <br>
                                    <label><strong>Telp:</strong> {{ $row->order->customer_phone }}</label><br>
                                </td>
                                <td>Rp {{ number_format($row->order->subtotal) }}</td>
                                <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($row->order->district_id = $row->order->district_id)
                                    {{ $row->order->customer_address }}, {{ $row->order->district->name }} <br>
                                    {{  $row->order->district->city->name}} -
                                    {{ $row->order->district->city->province->name }}
                                    @else
                                    {{ $row->customer_address }}
                                    @endif
                                </td>
                                <td>{!! $row->order->status_label !!}</td>
                                <td>
                                    <form action="{{ route('orders.destroy', $row->order->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('orders.view', $row->order->invoice) }}" class="btn btn-warning btn-sm">Lihat</a>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('admin/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>

<script>
    jQuery(document).ready(function () {
        jQuery('#basic-data-table').DataTable({
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
        });
    });
</script>
@endsection