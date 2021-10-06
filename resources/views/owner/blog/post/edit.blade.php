@extends('layouts.master')

@section('title')
    Update Post {{$post->title}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{route('update.post', $post->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" value="{{$post->title}}" maxlength="80" name="title" id="judul"
                            required placeholder="Judul Post">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="category_id" id="kategori">
                            <option value="{{$post->blog_category_id}}">{{$post->blog_category->name}}</option>
                            <hr>
                            @foreach ($kategori as $item)
                            <option value="{{$item->id}}" @if ($post->category_id == $item->id)selected
                                @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Tags</label>
                        <select class="tags form-control btn" name="tags[]" multiple="multiple">
                            @foreach ($tags as $t)
                            <option value="{{$t->id}}" @foreach ($post->tags as $tag)
                                @if ($t->id == $tag->id)
                                selected
                                @endif
                                @endforeach
                                >{{$t->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten</label>
                        <textarea id="my-editor" name="content" class="form-control">{{$post->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar" placeholder="Judul Post">
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
    $(document).ready(function() {
    $('.tags').select2();
});
</script>
<script>
    //HUBUNGKAN CKEDITOR DENGAN TEXTAREA YANG BERNAMA CONTENT
  //ADAPUN KONFIGURASI UPLOAD URLNYA MENGARAH KE ROUTE POST.IMAGE
  CKEDITOR.replace('my-editor', {
      filebrowserUploadUrl: "{{route('post.image', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
  });
</script>
@endsection