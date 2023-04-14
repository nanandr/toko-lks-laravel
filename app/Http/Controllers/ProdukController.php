<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Auth;

class ProdukController extends Controller
{
    public function buy(Request $request, $id){
        $kode = 'INV/' . Carbon::now()->format('Y') . '-' . Carbon::now()->format('m') . '-' . Carbon::now()->format('d') . '/' . Auth::user()->id . rand('10','99');
        Transaksi::create([
            'customer_id' => Auth::user()->id,
            'kode_transaksi' => $kode,
        ]);

        $data = Transaksi::where('kode_transaksi', $kode)->first();

        TransaksiDetail::create([
            'produk_id' => $id,
            'jumlah' => $request->jumlah,
            'transaksi_id' => $data->id,
        ]);
        return redirect('/');
    }

    public function add(Request $request){
        $file = $request->file('gambar');
        $encrypt = time() . '_' . $file->getClientOriginalName();
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $encrypt,
        ]);
        $file->move('uploads', $encrypt);
        return redirect('admin');
    }

    public function category(Request $request){
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect('admin');
    }

    public function produkEdit(Request $request, $id){
        $data = Produk::find($id);
        $data->nama_produk = $request->nama_produk;
        $data->kategori_id = $request->kategori;
        $data->deskripsi = $request->deskripsi;
        $data->harga = $request->harga;

        if($request->file('gambar') !== null){
            $file = $request->file('gambar');
            $encrypt = time() . '_' . $file->getClientOriginalName();

            $data->gambar = $encrypt;
            $file->move('uploads', $encrypt);
        }

        $data->save();
        return redirect('admin');
    }

    public function produkDelete($id){
        $data = Produk::find($id);

        // $detail = TransaksiDetail::where('produk_id', $id);
        // foreach($detail as $r){
        //     Transaksi::find($r->transaksi_id)->delete();
        // }

        $data->delete();
        return redirect('admin');
    }
}
