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

// For POST status do
Route::post('/send-do', [Main::class, 'sendDo']);


// For Get Status Control
Route::get('/iot', [Main::class, 'getStatus'])->name('getStatus');