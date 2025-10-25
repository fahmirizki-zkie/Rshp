<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    //Display a listing of jenis hewan.
    public function index()
    {
        // Metode 1: Mengambil semua data menggunakan all()
        $jenisHewan = JenisHewan::all();
        return view('admin.jenis_hewan.jenis_hewan', compact('jenisHewan'));
    }
}
