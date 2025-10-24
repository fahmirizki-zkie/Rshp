<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PetController extends Controller
{
    /**
     * Display a listing of pets.
     */
    public function index()
    {
        // Check if table exists to prevent errors
        if (Schema::hasTable('pet')) {
            // Ambil semua pet dengan relasi pemilik dan ras hewan
            $pets = Pet::with(['pemilik', 'rasHewan'])
                       ->orderBy('idpet', 'desc')
                       ->get();
        } else {
            $pets = collect();
        }
        
        return view('admin.data_pet.data_pet', compact('pets'));
    }

    /**
     * Show the form for editing pet name.
     * Administrator hanya bisa edit NAMA pet saja.
     */
    public function edit(Pet $pet)
    {
        // Load relationship untuk display saja (tidak bisa diedit)
        $pet->load(['pemilik', 'rasHewan']);
        
        return view('admin.data_pet.admin_edit_nama_pet', compact('pet'));
    }

    /**
     * Update pet name only.
     * Administrator hanya bisa update NAMA pet saja.
     */
    public function update(Request $request, Pet $pet)
    {
        // Validasi hanya untuk nama
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        // Update hanya nama
        $pet->update($validated);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Nama pet berhasil diupdate');
    }
}
