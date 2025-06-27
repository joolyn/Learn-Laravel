<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;

Route::get('/', function () {
    return view('welcome');
});

// For Get Web
Route::get('/main', [Main::class, 'index']);
// For POST status & mode
Route::post('/toggle-status', [Main::class, 'setStatus']);
Route::post('/sendmode', [Main::class, 'sendMode']);

// For POST and GET status IR Sensor
Route::get('/irsensor', [Main::class, 'getDataSensorIR']);
Route::post('/sendircondition', [Main::class, 'sendDataSensorIR']);

// For POST Action
Route::post('/send-action', [Main::class, 'setAction']);
// For POST Destination
Route::post('/dst', [Main::class, 'setDestination']);


// For Get Status Control
// Route::get('/iot', [Main::class, 'getStatus'])->name('getStatus');
Route::post('/iot/{robot_code}', [Main::class, 'getStatus'])->name('getStatus');
