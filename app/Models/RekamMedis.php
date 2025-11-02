<?php
// Mengimpor class DBconnection untuk koneksi database
require_once __DIR__ . '/../connection/DBconnection.php';

// Definisi class RekamMedis untuk mengelola data rekam medis
class RekamMedis {
    // Property untuk menyimpan data rekam medis
    public ?int $idrekam_medis = null;         // ID unik rekam medis (auto increment)
    public ?string $created_at = null;         // Waktu pembuatan rekam medis
    public ?string $anamnesa = null;          // Anamnesa (wawancara medis)
    public ?string $temuan_klinis = null;     // Temuan klinis
    public ?string $diagnosa = null;          // Diagnosa
    public ?int $idreservasi_dokter = null;   // ID reservasi dokter (foreign key)
    public ?int $dokter_pemeriksa = null;     // ID dokter pemeriksa

    // Method untuk membuat rekam medis baru
    public function create(): bool {
        // Validasi: idreservasi_dokter dan dokter_pemeriksa harus ada
        if ($this->idreservasi_dokter === null || $this->dokter_pemeriksa === null) return false;
        
        // Buat koneksi database
        $db = new DBconnection();
        
        // Escape string untuk mencegah SQL injection
        $anamnesa = $this->anamnesa ? "'" . addslashes($this->anamnesa) . "'" : 'NULL';
        $temuan_klinis = $this->temuan_klinis ? "'" . addslashes($this->temuan_klinis) . "'" : 'NULL';
        $diagnosa = $this->diagnosa ? "'" . addslashes($this->diagnosa) . "'" : 'NULL';
        $created_at = 'NOW()';
        $idreservasi = (int)$this->idreservasi_dokter;
        $dokter = (int)$this->dokter_pemeriksa;
        
        // Query SQL untuk insert data baru
        $sql = "INSERT INTO rekam_medis (created_at, anamnesa, temuan_klinis, diagnosa, idreservasi_dokter, dokter_pemeriksa) 
                VALUES ($created_at, $anamnesa, $temuan_klinis, $diagnosa, $idreservasi, $dokter)";
        
        $res = $db->send_query($sql);
        
        // Set ID yang baru dibuat jika berhasil
        if ($res['status'] === 'success') {
            $lastId = $db->send_query("SELECT LAST_INSERT_ID() as id");
            if (!empty($lastId['data'])) {
                $this->idrekam_medis = (int)$lastId['data'][0]['id'];
            }
        }
        
        // Tutup koneksi database
        $db->close_connection();
        
        return ($res['status'] ?? 'error') === 'success';
    }

    // Method untuk mengupdate rekam medis
    public function update(): bool {
        // Validasi: ID harus ada
        if ($this->idrekam_medis === null) return false;
        
        $db = new DBconnection();
        
        // Escape string untuk mencegah SQL injection
        $anamnesa = $this->anamnesa ? "'" . addslashes($this->anamnesa) . "'" : 'NULL';
        $temuan_klinis = $this->temuan_klinis ? "'" . addslashes($this->temuan_klinis) . "'" : 'NULL';
        $diagnosa = $this->diagnosa ? "'" . addslashes($this->diagnosa) . "'" : 'NULL';
        $dokter = $this->dokter_pemeriksa ? (int)$this->dokter_pemeriksa : 'NULL';
        $id = (int)$this->idrekam_medis;
        
        $sql = "UPDATE rekam_medis SET 
                anamnesa = $anamnesa, 
                temuan_klinis = $temuan_klinis, 
                diagnosa = $diagnosa, 
                dokter_pemeriksa = $dokter 
                WHERE idrekam_medis = $id";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return ($res['status'] ?? 'error') === 'success';
    }

    // Method untuk menghapus rekam medis
    public function delete(): bool {
        if ($this->idrekam_medis === null) return false;
        
        $db = new DBconnection();
        $id = (int)$this->idrekam_medis;
        
        // Hapus detail rekam medis terkait terlebih dahulu
        $db->send_query("DELETE FROM detail_rekam_medis WHERE idrekam_medis = $id");
        
        // Hapus rekam medis
        $sql = "DELETE FROM rekam_medis WHERE idrekam_medis = $id";
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return ($res['status'] ?? 'error') === 'success';
    }

    // Method untuk mengambil rekam medis berdasarkan ID
    public function getById(int $id): ?array {
        $db = new DBconnection();
        
        $sql = "SELECT rm.*, 
                       td.no_urut, td.waktu_daftar,
                       p.nama AS nama_pet,
                       u.nama AS nama_pemilik,
                       du.nama AS nama_dokter
                FROM rekam_medis rm
                LEFT JOIN temu_dokter td ON td.idreservasi_dokter = rm.idreservasi_dokter
                LEFT JOIN pet p ON p.idpet = td.idpet
                LEFT JOIN pemilik pm ON pm.idpemilik = p.idpemilik
                LEFT JOIN user u ON u.iduser = pm.iduser
                LEFT JOIN user du ON du.iduser = rm.dokter_pemeriksa
                WHERE rm.idrekam_medis = $id";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return !empty($res['data']) ? $res['data'][0] : null;
    }

    // Method untuk mengambil semua rekam medis dengan join
    public function getAllJoined(): array {
        $db = new DBconnection();
        
        $sql = "SELECT rm.*, 
                       td.no_urut, td.waktu_daftar,
                       p.nama AS nama_pet,
                       u.nama AS nama_pemilik,
                       du.nama AS nama_dokter
                FROM rekam_medis rm
                LEFT JOIN temu_dokter td ON td.idreservasi_dokter = rm.idreservasi_dokter
                LEFT JOIN pet p ON p.idpet = td.idpet
                LEFT JOIN pemilik pm ON pm.idpemilik = p.idpemilik
                LEFT JOIN user u ON u.iduser = pm.iduser
                LEFT JOIN user du ON du.iduser = rm.dokter_pemeriksa
                ORDER BY rm.created_at DESC";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return $res['data'] ?? [];
    }

    // Method untuk mengambil rekam medis berdasarkan reservasi
    public function getByReservasi(int $idreservasi): ?array {
        $db = new DBconnection();
        
        $sql = "SELECT rm.*, 
                       td.no_urut, td.waktu_daftar,
                       p.nama AS nama_pet,
                       u.nama AS nama_pemilik,
                       du.nama AS nama_dokter
                FROM rekam_medis rm
                LEFT JOIN temu_dokter td ON td.idreservasi_dokter = rm.idreservasi_dokter
                LEFT JOIN pet p ON p.idpet = td.idpet
                LEFT JOIN pemilik pm ON pm.idpemilik = p.idpemilik
                LEFT JOIN user u ON u.iduser = pm.iduser
                LEFT JOIN user du ON du.iduser = rm.dokter_pemeriksa
                WHERE rm.idreservasi_dokter = $idreservasi";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return !empty($res['data']) ? $res['data'][0] : null;
    }

    // Method untuk load data dari array
    public function loadFromArray(array $data): void {
        $this->idrekam_medis = $data['idrekam_medis'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->anamnesa = $data['anamnesa'] ?? null;
        $this->temuan_klinis = $data['temuan_klinis'] ?? null;
        $this->diagnosa = $data['diagnosa'] ?? null;
        $this->idreservasi_dokter = $data['idreservasi_dokter'] ?? null;
        $this->dokter_pemeriksa = $data['dokter_pemeriksa'] ?? null;
    }
}
?>