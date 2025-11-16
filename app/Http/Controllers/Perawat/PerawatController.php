<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedisLaravel;
use App\Models\DetailRekamMedisLaravel;
use App\Models\TemuDokterLaravel as TemuDokter;
use App\Models\KodeTindakanTerapi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PerawatController extends Controller
{
    /**
     * Helper untuk cek autentikasi
     */
    private function checkAuth(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        if ($request->session()->get('user_role') != 3) {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }
        
        return null;
    }

    /**
     * Dashboard Perawat
     */
    public function dashboard(Request $request)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $user_nama = $request->session()->get('user_name', 'Pengguna');
        
        return view('perawat.dashboard_perawat', compact('user_nama'));
    }

    /**
     * Halaman Rekam Medis Perawat
     */
    public function rekamMedis(Request $request)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $user_nama = $request->session()->get('user_name', 'Pengguna');

        // Ambil semua rekam medis dengan join
        $dataRekamMedis = RekamMedisLaravel::getAllJoined();

        // Ambil temu dokter yang belum punya rekam medis
        $temuTanpaRekam = TemuDokter::with([
            'pet.pemilik.user',
            'pet.rasHewan.jenisHewan',
            'roleUser.user'
        ])
        ->whereNotIn('idreservasi_dokter', function($query) {
            $query->select('idreservasi_dokter')
                  ->from('rekam_medis');
        })
        ->orderBy('waktu_daftar', 'desc')
        ->get();

        return view('perawat.rekam_medis_perawat', compact('user_nama', 'dataRekamMedis', 'temuTanpaRekam'));
    }

    /**
     * Halaman Tambah Rekam Medis
     */
    public function tambahRekamMedis(Request $request, $idreservasi)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        // Ambil data temu dokter
        $temuDokter = TemuDokter::with([
            'pet.pemilik.user',
            'pet.rasHewan.jenisHewan',
            'roleUser.user'
        ])->find($idreservasi);

        if (!$temuDokter) {
            return redirect()->route('perawat.rekam-medis')->with('error', 'Data temu dokter tidak ditemukan');
        }

        // Ambil semua kode tindakan terapi
        $kodeTindakan = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->orderBy('kode')
            ->get();

        $user_nama = $request->session()->get('user_name', 'Pengguna');

        return view('perawat.tambah_rekam_medis', compact('user_nama', 'temuDokter', 'kodeTindakan'));
    }

    /**
     * Store Rekam Medis Baru
     */
    public function storeRekamMedis(Request $request)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $validator = Validator::make($request->all(), [
            'idreservasi_dokter' => 'required|integer|exists:temu_dokter,idreservasi_dokter',
            'dokter_pemeriksa' => 'required|integer|exists:user,iduser',
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
            'kode_tindakan' => 'nullable|array',
            'kode_tindakan.*' => 'integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Buat rekam medis
            $rekamMedis = RekamMedisLaravel::create([
                'created_at' => now(),
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'idreservasi_dokter' => $request->idreservasi_dokter,
                'dokter_pemeriksa' => $request->dokter_pemeriksa,
            ]);

            // Tambahkan detail rekam medis (kode tindakan)
            if ($request->has('kode_tindakan') && is_array($request->kode_tindakan)) {
                foreach ($request->kode_tindakan as $kodeTindakanId) {
                    DetailRekamMedisLaravel::create([
                        'idrekam_medis' => $rekamMedis->idrekam_medis,
                        'idkode_tindakan_terapi' => $kodeTindakanId,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('perawat.rekam-medis')->with('success', 'Rekam medis berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal membuat rekam medis: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Edit Rekam Medis
     */
    public function editRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $rekamMedis = RekamMedisLaravel::getByIdJoined($id);

        if (!$rekamMedis) {
            return redirect()->route('perawat.rekam-medis')->with('error', 'Rekam medis tidak ditemukan');
        }

        $user_nama = $request->session()->get('user_name', 'Pengguna');

        return view('perawat.edit_rekam_medis', compact('user_nama', 'rekamMedis'));
    }

    /**
     * Update Rekam Medis
     */
    public function updateRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $validator = Validator::make($request->all(), [
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
            'dokter_pemeriksa' => 'required|integer|exists:user,iduser',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $rekamMedis = RekamMedisLaravel::find($id);
            
            if (!$rekamMedis) {
                return redirect()->route('perawat.rekam-medis')->with('error', 'Rekam medis tidak ditemukan');
            }

            $rekamMedis->update([
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'dokter_pemeriksa' => $request->dokter_pemeriksa,
            ]);

            return redirect()->route('perawat.rekam-medis')->with('success', 'Rekam medis berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal update rekam medis: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete Rekam Medis
     */
    public function deleteRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        try {
            DB::beginTransaction();

            $rekamMedis = RekamMedisLaravel::find($id);
            
            if (!$rekamMedis) {
                return redirect()->route('perawat.rekam-medis')->with('error', 'Rekam medis tidak ditemukan');
            }

            // Delete detail rekam medis dulu
            DetailRekamMedisLaravel::where('idrekam_medis', $id)->delete();

            // Delete rekam medis
            $rekamMedis->delete();

            DB::commit();

            return redirect()->route('perawat.rekam-medis')->with('success', 'Rekam medis berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal hapus rekam medis: ' . $e->getMessage());
        }
    }

    /**
     * Edit Detail Rekam Medis (Kode Tindakan)
     */
    public function editDetailRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $detailRekamMedis = DetailRekamMedisLaravel::with([
            'kodeTindakanTerapi.kategori',
            'kodeTindakanTerapi.kategoriKlinis'
        ])->findOrFail($id);

        if (!$detailRekamMedis) {
            return redirect()->route('perawat.rekam-medis')->with('error', 'Detail rekam medis tidak ditemukan');
        }

        // Ambil semua kode tindakan terapi
        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->orderBy('kode')
            ->get();

        $user_nama = $request->session()->get('user_name', 'Pengguna');

        return view('perawat.edit_detail_rekam_medis', compact('user_nama', 'detailRekamMedis', 'kodeTindakanTerapi'));
    }

    /**
     * Update Detail Rekam Medis (Kode Tindakan)
     */
    public function updateDetailRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $validator = Validator::make($request->all(), [
            'kode_tindakan' => 'nullable|array',
            'kode_tindakan.*' => 'integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $rekamMedis = RekamMedisLaravel::find($id);
            
            if (!$rekamMedis) {
                return redirect()->route('perawat.rekam-medis')->with('error', 'Rekam medis tidak ditemukan');
            }

            // Hapus detail lama
            DetailRekamMedisLaravel::where('idrekam_medis', $id)->delete();

            // Tambahkan detail baru
            if ($request->has('kode_tindakan') && is_array($request->kode_tindakan)) {
                foreach ($request->kode_tindakan as $kodeTindakanId) {
                    DetailRekamMedisLaravel::create([
                        'idrekam_medis' => $id,
                        'idkode_tindakan_terapi' => $kodeTindakanId,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('perawat.rekam-medis')->with('success', 'Detail rekam medis berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal update detail rekam medis: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * View Detail Rekam Medis
     */
    public function detailRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $rekamMedis = RekamMedisLaravel::with([
            'temuDokter.pet.pemilik.user',
            'dokter',
            'detailRekamMedis.kodeTindakanTerapi.kategori',
            'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis'
        ])->findOrFail($id);

        $kodeTindakanTerapi = KodeTindakanTerapi::getAllJoined();

        return view('perawat.detail_rekam_medis', compact('rekamMedis', 'kodeTindakanTerapi'));
    }

    /**
     * Store Detail Rekam Medis (Tindakan Terapi)
     */
    public function storeDetailRekamMedis(Request $request)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        $request->validate([
            'idrekam_medis' => 'required|integer|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|string|max:1000'
        ]);

        try {
            DetailRekamMedisLaravel::create([
                'idrekam_medis' => $request->idrekam_medis,
                'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
                'detail' => $request->detail
            ]);

            return redirect()->route('perawat.detail-rekam-medis', $request->idrekam_medis)
                ->with('success', 'Tindakan terapi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan tindakan terapi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete Detail Rekam Medis (Tindakan Terapi)
     */
    public function deleteDetailRekamMedis(Request $request, $id)
    {
        $authCheck = $this->checkAuth($request);
        if ($authCheck) return $authCheck;

        try {
            $detail = DetailRekamMedisLaravel::findOrFail($id);
            $idrekam_medis = $detail->idrekam_medis;
            
            $detail->delete();

            return redirect()->route('perawat.detail-rekam-medis', $idrekam_medis)
                ->with('success', 'Tindakan terapi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus tindakan terapi: ' . $e->getMessage());
        }
    }
}
