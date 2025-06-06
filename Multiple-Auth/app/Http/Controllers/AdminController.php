<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Import model for ORM
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
// Import DB for database operations
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller; // Import Controller class
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.admin');
    }

    public function login_page()
    {
        return view('Admin.admin-login');
    }
    
    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate(); // penting untuk keamanan sesi
            Cookie::queue('admin_email', $request->email, 60); // menyimpan email admin di cookie selama 30 hari            
            return redirect()->route('admin-main');
        } else {
            return back()->with('message', 'Invalid credentials');
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // <-- ini perbaikannya
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin-login');
    }

}
