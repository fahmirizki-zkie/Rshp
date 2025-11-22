<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use App\Models\User;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    /**
     * Display a listing of perawat.
     */
    public function index()
    {
        $perawatList = Perawat::with('user')->orderBy('id_perawat', 'desc')->get();
        
        return view('admin.perawat.perawat', compact('perawatList'));
    }

    /**
     * Show the form for creating new perawat.
     */
    public function create()
    {
        // Ambil ID user yang sudah terdaftar sebagai perawat
        $perawatUserIds = Perawat::pluck('iduser')->toArray();
        
        // Ambil user yang memiliki role perawat (role 3) tapi belum terdaftar di tabel perawat
        $availableUsers = User::whereHas('userRole', function($query) {
                $query->where('idrole', 3); // Role perawat
            })
            ->whereNotIn('iduser', $perawatUserIds)
            ->orderBy('nama')
            ->get();
        
        return view('admin.perawat.create', compact('availableUsers'));
    }

    /**
     * Store a newly created perawat in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser|unique:perawat,iduser',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        try {
            Perawat::create([
                'iduser' => $request->iduser,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            return redirect()->route('admin.perawat.index')
                ->with('success', 'Perawat berhasil ditambahkan');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan perawat: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified perawat.
     */
    public function edit($id)
    {
        $perawat = Perawat::with('user')->findOrFail($id);
        
        return view('admin.perawat.edit', compact('perawat'));
    }

    /**
     * Update the specified perawat in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        try {
            $perawat = Perawat::findOrFail($id);
            $perawat->update([
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            return redirect()->route('admin.perawat.index')
                ->with('success', 'Data perawat berhasil diperbarui');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data perawat: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified perawat from storage.
     */
    public function destroy($id)
    {
        try {
            $perawat = Perawat::findOrFail($id);
            $perawat->delete();

            return redirect()->route('admin.perawat.index')
                ->with('success', 'Perawat berhasil dihapus');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus perawat: ' . $e->getMessage());
        }
    }
}
