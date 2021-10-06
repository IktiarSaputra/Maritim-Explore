<!-- Copyright 2021 All Rights Reserved by RPL SMKN 1 JAKARTA -->
<!-- Author/Pembuat   : RPL SMKN 1 JAKARTA -->
<!-- Dibuat           : 19/02/2021 -->

<!DOCTYPE html>
<html id="home" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/front/icon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/front/icon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/front/icon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('/front/icon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Maritime Explore</title>

    <!-- CSS -->
    <link href="{{asset('/front/css/detail-education/style.css')}}" rel="stylesheet">
    <link href="{{asset('/front/css/detail-education/phone-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('/front/css/detail-education/tablet-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('/front/css/detail-education/desktop-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('/front/css/framework/aos.css')}}" rel="stylesheet">
    <link href="{{asset('/front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('/front/bootstrap/bootstrap.css')}}" rel="stylesheet">
    <style>
        blockquote {
            background: #f9f9f9;
            border-left: 10px solid #ccc;
            margin: 1.5em 10px;
            padding: 0.5em 10px;
            quotes: "\201C""\201D""\2018""\2019";
        }
    
        blockquote:before {
            color: #ccc;
            content: open-quote;
            font-size: 4em;
            line-height: 0.1em;
            margin-right: 0.25em;
            vertical-align: -0.4em;
        }
    
        blockquote p {
            display: inline;
            font-style: italic;
        }
    
        blockquote h6 {
            font-weight: 700;
            padding: 0;
            margin: 0 0 .25rem;
        }
    
        .child-comment {
            padding-left: 50px;
        }
    </style>

    <!-- JS -->
    <script src="{{asset('/front/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('/front/js/jquery.js')}}"></script>
    <script src="{{asset('/front/js/scroll-trigger.js')}}"></script>
    <script src="https://kit.fontawesome.com/6cbd9f0927.js" crossorigin="anonymous"></script>
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=6050914532910c0018e2187c&product=sop'
        async='async'></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v10.0" nonce="rI78zdyH"></script>

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
                    <a class="nav-link" id="nav-features" href="{{route('front.product')}}">Product</a>
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

    <!-- Content -->
    <div class="container" id="content">
        <div class="row">
            <h1>{{$post->title}}</h1>
            <img src="{{ asset('gambar/' . $post->gambar) }}" alt="{{$post->title}}" id="judul-img">
            <div class="col-lg-7 col-md-12 col-sm-12" id="isi">

                <span class="mr-2" id="author"><span class="icon-user"></span> {{$post->user->name}}</span><span
                    id="date"><span class="icon-clock-o"></span> {{$post->created_at->format('d M Y')}}</span><br><br>
                {!!$post->content!!}
                <ul id="tags">
                    @foreach ($post->tags as $tag)
                    <li><a href="#">{{$tag->name}}</a></li>
                    @endforeach
                </ul>
                <div class="sharethis-inline-share-buttons"></div>
                @guest
                    @foreach ($post->comments as $row)
                        <blockquote>
                            <h6>{{ $row->user }}</h6>
                            <hr>
                            <p>{{ $row->comment }}</p><br>
                            <a href="javascript:void(0)" onclick="balasKomentar({{ $row->id }}, '{{ $row->comment }}')">Balas</a>
                        </blockquote>
                        @foreach ($row->child as $val)
                        <div class="child-comment">
                            <blockquote>
                                <h6>{{ $val->user }}</h6>
                                <hr>
                                <p>{{ $val->comment }}</p><br>
                            </blockquote>
                        </div>
                        @endforeach
                    @endforeach
                @else
                    @forelse ($post->comments as $row)
                        <blockquote>
                            <h6>{{ $row->user }}</h6>
                            <hr>
                            <p>{{ $row->comment }}</p><br>
                            <a href="javascript:void(0)" onclick="balasKomentar({{ $row->id }}, '{{ $row->comment }}')">Balas</a>
                        </blockquote>
                        @foreach ($row->child as $val)
                        <div class="child-comment">
                            <blockquote>
                                <h6>{{ $val->user }}</h6>
                                <hr>
                                <p>{{ $val->comment }}</p><br>
                            </blockquote>
                        </div>
                        @endforeach
                    @empty
                        <span style="padding-top: 50px;padding-bottom : 50px">Belum Ada Komentar</span>
                    @endforelse
                    <form id="komentar" action="{{route('comment')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $post->id }}" class="form-control">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                        <input type="hidden" name="parent_id" id="parent_id" class="form-control">
                        <div class="form-group" style="display: none" id="formReplyComment">
                            <label for="">Balas Komentar</label>
                            <input type="text" id="replyComment" class="form-control" readonly>
                        </div>
                        <textarea id="message" name="comment" cols="30" rows="10" placeholder="Komentar..."></textarea>
                        <button class="mb-5" type="submit">Post Komentar!</button>
                    </form>
                @endguest
            </div>

            <!-- Sidebar -->
            <div class="col-lg-5 col-md-12 col-sm-12 " id="sidebar">
                <form action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search">
                </form>
                <h3>Kategori Terbaru</h3><!-- Ini Batasnye 5 Postingan yar -->
                <ul id="category">
                    @foreach ($kategori as $row)
                    <li>
                        <a href="/education/category/{{$row->slug}}">
                            <i class="fas fa-clone"></i> {{$row->name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <h3>Postingan Terpopuler</h3><!-- Ini Batasnye 2 Postingan yar -->
                <ul>
                    @foreach ($blog as $item)
                    <a href="/education/{{$item->slug}}">
                        <div class="card mb-3" style="max-width: 540px;" id="post-populer">
                            <div class="d-flex g-0">
                                <div class="col-5 col-md-4">
                                    <img src="{{ asset('/gambar/' . $item->gambar) }}" alt="{{$item->title}}">
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ Illuminate\Support\Str::limit($item->title, 20) }}</h4>
                                        <p class="card-text"></p>
                                        <p class="card-text row">
                                            <small
                                                class="text-muted col ml-3">{{$item->created_at->format('d M Y')}}</small>
                                            <span class="col" id="views">
                                                <i class="fas fa-eye"></i>
                                                {{views($item)->count()}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </ul>
                <h3>Postingan Lainnya</h3><!-- Ini Batasnye 5 Postingan yar -->
                <ul id="post-lainnya">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($blogpos as $p)
                    <li>
                        <a href="/education/{{$p->slug}}"><span>#{{$no++}}</span>
                            <h4>{{ Illuminate\Support\Str::limit($p->title, 40) }}</h4>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <h3>Rekomendasi Wisata</h3><!-- Ini Batasnye 2 Postingan yar -->
                <ul>
                    @foreach ($travel as $wisata)
                    <a href="/travel/{{$wisata->slug}}">
                        <div class="card mb-3" style="max-width: 540px;" id="post-populer">
                            <div class="d-flex g-0">
                                <div class="col-5 col-md-4">
                                    <img src="{{ asset('/gambar/' . $wisata->gambar) }}" alt="{{$wisata->title}}">
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$wisata->title}}</h4>
                                        <p class="card-text"></p>
                                        <p class="card-text row">
                                            <small
                                                class="text-muted col ml-3">{{$wisata->created_at->format('d M Y')}}</small>
                                            <span class="col" id="views">
                                                <i class="fas fa-eye"></i>
                                                {{views($wisata)->count()}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </ul>
                <h3>Social Media</h3>
                <div 
                    class="fb-page mt-2" 
                    data-href="https://www.facebook.com/Maritime-Explore-102640988593336/"
                    data-width="380" 
                    data-hide-cover="false"
                    data-show-facepile="false">
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
    function balasKomentar(id, title) {
        $('#formReplyComment').show();
        $('#parent_id').val(id)
        $('#replyComment').val(title)
    }
</script>