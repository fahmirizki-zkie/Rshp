<?php
// Mengimpor class DBconnection untuk koneksi database
require_once __DIR__ . '/../connection/DBconnection.php';

// Definisi class TemuDokter untuk mengelola data temu dokter
class TemuDokter {
    // Property untuk menyimpan data temu dokter
    public ?int $idreservasi_dokter = null;    // ID unik reservasi (auto increment)
    public ?int $no_urut = null;               // Nomor urut antrian per hari
    public ?string $waktu_daftar = null;       // Waktu pendaftaran (TIMESTAMP)
    public ?string $status = null;             // Status antrian (A=Antri, D=Dipanggil, S=Selesai)
    public ?int $idpet = null;                 // ID pet yang akan diperiksa
    public ?int $idrole_user = null;           // ID role_user dokter yang dipilih

    // Method untuk membuat reservasi baru
    public function create(): bool {
        // Validasi: idpet dan idrole_user harus ada
        if ($this->idpet === null || $this->idrole_user === null) return false;
        
        // Buat koneksi database
        $db = new DBconnection();
        
        // Hitung jumlah antrian hari ini untuk menentukan nomor urut
        $qCount = "SELECT COUNT(*) AS cnt FROM temu_dokter WHERE DATE(waktu_daftar) = CURDATE()";
        $resCount = $db->send_query($qCount);
        $count = (int)($resCount['data'][0]['cnt'] ?? 0);
        $this->no_urut = $count + 1; // Nomor urut = jumlah antrian hari ini + 1
        
        // Siapkan nilai untuk insert
        $now = 'NOW()'; // Waktu sekarang
        $status = $this->status !== null ? "'" . substr($this->status, 0, 1) . "'" : "'A'"; // Default status = A (Antri)
        $idpet = (int)$this->idpet;         // Convert ke integer untuk keamanan
        $idru = (int)$this->idrole_user;    // Convert ke integer untuk keamanan
        
        // Query SQL untuk insert data baru
        $sql = "INSERT INTO temu_dokter (no_urut, waktu_daftar, status, idpet, idrole_user) VALUES ({$this->no_urut}, {$now}, {$status}, {$idpet}, {$idru})";
        $res = $db->send_query($sql);
        
        // Tutup koneksi database
        $db->close_connection();
        
        // Return true jika berhasil, false jika gagal
        return ($res['status'] ?? 'error') === 'success';
    }

    // Method untuk mengambil semua data temu dokter dengan join ke tabel lain
    public function getAllJoined(): array {
        // Buat koneksi database
        $db = new DBconnection();
        
        $sql = "SELECT t.idreservasi_dokter, t.no_urut, t.waktu_daftar, t.status,
                       p.idpet, p.nama AS nama_pet, u.nama AS nama_pemilik,
                       du.nama AS nama_dokter
                FROM temu_dokter t
                LEFT JOIN pet p ON p.idpet = t.idpet
                LEFT JOIN pemilik pm ON pm.idpemilik = p.idpemilik
                LEFT JOIN user u ON u.iduser = pm.iduser
                LEFT JOIN role_user dru ON dru.idrole_user = t.idrole_user
                LEFT JOIN user du ON du.iduser = dru.iduser
                ORDER BY t.waktu_daftar ASC"; // Urutkan berdasarkan waktu daftar (yang pertama daftar di atas)
        
        // Eksekusi query
        $res = $db->send_query($sql);
        
        // Tutup koneksi database
        $db->close_connection();
        
        // Return array data, atau array kosong jika tidak ada data
        return $res['data'] ?? [];
    }

    // Method untuk mengambil temu dokter yang belum memiliki rekam medis
    public function getTemuDokterTanpaRekamMedis(): array {
        // Buat koneksi database
        $db = new DBconnection();
        
        // Query untuk mendapatkan temu dokter yang belum memiliki rekam medis
        $sql = "SELECT td.*, p.nama AS nama_pet, u.nama AS nama_pemilik, du.nama AS nama_dokter
                FROM temu_dokter td
                LEFT JOIN pet p ON p.idpet = td.idpet
                LEFT JOIN pemilik pm ON pm.idpemilik = p.idpemilik
                LEFT JOIN user u ON u.iduser = pm.iduser
                LEFT JOIN role_user dru ON dru.idrole_user = td.idrole_user
                LEFT JOIN user du ON du.iduser = dru.iduser
                LEFT JOIN rekam_medis rm ON rm.idreservasi_dokter = td.idreservasi_dokter
                WHERE td.status IN ('A', 'D') AND rm.idrekam_medis IS NULL
                ORDER BY td.waktu_daftar ASC";
        
        // Eksekusi query
        $res = $db->send_query($sql);
        
        // Tutup koneksi database
        $db->close_connection();
        
        // Return hasil dengan format yang sama seperti send_query
        return $res;
    }

    // Method untuk mengambil temu dokter by ID dengan data lengkap
    public function getTemuDokterById($reservasi_id): array {
        // Buat koneksi database
        $db = new DBconnection();
        
        // Validasi input
        $reservasi_id = (int)$reservasi_id;
        
        // Query kompleks untuk mendapatkan data lengkap temu dokter
        $sql = "SELECT td.*, p.nama AS nama_pet, u.nama AS nama_pemilik, du.nama AS nama_dokter, du.iduser as id_dokter
                FROM temu_dokter td
                LEFT JOIN pet p ON p.idpet = td.idpet
                LEFT JOIN pemilik pm ON pm.idpemilik = p.idpemilik
                LEFT JOIN user u ON u.iduser = pm.iduser
                LEFT JOIN role_user dru ON dru.idrole_user = td.idrole_user
                LEFT JOIN user du ON du.iduser = dru.iduser
                WHERE td.idreservasi_dokter = $reservasi_id";
        
        // Eksekusi query
        $res = $db->send_query($sql);
        
        // Tutup koneksi database
        $db->close_connection();
        
        // Return hasil dengan format yang sama seperti send_query
        return $res;
    }
}
?>
