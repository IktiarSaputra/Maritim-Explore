@extends('layouts.master')

@section('css')
<link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('title')
List Data User
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>List User</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-sm mb-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="mdi mdi-plus"></i> Add Owner
                </button>
            </div>

            <div class="card-body">
                <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Last Seen</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td><img src="{{$item->getAvatar()}}" style="border-radius: 50px" width="60px"
                                        height="60px" alt=""></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>
                                    @if ($item->level == 'admin')
                                    <span class="badge badge-success badge-pill">{{$item->level}}</span>
                                    @elseif($item->level == 'seller')
                                    <span class="badge badge-primary badge-pill">{{$item->level}}</span>
                                    @elseif($item->level == 'owner')
                                    <span class="badge badge-info badge-pill">{{$item->level}}</span>
                                    @elseif($item->level == '')
                                    <span class="badge badge-secondary badge-pill">User</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->district_id = $item->district_id)
                                    {{ $item->address }} <br> {{ $item->district->name }}
                                    {{ $item->district->city->name }}
                                    {{ $item->district->city->province->name }}
                                    @else
                                    {{ $item->address }}
                                    @endif
                                </td>
                                <td>
                                    @if(Cache::has('is_online' . $item->id))
                                    <span class="text-success">Online</span>
                                    @else
                                    <span class="text-secondary">Offline {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Owner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" method="POST" action="{{route('owneruser.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="number">No Hp</label>
                        <input id="phone_number" type="number"
                            class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                            value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                            name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row m-auto">
                        <button type="button" class="btn btn-danger col-5" data-bs-dismiss="modal"><i
                                class="mdi mdi-close"></i> Close</button>
                        <div class="col-2"></div>
                        <button type="submit" class="btn btn-success col-5"><i class="mdi mdi-content-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{asset('admin/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script>
    jQuery(document).ready(function () {
        jQuery('#basic-data-table').DataTable({
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
    integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
    integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
</script>
@endsection