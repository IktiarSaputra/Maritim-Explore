@extends('layouts.master')

@section('title')
    List Post
@endsection

@section('css')
    <link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <a class="btn btn-outline-danger mb-3" href="{{route('softdelete.post')}}">
        <i class="mdi mdi-delete"></i> Trash
    </a>
    
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>List Post</h2>
                
                    <a class="btn btn-outline-primary btn-sm mb-3" href="{{route('add.post')}}">
                        <i class="mdi mdi-plus"></i> Add Post
                    </a>
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
                                    <th>Created</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $item => $k)
                                <tr>
                                    <td>{{$item + $post->firstitem() }}</td>
                                    <td>
                                        <img src="{{asset('gambar/'. $k->gambar)}}" width="60px" height="60px" alt="">
                                    </td>
                                    <td><a href="/education/{{$k->slug}}">{{$k->title}}</a></td>
                                    <td>{{$k->blog_category->name}}</td>
                                    <td>
                                        @foreach ($k->tags as $item)
                                        <label class="badge badge-success">{{$item->name}}</label>
                                        @endforeach
                                    </td>
                                    <td>{{$k->created_at->format('d M Y')}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="/owner/post/edit/{{$k->id}}"><i
                                                class="mdi mdi-pencil"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/owner/post/hapus/{{$k->id}}"><i
                                                class="mdi mdi-delete"></i></a>
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
        swal("Post Was Successfully Added", {
                title: "Success",
                icon: "success",
            });
    </script>
    @endif
    
    @if (session('update'))
    <script>
        swal("Post Updated Successfully", {
                title: "Success",
                icon: "success",
            });
    </script>
    @endif
    
    @if (session('delete'))
    <script>
        swal("Post Deleted Successfully", {
                title: "Success",
                icon: "success",
            });
    </script>
    @endif

    @if (session('restore'))
    <script>
        swal("Post Successfully Restored", {
                    title: "Success",
                    icon: "success",
                });
    </script>
    @endif

    @if (session('trash'))
    <script>
        swal("Post was successfully deleted permanently", {
                        title: "Success",
                        icon: "success",
                    });
    </script>
    @endif
    
    @if (session('error'))
    <script>
        swal("This Post Has Kateg Children", {
                title: "Failed",
                icon: "warning",
            });
    </script>
    @endif
@endsection