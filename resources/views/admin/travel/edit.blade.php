@extends('layouts.master')

@section('title')
Edit Destination {{$travel->title}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('travel.update', $travel->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="title" value="{{$travel->title}}" maxlength="50" id="judul" required
                            placeholder="Judul Post">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->id}}" placeholder="Judul Post">
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea id="my-editor" name="content" class="form-control">{{$travel->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar"  placeholder="Judul Post">
                    </div>
                    <div class="form-group row m-auto">
                        <button type="submit" class="btn btn-success btn-block"><i class="mdi mdi-content-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/js/select2.min.js')}}"></script>
{{-- <script src="{{asset('ckeditor/ckeditor.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.tags').select2();
    });
</script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    //HUBUNGKAN CKEDITOR DENGAN TEXTAREA YANG BERNAMA CONTENT
  //ADAPUN KONFIGURASI UPLOAD URLNYA MENGARAH KE ROUTE POST.IMAGE
  CKEDITOR.replace('my-editor', {
      filebrowserUploadUrl: "{{route('travel.image', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
  });
</script>
@endsection