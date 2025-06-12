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


    public function sendMode(Request $request)
    {   
        // Versi monolitic
        // $currentStatus = Cache::get('led_mode', 'manual'); // default status adalah 'mati'
        // $newMode = ($currentStatus === 'manual') ? 'autopilot' : 'manual';
        // Cache::put('led_mode', $newMode, now()->addMinutes(60)); // expire dalam 1 jam
        // return redirect('/main'); // kembali ke halaman utama


        // Version json
        $status = $request->input('mode');

        if ($status === "manual") {
            Cache::put('led_mode', "automatic", now()->addMinutes(60));
            return response()->json(['status' => 'berhasil', 'mode' => 'manual']);
        } else if ($status === "automatic") {
            Cache::put('led_mode', "manual", now()->addMinutes(60));
            return response()->json(['status' => 'berhasil', 'mode' => 'automatic']);
        } else {
            return response()->json(['status' => 'gagal', 'pesan' => 'Mode tidak valid'], 400);
        }

        return response()->json(['status' => 'gagal', 'message' => 'Mode tidak ditemukan'], 400);
    }

    // FOr Send Data Sensor
    public function sendDataSensorIR (Request $request) 
    {
        $status = $request->input('status');

        if ($status === "detection") {
            Cache::put('ir', 'detection', now()->addMinutes(1));
        } else if ($status === "no-detection") {
            Cache::put('ir', "no-detection", now()->addMinutes(1));
        }
    }

    // For Get Data Sensor IR
    public function getDataSensorIR ()
    {
        $status = Cache::get('ir', "");
        return response()->json(['ir' => $status]);
    }

    // For Send Data DO
    public function sendDo (Request $request) 
    {
        $status = $request->input('do');

        Cache::add('do', '');
        
        if ($status === "forward") {
            Cache::put('do', 'forward', now()->addMinutes(1));
        } else if ($status === "left") {
            Cache::put('do', 'left', now()->addMinutes(1));
        } else if ($status === "right") {
            Cache::put('do', 'right', now()->addMinutes(1));
        } else if ($status === "stop") {
            Cache::put('do', 'stop', now()->addMinutes(1));            
        } else if ($status === "backward") {
            Cache::put('do', 'backward', now()->addMinutes(1));            
        }
    }

    public function getStatus()
    {
        $mode = Cache::get('led_mode', 'manual'); // default mode adalah 'normal'
        $do = Cache::get('do', 'stop');
        return response()->json(['mode' => $mode, 'action' => $do]);
    }
}
