<!DOCTYPE html><?php

<html lang="id">

<head>// INISIALISASI SESSION DAN VALIDASI AUTENTIKASI

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> //Mulai session untuk tracking user login

    <title>Tambah Rekam Medis - Perawat RS Hewan UNAIR</title>session_start();

    

    <!-- CSS Styling External -->/**

    <link rel="stylesheet" href="{{ asset('css/shared/style_rekam_medis.css') }}"> * Validasi autentikasi user

     * Redirect ke login jika belum terautentikasi

    <!-- Font Google untuk typography yang konsisten --> */

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">if (!isset($_SESSION['user'])) {

</head>    header('Location: login.php');

<body>    exit;

    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->}

    <div class="nav-content">

        <!-- Logo Universitas Airlangga (kiri) -->

        <div class="logokiri">// SECTION 2: IMPORT CLASS DAN INISIALISASI

            <img src="{{ asset('img/unairr.png') }}" alt="Logo UNAIR">

        </div>/**

         * Import class-class yang dibutuhkan untuk operasi rekam medis

        <!-- Text header utama --> */

        <div class="text">require_once __DIR__ . '/../../class/RekamMedis.php';

            <h2>Universitas Airlangga |</h2>require_once __DIR__ . '/../../class/TemuDokter.php';

        </div>require_once __DIR__ . '/../../class/User.php';

        require_once __DIR__ . '/../../connection/DBconnection.php';

        <!-- Text header secondary -->

        <div class="text2">/**

            <h2>Rumah Sakit Hewan Pendidikan</h2> * Inisialisasi database connection dan objects

        </div> */

        $db = new DBconnection();

        <!-- Logo Rumah Sakit Hewan (kanan) -->$temuDokter = new TemuDokter($db->getMysqli());

        <div class="logokanan">

            <img src="{{ asset('img/rshpp.png') }}" alt="Logo RSHP">/**

        </div> * Ambil data user dari session dengan sanitasi

    </div> */

