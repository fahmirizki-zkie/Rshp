<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of dokter.
     */
    public function index()
    {
        // Ambil semua dokter dengan relasi user
        $dokterList = Dokter::with('user')->orderBy('id_dokter', 'desc')->get();
        
        return view('admin.dokter.dokter', compact('dokterList'));
    }

    /**
     * Show the form for creating new dokter.
     */
    public function create()
    {
        // Ambil ID user yang sudah terdaftar sebagai dokter
        $dokterUserIds = Dokter::pluck('iduser')->toArray();
        
        // Ambil user yang memiliki role dokter (role 2) tapi belum terdaftar di tabel dokter
        $availableUsers = User::whereHas('userRole', function($query) {
                $query->where('idrole', 2); // Role dokter
            })
            ->whereNotIn('iduser', $dokterUserIds)
            ->orderBy('nama')
            ->get();
        
        return view('admin.dokter.create', compact('availableUsers'));
    }

    /**
     * Store a newly created dokter.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'bidang_dokter' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'iduser.required' => 'User wajib dipilih',
            'iduser.exists' => 'User tidak valid',
            'bidang_dokter.required' => 'Bidang dokter wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        ]);

        try {
            // Cek apakah user sudah jadi dokter
            $existingDokter = Dokter::where('iduser', $request->iduser)->first();
            if ($existingDokter) {
                return redirect()->back()
                    ->with('error', 'User ini sudah terdaftar sebagai dokter')
                    ->withInput();
            }

            // Buat data dokter (user sudah memiliki role dokter)
            Dokter::create([
                'iduser' => $request->iduser,
                'bidang_dokter' => $request->bidang_dokter,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            return redirect()->route('admin.dokter.index')
                ->with('success', 'Dokter berhasil ditambahkan');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan dokter: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing dokter.
     */
    public function edit($id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);
        
        return view('admin.dokter.edit', compact('dokter'));
    }

    /**
     * Update the specified dokter.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bidang_dokter' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'bidang_dokter.required' => 'Bidang dokter wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
        ]);

        try {
            $dokter = Dokter::findOrFail($id);
            $dokter->update($validated);

            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil diupdate');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate dokter: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified dokter.
     */
    public function destroy($id)
    {
        try {
            $dokter = Dokter::findOrFail($id);

            // Hapus data dokter (tidak menghapus role dokter dari user)
            $dokter->delete();

            return redirect()->route('admin.dokter.index')
                ->with('success', 'Dokter berhasil dihapus dari daftar');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus dokter: ' . $e->getMessage());
        }
    }
}
