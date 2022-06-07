<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {


        return view('backend.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {

            return redirect()->route('admin.dashboard')->with('success','Yönetim Paneline Hoşgeldiniz');
        }

        return redirect()->route('admin.login')->with('error','Kullanıcı Adı veya Şifre Yanlış');

    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('/admin');
    }


}