$user = $_SESSION['user'];

    <!-- NAVIGATION BAR: Menu navigasi dan logout -->$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

    <div class="navbar">

        <!-- Brand logo/text -->// SECTION 3: VALIDASI DAN PENGAMBILAN ID RESERVASI

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

        // Ambil ID reservasi dari parameter URL

        <!-- Navigation menu --> // Validasi dan convert ke integer untuk keamanan

        <div class="navbar-nav"> 

            <a href="{{ route('perawat.rekam-medis') }}">Back</a>$reservasi_id = isset($_GET['reservasi']) ? (int)$_GET['reservasi'] : 0;

            <a href="{{ route('logout') }}">Logout</a>

        </div>/**

    </div> * Validasi ID reservasi tidak boleh 0 atau kosong

 * Redirect ke halaman utama jika invalid

    <!-- MAIN CONTENT: Container untuk semua konten halaman --> */

    <div class="container">if ($reservasi_id == 0) {

        <h1>Tambah Rekam Medis</h1>    header('Location: rekam_medis_perawat.php?error=invalid_reservasi');

            exit;

        <!-- SECTION 1: Informasi Temu Dokter (Read-Only) -->}

        <div class="info-card">

            <h3>Informasi Temu Dokter</h3>// SECTION 4: PENGAMBILAN DATA TEMU DOKTER

            <div class="info-grid">

                <!-- Nomor urut antrian -->// Ambil data temu dokter by ID dengan informasi lengkap

                <div class="info-item">$temuResult = $temuDokter->getTemuDokterById($reservasi_id);

                    <strong>No. Urut:</strong> 

                    {{ $temuDokter->no_urut }}/**

                </div> * Validasi keberadaan data temu dokter

                 * Redirect jika data tidak ditemukan

                <!-- Tanggal dan waktu temu dokter --> */

                <div class="info-item">if (empty($temuResult['data'])) {

                    <strong>Tanggal/Waktu:</strong>     header('Location: rekam_medis_perawat.php?error=appointment_not_found');

                    {{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d/m/Y H:i') }}    exit;

                </div>}

                

                <!-- Nama hewan peliharaan -->/**

                <div class="info-item"> * Ambil data temu dokter pertama (seharusnya hanya 1 karena ID unik)

                    <strong>Nama Pet:</strong>  */

                    {{ $temuDokter->pet->nama }}$temuData = $temuResult['data'][0];

                </div>

                // SECTION 5: VALIDASI DUPLIKASI REKAM MEDIS

                <!-- Nama pemilik hewan -->

                <div class="info-item">/**

                    <strong>Pemilik:</strong>  * Cek apakah rekam medis untuk reservasi ini sudah ada

                    {{ $temuDokter->pet->pemilik->user->nama }} * Mencegah duplikasi data rekam medis

                </div> */

                $rekamMedis = new RekamMedis();

                <!-- Nama dokter yang memeriksa -->$existingRekam = $rekamMedis->getByReservasi($reservasi_id);

                <div class="info-item">

                    <strong>Dokter:</strong> // Jika rekam medis sudah ada, redirect ke halaman detail

                    {{ $temuDokter->roleUser->user->nama }}// Dengan pesan informasi bahwa data sudah ada

                </div>if ($existingRekam) {

            </div>    header('Location: detail_rekam_medis.php?id=' . $existingRekam['idrekam_medis'] . '&info=already_exists');

        </div>    exit;

}

        <!-- SECTION 2: Form Input Rekam Medis -->?>

        <form action="{{ route('perawat.rekam-medis.store') }}" method="POST" class="form-container">

            @csrf<!DOCTYPE html>

            <!-- Hidden fields untuk identifikasi data --><html lang="id">

            <input type="hidden" name="idreservasi_dokter" value="{{ $temuDokter->idreservasi_dokter }}"><head>

            <input type="hidden" name="dokter_pemeriksa" value="{{ $temuDokter->roleUser->iduser }}">    <meta charset="UTF-8">

                <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- Field Anamnesa -->    <title>Tambah Rekam Medis - Perawat RS Hewan UNAIR</title>

            <div class="form-group">    

                <label for="anamnesa">Anamnesa (Wawancara Medis):</label>    <!-- CSS Styling External -->

                <textarea name="anamnesa" id="anamnesa" rows="4"     <link rel="stylesheet" href="../../css/shared/style_rekam_medis.css">

                          placeholder="Masukkan hasil wawancara medis dengan pemilik hewan..."     

                          required>{{ old('anamnesa') }}</textarea>    <!-- Font Google untuk typography yang konsisten -->

                <small class="form-help">    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                    Catatan: Isi dengan riwayat keluhan dan informasi yang diberikan pemilik tentang kondisi hewan</head>

                </small><body>

                @error('anamnesa')    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->

                    <span class="error-message">{{ $message }}</span>    <div class="nav-content">

                @enderror        <!-- Logo Universitas Airlangga (kiri) -->

            </div>        <div class="logokiri">

            <img src="../../img/unairr.png" alt="Logo UNAIR">

            <!-- Field Temuan Klinis -->        </div>

            <div class="form-group">        

                <label for="temuan_klinis">Temuan Klinis:</label>        <!-- Text header utama -->

                <textarea name="temuan_klinis" id="temuan_klinis" rows="4"         <div class="text">

                          placeholder="Masukkan temuan klinis dari pemeriksaan..."             <h2>Universitas Airlangga |</h2>

                          required>{{ old('temuan_klinis') }}</textarea>        </div>

                <small class="form-help">        

                    Catatan: Isi dengan hasil pemeriksaan fisik dan observasi klinis pada hewan        <!-- Text header secondary -->

                </small>        <div class="text2">

                @error('temuan_klinis')            <h2>Rumah Sakit Hewan Pendidikan</h2>

                    <span class="error-message">{{ $message }}</span>        </div>

                @enderror        

            </div>        <!-- Logo Rumah Sakit Hewan (kanan) -->

        <div class="logokanan">

            <!-- Field Diagnosa -->            <img src="../../img/rshpp.png" alt="Logo RSHP">

            <div class="form-group">        </div>

                <label for="diagnosa">Diagnosa:</label>    </div>

                <textarea name="diagnosa" id="diagnosa" rows="3" 

                          placeholder="Masukkan diagnosa berdasarkan pemeriksaan..."     <!-- NAVIGATION BAR: Menu navigasi dan logout -->

                          required>{{ old('diagnosa') }}</textarea>    <div class="navbar">

                <small class="form-help">        <!-- Brand logo/text -->

                    Catatan: Isi dengan kesimpulan diagnosa berdasarkan anamnesa dan temuan klinis        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

                </small>        

                @error('diagnosa')        <!-- Navigation menu -->

                    <span class="error-message">{{ $message }}</span>        <div class="navbar-nav">

                @enderror            <a href="rekam_medis_perawat.php">Back</a>

            </div>            <a href="../../logic/login.php?action=logout">Logout</a>

        </div>

            <!-- Action buttons -->    </div>

            <div class="form-actions">

                <button type="submit" class="btn btn-primary">Simpan Rekam Medis</button>    <!-- MAIN CONTENT: Container untuk semua konten halaman -->

                <a href="{{ route('perawat.rekam-medis') }}" class="btn btn-secondary">Batal</a>    <div class="container">

            </div>        <h1>Tambah Rekam Medis</h1>

        </form>        

    </div>        <!-- SECTION 1: Informasi Temu Dokter (Read-Only) -->

</body>        <div class="info-card">

</html>            <h3>Informasi Temu Dokter</h3>

            <div class="info-grid">
                <!-- Nomor urut antrian -->
                <div class="info-item">
                    <strong>No. Urut:</strong> 
                    <?php echo htmlspecialchars($temuData['no_urut']); ?>
                </div>
                
                <!-- Tanggal dan waktu temu dokter -->
                <div class="info-item">
                    <strong>Tanggal/Waktu:</strong> 
                    <?php echo date('d/m/Y H:i', strtotime($temuData['waktu_daftar'])); ?>
                </div>
                
                <!-- Nama hewan peliharaan -->
                <div class="info-item">
                    <strong>Nama Pet:</strong> 
                    <?php echo htmlspecialchars($temuData['nama_pet']); ?>
                </div>
                
                <!-- Nama pemilik hewan -->
                <div class="info-item">
                    <strong>Pemilik:</strong> 
                    <?php echo htmlspecialchars($temuData['nama_pemilik']); ?>
                </div>
                
                <!-- Nama dokter yang memeriksa -->
                <div class="info-item">
                    <strong>Dokter:</strong> 
                    <?php echo htmlspecialchars($temuData['nama_dokter']); ?>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Form Input Rekam Medis -->
        <form action="../../logic/perawat/rekam_medis_process.php" method="POST" class="form-container">
            <!-- Hidden fields untuk identifikasi data -->
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="idreservasi_dokter" value="<?php echo $reservasi_id; ?>">
            <input type="hidden" name="dokter_pemeriksa" value="<?php echo $temuData['id_dokter']; ?>">
            
            <!-- Field Anamnesa -->
            <div class="form-group">
                <label for="anamnesa">Anamnesa (Wawancara Medis):</label>
                <textarea name="anamnesa" id="anamnesa" rows="4" 
                          placeholder="Masukkan hasil wawancara medis dengan pemilik hewan..." 
                          required></textarea>
                <small class="form-help">
                    Catatan: Isi dengan riwayat keluhan dan informasi yang diberikan pemilik tentang kondisi hewan
                </small>
            </div>

            <!-- Field Temuan Klinis -->
            <div class="form-group">
                <label for="temuan_klinis">Temuan Klinis:</label>
                <textarea name="temuan_klinis" id="temuan_klinis" rows="4" 
                          placeholder="Masukkan temuan klinis dari pemeriksaan..." 
                          required></textarea>
                <small class="form-help">
                    Catatan: Isi dengan hasil pemeriksaan fisik dan observasi klinis pada hewan
                </small>
            </div>

            <!-- Field Diagnosa -->
            <div class="form-group">
                <label for="diagnosa">Diagnosa:</label>
                <textarea name="diagnosa" id="diagnosa" rows="3" 
                          placeholder="Masukkan diagnosa berdasarkan pemeriksaan..." 
                          required></textarea>
                <small class="form-help">
                    Catatan: Isi dengan kesimpulan diagnosa berdasarkan anamnesa dan temuan klinis
                </small>
            </div>

            <!-- Action buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Rekam Medis</button>
                <a href="rekam_medis_perawat.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
// Tutup database connection
if (isset($db)) {
    $db->close_connection();
}
?>