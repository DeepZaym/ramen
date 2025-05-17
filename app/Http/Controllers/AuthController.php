<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ramen;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function tampilRegistrasi() {
        return view('ramen.registrasi');
    }

    function submitRegistrasi(Request $request) {
        $user = new AuthUser();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('login');

    }

    function tampilLogin() {
        return view('ramen.login');
    }

    function submitLogin(Request $request) {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('ramen');
        } else {
            return redirect()->back()->with('gagal', 'Email atau Password anda salah');
        }
    }

    function logout() {
        Auth::logout();
        return redirect()->route('login');

    }
}
