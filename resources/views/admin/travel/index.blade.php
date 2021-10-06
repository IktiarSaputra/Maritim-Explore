@extends('layouts.master')

@section('title')
List Tourism Object
@endsection

@section('css')
<link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>List Tourism Object</h2>
                 
                <a href="{{route('travel.create')}}" class="btn btn-outline-primary btn-sm mb-3"><i class="mdi mdi-plus"></i> Add Destination</a>
            </div>

            <div class="card-body">
                <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                    
                        <tbody>
                            @foreach ($travel as $item)
                            <tr>
                                <td>
                                    <img src="{{asset('gambar/'. $item->gambar)}}" width="60px" height="60px" alt="">
                                </td>
                                <td><a href="/travel/{{ $item->slug }}">{{$item->title}}</a></td>
                                <td>
                                    <form action="{{ route('travel.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('travel.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i> Edit</a>
                                        <button class="btn btn-danger btn-sm delete"><i class="mdi mdi-delete"></i>
                                            Hapus</button>
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

<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('travel.import')}}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger col" data-dismiss="modal"><i class="mdi mdi-close"></i>
                        Close</button>
                    <button type="submit" class="btn btn-success col"><i class="mdi mdi-content-save"></i>
                        Save</button>
                </div>
            </div>
        </form>
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
@endsection