<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class siteController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function cekkoneksi()
    {
        try {
            \DB::connection()->getPdo();
            return "Koneksi database berhasil!";
        } catch (\Exception $e) {
            return "Koneksi database gagal: " . $e->getMessage();
        }
    }
}