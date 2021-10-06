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
    <link href="{{asset('front/css/checkout/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/checkout/phone-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/checkout/tablet-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/checkout/desktop-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>

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
                    <a class="nav-link" id="nav-home" href="#home">Home</a>
                    <div class="retangle"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-features" href="#features">Features</a>
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

    <!-- Breadcrumb -->
    <nav class="container" aria-label="breadcrumb" id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('front.product') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ URL::previous() }}">Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>

    <h1 class="text-center">Checkout Payment</h1>

    <!-- Content -->
    <div id="content" class="container d-flex flex-wrap">
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div id="checkout1" class="col-md-6">
            <div class="mobile-grey">
                <p class="mb-5">Transfer Pembayaran</p>
                @foreach ($carts as $cart)
                <p>{{ \Str::limit($cart->name) }} x {{ $cart->quantity }} Rp. {{ number_format($cart->price) }}</p>
                @endforeach
                <p>Sub Total : Rp. {{ number_format(\Cart::getSubTotal()) }}</p>
                <p>Biaya Pengiriman :
                    <span id="ongkir">Rp. 0</span>
                </p>
                <p id="total" class="mt-5">Total : Rp. {{ number_format(\Cart::getTotal()) }}</p>
            </div>
        </div>
        <div id="checkout2" class="col-md-6">
            <form action="{{ route('front.store_checkout') }}" method="post" novalidate="novalidate">
                @csrf
                <input type="hidden" name="seller_id" value="{{ Auth::user()->id }}">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ Auth::user()->email }}" id="email" readonly required>
                <p class="text-danger">{{ $errors->first('email') }}</p>

                <label for="nama">Nama Penerima</label>
                <input type="text" name="customer_name" value="{{ Auth::user()->name }}" id="nama" required>
                <p class="text-danger">{{ $errors->first('customer_name') }}</p>

                <label for="no-telepon">No Telepon</label>
                <input type="text" name="customer_phone" id="no-telepon" value="{{ Auth::user()->phone_number }}" required>
                <p class="text-danger">{{ $errors->first('customer_phone') }}</p>

                <label for="alamat">Alamat</label>
                <input type="text" name="customer_address" id="alamat" required>
                <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                <label for="">Propinsi</label>
                <div class="">
                    <select class="form-control" name="province_id" id="province_id" required>
                        <option value="">Pilih Propinsi</option>
                        @foreach ($provinces as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <span class="icon-chevron-thin-down font-weight-bold"></span>
                </div>
                <p class="text-danger">{{ $errors->first('province_id') }}</p>
                <label for="">Kabupaten / Kota</label>
                <div class="">
                    <select class="form-control" name="city_id" id="city_id" required>
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                    <span class="icon-chevron-thin-down font-weight-bold"></span>
                </div>
                <p class="text-danger">{{ $errors->first('city_id') }}</p>
                <label for="">Kecamatan</label>
                <div class="">
                    <select class="form-control" name="district_id" id="district_id" required>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    <span class="icon-chevron-thin-down font-weight-bold"></span>
                </div>
                <p class="text-danger">{{ $errors->first('district_id') }}</p>
                <label for="">Kurir</label>
                <input type="hidden" name="weight" id="weight" value="{{$weight}}">
                <input type="hidden" name="origin" id="origin" value="{{$origin}}">
                <div class="">
                    <select class="form-control" name="courier" id="courier" required>
                        <option value="">Pilih Kurir</option>
                    </select>
                    <span class="icon-chevron-thin-down font-weight-bold"></span>
                </div>
                <p class="text-danger">{{ $errors->first('courier') }}</p>
                <br><br>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn" id="confirm">Confirm Payment</button>
    </div>
    <div class="text-center">
        <button id="cancel" class="btn"><a href="">Cancel</a></button>
    </div>

    </form>

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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
    window.jQuery || document.write('<script src="{{asset('
        front / assets / js / vendor / jquery.slim.min.js ')}}"><\/script>')
</script>
<script src="{{asset('/front/assets/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('ecommerce/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('ecommerce/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ecommerce/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('ecommerce/vendors/counter-up/jquery.counterup.js') }}"></script>
<script>
    $('#province_id').on('change', function () {
        $.ajax({
            url: "{{ url('/api/city') }}",
            type: "GET",
            data: {
                province_id: $(this).val()
            },
            success: function (html) {

                $('#city_id').empty()
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function (key, item) {
                    $('#city_id').append('<option value="' + item.id + '">' + item.name +
                        '</option>')
                })
            }
        });
    })

    $('#city_id').on('change', function () {
        $.ajax({
            url: "{{ url('/api/district') }}",
            type: "GET",
            data: {
                city_id: $(this).val()
            },
            success: function (html) {
                $('#district_id').empty()
                $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                $.each(html.data, function (key, item) {
                    $('#district_id').append('<option value="' + item.id + '">' + item
                        .name + '</option>')
                })
            }
        });
    })

    $('#district_id').on('change', function () {
        $('#courier').empty()
        $('#courier').append('<option value="">Loading...</option>')
        $.ajax({
            url: "{{ url('/api/cost') }}",
            type: "POST",
            data: {
                destination: $(this).val(),
                weight: $('#weight').val(),
            },
            success: function (html) {
                $('#courier').empty()
                $('#courier').append('<option value="">Pilih Kurir</option>')
                $.each(html.data.results, function (key, item) {
                    let courier = item.courier + ' - ' + item.service + ' (Rp ' + item
                        .cost + ')'
                    let value = item.courier + '-' + item.service + '-' + item.cost
                    $('#courier').append('<option value="' + value + '">' + courier +
                        '</option>')
                })
            }
        });
    })

    $('#courier').on('change', function () {
        let split = $(this).val().split('-')
        if (split['2'] > 1) {
            $('#ongkir').text('Rp ' + split['2'])
        } else {
            $('#ongkir').text('Rp ' + split['3'])
        }

        if (split['2'] > 1) {
            let subtotal = "{{ (\Cart::getTotal()) }}"
            let total = parseInt(subtotal) + parseInt(split['2'])
            $('#total').text('Rp' + total)
        } else {
            let subtotal = "{{ (\Cart::getTotal()) }}"
            let total = parseInt(subtotal) + parseInt(split['3'])
            $('#total').text('Rp' + total)
        }
    })
