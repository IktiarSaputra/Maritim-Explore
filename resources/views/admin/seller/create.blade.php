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
    <title>Sign Up</title>

    <!-- CSS -->
    <link href="{{asset('front/css/sign-seller/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/sign-seller/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/icon/style.css')}}" rel="stylesheet">
    <link href="{{asset('front/bootstrap/bootstrap.css')}}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('front/bootstrap/bootstrap.js')}}"></script>

</head>

<body>
    <div class="container" id="container">
        <div class="row">
            <div class="cube">
                <!-- Nav -->
                <nav class="navbar navbar-expand-lg navbar-light" id="nav-sign-up">
                    <a class="navbar-brand" href="/"><img src="{{asset('front/image/logo.png')}}"
                            alt="logo"></a>
                    <li><a class="pr-2" href="{{route('register')}}" id="seller">Sebagai Pengunjung</a><a class="pl-2"
                            href="/">Back to Home</a></li>
                </nav>
                <h1 class="mb-2">Daftar | Seller</h1>
                <form method="POST" action="{{ route('seller.store') }}">
                    @csrf

                    <label for="username">Nama</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="email">Alamat Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="number">No Hp</label>
                    <input id="phone_number" type="number"
                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                        value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="address">Address</label>
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                        name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="form-group">
                        <label for="" class="col-form-label">Propinsi</label>
                        <div class="">
                            <select class="form-control" name="province_id" id="province_id" required>
                                <option value="">Pilih Propinsi</option>
                                <!-- LOOPING DATA PROVINCE UNTUK DIPILIH OLEH CUSTOMER -->
                                @foreach ($provinces as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <span class="icon-chevron-thin-down font-weight-bold"></span>
                        </div>
                        <p class="text-danger">{{ $errors->first('province_id') }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-form-label">Kabupaten / Kota</label>
                        <div class="">
                            <select class="form-control" name="city_id" id="city_id" required>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            <span class="icon-chevron-thin-down font-weight-bold"></span>
                        </div>
                        <p class="text-danger">{{ $errors->first('city_id') }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="col-form-label">Kecamatan</label>
                        <div class="">
                            <select class="form-control" name="district_id" id="district_id" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <span class="icon-chevron-thin-down font-weight-bold"></span>
                        </div>
                        <p class="text-danger">{{ $errors->first('district_id') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="password" class=" col-form-label">{{ __('Password') }}</label>
                    
                        <div class="">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">
                    
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password-confirm" class=" col-form-label">{{ __('Confirm Password') }}</label>
                    
                        <div class="">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="text-center col-sm-12">
                        <button type="submit" class="btn">Buat Akun</button>
                    </div>
                </form>
                <a href="/login">Sudah Memiliki Akun</a>
            </div>
        </div>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
    window.jQuery || document.write('<script src="{{asset('
        front / assets / js / vendor / jquery.slim.min.js ')}}"><\/script>')
</script>
<script src="{{ asset('ecommerce/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('ecommerce/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ecommerce/vendors/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('ecommerce/vendors/counter-up/jquery.counterup.js') }}"></script>
<script>
    //KETIKA SELECT BOX DENGAN ID province_id DIPILIH
    $('#province_id').on('change', function () {
        //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
        //DAN MENGIRIMKAN DATA PROVINCE_ID
        $.ajax({
            url: "{{ url('/api/city') }}",
            type: "GET",
            data: {
                province_id: $(this).val()
            },
            success: function (html) {
                //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                $('#city_id').empty()
                //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function (key, item) {
                    $('#city_id').append('<option value="' + item.id + '">' + item
                        .name + '</option>')
                })
            }
        });
    })

    //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
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
</script>

</html>