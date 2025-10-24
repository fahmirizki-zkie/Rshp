<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    /**
     * Display a listing of jenis hewan.
     * Menggunakan Eloquent ORM untuk pengambilan data.
     */
    public function index()
    {
        // Metode 1: Mengambil semua data menggunakan all()
        $jenisHewan = JenisHewan::all();
        
        // Metode 2 (alternatif): Menggunakan select dengan filter tertentu
        // $jenisHewan = JenisHewan::select('idjenis_hewan', 'nama_jenis_hewan')->get();
        
        // Metode 3 (alternatif): Dengan where clause jika diperlukan
        // $jenisHewan = JenisHewan::where('aktif', 1)->get();
        
        return view('admin.jenis_hewan.jenis_hewan', compact('jenisHewan'));
    }
}
