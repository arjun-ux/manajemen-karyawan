<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    // index login multi auth
    public function login()
    {
        return view('auth.login');
    }
    // doLogin
    public function doLogin(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (auth()->attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withInput()->withErrors([
            'errors' => 'Username Atau Password Salah.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message'=>'Logout Berhasil']);
    }
}
