@extends('layouts.sbadmin')

@section('content')
<section class="login_box_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Pribadi</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('customer.setting') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required
                                    value="{{ $customer->name }}">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required
                                    value="{{ $customer->email }}" readonly>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="******">
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                <p>Biarkan kosong jika tidak ingin mengganti password</p>
                            </div>
                            <div class="form-group">
                                <label for="">No Telp</label>
                                <input type="text" name="phone_number" class="form-control" required
                                    value="{{ $customer->phone_number }}">
                                <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" name="address" class="form-control" required
                                    value="{{ $customer->address }}">
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Propinsi</label>
                                <select class="form-control" name="province_id" id="province_id" required>
                                    <option value="">Pilih Propinsi</option>
                                    <!-- LOOPING DATA PROVINCE UNTUK DIPILIH OLEH CUSTOMER -->
                                    @foreach ($provinces as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('province_id') }}</p>
                            </div>

                            <!-- ADAPUN DATA KOTA DAN KECAMATAN AKAN DI RENDER SETELAH PROVINSI DIPILIH -->
                            <div class="form-group">
                                <label for="">Kabupaten / Kota</label>
                                <select class="form-control" name="city_id" id="city_id" required>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('city_id') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Kecamatan</label>
                                <select class="form-control" name="district_id" id="district_id" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('district_id') }}</p>
                            </div>
                            <button class="btn btn-primary btn-sm">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
    window.jQuery || document.write('<script src="{{asset('
        front / assets / js / vendor / jquery.slim.min.js ')}}"><\/script>')
</script>

<script src="{{ asset('ecommerce/js/jquery-3.2.1.min.js') }}"></script>
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


@endsection