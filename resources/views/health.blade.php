<!-- Copyright 2021 All Rights Reserved by RPL SMKN 1 JAKARTA -->
<!-- Author/Pembuat   : RPL SMKN 1 JAKARTA -->
<!-- Dibuat           : 19/02/2021 -->

<!DOCTYPE html>
<html id="home" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('front/icon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('front/icon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('front/icon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('front/icon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('front/icon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Maritime Explore | healthy</title>

    <!-- CSS -->
    <link href="{{asset('front/css/healthy/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/healthy/mobile-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/healthy/tablet-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/healthy/desktop-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/framework/aos.css')}}" rel="stylesheet">
    <link href="{{asset('front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('asset/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <style>
        #container {
            margin: 0 auto;
        }

        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }
    </style>

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('front/js/jquery.js')}}"></script>
    <script src="{{asset('front/js/scroll-trigger.js')}}"></script>
    <script src="{{asset('asset/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('asset/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('asset/demo/datatables-demo.js')}}"></script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>
</head>

<body>

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/"><img src="{{asset('/front/image/logo.png')}}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            id="nav-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" id="nav-hom" href="/">Home</a>
                    <div class="retangle"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-product" href="{{route('front.product')}}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-about" href="{{route('about')}}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-contact" href="#contact">Contact</a>
                </li>
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}"><button id="button">Sign Up</button></a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        @if (Auth::user()->level == 'admin')
                            <a href="{{ route('dashboard.admin') }}" class="dropdown-item">Dashboard</a>
                        @elseif(Auth::user()->level == 'seller')
                            <a href="{{ route('dashboard.seller') }}" class="dropdown-item">Dashboard</a>
                        @elseif(Auth::user()->level == 'owner')
                            <a href="{{ route('owner.home') }}" class="dropdown-item">Dashboard</a>
                        @else
                            <a href="{{ route('home') }}" class="dropdown-item">Dashboard</a>
                        @endif

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="menu-overlay"> &nbsp;</div>

    <!-- Covid -->
    <div class="covid container-fluid">
        <h2 class="text-center font-weight-bold" data-aos="fade-up" data-aos-duration="1000"
            data-aos-anchor-placement="top-center">Perkembangan Covid-19 Di Indonesia</h2><br>
        <div id="container"></div>
        <div class="container">
            <div class="row">
                <div class="col col-lg-2 text-center"><br>
                    <b>{{number_format ($covid['deaths']['value'])}}</b><br>
                    <span>Kematian</span><br>
                </div>
                <div class="col-md-auto text-center">
                    <b>{{number_format ($covid['recovered']['value'])}}</b><br>
                    <span>Sembuh</span><br>
                </div>
                <div class="col col-lg-2 text-center"><br>
                    <b>{{number_format ($covid['confirmed']['value'])}}</b><br>
                    <span>Positif</span><br>
                </div>
            </div>
        </div>
    </div>

    <!-- 3M Covid -->
    <div class="container d-flex justify-content-center" id="protokol-3m-covid" data-aos="fade-up"
        data-aos-duration="1000" data-aos-anchor-placement="bottom-bottom">
        <div class="col-sm-6 d-flex justify-content-end">
            <svg width="254" height="306" viewBox="0 0 254 306" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="svg">
                    <path id="Vector"
                        d="M126.9 303C69.8543 303 23.5171 257.737 23.5171 201.686V84.0918H230.283V201.637C230.333 257.541 184.096 303 126.9 303Z"
                        fill="#FFF1E5" />
                    <path id="Vector_2"
                        d="M126.9 289.024C69.8543 289.024 23.5171 243.762 23.5171 187.71V201.686C23.5171 257.59 69.7042 303 126.9 303C183.946 303 230.283 257.738 230.283 201.686V187.71C230.333 243.565 184.096 289.024 126.9 289.024Z"
                        fill="#FFD7CF" />
                    <path id="Vector_3"
                        d="M126.9 303C69.8543 303 23.5171 257.737 23.5171 201.686V84.0918H230.283V201.637C230.333 257.541 184.096 303 126.9 303Z"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path id="Vector_4"
                        d="M231.134 95.8121C230.784 90.3689 230.484 84.7294 230.333 79.2861C161.528 82.4736 92.3727 82.0323 23.7176 76.0986C23.2171 82.3756 22.9169 88.6035 22.4165 94.8804C25.519 97.6266 28.8216 100.52 31.9241 103.217C34.5262 104.492 37.979 106.257 41.0815 107.876C54.8425 114.937 74.0079 123.911 92.3727 127.442C99.0781 128.717 106.134 129.355 113.34 129.207C144.314 128.864 170.385 116.85 181.344 111.848C182.995 111.063 184.296 110.426 185.097 110.229C185.748 109.886 186.398 109.739 187.399 109.739C189.351 109.739 191.652 110.229 194.455 110.72C198.058 111.504 202.311 112.338 207.065 111.995C212.469 111.652 217.373 110.082 222.127 106.993C224.929 103.217 228.032 99.5391 231.134 95.8121Z"
                        fill="#FFD7CF" />
                    <g id="Group" opacity="0.34">
                        <path id="Vector_5" opacity="0.34" d="M23.5173 149.46H12.0581V160.053H23.5173V149.46Z"
                            fill="#231A17" />
                        <path id="Vector_6" opacity="0.34" d="M241.793 149.46H230.333V160.053H241.793V149.46Z"
                            fill="#231A17" />
                    </g>
                    <path id="rambut"
                        d="M181.343 25.0004C181.343 25.0004 98.5766 -28.4516 30.1217 31.2773C17.3614 42.36 12.2573 58.2485 12.2573 72.862V160.053H23.7165V103.854C23.7165 99.6861 26.6689 96.4496 30.2718 96.4496C36.1765 96.4496 68.1022 113.172 95.1739 117.83C135.957 124.745 173.187 106.257 181.193 103.56C194.954 98.7544 206.113 115.427 223.477 96.6457H224.127C227.73 96.6457 230.683 100.029 230.683 104.051V160.249H242.092V73.3524C241.792 54.3745 219.474 6.85614 181.343 25.0004Z"
                        fill="#FF9376" />
                    <path id="Vector_7"
                        d="M181.343 25.0004C181.343 25.0004 98.5766 -28.4516 30.1217 31.2773C17.3614 42.36 12.2573 58.2485 12.2573 72.862V160.053H23.7165V103.854C23.7165 99.6861 26.6689 96.4496 30.2718 96.4496C36.1765 96.4496 68.1022 113.172 95.1739 117.83C135.957 124.745 173.187 106.257 181.193 103.56C194.954 98.7544 206.113 115.427 223.477 96.6457H224.127C227.73 96.6457 230.683 100.029 230.683 104.051V160.249H242.092V73.3524C241.792 54.3745 219.474 6.85614 181.343 25.0004Z"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path id="Vector_8" d="M111.337 77.1774C111.337 77.1774 22.5158 82.8168 3.70068 36.5735"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path id="Vector_9" d="M123.947 66.0947C123.947 66.0947 38.4283 60.7985 16.1104 14.5552"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path id="Vector_10"
                        d="M230.333 147.548V200.215C241.793 200.215 251 188.495 251 173.882C250.95 159.268 241.793 147.548 230.333 147.548Z"
                        fill="#FFF1E5" />
                    <path id="Vector_11"
                        d="M230.333 150.441V197.175C237.039 192.86 241.643 183.984 241.643 173.734C241.643 163.583 237.039 154.757 230.333 150.441Z"
                        fill="#FFD7CF" />
                    <path id="Vector_12"
                        d="M230.333 147.548V200.215C241.793 200.215 251 188.495 251 173.882C250.95 159.268 241.793 147.548 230.333 147.548Z"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path id="Vector_13"
                        d="M23.6674 147.548V200.215C12.2082 200.215 3.0008 188.495 3.0008 173.882C2.90072 159.268 12.2082 147.548 23.6674 147.548Z"
                        fill="#FFF1E5" />
                    <path id="Vector_14"
                        d="M23.6677 151.373C17.763 156.031 13.6597 164.368 13.6597 173.832C13.6597 183.297 17.6128 191.633 23.6677 196.292V151.373Z"
                        fill="#FFD7CF" />
                    <path id="Vector_15"
                        d="M23.6674 147.548V200.215C12.2082 200.215 3.0008 188.495 3.0008 173.882C2.90072 159.268 12.2082 147.548 23.6674 147.548Z"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path id="Vector_16"
                        d="M122.647 190.407L115.742 212.426C115.742 214.829 123.748 212.916 131.955 214.829"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path id="Vector_17" d="M161.328 231.502C163.78 248.224 141.812 262.984 124.648 259.944"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <g id="mata-kiri">
                        <path id="Vector_18"
                            d="M89.721 171.773C93.5348 171.773 96.6265 168.545 96.6265 164.564C96.6265 160.583 93.5348 157.355 89.721 157.355C85.9071 157.355 82.8154 160.583 82.8154 164.564C82.8154 168.545 85.9071 171.773 89.721 171.773Z"
                            stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path id="Vector_19"
                            d="M89.721 171.773C93.5348 171.773 96.6265 168.545 96.6265 164.564C96.6265 160.583 93.5348 157.355 89.721 157.355C85.9071 157.355 82.8154 160.583 82.8154 164.564C82.8154 168.545 85.9071 171.773 89.721 171.773Z"
                            fill="#441A36" />
                    </g>
                    <path id="alis-kiri"
                        d="M65.9512 149.313C69.4039 145.292 77.4104 142.546 86.918 142.546C94.4741 142.546 101.029 144.311 105.083 147.057"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <g id="mata-kanan">
                        <path id="Vector_20"
                            d="M165.081 171.773C168.895 171.773 171.986 168.545 171.986 164.564C171.986 160.583 168.895 157.355 165.081 157.355C161.267 157.355 158.175 160.583 158.175 164.564C158.175 168.545 161.267 171.773 165.081 171.773Z"
                            stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path id="Vector_21"
                            d="M165.081 171.773C168.895 171.773 171.986 168.545 171.986 164.564C171.986 160.583 168.895 157.355 165.081 157.355C161.267 157.355 158.175 160.583 158.175 164.564C158.175 168.545 161.267 171.773 165.081 171.773Z"
                            fill="#441A36" />
                    </g>
                    <path id="alis-kanan"
                        d="M188.85 149.313C185.397 145.292 177.39 142.546 167.883 142.546C160.327 142.546 153.772 144.311 149.718 147.057"
                        stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <g id="masker">
                        <path id="Vector_22"
                            d="M205.563 222.626C205.563 213.75 205.563 204.923 205.563 196.047C153.221 191.633 100.479 191.633 48.1367 196.047C48.1367 204.923 48.1367 213.75 48.1367 222.626C48.1367 259.454 83.365 289.318 126.85 289.318C170.335 289.318 205.563 259.503 205.563 222.626Z"
                            fill="#A4FCEF" />
                        <path id="Vector_23"
                            d="M205.563 222.626C205.563 213.75 205.563 204.923 205.563 196.047C153.221 191.633 100.479 191.633 48.1367 196.047C48.1367 204.923 48.1367 213.75 48.1367 222.626C48.1367 259.454 83.365 289.318 126.85 289.318C170.335 289.318 205.563 259.503 205.563 222.626Z"
                            fill="#21A8FB" fill-opacity="0.73" />
                        <path id="Vector_24"
                            d="M126.849 266.417C83.3645 266.417 48.1362 242.339 48.1362 212.622C48.1362 215.957 48.1362 219.34 48.1362 222.675C48.1362 259.503 83.3645 289.367 126.849 289.367C170.334 289.367 205.563 259.503 205.563 222.626C205.563 219.291 205.563 215.908 205.563 212.573C205.563 242.29 170.334 266.417 126.849 266.417Z"
                            fill="#21A8FB" fill-opacity="0.73" />
                        <path id="Vector_25" opacity="0.43"
                            d="M205.563 206.982C153.171 202.569 100.478 202.569 48.1362 206.982" stroke="white"
                            stroke-width="6" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path id="Vector_26"
                            d="M205.563 222.626C205.563 213.75 205.563 204.923 205.563 196.047C153.221 191.633 100.479 191.633 48.1367 196.047C48.1367 204.923 48.1367 213.75 48.1367 222.626C48.1367 259.454 83.365 289.318 126.85 289.318C170.335 289.318 205.563 259.503 205.563 222.626Z"
                            stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path id="Vector_27"
                            d="M67.1519 221.351C79.0614 227.138 101.329 231.012 126.85 231.012C152.37 231.012 174.638 227.138 186.548 221.351"
                            stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path id="Vector_28"
                            d="M73.7568 248.567C84.3654 254.354 104.181 258.228 126.849 258.228C149.518 258.228 169.384 254.354 179.942 248.567"
                            stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path id="Vector_29"
                            d="M205.563 196.096L230.283 149.46V200.215C230.283 200.215 220.575 229.589 199.358 248.567"
                            stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path id="Vector_30"
                            d="M48.4371 196.096L23.7173 149.46V200.215C23.7173 200.215 33.4251 229.589 54.6421 248.567"
                            stroke="#441A36" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                </g>
            </svg>
        </div>
        <div class="col-sm-6">
            <h2>#PAKAIMASKER</h2>
            <h2>#MENJAGAJARAK</h2>
            <h2>#CUCITANGAN</h2>
        </div>
    </div>

    <!-- Rumah Sakit Rujukan -->
    <div class="container-fluid" id="rumah-sakit">
        <h2 class="mb-5">Daftar Rumah Sakit Rujukan</h2>

        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($rujukan as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['address']}} <br> {{$item['region']}} <br> {{$item['province']}}</td>
                        <td>{{$item['phone']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>

        
    </div>

<!-- Footer -->
<div class="footer container-fluid d-flex flex-wrap" id="contact">
        <div class="col-sm-5">
            <img src="{{asset('front/image/logo-footer-desktop.png')}}" alt="footer-logo">
            <img src="{{asset('front/image/logo-footer.png')}}" alt="footer-logo">
        </div>
        <div class="col">
            <h3>Overview</h3>
            <p><a href="/desa">Desa Binaan</a></p>
            <p><a href="/kependudukan">Kependudukan</a></p>
        </div>
        <div class="col">
            <h3>Careers</h3>
            <p><a href="#">For Developer</a></p>
            <p><a href="#">Privacy Policy</a></p>
        </div>
        <div class="col pr-5">
            <h3>Contact</h3>
            <p><a href="#">+62 822 9948 3926</a></p>
            <p><a href="#">hackathonmaritim@gmail.com</a></p>
        </div>
        <div class="col">
            <h3>Social Media</h3>
            <div class="d-flex">
                <p><a href="https://youtube.com/channel/UCEyEKkFMKyGk5OeJ12lb3ww" target="_blank"><img
                            src="{{asset('front/image/youtube.svg')}}" alt="Youtube"></a></p>
                <p><a href="https://instagram.com/maritimeexplore?igshid=1bjcmmwvcgwez" target="_blank"><img
                            src="{{asset('front/image/instagram.svg')}}" alt="Instagram"></a></p>
                <p><a href="https://www.facebook.com/Maritime-Explore-102640988593336" target="_blank"><img src="{{asset('front/image/facebook.svg')}}" alt="Facebook"></a></p>
            </div>
        </div>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <h5>Overview</h5>
                        <span class="icon-chevron-thin-down font-weight-bold"></span>
                    </button>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <p><a href="/desa" target="_blank">Desa Binaan</a></p>
                        <p><a href="/kependudukan" target="_blank">Kependudukan</a></p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        <h5>Careers</h5>
                        <span class="icon-chevron-thin-down font-weight-bold"></span>
                    </button>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <p><a href="#" target="_blank">For Developer</a></p>
                        <p><a href="#" target="_blank">Privacy Policy</a></p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="false" aria-controls="collapseThree">
                        <h5>Contact</h5>
                        <span class="icon-chevron-thin-down font-weight-bold"></span>
                    </button>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <p><a href="#" target="_blank">+62 822 9948 3926</a></p>
                        <p><a href="#" target="_blank">hackathonmaritim@gmail.com</a></p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="false" aria-controls="collapseFour">
                        <h5>Social Media</h5>
                        <span class="icon-chevron-thin-down font-weight-bold"></span>
                    </button>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        <div class="d-flex">
                            <p><a href="https://youtube.com/channel/UCEyEKkFMKyGk5OeJ12lb3ww" target="_blank"><img
                                        src="{{asset('front/image/youtube.svg')}}" alt="Youtube"></a></p>
                            <p><a href="https://instagram.com/maritimeexplore?igshid=1bjcmmwvcgwez" target="_blank"><img
                                        src="{{asset('front/image/instagram.svg')}}" alt="Instagram"></a></p>
                            <p><a href="https://www.facebook.com/Maritime-Explore-102640988593336" target="_blank"><img src="{{asset('front/image/facebook.svg')}}"
                                        alt="Facebook"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright d-flex justify-content-center">
        <span>Copyright 2021. All Rights Reserved Design by RPL SMKN 1 JAKARTA</span>
    </div>

</body>

</html>
<script type="text/javascript">
    $("#nav-contact").click(function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#contact").offset().top
        }, 1000);
    });
