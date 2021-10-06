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
    <link href="{{asset('front/css/cart/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/cart/phone-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/cart/tablet-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('front/js/jquery.js')}}"></script>

</head>

<body>

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/"><img src="{{asset('front/image/logo.png')}}" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            id="nav-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" id="" href="#home">Home</a>
                    <div class="retangle"></div>
                </li>
                <li class="nav-item active">
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
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

    <!-- Breadcrumb -->
    <nav class="container" aria-label="breadcrumb" id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('front.product') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::previous() }}">Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>

    <!-- Content -->
    {!! Form::open(['url' => 'ecommerce/cart/update']) !!}
    <h1 class="text-center">Keranjang</h1>
    <div class="container d-flex flex-wrap" id="content">
        @forelse ($carts as $row)
        <div class="col-sm-12 col-md-3 mb-5" id="">
            <p class="product" id="tittle">Product</p>
            <div class="mb-3" id="hr"></div>
            <div class="d-flex">
                <img src="{{asset('/products/' . $row->associatedModel->image)}}" alt="{{ $row->name }}" width="130px">
                <h2 class="d-flex align-items-center justify-content-center text-center w-100">{{ $row->name }}</h2>
            </div>
        </div>

        <div class="col-sm-6 col-md-3" id="col">
            <p id="tittle">Price</p>
            <div class="mb-3" id="hr"></div>
            <h3 class="text-center" id="rem3">Rp {{ number_format($row->price) }}</h3>
        </div>

        <div class="col-sm-6 col-md-1 quantity" id="col">
            <p id="tittle">Quantity</p>
            <div class="mb-3" id="hr"></div>
            {!! Form::number('items['. $row->id .'][quantity]', $row->quantity, ['min' => 1,
            'required' => true],['class' => 'form-control']) !!}
        </div>

        <div class="col-md-3" id="col">
            <p id="tittle">Total</p>
            <div class="mb-3" id="hr"></div>
            <h3 class="text-center" id="rem3">Rp {{ number_format($row->price * $row->quantity) }}</h3>
        </div>

        <div class="col-md-2 text-center" id="col">
            <p id="tittle">Opsi</p>
            <div class="mb-3" id="hr"></div>
            <a href="/ecommerce/cart/{{$row->id}}" class="btn btn-danger"><span class="icon-close"></span></a>
        </div>
        @empty

        <center>
            <h6>Saat ini cart anda masih kosong</h6>
        </center>

        @endforelse

        <div class="row w-100">
            <div class="col-sm-7">
                @if (!$carts->isEmpty())
                <button type="submit" class="btn btn-secondary">Perbarui</button>
                @else
                
                @endif
            </div>
            <div class="col-sm-5" id="sub-total">
                <p>Subtotal Rp. {{number_format(\Cart::getSubTotal())}}</p>
            </div>
            <div class="col-sm-7">
            </div>
            <div class="col-sm-5 d-flex-justify">
                <a class="btn btn-info" href="{{ route('front.product') }}">Continue Shopping</a>
                @if (!$carts->isEmpty())
                <a class="btn btn-primary" href="{{ route('front.checkout') }}">Checkout All</a>
                @else
                
                @endif
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
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne"
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
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo"
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
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree"
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
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour"
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
<script type="text/javascript">
    ScrollTrigger.create({
        start: 'top -1',
        end: 99999,
        toggleClass: {
            className: 'nav-bg',
            targets: '.navbar'
        }
    });
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


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="cart_inner">
        {!! Form::open(['url' => 'ecommerce/cart/update']) !!}
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($carts as $row)
                    <tr>
                        <td>
                            <div class="media">
                                <div class="d-flex">
                                    <img src="{{asset('/products/' . $row->associatedModel->image)}}" width="100px"
height="100px" alt="{{ $row->name }}">
</div>
<div class="media-body">
    <p>{{ $row->name }}
    </p>
</div>
</div>
</td>
<td>
    <h5>Rp {{ number_format($row->price) }}
    </h5>
</td>
<td>
    <div class="product_count">
        {!! Form::number('items['. $row->id .'][quantity]', $row->quantity, ['min' => 1,
        'required' => true]) !!}
    </div>
</td>
<td>
    <h5>Rp {{ number_format($row->price * $row->quantity) }}</h5>
</td>
<td>
    <a href="/ecommerce/cart/{{$row->id}}" class="btn btn-danger">Delete</a>
</td>
</tr>
@empty
<tr>
    <td colspan="4">Tidak ada belanjaan</td>
</tr>
@endforelse
<tr class="bottom_button">
    <td>
        <button type="submit" class="gray_btn">Update Cart</button>
    </td>
    <td></td>
    <td></td>
    <td>
        <h5>Subtotal</h5>
    </td>
    <td>
        {{ number_format(\Cart::getSubTotal()) }}
    </td>
</tr>
{!! Form::close() !!}
<tr class="out_button_area">
    <td></td>
    <td></td>
    <td></td>
    <td>
        <div class="checkout_btn_inner">
            <a class="gray_btn" href="{{ route('front.product') }}">Continue Shopping</a>
            <a class="main_btn" href="{{ route('front.checkout') }}">Checkout All</a>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
@endsection --}}