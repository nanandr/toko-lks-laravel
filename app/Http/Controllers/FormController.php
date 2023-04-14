<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Kategori;
use Auth;

class FormController extends Controller
{
    public function login(){
        return view('page/form')
        ->with('title', 'Login')
        ->with('action', url('login/auth'))
        ->with('form', 'add')
        ->with('fillable' , [
            'email' => ['email'=>''],
            'password' => ['password'=>''],
        ]);
    }
    public function adminLogin(){
        return view('page/form')
        ->with('title', 'Login Admin')
        ->with('action', url('admin/login/auth'))
        ->with('form', 'add')
        ->with('fillable' , [
            'email' => ['email'=>''],
            'password' => ['password'=>''],
        ]);
    }

    public function register(){
        return view('page/form')
        ->with('title', 'Register')
        ->with('action', url('register/auth'))
        ->with('form', 'register')
        ->with('fillable' , [
            'nama_lengkap' => ['text'=>''],
            'email' => ['email'=>''],
            'no_hp' => ['number'=>''],
            'alamat_lengkap' => ['text'=>''],
            'password' => ['password'=>''],
        ]);
    }
    public function adminRegister(){
        return view('page/form')
        ->with('title', 'Register Admin')
        ->with('action', url('admin/register/auth'))
        ->with('form', 'register')
        ->with('fillable' , [
            'nama' => ['text'=>''],
            'email' => ['email'=>''],
            'password' => ['password'=>''],
        ]);
    }

    public function product(){
        $kategori = Kategori::all();
        return view('page/form', ['kategori' => $kategori])
        ->with('title', 'Tambah Produk')
        ->with('action', url('admin/product/add/auth'))
        ->with('form', 'add')
        ->with('fillable' , [
            'nama_produk' => ['text'=>''],
            'deskripsi' => ['text'=>''],
            'nama_produk' => ['text'=>''],
            'harga' => ['number'=>''],
            'gambar' => ['file'=>''],
        ]);
    }
    public function category(){
        return view('page/form')
        ->with('title', 'Tambah Kategori')
        ->with('action', url('admin/category/add/auth'))
        ->with('form', 'add')
        ->with('fillable' , [
            'nama_kategori' => ['text'=>'']
        ]);
    }

    public function adminProfile(){
        $data = Admin::find(Auth::user()->id);
        return view('page/form')
        ->with('title', 'Your Profile')
        ->with('action', url('admin/profile/edit/'.$data->id))
        ->with('form', 'edit')
        ->with('fillable' , [
            'nama' => ['text'=>$data->nama],
            'email' => ['email'=>$data->email],
        ]);
    }
    public function customerProfile(){
        $data = Customer::find(Auth::user()->id);
        return view('page/form')
        ->with('title', 'Your Profile')
        ->with('action', url('profile/edit/'.$data->id))
        ->with('form', 'edit')
        ->with('fillable' , [
            'nama_lengkap' => ['text'=>$data->nama_lengkap],
            'email' => ['email'=>$data->email],
            'no_hp' => ['number'=>$data->no_hp],
            'alamat_lengkap' => ['text'=>$data->alamat_lengkap],
        ]);
    }

    public function produkView($id){
        $data = Produk::find($id);
        $kategori = Kategori::all();
        return view('page/form', ['data' => $data, 'kategori' => $kategori])
        ->with('title', 'Buy')
        ->with('action', url('buy/'.$data->id))
        ->with('form', 'buy')
        ->with('fillable' , [
            'nama_produk' => ['text'=>$data->nama_produk],
            'deskripsi' => ['text'=>$data->deskripsi],
            'harga' => ['number'=>$data->harga],
        ]);
    }
    public function produkEdit($id){
        $data = Produk::find($id);
        $kategori = Kategori::all();
        return view('page/form', ['data' => $data, 'kategori' => $kategori])
        ->with('title', 'Edit Produk')
        ->with('action', url('admin/product/edit/'.$data->id))
        ->with('form', 'edit')
        ->with('fillable' , [
            'nama_produk' => ['text'=>$data->nama_produk],
            'deskripsi' => ['text'=>$data->deskripsi],
            'harga' => ['number'=>$data->harga],
            'gambar' => ['file'=>''],
        ]);
    }
}