</script>
<script>
    AOS.init();
</script>
<script>
    $('#nav-toggler').on('click', function() {
    $navMenuCont = $($(this).data('target'));
    $navMenuCont.animate({
      'width': 'toggle'
    }, 350);
    $(".menu-overlay").fadeIn(500);
  
  });
  $(".menu-overlay").click(function(event) {
    $(".navbar-toggler").trigger("click");
    $(".menu-overlay").fadeOut(500);
});
</script>
<script>
    jQuery(document).ready(function () {
        jQuery('#basic-data-table').DataTable({
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script>
    var data = [
    ['id-3700', 0],
    ['id-ac', {!!json_encode($aceh)!!}],
    ['id-jt', {!!json_encode($jateng)!!}],
    ['id-be', {!!json_encode($bengkulu)!!}],
    ['id-bt', {!!json_encode($banten)!!}],
    ['id-kb', {!!json_encode($kalbar)!!}],
    ['id-bb', {!!json_encode($bangka)!!}],
    ['id-ba', {!!json_encode($bali)!!}],
    ['id-ji', {!!json_encode($jatim)!!}],
    ['id-ks', {!!json_encode($kalsel)!!}],
    ['id-nt', {!!json_encode($ntt)!!}],
    ['id-se', {!!json_encode($sulsel)!!}],
    ['id-kr', {!!json_encode($kepriau)!!}],
    ['id-ib', {!!json_encode($papuabarat)!!}],
    ['id-su', {!!json_encode($sumut)!!}],
    ['id-ri', {!!json_encode($riau)!!}],
    ['id-sw', {!!json_encode($sulut)!!}],
    ['id-ku', {!!json_encode($kalut)!!}],
    ['id-la', {!!json_encode($malut)!!}],
    ['id-sb', {!!json_encode($sumbar)!!}],
    ['id-ma', {!!json_encode($maluku)!!}],
    ['id-nb', {!!json_encode($ntb)!!}],
    ['id-sg', {!!json_encode($sultenggara)!!}],
    ['id-st', {!!json_encode($sulteng)!!}],
    ['id-pa', {!!json_encode($papua)!!}],
    ['id-jr', {!!json_encode($jabar)!!}],
    ['id-ki', {!!json_encode($kaltim)!!}],
    ['id-1024', {!!json_encode($lampung)!!}],
    ['id-jk', {!!json_encode($jakarta)!!}],
    ['id-go', {!!json_encode($gorontalo)!!}],
    ['id-yo', {!!json_encode($diy)!!}],
    ['id-sl', {!!json_encode($sumsel)!!}],
    ['id-sr', {!!json_encode($sulbar)!!}],
    ['id-ja', {!!json_encode($jambi)!!}],
    ['id-kt', {!!json_encode($kalteng)!!}]
    ];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: 'countries/id/id-all'
        },

        title: {
            text: ''
        },

        subtitle: {
            text: ''
        },

        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },

        colorAxis: {
            min: 1,
            minColor: '#EEEEFF',
            maxColor: '#000022',
            stops: [
                [0, '#FFFFFF'],
                [0.50, '#EC7063'],
                [0.60, '#EC7063'],
                [1, '#C40401']
            ]
        },

        series: [{
            animation: {
            duration: 1000
            },
            data: data,
            name: '',
            states: {
                hover: {
                    color: '#E74C3C'
                }
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }]
    });
</script>