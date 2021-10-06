@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('ecommerce/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('ecommerce/vendors/linericon/style.css') }}">
<link rel="stylesheet" href="{{ asset('ecommerce/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('ecommerce/css/style.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css"
    rel="stylesheet" />
@endsection

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>ORIGIN</h3>
                    <hr>
                    <div class="form-group">
                        <label class="font-weight-bold">KOTA / KABUPATEN ASAL</label>
                        <input type="number" name="origin" readonly id="origin" value="{{$origin}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>DESTINATION</h3>
                    <hr>
                    <div class="form-group">
                        <label for="">Propinsi</label>
                        <select class="form-control" name="province_id" id="province_id" required>
                            <option value="">Pilih Propinsi</option>
                            @foreach ($provinces as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{ $errors->first('province_id') }}</p>
                    </div>
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
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>KURIR</h3>
                    <hr>
                    <div class="form-group">
                        <label>PROVINSI TUJUAN</label>
                        <select class="form-control kurir" name="courier">
                            <option value="0">-- pilih kurir --</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">BERAT (GRAM)</label>
                        <input type="number" readonly name="weight" id="weight" value="{{$weight}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-md btn-primary btn-block btn-check">CEK ONGKOS KIRIM</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card d-none ongkir">
                <div class="card-body">
                    <select class="form-control" id="ongkir" required>
                        <option value="">Pilih Kurir</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- <div class="container">
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <form class="row contact_form" action="" method="post" novalidate="novalidate">
                @csrf
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
<div class="form-group col-md-12 p_star">
    <label>PROVINSI TUJUAN</label>
    <select class="form-control kurir" name="courier">
        <option value="0">-- pilih kurir --</option>
        <option value="jne">JNE</option>
        <option value="pos">POS</option>
        <option value="tiki">TIKI</option>
    </select>
</div>
<div class="form-group col-md-12 p_star">
    <input type="hidden" name="weight" id="weight" value="{{$weight}}">
</div>
<div class="form-group col-md-12 p_star">
    <input type="hidden" name="origin" id="origin" value="{{$origin}}">
</div>

<div class="col-md-3">
    <button class="btn btn-md btn-primary btn-block btn-check">CEK ONGKOS KIRIM</button>
</div>
</form>
</div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card d-none ongkir">
            <div class="card-body">
                <ul class="list-group" id="ongkir"></ul>
            </div>
        </div>
    </div>
</div>
</div> --}}

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
</script>

<script>
    let isProcessing = false;
    $('.btn-check').click(function (e) {
        e.preventDefault();

        let token = $("meta[name='csrf-token']").attr("content");
        let city_origin = $('input[name=origin]').val();
        let city_destination = $('select[name=city_id]').val();
        let courier = $('select[name=courier]').val();
        let weight = $('#weight').val();

        if (isProcessing) {
            return;
        }

        isProcessing = true;
        jQuery.ajax({
            url: "/ongkir",
            data: {
                _token: token,
                city_origin: city_origin,
                city_destination: city_destination,
                courier: courier,
                weight: weight,
            },
            dataType: "JSON",
            type: "POST",
            success: function (response) {
                isProcessing = false;
                if (response) {
                    $('#ongkir').empty();
                    $('.ongkir').addClass('d-block');
                    $.each(response[0]['costs'], function (key, value) {
                        $('#ongkir').append('<option>' + response[0]
                            .code.toUpperCase() + ' : <strong>' + value.service +
                            '</strong> - Rp. ' + value.cost[0].value + '(' + value.cost[
                                0].etd + 'hari) </option>')
                    });

                }
            }
        });

    });
</script>

@endsection