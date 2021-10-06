@extends('layouts.master')

@section('title')
    Dashboard Admin
@endsection
@section('content')
<div id="toaster"></div>
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">{{\DB::table('users')->count()}}</h2>
                    <p>Total User</p>
                    <div class="chartjs-wrapper">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini  mb-4">
                <div class="card-body">
                    <h2 class="mb-1">{{\DB::table('sellers')->count()}}</h2>
                    <p>Total Seller</p>
                    <div class="chartjs-wrapper">
                        <canvas id="dual-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">{{\DB::table('travel')->count()}}</h2>
                    <p>Total Tourism Objects</p>
                    <div class="chartjs-wrapper">
                        <canvas id="area-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">{{\DB::table('populations')->count()}}</h2>
                    <p>Total Regional</p>
                    <div class="chartjs-wrapper">
                        <canvas id="line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <!-- Recent Order Table -->
            <div class="card card-table-border-none" id="recent-orders">
                <div class="card-header justify-content-between">
                    <h2>Recent Orders</h2>
                </div>
                <div class="card-body pt-0 pb-5">
                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order Invoice</th>
                                <th>Customer Name</th>
                                <th class="d-none d-lg-table-cell">Date</th>
                                <th class="d-none d-lg-table-cell">Subtotal</th>
                                <th class="d-none d-lg-table-cell">Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $row)
                                <tr>
                                    <td>{{ $row->order->invoice }}</td>
                                    <td>
                                        <a class="text-dark"> {{ $row->order->customer_name }}</a>
                                    </td>
                                    <td class="d-none d-lg-table-cell">{{ $row->created_at->format('d M Y') }}</td>
                                    <td class="d-none d-lg-table-cell">Rp. {{ number_format($row->order->subtotal) }}</td>
                                    <td class="d-none d-lg-table-cell">Rp. {{ number_format($row->order->subtotal + $row->order->cost) }}</td>
                                    <td>
                                        {!! $row->order->status_label !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="6" class="text-center">There are no orders available</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-5">
            <!-- New Customers -->
            <div class="card card-table-border-none" data-scroll-height="580">
                <div class="card-header justify-content-between ">
                    <h2>New Customers</h2>
                </div>
                <div class="card-body pt-0">
                    <table class="table ">
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="media-image mr-3 rounded-circle">
                                                <a href="profile.html"><img class="rounded-circle w-45" src="{{$item->getAvatar()}}"
                                                        alt="customer image"></a>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <a href="profile.html">
                                                    <h6 class="mt-0 text-dark font-weight-medium">{{$item->name}}</h6>
                                                </a>
                                                <small>{{$item->email}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->level == 'admin')
                                            <span class="badge badge-success">Admin</span>
                                        @elseif($item->level == 'seller')
                                            <span class="badge badge-primary">Seller</span>
                                        @elseif($item->level == 'owner')
                                            <span class="badge badge-info">Owner</span>
                                        @else
                                            <span class="badge badge-warning">Users</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <!-- Top Products -->
            <div class="card card-default" data-scroll-height="580">
                <div class="card-header justify-content-between mb-4">
                    <h2>Top Products</h2>
                </div>
                <div class="card-body py-0">
                    @forelse ($product as $row)
                        <div class="media d-flex mb-5">
                            <div class="media-image align-self-center mr-3 rounded">
                                <a href="#"><img src="{{ asset('/products/' . $row->image) }}" width="150px" height="100px"
                                        alt="{{$row->name}}"></a>
                            </div>
                            <div class="media-body align-self-center">
                                <a href="#">
                                    <h6 class="mb-3 text-dark font-weight-medium">{{$row->name}}</h6>
                                </a>
                                <p class="d-none d-md-block">{!!$row->description!!}</p>
                                <p class="mb-0">
                                    <span class="text-dark">Rp. {{number_format($row->price)}}</span>
                                </p>
                            </div>
                        </div>
                    @empty
                        <span class="text-center">There are no top products at this time</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection