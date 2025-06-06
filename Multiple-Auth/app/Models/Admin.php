<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
}

// For testing purposes, you can uncomment the following lines to create an admin user.
// Admin::create(['name' => 'Admin User 3','email' => 'abcd3@gmail.com','password' => bcrypt('123456789'), ]);

// $admin = Admin::where('email', 'abcd@gmail.com')->where('password', '123456789')->first();
