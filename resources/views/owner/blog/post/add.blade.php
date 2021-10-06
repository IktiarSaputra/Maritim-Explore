@extends('layouts.master')

@section('title')
Add New Post
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection      

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('store.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="title" id="judul" required
                            placeholder="Judul Post">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="blog_category_id" id="kategori">
                            <option value="" holder>Pilih Kategori :</option>
                            @foreach ($kategori as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->id}}"
                            placeholder="Judul Post">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Tags</label>
                        <select class="tags form-control btn" name="tags[]" multiple="multiple">
                            @foreach ($tags as $t)
                            <option value="{{$t->id}}">{{$t->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea id="my-editor" name="content" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar" required
                            placeholder="Judul Post">
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
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.tags').select2();
    });
</script>

<script>
  CKEDITOR.replace('my-editor', {
      filebrowserUploadUrl: "{{route('post.image', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
  });
</script>
@endsection