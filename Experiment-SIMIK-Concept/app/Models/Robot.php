<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $fillable = [
        'robot_code',
        'photo',
        'name',
        'description',
        'status',
        'secret_key'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}

// Untuk Tes ORM Robot
// use App\Models\Robot;
// Robot::create(['robot_code' => 'RWD-1975', 'photo' => 'aaaaa', 'name' => 'RWD-01', 'description' => 'aaaaa', 'secret_key' => 'abcdefgh']);