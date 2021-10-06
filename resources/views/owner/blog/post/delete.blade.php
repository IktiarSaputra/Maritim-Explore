@extends('layouts.master')

@section('title')
    Softdelete Post
@endsection

@section('css')
    <link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>List Softdelete Post</h2>
                </div>
                <div class="card-body">
                    <div class="basic-data-table">
                        <table class="table nowrap" id="basic-data-table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tags</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item => $k)
                                <tr>
                                    <td>{{$item + $post->firstitem() }}</td>
                                    <td>
                                        <img src="{{asset('gambar/'. $k->gambar)}}" width="100px" height="100px" alt="">
                                    </td>
                                    <td>{{$k->title}}</td>
                                    <td>{{$k->blog_category->name}}</td>
                                    <td>
                                        @foreach ($k->tags as $item)
                                        <ul>
                                            <li><label class="badge badge-gradient-success">{{$item->name}}</label></li>
                                        </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="/owner/post/restore/{{$k->id}}"><i class="mdi mdi-eye"></i>
                                            Pulihkan</a>
                                        <a class="btn btn-danger" href="/owner/post/delete/{{$k->id}}">Hapus</a>
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
@endsection