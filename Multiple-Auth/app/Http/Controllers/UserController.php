<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import model for ORM
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller; // Import Controller class

class UserController extends Controller
{    
    public function index()
    {
        return view('User.user');
    }

    public function login_page()
    {
        return view('User.user-login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate(); 
            
            return redirect()->route('user-main'); // user dashboard
        } else {
            return back()->with('message', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user-login');
    }

}
