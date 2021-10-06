@extends('layouts.sbadmin')

@section('title')
List Pesanan
@endsection

@section('css')
<link href="{{ asset('/sb/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Pesanan</h6>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Penerima</th>
                        <th>No Telp</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $row)
                    <tr>
                        <td><b>{{  $row->invoice  }}</b></td>
                        <td>{{  $row->customer_name  }}</td>
                        <td>{{  $row->customer_phone  }}</td>
                        <td>{{ number_format($row->total) }}</td>
                        <td>{!! $row->status_label !!}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            <form action="{{ route('customer.order_accept') }}" class="form-inline"
                                onsubmit="return confirm('Kamu Yakin?');" method="post">
                                @csrf

                                <!-- TOMBOL VIEW ORDER KITA BUNGKUS JG DENGAN FORM AGAR RAPI -->
                                <a href="{{ route('customer.view_order', $row->invoice) }}"
                                    class="btn btn-primary btn-sm mr-1">Detail</a>

                                <input type="hidden" name="order_id" value="{{ $row->id }}">
                                @if ($row->status == 3)
                                <button class="btn btn-success btn-sm mr-1">Terima</button>
                                <!-- TOMBOL RETURN AKAN DITEMPATKAN DISINI PADA SUB-BAB SELANJUTNYA -->
                                <a href="{{ route('customer.order_return', $row->invoice) }}"
                                    class="btn btn-danger btn-sm">Return</a>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{ asset('/sb/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/sb/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/sb/js/demo/datatables-demo.js') }}"></script>

@endsection