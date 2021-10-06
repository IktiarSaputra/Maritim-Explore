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
    <title>Maritime Explore | {{$product->name}}</title>

    <!-- CSS -->
    <link href="{{asset('front/css/detail/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/detail/phone-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/detail/tablet-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/detail/desktop-responsive.css')}}" rel="stylesheet">
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

        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: visible;
            width: 140px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -75px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
    {{-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

</head>

<body>

    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/"><img src="{{asset('front/image/logo.png')}}" alt="logo"></a>
        <div id="mobile">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                id="nav-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="mobile" href="{{route('front.list_cart')}}" id="button"><img src="{{asset('front/svg/cart.svg')}}"
                    alt="cart"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" id="nav-home" href="/">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" id="nav-home" href="{{route('front.product')}}">Product</a>
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
                <li class="nav-item">
                    <a href="{{route('front.list_cart')}}"><button id="button"><img
                        src="{{asset('front/svg/cart.svg')}}" alt="cart"></button></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="menu-overlay"> &nbsp;</div>

    <!-- Breadcrumb -->
    <nav class="container" aria-label="breadcrumb" id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('front.product')}}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
        </ol>
    </nav>

    <h1 class="text-center">Details Product</h1>

    <!-- Content -->
    <div id="content" class="container d-flex flex-wrap">
        <div class="col-md-6">
            <img id="product-img" src="{{ asset('/products/' . $product->image) }}" alt="ikan">
            <div class="d-flex flex-wrap">
                <div class="col-sm-6">
                    <h2>{{$product->name}}</h2>
                    {!! $product->description !!}
                </div>
                <div class="col-sm-6">
                    <p style="color: #C4C4C4;">-{{ $product->category->name }}-</p>
                    <a href="/ecommerce/toko/{{ $product->user_id }}"><span class="icon-user mr-2"></span>{{ $product->user->name }}</a>
                </div>
                <div class="col-sm-12 mt-3">
                    @if ($product->user->district_id = $product->user->district_id)
                    {{ $product->user->district->city->name}} -
                    {{ $product->user->district->city->province->name }}
                    @else
                    {{ $product->user->address }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @if (auth()->user())
            <label>Afiliasi Link</label>
            <!-- The text field -->
            <input type="text" class="form-control"
                value="{{ url('ecommerce/product/ref/' . auth()->user()->id . '/' . $product->id) }}" readonly
                id="myInput">
            <div class="tooltip">
                <button onclick="myFunction()" onmouseout="outFunc()">
                    <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                    Copy text
                </button>
            </div>
            @endif
            <form action="{{ url('/ecommerce/cart/add') }}" method="POST">
                @csrf
                <p id="quantity">Quantity</p>
                <div class="input-group d-flex">
                    <input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                    <button id="quantity1" type="button" class="btn btn-number"  data-type="minus" data-field="quantity">
                    <span class="icon-minus"></span>
                    </button>
                    <input id="quantity-input" type="text" name="quantity" class="input-number" value="1" min="1" max="100">
                    <button id="quantity2" type="button" class="btn btn-number" data-type="plus" data-field="quantity">
                        <span class="icon-plus"></span>
                    </button>
                </div>
                <p id="price">Price</p>
                <b>Rp {{ number_format($product->price) }}</b>
                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5"
                    data-step="0.1" value="{{ $product->averageRating }}" data-size="xs" disabled="">
                <div class="text-center">
                    <button type="submit" id="cart" class="btn">Tambah ke Keranjang</button>
                </div>
            </form>
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
<script type="text/javascript">
    $("#input-id").rating();
</script>
<script>
    $('.btn-number').click(function(e){
        e.preventDefault();
        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {   
                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                } 
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }
                } else if(type == 'plus') {
                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }
                }
            } else {
                input.val(0);
            }
    });
    $('.input-number').focusin(function(){
    $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());
            
        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });
    $(".input-number").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>
<script>
    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");

        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copied: " + copyText.value;
    }

    function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copy to clipboard";
    }
</script>