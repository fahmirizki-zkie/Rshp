<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    /**
     * Display a listing of jenis hewan.
     */
    public function index()
    {
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan', 'asc')->get();
        return view('admin.jenis_hewan.jenis_hewan', compact('jenisHewan'));
    }

    /**
     * Store a newly created jenis hewan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 100 karakter',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada',
        ]);

        JenisHewan::create($validated);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil ditambahkan');
    }

    /**
     * Show the form for editing jenis hewan.
     */
    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.jenis_hewan.edit_jenis_hewan', compact('jenisHewan'));
    }

    /**
     * Update the specified jenis hewan.
     */
    public function update(Request $request, $id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 100 karakter',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada',
        ]);

        $jenisHewan->update($validated);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil diupdate');
    }

    /**
     * Remove the specified jenis hewan.
     */
    public function destroy($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        
        // Cek apakah jenis hewan masih digunakan oleh ras hewan
        $rasCount = $jenisHewan->rasHewan()->count();
        
        if ($rasCount > 0) {
            return redirect()->route('admin.jenis-hewan.index')
                ->with('error', "Jenis hewan tidak bisa dihapus karena masih digunakan oleh {$rasCount} ras hewan");
        }

        $jenisHewan->delete();

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil dihapus');
    }
}
