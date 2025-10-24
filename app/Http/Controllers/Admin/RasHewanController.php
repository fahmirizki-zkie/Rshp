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
    
    // CRUD functions commented out - untuk nanti jika diperlukan
    
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
    //         'nama_ras' => 'required|string|max:100',
    //     ]);
    //     
    //     RasHewan::create([
    //         'idjenis_hewan' => $request->idjenis_hewan,
    //         'nama_ras' => $request->nama_ras,
    //     ]);
    //     
    //     return redirect()->route('admin.ras-hewan.index')
    //         ->with('success', 'Ras hewan berhasil ditambahkan!');
    // }
    
    // public function edit($id)
    // {
    //     $ras = RasHewan::findOrFail($id);
    //     $jenisList = JenisHewan::orderBy('nama_jenis_hewan')->get();
    //     
    //     return view('admin.rashewan.edit', compact('ras', 'jenisList'));
    // }
    
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
    //         'nama_ras' => 'required|string|max:100',
    //     ]);
    //     
    //     $ras = RasHewan::findOrFail($id);
    //     $ras->update([
    //         'idjenis_hewan' => $request->idjenis_hewan,
    //         'nama_ras' => $request->nama_ras,
    //     ]);
    //     
    //     return redirect()->route('admin.ras-hewan.index')
    //         ->with('success', 'Ras hewan berhasil diupdate!');
    // }
    
    // public function destroy($id)
    // {
    //     try {
    //         $ras = RasHewan::findOrFail($id);
    //         $ras->delete();
    //         
    //         return redirect()->route('admin.ras-hewan.index')
    //             ->with('success', 'Ras hewan berhasil dihapus!');
    //     } catch (\Exception $e) {
    //         return redirect()->route('admin.ras-hewan.index')
    //             ->with('error', 'Gagal menghapus ras hewan: ' . $e->getMessage());
    //     }
    // }
}
