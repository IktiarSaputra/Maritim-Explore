@extends('layouts.master')

@section('css')
<link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('title')
    List Product
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>List Product</h2>

                <a href="{{route('product.create')}}" class="btn btn-outline-primary btn-sm text-uppercase">
                    <i class=" mdi mdi-plus mr-1"></i> Add Product
                </a>
            </div>

            <div class="card-body">
                <!-- KETIKA ADA SESSION ERROR  -->
                @if (session('error'))
                <!-- MAKA TAMPILKAN ALERT DANGER -->
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($product as $row)
                            <tr>
                                <td>
                                    <img src="{{ asset('products/' . $row->image) }}" alt="{{$row->name}}"
                                        width="70px" height="70px">
                                </td>
                                <td>
                                    <strong>{{ $row->name }}</strong><br>
                                    <!-- ADAPUN NAMA KATEGORINYA DIAMBIL DARI HASIL RELASI PRODUK DAN KATEGORI -->
                                    <label>Kategori: <span
                                            class="badge badge-info">{{ $row->category->name }}</span></label><br>
                                    <label>Berat: <span class="badge badge-info">{{ $row->weight }} Gram</span></label>
                                    <label>Min. order: <span
                                            class="badge badge-info">{{ $row->min_order }}</span></label>
                                </td>
                                <td>
                                    Rp {{ number_format($row->price) }}
                                </td>
                                <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                <td>{!! $row->status_label !!}</td>
                                <td>
                                    <form action="{{ route('product.destroy', $row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('product.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm delete">Hapus</button>
                                    </form>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@if (session('insert'))
<script>
    swal("Product Was Successfully Added",{
            title: "Success",
            icon: "success",
        });
</script>
@endif

@if (session('update'))
<script>
    swal("Product Updated Successfully",{
            title: "Success",
            icon: "success",
        });
</script>
@endif

@if (session('delete'))
<script>
    swal("Product Deleted Successfully",{
            title: "Success",
            icon: "success",
        });
</script>
@endif
@endsection