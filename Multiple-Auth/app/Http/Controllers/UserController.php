<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import model for ORM
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller; // Import Controller class
use Illuminate\Support\Facades\Cookie; // Import Cookie
use Illuminate\Support\Facades\Hash;

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

    // Public function with default authentication
    // public function login_action(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('web')->attempt($credentials)) {
    //         $request->session()->regenerate();
            
    //         return redirect()->route('user-main'); // user dashboard
    //     } else {
    //         return back()->with('message', 'Invalid credentials');
    //     }
    // }

    public function login_action(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $password = bcrypt($credentials['password']);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)){
            $token = bin2hex(random_bytes(16));

            // Simpan ke cookie
            Cookie::queue('login_token', $token, 60 * 24);

            // Simpan token ke database
            User::where('email', $credentials['email'])->update(['remember_token' => $token]);

            return redirect()->route('user-main'); // user dashboard
        } else {
            return back()->with('message', 'Invalid credentials');
        }
        

        // $user = User
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user-login');
    }

}
