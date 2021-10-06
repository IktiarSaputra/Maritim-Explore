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
    <title>Sign Up | User</title>

    <!-- CSS -->
    <link href="{{asset('front/css/sign-login/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/sign-login/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>

</head>

<body>
    <div class="container-fluid d-flex" id="d-flex">
        <div class="col-md-6">
            <img src="{{asset('front/image/sign-up.png')}}" width="100%">
        </div>
        <div class="col-md-6">
            <div class="cube">
                <!-- Nav -->
                <nav class="navbar navbar-expand-lg navbar-light" id="nav-sign-up">
                    <a class="navbar-brand" href="/"><img src="{{asset('front/image/logo.png')}}"
                            alt="logo"></a>
                    <li><a class="pr-2" href="/seller/register" id="seller">Sebagai Penjual</a><a class="pl-2" href="/">Back to Home</a></li>
                </nav>
                <h1 class="mb-2">Daftar</h1>
                <form method="POST" action="{{ route('register') }}" class="row">
                    @csrf
                    <div class="col-sm-6">
                        <label for="name">Nama</label>
                        <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="email">Alamat Email</label>
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">
                        
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="phone_number">Phone Number</label>
                        <input id="phone_number" type="text" class=" @error('phone_number') is-invalid @enderror"
                            name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
                        
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="address">Address</label>
                        <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address"
                            value="{{ old('address') }}" required autocomplete="address" autofocus>
                        
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="password">Password</label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
                            required autocomplete="new-password">
                        
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="" name="password_confirmation" required
                            autocomplete="new-password">
                    </div>
                    <div class="text-center col-sm-12">
                        <button type="submit" class="btn">Buat Akun</button>
                    </div>
                </form>
                <a href="{{route('login')}}">Sudah Memiliki Akun</a>
            </div>
        </div>
    </div>
</body>
</html>