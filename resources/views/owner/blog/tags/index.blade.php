@extends('layouts.master')

@section('title')
    List Tags
@endsection

@section('css')
    <link href="{{asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-titlectext-center" id="exampleModalLabel">Add Tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="{{route('add.tags')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputNis1">Nama</label>
                            <input type="text" class="form-control" name="name" id="exampleInputNis1" required
                                placeholder="Nama Tags">
                        </div>
                        <div class="form-group row m-auto">
                            <button type="button" class="btn btn-danger col-5" data-dismiss="modal"><i
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
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>List Tags</h2>
                
                    <button type="button" class="btn btn-outline-primary btn-sm text-uppercase" data-toggle="modal"
                        data-target="#exampleModal">
                        <i class=" mdi mdi-plus mr-1"></i> Add Tags
                    </button>
                </div>
                <div class="card-body">
                    <div class="basic-data-table">
                        <table class="table nowrap" id="basic-data-table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tags</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $item => $k)
                                <tr>
                                    <td>{{$item + $tags->firstitem() }}</td>
                                    <td>{{$k->name}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="/owner/tags/edit/{{$k->id}}"><i
                                                class="mdi mdi-pencil"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/owner/tags/hapus/{{$k->id}}"><i
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
        swal("Tags Was Successfully Added", {
                title: "Success",
                icon: "success",
            });
    </script>
    @endif
    
    @if (session('update'))
    <script>
        swal("Tags Updated Successfully", {
                title: "Success",
                icon: "success",
            });
    </script>
    @endif
    
    @if (session('delete'))
    <script>
        swal("Tags Deleted Successfully", {
                title: "Success",
                icon: "success",
            });
    </script>
    @endif
    
    @if (session('error'))
    <script>
        swal("This Tags Has Kateg Children", {
                title: "Failed",
                icon: "warning",
            });
    </script>
    @endif
@endsection