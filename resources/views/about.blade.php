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
    <title>Maritime Explore | About</title>

    <!-- CSS -->
    <link href="{{asset('front/css/about/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/about/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/framework/aos.css')}}" rel="stylesheet">
    <link href="{{asset('front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('front/js/jquery.js')}}"></script>
    <script src="{{asset('front/js/scroll-trigger.js')}}"></script>

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
                    <a class="nav-link" id="nav-home" href="/">Home</a>
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
    <div class="container-fluid" id="content">
        <h1 class="text-center font-weight-bold" data-aos="zoom-out" data-aos-duration="1000">Siapakah Kami ?</h1>
        <div class="row">
            <div class="col-sm-4 text-center" id="rizky-mobile" data-aos="fade-up" data-aos-duration="1000"
                data-aos-anchor-placement="top-center">
                <img src="{{asset('front/image/about/rizky.svg')}}"><br><br>
                <h2>Muhammad Rizky Fajriansyah</h2>
                <span>UI Designer</span>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#RizkyOne"
                                aria-expanded="true" aria-controls="RizkyOne">
                                <span class="icon-chevron-thin-down font-weight-bold"></span>
                            </button>
                        </div>
                        <div id="RizkyOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>UI designer</b> adalah merancang semua layar tempat pengguna akan bergerak, dan
                                    menciptakan elemen visual dan sifat interaktif yang memfasilitasi pergerakan ini.
                                    <br><br><b>Tools</b> Yang digunakan:<br>
                                    <img src="{{asset('front/image/about/figma.svg')}}" alt="Figma" id="icon-logo">
                                    <img src="{{asset('front/image/about/sketch.svg')}}" alt="Sketch" id="icon-logo">
                                    <img src="{{asset('front/image/about/invision.svg')}}" alt="Invision"
                                        id="icon-logo">
                                    <img src="{{asset('front/image/about/adobe-xd.svg')}}" alt="Adobe Xd"
                                        id="icon-logo">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center" id="dewa-desktop" data-aos="zoom-in" data-aos-duration="1500">
                <img src="{{asset('front/image/about/dewa.svg')}}"><br><br>
                <h2>Adityawarman Dewa Putra</h2>
                <span>Front End Developer</span>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#DewaDesktop"
                                aria-expanded="true" aria-controls="DewaDesktop">
                                <span class="icon-chevron-thin-down font-weight-bold"></span>
                            </button>
                        </div>
                        <div id="DewaDesktop" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Front end developer</b> adalah pengembang website yang menggunakan baris kode
                                    HTML, CSS, dan JavaScript untuk menghasilkan website dengan tampilan yang menarik.
                                    <br><br><b>Tools</b> Yang digunakan:<br>
                                    <img src="{{asset('front/image/about/visual-studio-code.svg')}}"
                                        alt="Visual Studio Code" id="icon-logo">
                                    <img src="{{asset('front/image/about/css.svg')}}" alt="CSS" id="icon-logo">
                                    <img src="{{asset('front/image/about/bootstrap.svg')}}" alt="Bootstrap"
                                        id="icon-logo">
                                    <img src="{{asset('front/image/about/javascript.svg')}}" alt="Javascript"
                                        id="icon-logo">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center" id="rizky-desktop" data-aos="zoom-in" data-aos-duration="1500">
                <img src="{{asset('front/image/about/rizky.svg')}}"><br><br>
                <h2>Muhammad Rizky Fajriansyah</h2>
                <span>UI Designer</span>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <span class="icon-chevron-thin-down font-weight-bold"></span>
                            </button>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>UI designer</b> adalah merancang semua layar tempat pengguna akan bergerak, dan
                                    menciptakan elemen visual dan sifat interaktif yang memfasilitasi pergerakan ini.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center" id="dewa-mobile" data-aos="fade-up" data-aos-duration="1000"
                data-aos-anchor-placement="bottom-bottom">
                <img src="{{asset('front/image/about/dewa.svg')}}"><br><br>
                <h2>Adityawarman Dewa Putra</h2>
                <span>Front End Developer</span>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="DewaMobile">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#DewaMobile"
                                aria-expanded="true" aria-controls="DewaMobile">
                                <span class="icon-chevron-thin-down font-weight-bold"></span>
                            </button>
                        </div>
                        <div id="DewaMobile" class="collapse" aria-labelledby="DewaMobile" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Front end developer</b> adalah pengembang website yang menggunakan baris kode
                                    HTML, CSS, dan JavaScript untuk menghasilkan website dengan tampilan yang menarik.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center" data-aos="zoom-in" data-aos-duration="1500">
                <img src="{{asset('front/image/about/ikctiar.svg')}}"><br><br>
                <h2>Muhammad Ikctiar Saputra</h2>
                <span>Back End Developer</span>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#IkctiarOne"
                                aria-expanded="true" aria-controls="IkctiarOne">
                                <span class="icon-chevron-thin-down font-weight-bold"></span>
                            </button>
                        </div>
                        <div id="IkctiarOne" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <p><b>Back end developer</b> bertanggung jawab memprogram server agar mengirimkan
                                    dokumen (dalam hal ini HTML, CSS, dan kode JavaScript) ke browser pengguna setiap
                                    kali pengguna memintanya melalui http request.
                                    <br><br><b>Tools</b> Yang digunakan:<br>
                                    <img src="{{asset('front/image/about/visual-studio-code.svg')}}"
                                        alt="Visual Studio Code" id="icon-logo">
                                    <img src="{{asset('front/image/about/laravel.svg')}}" alt="Laravel" id="icon-logo">
                                    <img src="{{asset('front/image/about/highcharts.svg')}}" alt="Highcharts"
                                        id="icon-logo">
                                </p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p id="description"><b>UI designer</b> adalah merancang semua layar tempat pengguna akan bergerak, dan<br>
                menciptakan elemen visual dan sifat interaktif yang memfasilitasi pergerakan ini.
                <br><br><b>Tools</b> Yang digunakan:<br>
                <img src="{{asset('front/image/about/figma.svg')}}" alt="Figma" id="icon-logo">
                <img src="{{asset('front/image/about/sketch.svg')}}" alt="Sketch" id="icon-logo">
                <img src="{{asset('front/image/about/invision.svg')}}" alt="Invision" id="icon-logo">
                <img src="{{asset('front/image/about/adobe-xd.svg')}}" alt="Adobe Xd" id="icon-logo">
                <br><br><br>
                <b>Front end developer</b> adalah pengembang website yang menggunakan baris kode<br> HTML, CSS, dan
                JavaScript untuk menghasilkan website dengan tampilan yang menarik.
                <br><br><b>Tools</b> Yang digunakan:<br>
                <img src="{{asset('front/image/about/visual-studio-code.svg')}}" alt="Visual Studio Code"
                    id="icon-logo">
                <img src="{{asset('front/image/about/css.svg')}}" alt="CSS" id="icon-logo">
                <img src="{{asset('front/image/about/bootstrap.svg')}}" alt="Bootstrap" id="icon-logo">
                <img src="{{asset('front/image/about/javascript.svg')}}" alt="Javascript" id="icon-logo">
                <br><br><br>
                <b>Back end developer</b> bertanggung jawab memprogram server agar mengirimkan dokumen<br> (dalam hal
                ini HTML, CSS, dan kode JavaScript) ke browser pengguna setiap kali<br> pengguna memintanya melalui http
                request.
                <br><br><b>Tools</b> Yang digunakan:<br>
                <img src="{{asset('front/image/about/visual-studio-code.svg')}}" alt="Visual Studio Code"
                    id="icon-logo">
                <img src="{{asset('front/image/about/laravel.svg')}}" alt="Laravel" id="icon-logo">
                <img src="{{asset('front/image/about/highcharts.svg')}}" alt="Highcharts" id="icon-logo">
                <br><br><br>
            </p>
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