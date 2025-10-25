<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KodeTindakanTerapiController extends Controller
{
    //Display a listing of kode tindakan terapi with create form.
    public function index()
    {
        // Check if table exists to prevent errors
        if (Schema::hasTable('kode_tindakan_terapi')) {
            $kodeTindakanTerapis = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
                ->orderBy('idkode_tindakan_terapi', 'desc')
                ->get();
        } else {
            $kodeTindakanTerapis = collect();
        }
        
        // Get dropdowns data
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $kategoriKlinises = KategoriKlinis::orderBy('nama_kategori_klinis')->get();
        
        return view('admin.kode_tindakan.kode_tindakan_terapi', compact('kodeTindakanTerapis', 'kategoris', 'kategoriKlinises'));
    }

    //Store a newly created kode tindakan terapi in storage.

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:kode_tindakan_terapi,kode',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
            'deskripsi_tindakan_terapi' => 'nullable|string|max:500',
        ], [
            'kode.required' => 'Kode tindakan wajib diisi',
            'kode.unique' => 'Kode tindakan sudah ada',
            'kode.max' => 'Kode tindakan maksimal 50 karakter',
            'idkategori.required' => 'Kategori wajib dipilih',
            'idkategori.exists' => 'Kategori tidak valid',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih',
            'idkategori_klinis.exists' => 'Kategori klinis tidak valid',
            'deskripsi_tindakan_terapi.max' => 'Deskripsi maksimal 500 karakter',
        ]);

        KodeTindakanTerapi::create($validated);

        return redirect()->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan/terapi berhasil ditambahkan');
    }

    //Show the form for editing the specified kode tindakan terapi.

    public function edit(KodeTindakanTerapi $kodeTindakan)
    {
        $kodeTindakan->load(['kategori', 'kategoriKlinis']);
        
        // Get dropdowns data
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $kategoriKlinises = KategoriKlinis::orderBy('nama_kategori_klinis')->get();
        
        return view('admin.kode_tindakan.kode_tindakan_terapi_edit', compact('kodeTindakan', 'kategoris', 'kategoriKlinises'));
    }

    //Update the specified kode tindakan terapi in storage.

    public function update(Request $request, KodeTindakanTerapi $kodeTindakan)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:kode_tindakan_terapi,kode,' . $kodeTindakan->idkode_tindakan_terapi . ',idkode_tindakan_terapi',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
            'deskripsi_tindakan_terapi' => 'nullable|string|max:500',
        ], [
            'kode.required' => 'Kode tindakan wajib diisi',
            'kode.unique' => 'Kode tindakan sudah ada',
            'kode.max' => 'Kode tindakan maksimal 50 karakter',
            'idkategori.required' => 'Kategori wajib dipilih',
            'idkategori.exists' => 'Kategori tidak valid',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih',
            'idkategori_klinis.exists' => 'Kategori klinis tidak valid',
            'deskripsi_tindakan_terapi.max' => 'Deskripsi maksimal 500 karakter',
        ]);

        $kodeTindakan->update($validated);

        return redirect()->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan/terapi berhasil diupdate');
    }

    //Remove the specified kode tindakan terapi from storage.

    public function destroy(KodeTindakanTerapi $kodeTindakan)
    {
        $kodeTindakan->delete();

        return redirect()->route('admin.kode-tindakan.index')
            ->with('success', 'Kode tindakan/terapi berhasil dihapus');
    }
}
