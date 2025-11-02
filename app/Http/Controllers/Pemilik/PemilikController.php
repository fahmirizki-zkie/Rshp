<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RekamMedisLaravel;
use Carbon\Carbon;

class PemilikController extends Controller
{
    /**
     * Check authentication for pemilik (role 5)
     */
    private function checkAuth()
    {
        if (!session('user_id') || session('user_role') != 5) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login sebagai pemilik terlebih dahulu');
        }
        return null;
    }

    /**
     * Get pemilik data by user ID using Eloquent
     */
    private function getPemilikData()
    {
        $userId = session('user_id');
        
        if (!$userId) {
            return null;
        }

        return Pemilik::with('user')
            ->where('iduser', $userId)
            ->first();
    }

    /**
     * Display dashboard pemilik with summary data
     */
    public function index()
    {
        // Check authentication
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $pemilikData = $this->getPemilikData();
        
        if (!$pemilikData) {
            return redirect()->route('login')
                ->with('error', 'Data pemilik tidak ditemukan');
        }

        $idpemilik = $pemilikData->idpemilik;

        // Count pets using Eloquent
        $totalPets = Pet::where('idpemilik', $idpemilik)->count();

        // Count reservations using Eloquent
        $totalReservasi = TemuDokter::whereHas('pet', function($query) use ($idpemilik) {
            $query->where('idpemilik', $idpemilik);
        })->count();

        // Count rekam medis using Eloquent
        $totalRekamMedis = RekamMedisLaravel::whereHas('temuDokter.pet', function($query) use ($idpemilik) {
            $query->where('idpemilik', $idpemilik);
        })->count();

        // Get last visit using Eloquent
        $lastVisitData = RekamMedisLaravel::whereHas('temuDokter.pet', function($query) use ($idpemilik) {
            $query->where('idpemilik', $idpemilik);
        })
        ->orderBy('created_at', 'desc')
        ->first();

        $lastVisit = $lastVisitData ? $lastVisitData->created_at : null;

        // Get upcoming reservation
        $upcomingReservation = TemuDokter::with('pet')
            ->whereHas('pet', function($query) use ($idpemilik) {
                $query->where('idpemilik', $idpemilik);
            })
            ->where('status', 'A')  // Active/Approved
            ->where('waktu_daftar', '>', now())
            ->orderBy('waktu_daftar', 'asc')
            ->first();

        // Prepare summary data
        $summary = [
            'total_pets' => $totalPets,
            'total_reservations' => $totalReservasi,
            'total_rekam_medis' => $totalRekamMedis,
            'last_visit' => $lastVisit,
            'upcoming_reservation' => $upcomingReservation ? [
                'tanggal_temu' => $upcomingReservation->waktu_daftar
            ] : null
        ];

        return view('pemilik.dashboard_pemilik', [
            'pemilikData' => $pemilikData,
            'summary' => $summary
        ]);
    }

    /**
     * Get pet list for this pemilik using Eloquent
     */
    public function getPetList()
    {
        // Check authentication
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $pemilikData = $this->getPemilikData();
        
        if (!$pemilikData) {
            return redirect()->back()
                ->with('error', 'Data pemilik tidak ditemukan');
        }

        // Using Eloquent with relationships
        $pets = Pet::with(['rasHewan.jenisHewan'])
            ->where('idpemilik', $pemilikData->idpemilik)
            ->orderBy('nama')
            ->get();

        return view('pemilik.daftar_pet', compact('pets'));
    }

    /**
     * Get reservasi list for this pemilik
     */
    public function getReservasiList()
    {
        // Check authentication
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $pemilikData = $this->getPemilikData();
        
        if (!$pemilikData) {
            return redirect()->back()
                ->with('error', 'Data pemilik tidak ditemukan');
        }

        // Get reservations using Eloquent with relationships
        $reservations = TemuDokter::with([
            'pet.rasHewan.jenisHewan',
            'pet.pemilik',
            'roleUser.user'
        ])
        ->whereHas('pet', function($query) use ($pemilikData) {
            $query->where('idpemilik', $pemilikData->idpemilik);
        })
        ->orderBy('waktu_daftar', 'desc')
        ->get();

        return view('pemilik.daftar_reservasi', compact('reservations', 'pemilikData'));
    }

    /**
     * Get rekam medis list for this pemilik
     */
    public function getRekamMedisList()
    {
        // Check authentication
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $pemilikData = $this->getPemilikData();
        
        if (!$pemilikData) {
            return redirect()->back()
                ->with('error', 'Data pemilik tidak ditemukan');
        }

        // Get rekam medis menggunakan Eloquent dengan relationships
        $rekamMedisList = \App\Models\RekamMedisLaravel::with([
            'temuDokter.pet.pemilik',
            'temuDokter.pet.rasHewan.jenisHewan',
            'dokter'
        ])
        ->whereHas('temuDokter.pet', function($query) use ($pemilikData) {
            $query->where('idpemilik', $pemilikData->idpemilik);
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pemilik.daftar_rekam_medis', compact('rekamMedisList', 'pemilikData'));
    }

    /**
     * Show profile page
     */
    public function showProfile()
    {
        // Check authentication
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $pemilikData = $this->getPemilikData();
        
        if (!$pemilikData) {
            return redirect()->back()
                ->with('error', 'Data pemilik tidak ditemukan');
        }

        return view('pemilik.profile', compact('pemilikData'));
    }

    /**
     * Update profile using Eloquent
     */
    public function updateProfile(Request $request)
    {
        // Check authentication
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $pemilikData = $this->getPemilikData();
        
        if (!$pemilikData) {
            return redirect()->back()
                ->with('error', 'Data pemilik tidak ditemukan');
        }

        $request->validate([
            'no_wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        // Using Eloquent update
        $pemilikData->update([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()
            ->with('success', 'Profile berhasil diperbarui');
    }
}
