@extends('layouts.master')

@section('title')
List Data Populations
@endsection

@section('css')
<link href="{{asset('/js/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>List Populations</h2>

                <button type="button" class="btn btn-outline-primary btn-sm mb-3" data-toggle="modal" data-target="#importExcel">
                    IMPORT EXCEL
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Region</th>
                                <th>Jumlah Penduduk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($population as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->nama_wilayah}}</td>
                                <td>{{$item->jumlah_penduduk}}</td>
                            </tr>
                            @empty
        
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Manager</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($population as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->nama_wilayah}}</td>
                                <td>{{$item->jumlah_penduduk}}</td>
                                <td>{{$item->pria}}</td>
                                <td>{{$item->wanita}}</td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('population.import')}}" enctype="multipart/form-data">
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
                    <button type="button" class="btn btn-danger col" data-dismiss="modal"><i class="mdi mdi-close"></i> Close</button>
                    <button type="submit" class="btn btn-success col"><i class="mdi mdi-content-save"></i>
                        Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/js/demo/datatables-demo.js')}}"></script>
@endsection