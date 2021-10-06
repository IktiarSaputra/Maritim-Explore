@extends('layouts.master')

@section('title')
    List Reports Return
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Reports Return
                    </h4>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
    
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
    
                    <form action="{{ route('report.return') }}" method="get">
                        <div class="input-group mb-3 col-md-4 float-right">
                            <input type="text" id="created_at" name="date" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit">Filter</button>
                            </div>
                            <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>InvoiceID</th>
                                    <th>Pelanggan</th>
                                    <th>Subtotal</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $row)
                                <tr>
                                    <td><strong>{{ $row->order->invoice }}</strong></td>
                                    <td>
                                        <strong>{{ $row->order->customer_name }}</strong><br>
                                        <label><strong>Telp:</strong> {{ $row->customer_phone }}</label><br>
                                        <label><strong>Alamat:</strong>
                                            @if ($row->order->district_id = $row->order->district_id)
                                            {{ $row->order->customer_address }}, {{ $row->order->district->name }} <br>
                                            {{  $row->order->district->city->name}} -
                                            {{ $row->order->district->city->province->name }}
                                            @else
                                            {{ $row->order->customer_address }}
                                            @endif
                                    </td>
                                    <td>Rp {{ number_format($row->subtotal) }}</td>
                                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
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

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function() {
                let start = moment().startOf('month')
                let end = moment().endOf('month')
    
                $('#exportpdf').attr('href', '/seller/reports/return/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))
    
                $('#created_at').daterangepicker({
                    startDate: start,
                    endDate: end
                }, function(first, last) {
                    $('#exportpdf').attr('href', '/seller/reports/return/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
                })
            })
    </script>
@endsection