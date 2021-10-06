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
    <title>Maritime Explore</title>

    <!-- CSS -->
    <link href="{{asset('front/css/profile-toko/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/profile-toko/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>
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
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
    <script src="{{asset('front/js/jquery.js')}}"></script>

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
                    <a class="nav-link" id="nav" href="/">Home</a>
                    <div class="retangle"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-product" href="{{route('front.product')}}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-about" href="#about">About Us</a>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
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

    <!-- Content -->
    <div class="container" id="content">
        <div class="row" id="profile">
            <div class="col-3 col-md-3 col-lg-1">
                <img src="{{$user->getAvatar()}}" width="100%">
            </div>
            <div class="col-9 col-md-9 col-lg-2">
                <p class="ml-2" id="name">{{ $user->seller->shop_name }}</p>
                <p id="pemilik" class="text-primary ml-2">Pemilik: {{ $user->name }}</p>
                <span class="ml-2" id="location">Jakarta</span>
            </div>
            <div class="col-md-12 col-lg-3" id="info">
                <div class="d-flex flex-warp justify-content-between">
                    <p><span class="icon-chat mr-2 text-primary"></span>Terakhir Online</p>
                    <p id="status">
                        @if(Cache::has('is_online' . $user->id))
                        <span class="text-success">Online</span>
                        @else
                        <span class="text-secondary">Offline
                            {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                        @endif
                    </p>
                </div>
                <div class="d-flex flex-warp justify-content-between">
                    <p><span class="icon-box mr-2 text-primary"></span>Jumlah Produk</p>
                    <p id="status">{{ $user->product->count() }}</p>
                </div>
                <div class="d-flex flex-warp justify-content-between">
                    <p><span class="icon-handshake-o mr-2 text-primary"></span>Bergabung</p>
                    <p id="status">{{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
            <div class="col-md-12 col-lg-4" id="info2">
                <div class="">
                    <p class="font-weight-bold"><span class="icon-location mr-2 text-primary"></span>Alamat</p>
                    <p>
                        @if ($user->district_id = $user->district_id)
                        {{ $user->address }}, {{ $user->district->name }}
                        {{ $user->district->city->name }}
                        {{ $user->district->city->province->name }}
                        @else
                        {{ $user->address }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-md-12 col-lg-2 text-center" id="tindakan">
                <a class="text-danger" href="#" id="laporkan">Laporkan Toko</a>
            </div>
        </div><br>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-deskripsi-tab" data-toggle="pill" href="#pills-deskripsi"
                    role="tab" aria-controls="pills-deskripsi" aria-selected="true">Deskripsi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-produk-tab" data-toggle="pill" href="#pills-produk" role="tab"
                    aria-controls="pills-produk" aria-selected="false">Produk</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-deskripsi" role="tabpanel"
                aria-labelledby="pills-deskripsi-tab">
                <p>{!! $user->seller->description !!}</p>
            </div>
            <div class="tab-pane fade" id="pills-produk" role="tabpanel" aria-labelledby="pills-produk-tab">
                <div class="card-deck d-flex flex-wrap overflow-hidden justify-content-center mt-1">
                    @foreach ($user->product as $row)
                    <a href="{{ url('ecommerce/product/' . $row->slug) }}">
                        <div class="card" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-anchor-placement="top-center">
                            <img class="card-img-top" src="{{ asset('products/' . $row->image) }}"
                                alt="{{ $row->name }}">
                            <div class="card-body">
                                <h1>{{ $row->name }}</h1>
                                <p class="price mb-0">Rp. {{ $row->price }}</p>
                                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5"
                            data-step="0.1" value="{{ $row->averageRating }}" data-size="xs" disabled="">
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
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
    $("#nav-contact").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#contact").offset().top
        }, 1000);
    });
</script>
<script>
    AOS.init();
</script>
<script>
    $('#nav-toggler').on('click', function () {
        $navMenuCont = $($(this).data('target'));
        $navMenuCont.animate({
            'width': 'toggle'
        }, 350);
        $(".menu-overlay").fadeIn(500);

    });
    $(".menu-overlay").click(function (event) {
        $(".navbar-toggler").trigger("click");
        $(".menu-overlay").fadeOut(500);
    });
</script>
<script>
    var tabEl = document.querySelector('button[data-bs-toggle="tab"]')
    tabEl.addEventListener('shown.bs.tab', function (event) {
        event.target // newly activated tab
        event.relatedTarget // previous active tab
    })
</script>