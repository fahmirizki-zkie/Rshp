<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Display admin dashboard
    public function index()
    {
        // Ambil data user yang login
        $user_nama = auth()->check() ? auth()->user()->nama : 'Administrator';
        $nama_role = 'Administrator'; // Bisa diambil dari auth()->user()->role->nama_role
        
        return view('admin.dashboard', compact('user_nama', 'nama_role'));
    }
    
    //Display data master page
    public function dataMaster()
    {
        return view('admin.data_master');
    }
}
