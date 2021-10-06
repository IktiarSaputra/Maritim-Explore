<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description"
        content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
    <title>@yield('title')</title>
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="{{asset('admin/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
    <!-- No Extra plugin used -->
    <link href="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/toastr/toastr.min.css')}}" rel="stylesheet" />
    <!-- SLEEK CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/sleek.css')}}" />
    <!-- FAVICON -->
    <link href="{{asset('admin/assets/img/favicon.png')}}" rel="shortcut icon" />
    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{asset('admin/assets/plugins/nprogress/nprogress.js')}}"></script>
    @yield('css')
</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>

    <div class="wrapper">
        <!-- Github Link -->
        <a href="https://github.com/tafcoder/sleek-dashboard" target="_blank" class="github-link">
            <svg width="70" height="70" viewBox="0 0 250 250" aria-hidden="true">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="75%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#896def;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#482271;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M 0,0 L115,115 L115,115 L142,142 L250,250 L250,0 Z" fill="url(#grad1)"></path>
            </svg>
            <i class="mdi mdi-github-circle"></i>
        </a>

        <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="#" title="Sleek Dashboard">
                        <img src="{{asset('/front/image/logo.png')}}" width="25px" height="25px" alt="logo">
                        <span class="brand-name text-truncate">Maritime Dashboard</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-scrollbar">

                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        @if (auth()->user()->level == 'admin')
                        <li
                            class="has-sub {{ Route::currentRouteNamed('dashboard.admin') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.admin') ? 'expand' : '' }}">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="nav-text">Dashboard</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse {{ Route::currentRouteNamed('dashboard.admin') ? 'show' : '' }}"
                                id="dashboard" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="{{ Route::currentRouteNamed('dashboard.admin') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('dashboard.admin')}}">
                                            <span class="nav-text">Ecommerce</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li
                            class="has-sub {{ Route::currentRouteNamed('seller.list') ? 'active' : '' }} {{ Route::currentRouteNamed('seller.list') ? 'expand' : '' }} {{ Route::currentRouteNamed('user.list') ? 'active' : '' }} {{ Route::currentRouteNamed('user.list') ? 'expand' : '' }} {{ Route::currentRouteNamed('travel.index') ? 'active' : '' }} {{ Route::currentRouteNamed('travel.index') ? 'expand' : '' }} {{ Route::currentRouteNamed('population.index') ? 'active' : '' }} {{ Route::currentRouteNamed('population.index') ? 'expand' : '' }} {{ Route::currentRouteNamed('village.index') ? 'active' : '' }} {{ Route::currentRouteNamed('village.index') ? 'expand' : '' }}">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#seller" aria-expanded="false" aria-controls="seller">
                                <i class="mdi mdi-folder-multiple-outline"></i>
                                <span class="nav-text">Data Master</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse {{ Route::currentRouteNamed('seller.list') ? 'show' : '' }} {{ Route::currentRouteNamed('user.list') ? 'show' : '' }} {{ Route::currentRouteNamed('travel.index') ? 'show' : '' }} {{ Route::currentRouteNamed('population.index') ? 'show' : '' }} {{ Route::currentRouteNamed('village.index') ? 'show' : '' }} "
                                id="seller" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="{{ Route::currentRouteNamed('seller.list') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('seller.list')}}">
                                            <span class="nav-text">Seller</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('user.list') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('user.list')}}">
                                            <span class="nav-text">User</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('travel.index') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('travel.index')}}">
                                            <span class="nav-text">Travel</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('population.index') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('population.index')}}">
                                            <span class="nav-text">Populations</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('village.index') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('village.index')}}">
                                            <span class="nav-text">Village</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        @elseif(auth()->user()->level == 'owner')
                        <li
                            class="has-sub {{ Route::currentRouteNamed('owner.home') ? 'active' : '' }} {{ Route::currentRouteNamed('owner.home') ? 'expand' : '' }}">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="nav-text">Dashboard</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse {{ Route::currentRouteNamed('owner.home') ? 'show' : '' }}"
                                id="dashboard" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="{{ Route::currentRouteNamed('owner.home') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('owner.home')}}">
                                            <span class="nav-text">Education</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li
                            class="has-sub {{ Route::currentRouteNamed('category') ? 'active' : '' }} {{ Route::currentRouteNamed('category') ? 'expand' : '' }} {{ Route::currentRouteNamed('tags') ? 'active' : '' }} {{ Route::currentRouteNamed('tags') ? 'expand' : '' }} {{ Route::currentRouteNamed('post') ? 'active' : '' }} {{ Route::currentRouteNamed('post') ? 'expand' : '' }} ">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#seller" aria-expanded="false" aria-controls="seller">
                                <i class="mdi mdi-folder-multiple-outline"></i>
                                <span class="nav-text">Data Master</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse {{ Route::currentRouteNamed('category') ? 'show' : '' }} {{ Route::currentRouteNamed('tags') ? 'show' : '' }} {{ Route::currentRouteNamed('post') ? 'show' : '' }}"
                                id="seller" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="{{ Route::currentRouteNamed('category') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('category')}}">
                                            <span class="nav-text">Category</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('tags') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('tags')}}">
                                            <span class="nav-text">Tags</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('post') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('post')}}">
                                            <span class="nav-text">Post</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        @else
                        <li
                            class="has-sub {{ Route::currentRouteNamed('dashboard.seller') ? 'active' : '' }} {{ Route::currentRouteNamed('dashboard.seller') ? 'expand' : '' }}">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="nav-text">Dashboard</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse {{ Route::currentRouteNamed('dashboard.seller') ? 'show' : '' }}"
                                id="dashboard" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="{{ Route::currentRouteNamed('dashboard.seller') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('dashboard.seller')}}">
                                            <span class="nav-text">Ecommerce</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li
                            class="has-sub {{ Route::currentRouteNamed('category.index') ? 'active' : '' }} {{ Route::currentRouteNamed('category.index') ? 'expand' : '' }} {{ Route::currentRouteNamed('product.index') ? 'active' : '' }} {{ Route::currentRouteNamed('product.index') ? 'expand' : '' }} {{ Route::currentRouteNamed('orders.index') ? 'active' : '' }} {{ Route::currentRouteNamed('orders.index') ? 'expand' : '' }}">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#category" aria-expanded="false" aria-controls="category">
                                <i class="mdi mdi-folder-multiple-outline"></i>
                                <span class="nav-text">Data Master</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse {{ Route::currentRouteNamed('category.index') ? 'show' : '' }} {{ Route::currentRouteNamed('product.index') ? 'show' : '' }} {{ Route::currentRouteNamed('orders.index') ? 'show' : '' }} "
                                id="category" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="{{ Route::currentRouteNamed('category.index') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('category.index')}}">
                                            <span class="nav-text">Categories</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('product.index') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('product.index')}}">
                                            <span class="nav-text">Products</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('orders.index') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('orders.index')}}">
                                            <span class="nav-text">Orders</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li
                            class="has-sub {{ Route::currentRouteNamed('report.order') ? 'active' : '' }} {{ Route::currentRouteNamed('report.order') ? 'expand' : '' }} {{ Route::currentRouteNamed('report.return') ? 'active' : '' }} {{ Route::currentRouteNamed('report.return') ? 'expand' : '' }}">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#report" aria-expanded="false" aria-controls="report">
                                <i class="mdi mdi-folder-multiple-outline"></i>
                                <span class="nav-text">Reports</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse {{ Route::currentRouteNamed('report.order') ? 'show' : '' }} {{ Route::currentRouteNamed('report.return') ? 'show' : '' }}"
                                id="report" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="{{ Route::currentRouteNamed('report.order') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('report.order')}}">
                                            <span class="nav-text">Order</span>
                                        </a>
                                    </li>
                                    <li class="{{ Route::currentRouteNamed('report.return') ? 'active' : '' }}">
                                        <a class="sidenav-item-link" href="{{route('report.return')}}">
                                            <span class="nav-text">Return</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </aside>

        <div class="page-wrapper">
            <!-- Header -->
            <header class="main-header " id="header">
                <nav class="navbar navbar-static-top navbar-expand-lg">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <!-- search form -->
                    <div class="search-form d-none d-lg-inline-block">

                    </div>

                    <div class="navbar-right ">
                        <ul class="nav navbar-nav">
                            <li class="right-sidebar-in right-sidebar-2-menu">
                                <i class="mdi mdi-settings mdi-spin"></i>
                            </li>
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="{{Auth::user()->getAvatar()}}" style="border-radius: 50px"
                                        class="user-image" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">{{Auth::user()->name}}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!-- User image -->
                                    <li class="dropdown-header">
                                        <img src="{{Auth::user()->getAvatar()}}" class="img-circle" alt="User Image" />
                                        <div class="d-inline-block">
                                            {{Auth::user()->name}} <small class="pt-1">{{Auth::user()->email}}</small>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="{{route('seller.profile')}}">
                                            <i class="mdi mdi-account"></i> My Profile
                                        </a>
                                    </li>

                                    <li class="right-sidebar-in">
                                        <a href="javascript:0"> <i class="mdi mdi-settings"></i> Setting </a>
                                    </li>

                                    <li class="dropdown-footer">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout"></i> Log Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper">
                <div class="content">
                    <!-- Top Statistics -->
                    @yield('content')
                </div>

                <div class="right-sidebar-2">
                    <div class="right-sidebar-container-2">
                        <div class="slim-scroll-right-sidebar-2">
                            <div class="right-sidebar-2-header">
                                <h2>Layout Settings</h2>
                                <p>User Interface Settings</p>
                                <div class="btn-close-right-sidebar-2">
                                    <i class="mdi mdi-window-close"></i>
                                </div>
                            </div>

                            <div class="right-sidebar-2-body">
                                <span class="right-sidebar-2-subtitle">Header Layout</span>
                                <div class="no-col-space">
                                    <a href="javascript:void(0);"
                                        class="btn-right-sidebar-2 header-fixed-to btn-right-sidebar-2-active">Fixed</a>
                                    <a href="javascript:void(0);"
                                        class="btn-right-sidebar-2 header-static-to">Static</a>
                                </div>

                                <span class="right-sidebar-2-subtitle">Sidebar Layout</span>
                                <div class="no-col-space">
                                    <select class="right-sidebar-2-select" id="sidebar-option-select">
                                        <option value="sidebar-fixed">Fixed Default</option>
                                        <option value="sidebar-fixed-minified">Fixed Minified</option>
                                        <option value="sidebar-fixed-offcanvas">Fixed Offcanvas</option>
                                        <option value="sidebar-static">Static Default</option>
                                        <option value="sidebar-static-minified">Static Minified</option>
                                        <option value="sidebar-static-offcanvas">Static Offcanvas</option>
                                    </select>
                                </div>

                                <span class="right-sidebar-2-subtitle">Header Background</span>
                                <div class="no-col-space">
                                    <a href="javascript:void(0);"
                                        class="btn-right-sidebar-2 btn-right-sidebar-2-active header-light-to">Light</a>
                                    <a href="javascript:void(0);" class="btn-right-sidebar-2 header-dark-to">Dark</a>
                                </div>

                                <span class="right-sidebar-2-subtitle">Navigation Background</span>
                                <div class="no-col-space">
                                    <a href="javascript:void(0);"
                                        class="btn-right-sidebar-2 btn-right-sidebar-2-active sidebar-dark-to">Dark</a>
                                    <a href="javascript:void(0);" class="btn-right-sidebar-2 sidebar-light-to">Light</a>
                                </div>

                                <span class="right-sidebar-2-subtitle">Direction</span>
                                <div class="no-col-space">
                                    <a href="javascript:void(0);"
                                        class="btn-right-sidebar-2 btn-right-sidebar-2-active ltr-to">LTR</a>
                                    <a href="javascript:void(0);" class="btn-right-sidebar-2 rtl-to">RTL</a>
                                </div>

                                <div class="d-flex justify-content-center" style="padding-top: 30px">
                                    <div id="reset-options" style="width: auto; cursor: pointer"
                                        class="btn-right-sidebar-2 btn-reset">Reset
                                        Settings</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                        <a class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>
        </div>
    </div>

    <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jekyll-search.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/charts/Chart.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('input[name="dateRange"]').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                jQuery(this).val('');
            });
        });
    </script>
    <script src="{{asset('admin/assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/sleek.bundle.js')}}"></script>
    @yield('js')
</body>

</html>