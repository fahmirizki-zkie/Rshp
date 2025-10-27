<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardResepsionisController extends Controller
{
    /**
     * Display the resepsionis dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Cek apakah user sudah login dan role-nya resepsionis (role 3)
        if (!session('user_id') || session('user_role') != 3) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login sebagai resepsionis terlebih dahulu');
        }

        return view('resepsionis.dashboard_resepsionis');
    }
}
