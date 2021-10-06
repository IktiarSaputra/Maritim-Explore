@extends('layouts.master')

@section('title')
List Category
@endsection

@section('css')
<link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>List Category</h2>

                <button type="button" class="btn btn-outline-primary btn-sm text-uppercase" data-toggle="modal"
                    data-target="#exampleModalForm">
                    <i class=" mdi mdi-plus mr-1"></i> Add Category
                </button>
            </div>

            <div class="card-body">
                @if ($errors->first('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
                <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($category as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->parent ? $item->parent->name:'-' }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <form action="{{ route('category.destroy', $item->id) }}" method="post">
                                        <!-- KONVERSI DARI @ CSRF & @ METHOD AKAN DIJELASKAN DIBAWAH -->
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('category.edit', $item->id) }}"
                                            class="btn btn-outline-warning btn-sm">Edit</a>
                                        <button class="btn btn-outline-danger btn-sm">Hapus</button>
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

<div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFormTitle">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                            aria-describedby="emailHelp" placeholder="Enter Name">
                        <small id="emailHelp" class="form-text text-danger">Please check your category name first before
                            creating a new one</small>

                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent</label>
                        <select name="parent_id" class="form-control">
                            <option value="">None</option>
                            @foreach ($parent as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row m-auto">
                        <button type="button" class="btn btn-danger col-5" data-dismiss="modal"><i class="mdi mdi-close"></i> Close</button>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@if (session('insert'))
<script>
    swal("Category Was Successfully Added", {
        title: "Success",
        icon: "success",
    });
</script>
@endif

@if (session('update'))
<script>
    swal("Category Updated Successfully", {
        title: "Success",
        icon: "success",
    });
</script>
@endif

@if (session('delete'))
<script>
    swal("Category Deleted Successfully", {
        title: "Success",
        icon: "success",
    });
</script>
@endif

@if (session('error'))
<script>
    swal("This Category Has Kateg Children", {
        title: "Failed",
        icon: "warning",
    });
</script>
@endif
@endsection