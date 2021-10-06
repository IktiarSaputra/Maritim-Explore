@extends('layouts.sbadmin')

@section('title')
    Dashboard
@endsection

@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Informasi</h1>
        <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Back to Home</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Belum di Bayar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($orders[0]->pending) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dalam Proses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders[0]->process }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-loading fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dikirim
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders[0]->shipping }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders[0]->completeOrder }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        {{-- <div class="col-12 col-lg-3 bg-white pl-0 pr-0">
            <div class="card profile">
                <div class="background-block">
                    <img src="{{asset('front/image/bg-profile-user.jpg')}}" alt="Banner" class="background">
                </div>
                <div class="profile-thumb-block">
                    <img src="{{asset('front/image/about/dewa.svg')}}" alt="Profile Image" class="profile">
                </div>
                <div class="card-content">
                    <h2>Adityawarman<small>User</small></h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 pt-3 bg-white">
            <div class="d-flex flex-warp justify-content-between"><p><span class="icon-user mr-2 text-primary"></span>Nama Lengkap</p><p id="status">Adityawarman</p></div>
            <div class="d-flex flex-warp justify-content-between"><p><span class="icon-envelope-o mr-2 text-primary"></span>Email</p><p id="status">142</p></div>
            <div class="d-flex flex-warp justify-content-between"><p><span class="icon-phone mr-2 text-primary"></span>No Telepon</p><p id="status">1.000 Pengikut</p></div>
            <div class="d-flex flex-warp justify-content-between"><p><span class="icon-user-check mr-2 text-primary"></span>Bergabung</p><p id="status">26 Maret 2021</p></div>
        </div>
        <div class="col-12 col-lg-6 pt-3 bg-white">
        <div class="d-flex flex-warp justify-content-between"><p><span class="icon-location mr-2 text-primary"></span></span>Alamat</p><p id="status">25 Maret 2021</p></div>
            <div class="d-flex flex-warp justify-content-between"><p><span class="icon-location mr-2 text-primary"></span></span>Provinsi</p><p id="status">25 Maret 2021</p></div>
            <div class="d-flex flex-warp justify-content-between"><p><span class="icon-location mr-2 text-primary"></span></span>Kabupaten</p><p id="status">25 Maret 2021</p></div>
            <div class="d-flex flex-warp justify-content-between"><p><span class="icon-location mr-2 text-primary"></span></span>Kecamatan</p><p id="status">25 Maret 2021</p></div>
        </div> --}}
    </div>
@endsection