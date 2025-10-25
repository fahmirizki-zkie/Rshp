<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KategoriKlinisController extends Controller
{
    //Display a listing of kategori klinis with create form.
 
    public function index()
    {
        // Check if table exists to prevent errors
        if (Schema::hasTable('kategori_klinis')) {
            $kategoriKlinises = KategoriKlinis::orderBy('idkategori_klinis', 'desc')->get();
        } else {
            $kategoriKlinises = collect();
        }
        
        return view('admin.data_kategori_klinis.data_kategori_klinis', compact('kategoriKlinises'));
    }

    //Store a newly created kategori klinis in storage.

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 100 karakter',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada',
        ]);

        KategoriKlinis::create($validated);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil ditambahkan');
    }

    //Show the form for editing the specified kategori klinis.

    public function edit(KategoriKlinis $kategoriKlinis)
    {
        return view('admin.data_kategori_klinis.data_kategori_klinis_edit', compact('kategoriKlinis'));
    }

    //Update the specified kategori klinis in storage.

    public function update(Request $request, KategoriKlinis $kategoriKlinis)
    {
        $validated = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis,' . $kategoriKlinis->idkategori_klinis . ',idkategori_klinis',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 100 karakter',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada',
        ]);

        $kategoriKlinis->update($validated);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil diupdate');
    }

    //Remove the specified kategori klinis from storage.

    public function destroy(KategoriKlinis $kategoriKlinis)
    {
        $kategoriKlinis->delete();

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil dihapus');
    }
}
