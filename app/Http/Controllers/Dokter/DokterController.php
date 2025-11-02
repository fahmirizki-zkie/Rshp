<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedisLaravel;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Helper untuk cek autentikasi
     */
    private function checkAuth(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        if ($request->session()->get('user_role') != 2) {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }
        
        return null;
    }

    /**
     * Dashboard Dokter
     */
    public function dashboard(Request $request)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $user_nama = $request->session()->get('user_name', 'Pengguna');
        
        return view('dokter.dashboard_dokter', compact('user_nama'));
    }

    /**
     * Halaman Rekam Medis Dokter (Read Only)
     */
    public function rekamMedis(Request $request)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $user_nama = $request->session()->get('user_name', 'Pengguna');

        // Ambil semua rekam medis dengan join
        $dataRekamMedis = RekamMedisLaravel::getAllJoined();

        return view('dokter.rekam_medis_dokter', compact('user_nama', 'dataRekamMedis'));
    }

    /**
     * Detail Rekam Medis (Read Only untuk Dokter)
     */
    public function detailRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $rekamMedis = RekamMedisLaravel::getByIdJoined($id);

        if (!$rekamMedis) {
            return redirect()->route('dokter.rekam-medis')->with('error', 'Rekam medis tidak ditemukan');
        }

        $user_nama = $request->session()->get('user_name', 'Pengguna');

        return view('dokter.detail_rekam_medis_dokter', compact('user_nama', 'rekamMedis'));
    }
}
