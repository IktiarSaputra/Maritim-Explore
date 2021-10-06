@extends('layouts.master')

@section('title')
    Update Tags {{$tags->name}}
@endsection

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" method="POST" action="/owner/tags/update/{{$tags->id}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputNis1">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$tags->name}}" id="exampleInputNis1"
                            required placeholder="Nama Kategori">
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