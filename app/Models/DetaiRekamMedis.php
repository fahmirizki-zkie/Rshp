<?php
// untuk koneksi database
require_once __DIR__ . '/../connection/DBconnection.php';

// Definisi class DetailRekamMedis untuk mengelola detail rekam medis
class DetailRekamMedis {
    // Property untuk menyimpan data detail rekam medis
    public ?int $iddetail_rekam_medis = null; // ID unik detail rekam medis (auto increment)
    public ?int $idrekam_medis = null;        // ID rekam medis (foreign key)
    public ?int $idkode_tindakan_terapi = null; // ID kode tindakan terapi (foreign key)
    public ?string $detail = null;            // Detail tindakan

    // Method untuk membuat detail rekam medis baru
    public function create(): bool {
        // Validasi: idrekam_medis dan idkode_tindakan_terapi harus ada
        if ($this->idrekam_medis === null || $this->idkode_tindakan_terapi === null) return false;
        
        // Buat koneksi database
        $db = new DBconnection();
        
        // Escape string untuk mencegah SQL injection
        $detail = $this->detail ? "'" . addslashes($this->detail) . "'" : 'NULL';
        $idrekam = (int)$this->idrekam_medis;
        $idkode = (int)$this->idkode_tindakan_terapi;
        
        // Query SQL untuk insert data baru
        $sql = "INSERT INTO detail_rekam_medis (idrekam_medis, idkode_tindakan_terapi, detail) 
                VALUES ($idrekam, $idkode, $detail)";
        
        $res = $db->send_query($sql);
        
        // Set ID yang baru dibuat jika berhasil
        if ($res['status'] === 'success') {
            $lastId = $db->send_query("SELECT LAST_INSERT_ID() as id");
            if (!empty($lastId['data'])) {
                $this->iddetail_rekam_medis = (int)$lastId['data'][0]['id'];
            }
        }
        
        // Tutup koneksi database
        $db->close_connection();
        
        return ($res['status'] ?? 'error') === 'success';
    }

    // Method untuk mengupdate detail rekam medis
    public function update(): bool {
        // Validasi: ID harus ada
        if ($this->iddetail_rekam_medis === null) return false;
        
        $db = new DBconnection();
        
        // Escape string untuk mencegah SQL injection
        $detail = $this->detail ? "'" . addslashes($this->detail) . "'" : 'NULL';
        $idkode = $this->idkode_tindakan_terapi ? (int)$this->idkode_tindakan_terapi : 'NULL';
        $id = (int)$this->iddetail_rekam_medis;
        
        $sql = "UPDATE detail_rekam_medis SET 
                detail = $detail, 
                idkode_tindakan_terapi = $idkode 
                WHERE iddetail_rekam_medis = $id";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return ($res['status'] ?? 'error') === 'success';
    }

    // Method untuk menghapus detail rekam medis
    public function delete(): bool {
        if ($this->iddetail_rekam_medis === null) return false;
        
        $db = new DBconnection();
        $id = (int)$this->iddetail_rekam_medis;
        
        $sql = "DELETE FROM detail_rekam_medis WHERE iddetail_rekam_medis = $id";
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return ($res['status'] ?? 'error') === 'success';
    }

    // Method untuk mengambil detail rekam medis berdasarkan ID
    public function getById(int $id): ?array {
        $db = new DBconnection();
        
        $sql = "SELECT drm.*, 
                       ktt.kode, ktt.deskripsi_tindakan_terapi,
                       k.nama_kategori,
                       kk.nama_kategori_klinis
                FROM detail_rekam_medis drm
                LEFT JOIN kode_tindakan_terapi ktt ON ktt.idkode_tindakan_terapi = drm.idkode_tindakan_terapi
                LEFT JOIN kategori k ON k.idkategori = ktt.idkategori
                LEFT JOIN kategori_klinis kk ON kk.idkategori_klinis = ktt.idkategori_klinis
                WHERE drm.iddetail_rekam_medis = $id";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return !empty($res['data']) ? $res['data'][0] : null;
    }

    // Method untuk mengambil detail rekam medis berdasarkan ID rekam medis
    public function getByRekamMedis(int $idrekam_medis): array {
        $db = new DBconnection();
        
        $sql = "SELECT drm.*, 
                       ktt.kode, ktt.deskripsi_tindakan_terapi,
                       k.nama_kategori,
                       kk.nama_kategori_klinis
                FROM detail_rekam_medis drm
                LEFT JOIN kode_tindakan_terapi ktt ON ktt.idkode_tindakan_terapi = drm.idkode_tindakan_terapi
                LEFT JOIN kategori k ON k.idkategori = ktt.idkategori
                LEFT JOIN kategori_klinis kk ON kk.idkategori_klinis = ktt.idkategori_klinis
                WHERE drm.idrekam_medis = $idrekam_medis
                ORDER BY drm.iddetail_rekam_medis ASC";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return $res['data'] ?? [];
    }

    // Method untuk mengambil semua detail rekam medis dengan join
    public function getAllJoined(): array {
        $db = new DBconnection();
        
        $sql = "SELECT drm.*, 
                       ktt.kode, ktt.deskripsi_tindakan_terapi,
                       k.nama_kategori,
                       kk.nama_kategori_klinis,
                       rm.created_at as tgl_rekam_medis
                FROM detail_rekam_medis drm
                LEFT JOIN kode_tindakan_terapi ktt ON ktt.idkode_tindakan_terapi = drm.idkode_tindakan_terapi
                LEFT JOIN kategori k ON k.idkategori = ktt.idkategori
                LEFT JOIN kategori_klinis kk ON kk.idkategori_klinis = ktt.idkategori_klinis
                LEFT JOIN rekam_medis rm ON rm.idrekam_medis = drm.idrekam_medis
                ORDER BY rm.created_at DESC, drm.iddetail_rekam_medis ASC";
        
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return $res['data'] ?? [];
    }

    // Method untuk load data dari array
    public function loadFromArray(array $data): void {
        $this->iddetail_rekam_medis = $data['iddetail_rekam_medis'] ?? null;
        $this->idrekam_medis = $data['idrekam_medis'] ?? null;
        $this->idkode_tindakan_terapi = $data['idkode_tindakan_terapi'] ?? null;
        $this->detail = $data['detail'] ?? null;
    }

    // Method untuk menghitung jumlah detail per rekam medis
    public function countByRekamMedis(int $idrekam_medis): int {
        $db = new DBconnection();
        
        $sql = "SELECT COUNT(*) as total FROM detail_rekam_medis WHERE idrekam_medis = $idrekam_medis";
        $res = $db->send_query($sql);
        $db->close_connection();
        
        return !empty($res['data']) ? (int)$res['data'][0]['total'] : 0;
    }
}
?>