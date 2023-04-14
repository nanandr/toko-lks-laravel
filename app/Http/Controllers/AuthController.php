<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        Customer::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat_lengkap' => $request->alamat_lengkap,
            'password' => Hash::make($request->password),
        ]);
        Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect('/');
    }


    public function adminRegister(Request $request){
        Admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        return redirect('admin');
    }

    public function login(Request $request){
        if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended('/');
        }
        elseif(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended('admin');
        }
        else{
            return redirect('login')->with('error', 'Email/Password Salah');
        }
    }
    public function adminLogin(Request $request){
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended('admin');
        }
        else{
            return redirect('admin/login')->with('error', 'Email/Password Salah');
        }
    }

    public function customerEdit(Request $request, $id){
        $user = Customer::find($id);
        if(Hash::check($request->old_password, $user->password)){
            $user->nama_lengkap = $request->nama_lengkap;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->alamat_lengkap = $request->alamat_lengkap;
            if(isset($request->new_password)){
                $user->password = Hash::make($request->new_password);
            }
            $user->save();

            return redirect('/');
        }
        else{
            return redirect('profile');
        }
    }
    public function adminEdit(Request $request, $id){
        $user = Admin::find($id);
        if(Hash::check($request->old_password, $user->password)){
            $user->nama = $request->nama;
            $user->email = $request->email;
            if(isset($request->new_password)){
                $user->password = Hash::make($request->new_password);
            }
            $user->save();

            return redirect('admin');
        }
        else{
            return redirect('admin/profile');
        }
    }

    public function logout(){
        Auth::guard('customer')->logout();
        return redirect('login');
    }
    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
