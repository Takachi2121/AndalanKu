<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }
    public function index(Request $request)
    {
        $request->validate([
            'emailUser' => 'required|email',
            'passUser' => 'required'
        ]);

        $user = User::where('email', $request->emailUser)->first();

        if (!$user || !Hash::check($request->passUser, $user->password)) {
            return back()->withErrors(['login' => 'Email atau password salah'])->withInput();
        }

        // Simpan data login ke session
        Session::put('login_user', $user->id);
        Session::put('login_user_email', $user->email); // atau field lain yang kamu mau

        return redirect()->route('mainDashboard')->with('success', 'Login berhasil');
    }

    public function logout(){
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
