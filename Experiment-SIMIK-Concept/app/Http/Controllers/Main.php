<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Main extends Controller
{
    public function index()
    {
        $mode = Cache::get('led_mode', 'manual');
        $status = Cache::get('led_status', 'mati');
        return view('main', ['mode' => $mode, 'status' => $status]);
    }

    public function setStatus(Request $request)
    {
        $current = Cache::get('led_status', 'mati');
        $newStatus = ($current === 'mati') ? 'nyala' : 'mati';
        Cache::put('led_status', $newStatus, now()->addMinutes(60));

        if ($request->ajax()) {
            return response()->json(['status' => $newStatus]);
        }

        return redirect('/main');
    }


    public function setMode(Request $request)
    {
        $currentStatus = Cache::get('led_mode', 'manual'); // default status adalah 'mati'
        $newMode = ($currentStatus === 'manual') ? 'autopilot' : 'manual';
        Cache::put('led_mode', $newMode, now()->addMinutes(60)); // expire dalam 1 jam
        return redirect('/main'); // kembali ke halaman utama
    }

    public function getStatus()
    {
        $mode = Cache::get('led_mode', 'manual'); // default mode adalah 'normal'
        $status = Cache::get('led_status', 'mati');
        return response()->json(['mode' => $mode, 'status' => $status]);
    }
}
