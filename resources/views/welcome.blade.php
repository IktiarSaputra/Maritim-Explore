<!-- Copyright 2021 All Rights Reserved by RPL SMKN 1 JAKARTA -->
<!-- Author/Pembuat   : RPL SMKN 1 JAKARTA -->
<!-- Dibuat           : 19/02/2021 -->

<!DOCTYPE html>
<html id="home" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('front/icon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('front/icon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('front/icon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('front/icon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('front/icon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Maritime Explore</title>

    <!-- CSS -->
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/phone-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/tablet-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/desktop-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/framework/aos.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/framework/slick.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/framework/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('front/js/jquery.js')}}"></script>
    <script src="{{asset('front/js/scroll-trigger.js')}}"></script>
    <script src="{{asset('front/js/slick.js')}}"></script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>

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

    <!-- Hero -->
    <div class="container-fluid d-sm-flex" id="hero">
        <div class="col-sm-12">
            <h1> Welcome To<br>Maritime Explore </h1>
            <div id="blue-border"></div>
            <p>Kami berusaha keras untuk mengembangkan ekonomi Indonesia<br id="one">
                melalui sektor kelautan di bidang pariwisata, <br> dan pemberdayaan<br> UMKM.</p>
            <a id="button-hero" href="#features"><button class="btn" type="button">Explore Now</button></a>
        </div>
    </div>

    <!-- Features -->
    <div class="features container-fluid" id="features" data-aos="fade-up" data-aos-duration="1500"
            data-aos-anchor-placement="bottom-bottom">
        <h2 class="overflow-hidden">Most Features</h2>
        <div class="card-deck d-flex flex-wrap overflow-hidden">
            <a href="{{route('front.product')}}">
                <div class="card justify-content-center" id="market">
                    <div class="card-body">
                        <img src="{{asset('front/image/shopping-cart.svg')}}" alt="shopping-cart">
                        <p>Toko</p>
                    </div>
                </div>
            </a>
            <a href="{{route('healthy')}}">
                <div class="card justify-content-center overflow-hidden" id="healthy">
                    <div class="card-body">
                        <img src="{{asset('front/image/wheelchair_pickup.svg')}}" alt="wheelchair_pickup">
                        <p>Kesehatan</p>
                    </div>
                </div>
            </a>
            <a href="{{route('education')}}">
                <div class="card justify-content-center overflow-hidden" id="education">
                    <div class="card-body">
                        <img src="{{asset('front/image/book.svg')}}" alt="book">
                        <p>Edukasi</p>
                    </div>
                </div>
            </a>
            <a href="{{route('index.travel')}}">
                <div class="card justify-content-center overflow-hidden" id="tourist">
                    <div class="card-body">
                        <img src="{{asset('front/image/flight_takeoff.svg')}}" alt="flight_takeoff">
                        <p>Pariwisata</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- New Release -->
    <div class="container-fluid" id="new-release" data-aos="fade-up" data-aos-duration="1500"
        data-aos-anchor-placement="bottom-bottom">
        <h2>Produk Terbaru</h2>
        <div class="card-deck d-flex flex-wrap overflow-hidden">
            
            @foreach ($product as $row)
            <a href="{{ url('ecommerce/product/' . $row->slug) }}" id="card-new-release">
            <div class="card overflow-hidden">
                <img src="{{ asset('/products/' . $row->image) }}" alt="{{$row->name}}">
                <div class="stretched-link" id="category">
                    <p>Toko</p>
                </div>
            </div>
            </a>
            @endforeach

            @foreach ($travel as $t)
            <a href="{{ url('/travel/' . $t->slug) }}" id="card-new-release">
            <div class="card overflow-hidden">
                <img src="{{ asset('/gambar/' . $t->gambar) }}" alt="{{$t->title}}">
                <div class="stretched-link" id="category">
                    <p>Pariwisata</p>
                </div>
            </div>
            </a>
            @endforeach

            @foreach ($post as $p)
            <a href="{{ url('/education/' . $p->slug) }}" id="card-new-release">
            <div class="card overflow-hidden">
                <img src="{{ asset('/gambar/' . $p->gambar) }}" alt="{{$p->title}}">
                <div class="stretched-link" id="category">
                    <p>Edukasi</p>
                </div>
            </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- About -->
    <div class="about container-fluid d-flex" id="about" data-aos="fade-up" data-aos-duration="1500"
        data-aos-anchor-placement="bottom-bottom">
        <div class="col">
            <img src="{{asset('front/image/about-img.png')}}" alt="About">
        </div>
        <div class="col">
            <h2>Apa Saja Yang Kamu Dapat ?</h2>
            <div class="media position-relative">
                <div id="box">1</div>
                <div class="media-body">
                    <p>Kami tidak meminta biaya apapun dari kedua belah<br id="none">
                    pihak (pemilik atau bahkan pembeli)</p>
                </div>
            </div>
            <div class="media position-relative">
                <div id="box">2</div>
                <div class="media-body">
                    <p>Kami menangani setiap hal yang harus <br id="none">
                        diselesaikan pembeli terlebih dahulu</p>
                </div>
            </div>
            <div class="media position-relative">
                <div id="box">3</div>
                <div class="media-body">
                    <p>Kami membantu pembeli untuk menemukan tempat tanpa<br id="none">
                    merepotkan dan membantu mereka dengan dokumentasi</p>
                </div>
            </div>
            <div class="media position-relative">
                <div id="box">4</div>
                <div class="media-body">
                    <p>Kami membantu pemilik untuk mendaftarkan lisensi<br id="none">
                    mereka kepada pemerintah agar mau menjual</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Covid -->
    <div class="covid container-fluid" data-aos="fade-up" data-aos-duration="1000"
        data-aos-anchor-placement="top-center">
        <h2 class="text-center font-weight-bold">Perkembangan Covid-19 Di Indonesia</h2>
        <div id="container"></div>
        <div class="container">
            <div class="row">
                <div class="col col-lg-2 text-center"><br>
                    <b>{{number_format ($data['deaths']['value'])}}</b><br><br>
                    <span>Kematian</span>
                </div>
                <div class="col-md-auto text-center">
                    <b>{{number_format ($data['recovered']['value'])}}</b><br><br>
                    <span>Sembuh</span>
                </div>
                <div class="col col-lg-2 text-center"><br>
                    <b>{{number_format ($data['confirmed']['value'])}}</b><br><br>
                    <span>Positif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Trending -->
    <div class="trending container-fluid" id="trending" data-aos="fade-up" data-aos-duration="1500"
        data-aos-anchor-placement="top-center">
        <h2>Trending di Kesehatan</h2>
        <section class="center slider">
            <a href="/germas">
                <div class="card">
                    <div class="card-img-overlay text-white d-flex flex-column">
                        <h3 class="card-title">Germas</h3>
                    </div>
                </div>
            </a>
            <a href="{{route('healthy')}}">
                <div class="card">
                    <div class="card-img-overlay text-white d-flex flex-column">
                        <h3 class="card-title">Kasus Covid-19</h3>
                    </div>
                </div>
            </a>
            <a href="/vaksinasi">
                <div class="card">
                    <div class="card-img-overlay text-white d-flex flex-column">
                        <h3 class="card-title">Vaksinasi</h3>
                    </div>
                </div>
            </a>
        </section>
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
    $("#nav-home").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#home").offset().top
        }, 1000);
    });
</script>
<script type="text/javascript">
    $("#nav-features").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#features").offset().top - 200
        }, 1000);
    });
</script>
<script type="text/javascript">
    $("#nav-contact").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#contact").offset().top
        }, 1000);
    });
</script>
<script type="text/javascript">
    $("#button-hero").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#features").offset().top - 200
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
<script type="text/javascript">
$('.center').slick({
  centerMode: true,
  arrows: true,
  centerPadding: '0px',
  slidesToShow: 3,
  cssEase: 'linear',
  autoplay: true,
  responsive: [
    {
      breakpoint: 1050,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 1
      }
    }
  ]
});
</script>
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