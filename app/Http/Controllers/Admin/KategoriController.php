<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KategoriController extends Controller
{
    //Display a listing of kategori with create form.

    public function index()
    {
        // Check if table exists to prevent errors
        if (Schema::hasTable('kategori')) {
            $kategoris = Kategori::orderBy('idkategori', 'desc')->get();
        } else {
            $kategoris = collect();
        }
        
        return view('admin.data_kategori.data_kategori', compact('kategoris'));
    }

    //Store a newly created kategori in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        Kategori::create($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    //Show the form for editing the specified kategori.
    public function edit(Kategori $kategori)
    {
        return view('admin.data_kategori.data_kategori_edit', compact('kategori'));
    }

    //Update the specified kategori in storage.
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $kategori->idkategori . ',idkategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    //Remove the specified kategori from storage.
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
