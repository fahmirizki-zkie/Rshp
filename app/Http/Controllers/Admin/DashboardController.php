<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Display admin dashboard
    public function index()
    {
        // Ambil data user yang login
        $user_nama = auth()->check() ? auth()->user()->nama : 'Administrator';
        $nama_role = 'Administrator'; // Bisa diambil dari auth()->user()->role->nama_role
        
        // Hitung total data dari database
        $total_users = User::count();
        
        // Hitung role dari user yang berbeda (atau gunakan nilai statis jika tidak ada table role)
        // Karena table model_has_roles tidak ada, kita gunakan nilai statis
        $total_roles = 5; // Admin, Dokter, Perawat, Resepsionis, Pemilik
        
        $total_jenis_hewan = DB::table('jenis_hewan')->count();
        $total_ras_hewan = DB::table('ras_hewan')->count();
        
        return view('admin.dashboard', compact(
            'user_nama', 
            'nama_role',
            'total_users',
            'total_roles',
            'total_jenis_hewan',
            'total_ras_hewan'
        ));
    }
    
    //Display data master page
    public function dataMaster()
    {
        return view('admin.data_master');
    }
}