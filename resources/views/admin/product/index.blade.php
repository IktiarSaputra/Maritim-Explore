@extends('layouts.master')

@section('title')
List Product
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Product
                </h4>
                <form action="{{ route('product.index') }}" method="get">
                    <div class="input-group mb-3 col-md-3 float-right">
                        <input type="text" name="q" class="form-control" placeholder="Cari..."
                            value="{{ request()->q }}">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-secondary" type="button">Cari</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product as $row)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/products/' . $row->image) }}" width="100px"
                                        height="100px" alt="{{ $row->name }}">
                                </td>
                                <td>
                                    <strong>{{ $row->name }}</strong><br>
                                    <!-- ADAPUN NAMA KATEGORINYA DIAMBIL DARI HASIL RELASI PRODUK DAN KATEGORI -->
                                    <label>Kategori: <span
                                            class="badge badge-info">{{ $row->category->name }}</span></label><br>
                                    <label>Berat: <span class="badge badge-info">{{ $row->weight }}</span></label>
                                    <label>Min. order: <span
                                            class="badge badge-info">{{ $row->min_order }}</span></label>
                                </td>
                                <td>Rp {{ number_format($row->price) }}</td>
                                <td>{{ $row->created_at->format('d-m-Y') }}</td>

                                <!-- KARENA BERISI HTML MAKA KITA GUNAKAN { !! UNTUK MENCETAK DATA -->
                                <td>{!! $row->status_label !!}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- MEMBUAT LINK PAGINASI JIKA ADA -->
                {!! $product->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection