<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    /**
     * Display a listing of ras hewan grouped by jenis hewan.
     * VIEW ONLY - CRUD functions disabled
     */
    public function index()
    {
        // Ambil semua jenis hewan
        $jenisList = JenisHewan::orderBy('nama_jenis_hewan')->get();
        
        // Ambil semua ras hewan
        $allRas = RasHewan::orderBy('nama_ras')->get();
        
        // Group ras by jenis_hewan
        $rasByJenis = [];
        foreach ($allRas as $ras) {
            $rasByJenis[$ras->idjenis_hewan][] = $ras;
        }
        
        return view('admin.rashewan.rahhewan', compact('jenisList', 'rasByJenis'));
    }
    
    /**
     * Store a newly created ras hewan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'nama_ras' => 'required|string|max:100',
        ], [
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid',
            'nama_ras.required' => 'Nama ras wajib diisi',
            'nama_ras.max' => 'Nama ras maksimal 100 karakter',
        ]);
        
        RasHewan::create($validated);
        
        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil ditambahkan!');
    }
    
    /**
     * Show the form for editing ras hewan.
     */
    public function edit($id)
    {
        $ras = RasHewan::findOrFail($id);
        $jenisList = JenisHewan::orderBy('nama_jenis_hewan')->get();
        
        return view('admin.rashewan.edit', compact('ras', 'jenisList'));
    }
    
    /**
     * Update the specified ras hewan.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'nama_ras' => 'required|string|max:100',
        ], [
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid',
            'nama_ras.required' => 'Nama ras wajib diisi',
            'nama_ras.max' => 'Nama ras maksimal 100 karakter',
        ]);
        
        $ras = RasHewan::findOrFail($id);
        $ras->update($validated);
        
        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil diupdate!');
    }
    
    /**
     * Remove the specified ras hewan.
     */
    public function destroy($id)
    {
        $ras = RasHewan::findOrFail($id);
        
        // Cek apakah ras masih digunakan oleh pet
        $petCount = $ras->pet()->count();
        
        if ($petCount > 0) {
            return redirect()->route('admin.ras-hewan.index')
                ->with('error', "Ras hewan tidak bisa dihapus karena masih digunakan oleh {$petCount} hewan peliharaan");
        }
        
        $ras->delete();
        
        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil dihapus!');
    }
}
