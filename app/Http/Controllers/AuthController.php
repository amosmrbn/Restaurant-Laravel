<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() 
    {
        $data = [
            "title" => "Login",
        ];

        return view('auth.index', $data);
    }

    public function login(Request $request)
    {
        $messages = [
            'username.required' => 'Tolong isi usernamenya.',
            'password.required' => 'Isi donk passwordnya',
        ];

        $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // jika berhasil
        if(Auth::attempt($data))
        {
            // dd("sukses");
            $request->session()->regenerate();
            return redirect("/");
        }

        // username atau password tidak ada
        return back()->with("errorMessage", "Gagal login, username atau password tidak ditemukan");
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
