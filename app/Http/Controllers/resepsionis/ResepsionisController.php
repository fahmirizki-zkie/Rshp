<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokterLaravel as TemuDokter;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use App\Models\UserRole;

class ResepsionisController extends Controller
{
    /**
     * Check authentication for resepsionis (role 4)
     */
    private function checkAuth()
    {
        if (!session('user_id') || session('user_role') != 4) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login sebagai resepsionis terlebih dahulu');
        }
        return null;
    }

    /**
     * Dashboard Resepsionis
     */
    public function dashboard()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        return view('resepsionis.dashboard_resepsionis');
    }

    /**
     * Tampilkan form tambah pemilik
     */
    public function tambahPemilik()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // Ambil semua user untuk dropdown
        $users = User::all();

        return view('resepsionis.resepsionis_tambah_pemilik', compact('users'));
    }

    /**
     * Store pemilik baru
     */
    public function storePemilik(Request $request)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        try {
            // Cek apakah user sudah jadi pemilik
            $existingPemilik = Pemilik::where('iduser', $request->iduser)->first();
            if ($existingPemilik) {
                return redirect()->back()
                    ->with('error', 'User ini sudah terdaftar sebagai pemilik')
                    ->withInput();
            }

            // Buat data pemilik
            Pemilik::create([
                'iduser' => $request->iduser,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

            return redirect()->route('admin.pemilik.index')
                ->with('success', 'Pemilik berhasil ditambahkan');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan pemilik: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Tampilkan form tambah pet
     */
    public function tambahPet()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // Ambil daftar pemilik untuk dropdown
        $pemiliks = Pemilik::with('user')->get();

        // Ambil daftar ras hewan
        $rasList = RasHewan::with('jenisHewan')->orderBy('nama_ras')->get();

        return view('resepsionis.resepsionis_tambah_pet', compact('pemiliks', 'rasList'));
    }

    /**
     * Store pet baru
     */
    public function storePet(Request $request)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|in:J,B',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        try {
            Pet::create([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'warna_tanda' => $request->warna_tanda,
                'jenis_kelamin' => $request->jenis_kelamin,
                'idpemilik' => $request->idpemilik,
                'idras_hewan' => $request->idras_hewan,
            ]);

            return redirect()->route('admin.pet.index')
                ->with('success', 'Pet berhasil ditambahkan');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan pet: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Tampilkan form temu dokter
     */
    public function temuDokter()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        // Ambil daftar pet untuk dropdown
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->get();

        // Ambil daftar dokter (role 2)
        $dokters = UserRole::with('user')
            ->where('idrole', 2)
            ->where('status', 1)
            ->get();

        // Ambil daftar antrian hari ini
        $temuDokterList = TemuDokter::with([
            'pet.pemilik.user',
            'roleUser.user'
        ])
        ->whereDate('waktu_daftar', today())
        ->orderBy('no_urut')
        ->get();

        return view('resepsionis.temu_dokter', compact('pets', 'dokters', 'temuDokterList'));
    }

    /**
     * Store temu dokter baru
     */
    public function storeTemuDokter(Request $request)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);

        try {
            // Hitung nomor urut untuk hari ini
            $count = TemuDokter::whereDate('waktu_daftar', today())->count();
            $noUrut = $count + 1;

            TemuDokter::create([
                'no_urut' => $noUrut,
                'waktu_daftar' => now(),
                'status' => 'A', // A = Antri
                'idpet' => $request->idpet,
                'idrole_user' => $request->idrole_user,
            ]);

            return redirect()->route('resepsionis.temu-dokter')
                ->with('success', 'Reservasi temu dokter berhasil dibuat dengan nomor urut: ' . $noUrut);
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal membuat reservasi: ' . $e->getMessage())
                ->withInput();
        }
    }
}
