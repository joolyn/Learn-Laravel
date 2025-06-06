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
use App\Models\Admin_Crud; // Import model Admin_Crud
use Illuminate\Contracts\Session\Session;

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
            $user = Auth::guard('admin')->user();
            $value = $user->id;
            $request->session()->put('admin_id', $value); // Store admin ID in session
            return redirect()->route('admin-main')->with('message', $value);
        } else {
            return back()->with('message', 'Invalid credentials');
        }
    }

    public function create_data_page()
    {
        return view('Admin.admin-create');
    }

    public function create_data_action(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // $value = $request->session()->get('admin_id'); // Get admin ID from session
        $value = session('admin_id'); // Get admin ID from session
        // $value = 0;

        if ($value) {
            $admin = new Admin_Crud();
            $admin->admin_id = $value;
            $admin->title = $request->input('title');
            $admin->description = $request->input('description');
            $admin->save();

            return redirect()->route('admin.create')->with('message', 'Data created successfully');
        } else {
            return redirect()->route('admin.login')->with('message', 'Please login first');
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
