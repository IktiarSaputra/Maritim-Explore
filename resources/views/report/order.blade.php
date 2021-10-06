@extends('layouts.master')

@section('css')
<link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('title')
List Reports Order
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Reports Order
                </h4>
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- FORM UNTUK FILTER BERDASARKAN DATE RANGE -->
                <form action="{{ route('report.order') }}" method="get">
                    <div class="input-group mb-3 col-md-4 float-right">
                        <input type="text" id="created_at" name="date" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit">Filter</button>
                        </div>
                        <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                    </div>
                </form>
                <div class="table-responsive">
                    <!-- TAMPILKAN DATA YANG BERHASIL DIFILTER -->
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>InvoiceID</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $row)
                            <tr>
                                <td><strong>{{ $row->order->invoice }}</strong></td>
                                <td>
                                    <strong>{{ $row->customer_name }}</strong><br>
                                    <label><strong>Telp:</strong> {{ $row->order->customer_phone }}</label><br>
                                    <label><strong>Alamat:</strong>
                                        @if ($row->order->district_id = $row->order->district_id)
                                        {{ $row->order->customer_address }}, {{ $row->order->district->name }} <br>
                                        {{  $row->order->district->city->name}} -
                                        {{ $row->order->district->city->province->name }}
                                        @else
                                        {{ $row->order->customer_address }}
                                        @endif
                                </td>
                                <td>Rp {{ number_format($row->order->subtotal + $row->order->cost) }}</td>
                                <td>{{ $row->order->created_at->format('d-m-Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- KITA GUNAKAN LIBRARY DATERANGEPICKER -->
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
            $('#exportpdf').attr('href', '/seller/reports/order/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //INISIASI DATERANGEPICKER
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                $('#exportpdf').attr('href', '/seller/reports/order/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
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