</script>

{{-- <!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Informasi Pengiriman</h3>

                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form class="row contact_form" action="{{ route('front.store_checkout') }}" method="post" novalidate="novalidate">
    @csrf
    <input type="hidden" name="seller_id" value="{{$seller}}">
    <div class="col-md-12 form-group p_star">
        <label for="">Nama Lengkap</label>
        <input type="text" class="form-control" id="first" name="customer_name" required>
        <p class="text-danger">{{ $errors->first('customer_name') }}</p>
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="">No Telp</label>
        <input type="text" class="form-control" id="number" name="customer_phone" required>
        <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
    </div>
    <div class="col-md-6 form-group p_star">
        <label for="">Email</label>
        @if (auth()->check())
        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required
            {{ auth()->check() ? 'readonly':'' }}>
        @else
        <input type="email" class="form-control" id="email" name="email" required>
        @endif
        <p class="text-danger">{{ $errors->first('email') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Alamat Lengkap</label>
        <input type="text" class="form-control" id="add1" name="customer_address" required>
        <p class="text-danger">{{ $errors->first('customer_address') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Propinsi</label>
        <select class="form-control" name="province_id" id="province_id" required>
            <option value="">Pilih Propinsi</option>
            @foreach ($provinces as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
            @endforeach
        </select>
        <p class="text-danger">{{ $errors->first('province_id') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Kabupaten / Kota</label>
        <select class="form-control" name="city_id" id="city_id" required>
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        <p class="text-danger">{{ $errors->first('city_id') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Kecamatan</label>
        <select class="form-control" name="district_id" id="district_id" required>
            <option value="">Pilih Kecamatan</option>
        </select>
        <p class="text-danger">{{ $errors->first('district_id') }}</p>
    </div>
    <div class="col-md-12 form-group p_star">
        <label for="">Kurir</label>
        <input type="hidden" name="weight" id="weight" value="{{$weight}}">
        <input type="hidden" name="origin" id="origin" value="{{$origin}}">
        <select class="form-control" name="courier" id="courier" required>
            <option value="">Pilih Kurir</option>
        </select>
        <p class="text-danger">{{ $errors->first('courier') }}</p>
    </div>

    </div>
    <div class="col-lg-4">
        <div class="order_box">
            <h2>Ringkasan Pesanan</h2>
            <ul class="list">
                <li>
                    <a href="#">Product
                        <span>Total</span>
                    </a>
                </li>
                @foreach ($carts as $cart)
                <li>
                    <a href="#">{{ \Str::limit($cart->name) }}
                        <span class="middle">x {{ $cart->quantity }}</span>
                        <span class="last">Rp {{ number_format($cart->price) }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <ul class="list list_2">
                <li>
                    <a href="#">Subtotal
                        <span>Rp {{ number_format(\Cart::getSubTotal()) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">Pengiriman
                        <span id="ongkir">Rp 0</span>
                    </a>
                </li>
                <li>
                    <a href="#">Total
                        <span id="total">Rp {{ number_format(\Cart::getTotal()) }}</span>
                    </a>
                </li>
            </ul>
            <button class="main_btn">Bayar Pesanan</button>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
<!--================End Checkout Area =================-->
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
    window.jQuery || document.write('<script src="{{asset('
        front / assets / js / vendor / jquery.slim.min.js ')}}"><\/script>')
</script>
<script src="{{asset('/front/assets/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('ecommerce/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('ecommerce/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ecommerce/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('ecommerce/vendors/counter-up/jquery.counterup.js') }}"></script>
<script>
    $('#province_id').on('change', function () {
        $.ajax({
            url: "{{ url('/api/city') }}",
            type: "GET",
            data: {
                province_id: $(this).val()
            },
            success: function (html) {

                $('#city_id').empty()
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function (key, item) {
                    $('#city_id').append('<option value="' + item.id + '">' + item.name +
                        '</option>')
                })
            }
        });
    })

    $('#city_id').on('change', function () {
        $.ajax({
            url: "{{ url('/api/district') }}",
            type: "GET",
            data: {
                city_id: $(this).val()
            },
            success: function (html) {
                $('#district_id').empty()
                $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                $.each(html.data, function (key, item) {
                    $('#district_id').append('<option value="' + item.id + '">' + item
                        .name + '</option>')
                })
            }
        });
    })

    $('#district_id').on('change', function () {
        $('#courier').empty()
        $('#courier').append('<option value="">Loading...</option>')
        $.ajax({
            url: "{{ url('/api/cost') }}",
            type: "POST",
            data: {
                destination: $(this).val(),
                weight: $('#weight').val(),
            },
            success: function (html) {
                $('#courier').empty()
                $('#courier').append('<option value="">Pilih Kurir</option>')
                $.each(html.data.results, function (key, item) {
                    let courier = item.courier + ' - ' + item.service + ' (Rp ' + item
                        .cost + ')'
                    let value = item.courier + '-' + item.service + '-' + item.cost
                    $('#courier').append('<option value="' + value + '">' + courier +
                        '</option>')
                })
            }
        });
    })

    $('#courier').on('change', function () {
        let split = $(this).val().split('-')
        if (split['2'] > 1) {
            $('#ongkir').text('Rp ' + split['2'])
        } else {
            $('#ongkir').text('Rp ' + split['3'])
        }

        if (split['2'] > 1) {
            let subtotal = "{{ (\Cart::getTotal()) }}"
            let total = parseInt(subtotal) + parseInt(split['2'])
            $('#total').text('Rp' + total)
        } else {
            let subtotal = "{{ (\Cart::getTotal()) }}"
            let total = parseInt(subtotal) + parseInt(split['3'])
            $('#total').text('Rp' + total)
        }
    })
</script> --}}
