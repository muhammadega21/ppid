<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.email' => 'Email Harus Berupa Email Yang Benar!'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Email atau Password Anda Salah');
    }

    function register()
    {
        return view('auth.register', [
            'title' => 'Login',
            'user' => User::pluck('id')->last()
        ]);
    }

    public function store_register(Request $request)
    {

        $request->validate([
            'name' => 'required|max:30|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4'
        ], [

            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.unique' => 'Nama Sudah Ada!',
            'name.max' => 'Max 30 Character!',

            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Harus Berupa Email Yang Benar!',
            'email.unique' => 'Email Sudah Ada!',

            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Harus Minimal 4 Huruf/Angka!',
        ]);

        User::create([
            'email' => $request['email'],
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => bcrypt($request['password'])
        ]);

        return redirect('/login')->with('success', 'Berhasil Registrasi! Silahkan Login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
