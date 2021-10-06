@extends('layouts.master')

@section('title')
    Update Category {{$kategori->name}}
@endsection

@section('css')
    
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" method="POST" action="/owner/category/update/{{$kategori->id}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputNis1">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$kategori->name}}"
                            id="exampleInputNis1" required placeholder="Nama Kategori">
                    </div>
                    <div class="form-group row m-auto">
                        <button type="submit" class="btn btn-success btn-block"><i class="mdi mdi-content-save"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    
@endsection