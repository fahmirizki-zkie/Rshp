<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PetController extends Controller
{
    //Display a listing of pets.
    public function index()
    {
        // Check if table exists to prevent errors
        if (Schema::hasTable('pet')) {
            // Ambil semua pet dengan join ke pemilik, user, dan ras_hewan
            $pets = DB::table('pet')
                ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
                ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                ->select(
                    'pet.*',
                    'pemilik.idpemilik',
                    'user.nama as pemilik_nama',
                    'ras_hewan.nama as ras_nama',
                    'jenis_hewan.nama as jenis_nama'
                )
                ->orderBy('pet.idpet', 'desc')
                ->get();
        } else {
            $pets = collect();
        }
        
        return view('admin.data_pet.data_pet', compact('pets'));
    }

    //Show the form for editing pet name.
    public function edit($id)
    {
        // Ambil data pet dengan join untuk display
        $pet = DB::table('pet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->where('pet.idpet', $id)
            ->select(
                'pet.*',
                'user.nama as pemilik_nama',
                'ras_hewan.nama as ras_nama',
                'jenis_hewan.nama as jenis_nama'
            )
            ->first();

        if (!$pet) {
            return redirect()->route('admin.pet.index')
                ->with('error', 'Data pet tidak ditemukan');
        }
        
        return view('admin.data_pet.admin_edit_nama_pet', compact('pet'));
    }

    //Update pet name only.
    public function update(Request $request, $id)
    {
        // Validasi hanya untuk nama
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama pet wajib diisi',
            'nama.string' => 'Nama pet harus berupa teks',
            'nama.max' => 'Nama pet maksimal 100 karakter',
        ]);

        // Update hanya nama menggunakan Query Builder
        $updated = DB::table('pet')
            ->where('idpet', $id)
            ->update([
                'nama' => $validated['nama'],
                'updated_at' => now(),
            ]);

        if ($updated) {
            return redirect()->route('admin.pet.index')
                ->with('success', 'Nama pet berhasil diupdate');
        }

        return redirect()->route('admin.pet.index')
            ->with('error', 'Gagal mengupdate nama pet');
    }
}
