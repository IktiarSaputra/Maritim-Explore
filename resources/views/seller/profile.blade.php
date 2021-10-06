@extends('layouts.master')

@section('title')
Profile {{Auth::user()->name}}
@endsection

@section('css')
<link href="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="bg-white border rounded">
    <div class="row no-gutters">
        <div class="col-lg-4 col-xl-3">
            <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                <div class="card text-center widget-profile px-0 border-0">
                    <div class="card-img mx-auto rounded-circle">
                        <img id="blah" src="{{Auth::user()->getAvatar()}}" alt="user image">
                    </div>
                    <div class="card-body">
                        <h4 class="py-2 text-dark">{{Auth::user()->name}}</h4>
                        <p>{{Auth::user()->email}}</p>
                    </div>
                </div>
                <hr class="w-100">
                <div class="contact-info pt-4">
                    <h5 class="text-dark mb-1">Personal Information</h5>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
                    <p>{{Auth::user()->email}}</p>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
                    <p>{{Auth::user()->phone_number}}</p>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Address</p>
                    <p>{{Auth::user()->address}}<br>{{Auth::user()->district->city->name}}<br>{{Auth::user()->district->city->province->name}}
                    </p>

                    <hr class="w-100">

                    <h5 class="text-dark mb-1">seller Information</h5>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Name Shop</p>
                    <p>{{Auth::user()->seller->shop_name}}</p>
                    <p class="text-dark font-weight-medium pt-4 mb-2">Description</p>
                    <p>{!!Auth::user()->seller->description!!}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-9">
            <div class="profile-content-right py-5">
                <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Personal Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="sellers-tab" data-toggle="tab" href="#sellers" role="tab"
                            aria-controls="sellers" aria-selected="false">Sellers Profile</a>
                    </li>
                </ul>
                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="mt-5">
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
                    <div class="tab-pane fade show active" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                        <div class="mt-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Add Account Number
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Account Number</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('seller.update')}}" method="POST">
                                                @csrf
                                                <input type="hidden" class="form-control" name="user_id"
                                                    value="{{Auth::user()->id}}" id="userName">

                                                <div class="form-group mb-4">
                                                    <label for="userName">Name</label>
                                                    <input type="text" name="name" class="form-control" id="userName"
                                                        required>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label for="userName">Bank Name</label>
                                                    <input type="text" name="bank_name" class="form-control"
                                                        id="userName" required>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label for="no-rek">Account Number</label>
                                                    <input type="number" name="number" class="form-control" id="no-rek"
                                                        required>
                                                </div>

                                                <div class="form-group row m-auto">
                                                    <button type="button" class="btn btn-danger col-5"
                                                        data-bs-dismiss="modal"><i class="mdi mdi-close"></i>
                                                        Close</button>

                                                    <div class="col-2"></div>
                                                    <button type="submit" class="btn btn-success col-5"><i
                                                            class="mdi mdi-content-save"></i>
                                                        Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Bank Name</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @forelse ($number as $num)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td>{{$num->name}}</td>
                                        <td>{{$num->bank_name}}</td>
                                        <td>{{$num->number}}</td>
                                        <td>
                                            <a href="/seller/profile/delete/{{$num->id}}"
                                                class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="5" class="text-center">
                                            Account Number Has Not Been Added
                                        </th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <form action="{{ route('seller.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name Shop</label>
                                    <input type="text" name="shop_name" class="form-control" required
                                        value="{{ $customer->seller->shop_name }}">
                                    <p class="text-danger">{{ $errors->first('name_shop') }}</p>
                                </div>
                                <input type="hidden" name="user_id" value="{{ $customer->id }}">
                                <div class="form-group">
                                    <label for="description">Description</label>

                                    <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                                    <textarea name="description" id="description"
                                        class="form-control">{!! $customer->seller->description !!}</textarea>
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                </div>
                                <button class="btn btn-primary btn-sm">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
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
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
            CKEDITOR.replace('description');
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
    integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
    integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if (session('sukses'))
<script>
    swal("Please complete your personal data first");
</script>
@endif
@endsection