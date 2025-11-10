<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    /**
     * Display a listing of jenis hewan.
     */
    public function index()
    {
        // Menggunakan Query Builder untuk mengambil data
        $jenisHewan = DB::table('jenis_hewan')
            ->orderBy('nama_jenis_hewan', 'asc')
            ->get();

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

        // Insert menggunakan Query Builder
        DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $validated['nama_jenis_hewan'],
        ]);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil ditambahkan');
    }

    /**
     * Show the form for editing jenis hewan.
     */
    public function edit($id)
    {
        // Ambil data menggunakan Query Builder
        $jenisHewan = DB::table('jenis_hewan')->where('idjenis_hewan', $id)->first();

        if (! $jenisHewan) {
            abort(404);
        }

        return view('admin.jenis_hewan.edit_jenis_hewan', compact('jenisHewan'));
    }

    /**
     * Update the specified jenis hewan.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 100 karakter',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada',
        ]);

        // Update menggunakan Query Builder
        $updated = DB::table('jenis_hewan')->where('idjenis_hewan', $id)
            ->update(['nama_jenis_hewan' => $validated['nama_jenis_hewan']]);

        if ($updated === 0) {
            // Jika tidak ada baris yang diupdate, kemungkinan id tidak ditemukan
            abort(404);
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil diupdate');
    }

    /**
     * Remove the specified jenis hewan.
     */
    public function destroy($id)
    {
        // Cek apakah jenis hewan masih digunakan oleh ras hewan (menggunakan model RasHewan)
        $rasCount = RasHewan::where('idjenis_hewan', $id)->count();

        if ($rasCount > 0) {
            return redirect()->route('admin.jenis-hewan.index')
                ->with('error', "Jenis hewan tidak bisa dihapus karena masih digunakan oleh {$rasCount} ras hewan");
        }

        // Hapus menggunakan Query Builder
        $deleted = DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();

        if ($deleted === 0) {
            abort(404);
        }

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil dihapus');
    }
}
