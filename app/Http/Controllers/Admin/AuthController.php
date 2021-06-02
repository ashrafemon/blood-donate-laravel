<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('pages.auth.login');
    }

    public function login()
    {
        $data = request()->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);

        if(!auth()->attempt($data)){
            return redirect()->back()->with('error_message', 'Credentials not matched...');
        }

        return redirect()->route('dashboard.index');
    }
}
