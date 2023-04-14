@extends('app')
@section('nav')
    @include('components/nav')
@endsection
@section('content')
    <img class="banner" src="{{asset('img/banner/banner.jpg')}}" alt="">
    <div class="section">
        <h1 id="products">
            @if(request('keyword') !== null)
                You searched for "{{request()->keyword}}"
            @else
                Toko Online LKS @if($user == 'admin') Admin Dashboard @endif
            @endif
        </h1>
        @if($user == 'admin')
            <a href="{{ url('admin/product/add') }}">
                <div class="card card-sm">
                    <div class="card-content">
                        <p>Tambah Data Produk</p>
                    </div>
                </div>
            </a>
            <a href="{{ url('admin/category/add') }}">
                <div class="card card-sm">
                    <div class="card-content">
                        <p>Tambah Data Kategori</p>
                    </div>
                </div>
            </a>
        @endif
        @foreach ($data as $r)
            <a href="@if($user=='customer'){{ url('item/'.$r->id) }}@elseif($user=='admin'){{ url('admin/item/'.$r->id) }}@endif">
                <div class="card">
                    <img src="{{ asset('uploads/'.$r->gambar) }}" alt="">
                    <div class="card-content">
                        <h1>{{ $r->nama_produk }}</h1>
                        <p>Rp {{ $r->harga }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
@section('footer')
    @include('components/footer')
@endsection
