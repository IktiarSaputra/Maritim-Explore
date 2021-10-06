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
    <title>Login</title>

    <!-- CSS -->
    <link href="{{asset('front/css/sign-login/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/sign-login/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>

</head>

<body>
    <div class="container-fluid d-flex">
        <div class="col-md-6">
            <img src="{{asset('front/image/sign-up.png')}}" width="100%">
        </div>
        <div class="col-md-6">
            <div class="cube" id="login">
                <!-- Nav -->
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/"><img src="{{asset('front/image/logo.png')}}" alt="logo"></a>
                    <a href="/">Back to Home</a>
                </nav>
                <h1 class="mb-2">Masuk</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label for="email">Alamat Email</label>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="password">Kata Sandi</label>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="text-center">
                        <button type="submit" class="btn">Masuk</button>
                    </div>
                </form>
                <a href="{{ route('register') }}">Tidak Memiliki Akun?</a>
            </div>
        </div>
    </div>
</body>

</html>