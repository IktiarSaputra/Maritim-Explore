@extends('layouts.sbadmin')

@section('title')
    Konfirmasi Pembayaran
@endsection

@section('content')
<section class="login_box_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Konfirmasi Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customer.savePayment') }}" enctype="multipart/form-data" method="post">
                            @csrf

                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="form-group">
                                <label for="">Invoice ID</label>
                                <input type="text" name="invoice" class="form-control" value="{{ request()->invoice }}"
                                    required readonly>
                                <p class="text-danger">{{ $errors->first('invoice') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pengirim</label>
                                <input type="text" name="name" class="form-control" required>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Transfer Ke</label>
                                <select name="transfer_to" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($rek as $item)
                                    <option value="{{$item->bank_name}} - {{$item->number}}">{{$item->bank_name}}:
                                        {{$item->number}} a.n {{$item->name}}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('transfer_to') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Transfer</label>
                                <input type="number" name="amount" class="form-control" required>
                                <p class="text-danger">{{ $errors->first('amount') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Transfer</label>
                                <input type="date" name="transfer_date" id="transfer_date" class="form-control"
                                    required>
                                <p class="text-danger">{{ $errors->first('transfer_date') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Bukti Transfer</label>
                                <input type="file" name="proof" class="form-control" required>
                                <p class="text-danger">{{ $errors->first('proof') }}</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
{{-- <script>
    $('#transfer_date').datepicker({
        "todayHighlight": true,
        "setDate": new Date(),
        "autoclose": true
    })
</script> --}}
@endsection