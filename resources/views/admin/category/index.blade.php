@extends('layouts.master')

@section('css')
<link href="{{asset('asset/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Kategori</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="padding: 0px;">
                                <th>No</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Created At</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- BAGIAN INI AKAN MENG-HANDLE TABLE LIST CATEGORY  -->
</div>
@endsection

@section('js')
<script src="{{asset('asset/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('asset/demo/datatables-demo.js')}}"></script>

@endsection