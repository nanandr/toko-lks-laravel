@extends('app')
@section('nav')
    @include('components/nav')
@endsection
@section('content')
    <img class="banner banner-sm" style="object-fit:contain !important;" src="@if($form == 'buy' || $title == 'Edit Produk'){{asset('uploads/'.$data->gambar)}}@else{{asset('img/banner/banner.jpg')}}@endif" alt="">
    <div class="form">
        <h1>{{$title}}</h1>
        <form action="{{$action}}" method="post" enctype="multipart/form-data">

            @if($form == 'edit' || $form == 'buy')
                {{ method_field('PUT') }}
            @endif
            {{ csrf_field() }}

            @foreach ($fillable as $name => $r)
                <input
                @foreach ($r as $type => $value)
                        type="{{ $type }}" placeholder="{{ str_replace('_', ' ', ucfirst($name)) }}" name="{{ $name }}"
                        @if($title != 'Edit Produk' && $type != 'file')
                            required
                        @endif
                        @if($form == 'edit' || $form == 'buy')
                            value="{{ $value }}"
                        @endif
                        @if($value == 'number')
                            min="0"
                        @endif
                @endforeach
                @if($form == 'buy')
                    readonly
                @endif
                >
                <br>
            @endforeach

            @if($title == 'Your Profile')
                <input type="password" placeholder="Password.. (Required)" name="old_password" required>
                <br>
                <input type="password" placeholder="New password.. (Optional)" name="new_password">
                <br>
            @endif

            @if($form == 'buy' || $title == 'Tambah Produk' || $title == 'Edit Produk')
                <select @if(isset($data) && $title != 'Edit Produk') disabled @elseif($title == 'Edit Produk' || $title == 'Tambah Produk') required @endif name="kategori">
                    <option value="Pilih Kategori" @if(!isset($data)) selected @endif disabled>Pilih Kategori</option>
                    @foreach($kategori as $r)
                        <option value="{{ $r->id }}" @if(isset($data) && $r->id == $data->kategori_id) selected @endif>{{$r->nama_kategori}}</option>
                    @endforeach
                </select>
                <br>
            @endif

            <input type="submit" value="{{str_replace('_', ' ', ucfirst($form)) }}">

            @if($form == 'buy')
                <input type="number" name="jumlah" placeholder="Jumlah" value="1" min="1">
            @endif
        </form>
        <br>
        @if($title == 'Login')
            <a class="register" href="{{url('register')}}">Register</a>
        @elseif($title == 'Your Profile')
            <?php $logout = 'logout' ?>
            @if(isset(Auth::user()->nama))
                <?php $logout = 'admin/logout' ?>
            @endif
            <a class="register" href="{{url($logout)}}" onclick="return confirm('Apakah anda yakin akan logout?')">Logout</a>
        @elseif($title == 'Edit Produk')
            <a class="register" href="{{url('admin/product/delete/'.$data->id)}}" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">Hapus</a>
        @endif

        @if(isset($error))
            {{$error}}
        @endif

    </div>
@endsection
@section('footer')
    @include('components/footer')
@endsection
