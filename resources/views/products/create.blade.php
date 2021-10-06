@extends('layouts.master')

@section('title')
    Create Product
@endsection

@section('content')
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Create New Produk</h4>
                        <div class="form-group">
                            <label for="name">Name Product</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ old('status') == '1' ? 'selected':'' }}>Tersedia</option>
                                <option value="0" {{ old('status') == '0' ? 'selected':'' }}>Habis</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('status') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
    
                            <!-- TAMBAHKAN ID YANG NNTINYA DIGUNAKAN UTK MENGHUBUNGKAN DENGAN CKEDITOR -->
                            <textarea name="description" id="description"
                                class="form-control">{{ old('description') }}</textarea>
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="category_id">Category</label>
    
                            <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                            <select name="category_id" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($category as $row)
                                <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected':'' }}>
                                    {{ $row->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('category_id') }}</p>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                            <p class="text-danger">{{ $errors->first('price') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="price">Min. Order</label>
                            <input type="text" name="min_order" class="form-control" value="{{ old('min_order') }}">
                            <p style="font-size: 12px;color:red"><strong>*Biarkan kosong jika tidak ada minimal order*</strong></p>
                            <p style="font-size: 12px;color:red"><strong>*Satuan Kilogram*</strong></p>
                            <p class="text-danger">{{ $errors->first('min_order') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight') }}">
                            <p style="font-size: 12px;color:red"><strong>*Satuan Gram*</strong></p>
                            <p class="text-danger">{{ $errors->first('weight') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="image">Image Product</label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}" required>
                            <p class="text-danger">{{ $errors->first('image') }}</p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary col">Create Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
            CKEDITOR.replace('description');
    </script>
@endsection