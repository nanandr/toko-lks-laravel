<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Transaksi;
use Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        if(isset($request->keyword)){
            $data = Produk::orderBy('nama_produk')->where('nama_produk', 'like' , '%'.$request->keyword.'%')->get();
        }
        else{
            $data = Produk::orderBy('nama_produk')->get();
        }
        return view('page/index', ['data' => $data])->with('user', 'customer');
    }

    public function admin(Request $request){
        if(isset($request->keyword)){
            $data = Produk::orderBy('nama_produk')->where('nama_produk', 'like' , '%'.$request->keyword.'%')->get();
        }
        else{
            $data = Produk::orderBy('nama_produk')->get();
        }
        return view('page/index', ['data' => $data])->with('user', 'admin');
    }

    public function transaction(Request $request){
        if(isset($request->keyword)){
            $data = Produk::orderBy('nama_produk')->where('nama_produk', 'like' , '%'.$request->keyword.'%')->get();
        }
        else{
            $data = Transaksi::where('customer_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        }
        return view('page/transaksi', ['data' => $data])->with('user', 'customer');
    }

    public function transactionAdmin(Request $request){
        if(isset($request->keyword)){
            // $data = Transaksi::orderBy('created_at', 'desc')->where('nama_produk', 'like' , '%'.$request->keyword.'%')->get();
        }
        else{
            $data = Transaksi::orderBy('created_at', 'desc')->get();
        }
        return view('page/transaksi', ['data' => $data])->with('user', 'customer');
    }
}
