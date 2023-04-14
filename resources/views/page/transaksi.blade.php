@extends('app')
@section('nav')
    @include('components/nav')
@endsection
@section('content')
    <img class="banner" src="{{asset('img/banner/banner.jpg')}}" alt="">
    <div class="section">
        <h1 id="products">Daftar Transaksi</h1>
        @foreach ($data as $r)
            <a href="{{ url('transaction/detail/'.$r->id) }}">
                <div class="card">
                    <div class="card-content">
                        <div style="display: flex; flex-direction: rows; align-items: center;">
                            <h1>{{ $r->transaksi_detail->produk->nama_produk }}</h1>
                            <p>{{ $r->customer->nama_lengkap }}</p>
                        </div>
                        <p>{{ $r->kode_transaksi }}</p>
                        <p>{{ $r->created_at }}</p>
                        <p><b>Jumlah:</b> {{ $r->transaksi_detail->jumlah }} <b>Total:</b> Rp {{ $r->transaksi_detail->produk->harga * $r->transaksi_detail->jumlah }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
@section('footer')
    @include('components/footer')
@endsection
