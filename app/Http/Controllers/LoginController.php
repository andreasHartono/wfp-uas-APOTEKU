<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request){

        $credentials = $request->validate([
            'username' => ['required'],
            'password'=>['required']
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->sebagai == 'pegawai')
            {
                return redirect('/dashboard');   
            }
               else
            {
                return redirect('/');   
            }
        }

        return back()->with('loginError','Login Failed!');
    }

    public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
