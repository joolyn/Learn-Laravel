<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin_Crud extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'admin_crud'; // Nama tabel yang digunakan oleh model ini
    public $timestamps = false;

    protected $fillable = [
        'name',
        'title',
        'description',
    ];

}
