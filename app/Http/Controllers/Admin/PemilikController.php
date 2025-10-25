<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    /**
     * Display a listing of pemilik.
     * Menggunakan Eloquent ORM untuk pengambilan data.
     */
    public function index()
    {
        $pemilikData = Pemilik::with('user')->first();
        
        // Data summary (bisa dikembangkan dengan query ke tabel pets, reservasi, rekam_medis)
        $summary = [
            'total_pets' => 0,
            'total_reservations' => 0,
            'total_rekam_medis' => 0,
            'last_visit' => null,
            'upcoming_reservation' => null
        ];
        
        // Jika ada pemilik data, hitung summary-nya
        if ($pemilikData) {
            // TODO: Implementasi query untuk menghitung:
            // - Total pets milik pemilik ini
            // - Total reservasi
            // - Total rekam medis
            // - Kunjungan terakhir
            // - Reservasi mendatang
            
            $summary['total_pets'] = Pet::where('idpemilik', $pemilikData->idpemilik)->count();
            $summary['total_reservations'] = Reservasi::where('idpemilik', $pemilikData->idpemilik)->count();
        }
        
        return view('pemilik.pemilik', compact('pemilikData', 'summary'));
    }

    //Display data pemilik table (untuk admin/resepsionis)
    

    public function dataPemilik()
    {
        // Ambil semua data pemilik dengan relasi user
        $pemilikList = Pemilik::with('user')->get();
        
        // Role - bisa diambil dari auth user, untuk sementara hardcode
        // Dalam implementasi real: $role = auth()->user()->role->nama_role;
        $role = 'administrator'; // atau 'resepsionis'
        
        return view('admin.Pemilik.data_pemilik', compact('pemilikList', 'role'));
    }
    
    //Show the form for editing pemilik (route: admin.pemilik.edit)
 
    public function edit($iduser)
    {
        // TODO: Implementasi edit form
        return redirect()->back()->with('info', 'Fitur edit belum diimplementasikan');
    }
    
    //Remove the specified pemilik from database (route: admin.pemilik.destroy)
   
    public function destroy($idpemilik)
    {
        // TODO: Implementasi delete dengan validasi
        $pemilik = Pemilik::findOrFail($idpemilik);
        $pemilik->delete();
        // Contoh:
        // $pemilik = Pemilik::findOrFail($idpemilik);
        // $pemilik->delete();
        
        return redirect()->back()->with('success', 'Data pemilik berhasil dihapus');
    }
}
