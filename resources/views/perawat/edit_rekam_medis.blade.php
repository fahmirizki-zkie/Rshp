<!DOCTYPE html><?php

<html lang="id">

<head>// SECTION 1: INISIALISASI SESSION DAN VALIDASI AUTENTIKASI

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// Mulai session untuk tracking user login

    <title>Edit Rekam Medis - Perawat RS Hewan UNAIR</title>session_start();

    

    <!-- CSS Styling External -->// Validasi autentikasi user

    <link rel="stylesheet" href="{{ asset('css/shared/style_rekam_medis.css') }}">// Redirect ke login jika belum terautentikasi

    if (!isset($_SESSION['user'])) {

    <!-- Font Google untuk typography yang konsisten -->    header('Location: login.php');

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">    exit;

</head>}

<body>

    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->// SECTION 2: IMPORT CLASS DAN INISIALISASI

    <div class="nav-content">

        <div class="logokiri">// Import class yang dibutuhkan untuk operasi rekam medis

            <img src="{{ asset('img/unairr.png') }}" alt="Logo UNAIR">require_once __DIR__ . '/../../class/RekamMedis.php';

        </div>

        <div class="text">// Ambil data user dari session dengan sanitasi

            <h2>Universitas Airlangga |</h2>$user = $_SESSION['user'];

        </div>$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

        <div class="text2">

            <h2>Rumah Sakit Hewan Pendidikan</h2>// SECTION 3: VALIDASI DAN PENGAMBILAN ID REKAM MEDIS

        </div>

        <div class="logokanan">// Ambil ID rekam medis dari parameter URL

            <img src="{{ asset('img/rshpp.png') }}" alt="Logo RSHP">// Validasi dan convert ke integer untuk keamanan

        </div>$rekam_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    </div>

// Validasi ID rekam medis tidak boleh 0 atau kosong

    <!-- NAVIGATION BAR: Menu navigasi dan logout -->// Redirect ke halaman utama jika invalid

    <div class="navbar">if ($rekam_id == 0) {

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>    header('Location: rekam_medis_perawat.php?error=invalid_id');

        <div class="navbar-nav">    exit;

            <a href="{{ route('perawat.detail-rekam-medis', $rekamMedis->idrekam_medis) }}">Back</a>}

            <a href="{{ route('logout') }}">Logout</a>

        </div>// SECTION 4: PENGAMBILAN DATA REKAM MEDIS

    </div>

// Inisialisasi object RekamMedis dan ambil data berdasarkan ID

    <!-- MAIN CONTENT: Container untuk semua konten halaman -->$rekamMedis = new RekamMedis();

    <div class="container">$rekamData = $rekamMedis->getById($rekam_id);

        <h1>Edit Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h1>

        // Validasi keberadaan data rekam medis

        <!-- SECTION 1: Informasi Pasien (Read-Only Reference) -->// Redirect jika data tidak ditemukan

        <div class="info-card">if (!$rekamData) {

            <h3>Informasi Pasien</h3>    header('Location: rekam_medis_perawat.php?error=record_not_found');

            <div class="info-grid">    exit;

                <div class="info-item">}

                    <strong>Tanggal:</strong> ?>

                    {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d/m/Y H:i') }}

                </div><!DOCTYPE html>

                <div class="info-item"><html lang="id">

                    <strong>No. Urut:</strong> <head>

                    {{ $rekamMedis->temuDokter->no_urut ?? '-' }}    <meta charset="UTF-8">

                </div>    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <div class="info-item">    <title>Edit Rekam Medis - Perawat RS Hewan UNAIR</title>

                    <strong>Nama Pet:</strong>     

                    {{ $rekamMedis->temuDokter->pet->nama ?? '-' }}    <!-- CSS Styling External -->

                </div>    <link rel="stylesheet" href="../../css/shared/style_rekam_medis.css">

                <div class="info-item">    

                    <strong>Pemilik:</strong>     <!-- Font Google untuk typography yang konsisten -->

                    {{ $rekamMedis->temuDokter->pet->pemilik->user->nama ?? '-' }}    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

                </div></head>

                <div class="info-item"><body>

                    <strong>Dokter:</strong>     <!-- =================================================================== -->

                    {{ $rekamMedis->dokter->nama ?? '-' }}    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->

                </div>    <!-- =================================================================== -->

            </div>    <div class="nav-content">

        </div>        <div class="logokiri">

            <img src="../../img/unairr.png" alt="Logo UNAIR">

        <!-- SECTION 2: Form Edit Rekam Medis -->        </div>

        <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST" class="form-container">        <div class="text">

            @csrf            <h2>Universitas Airlangga |</h2>

            @method('PUT')        </div>

                    <div class="text2">

            <!-- Field Anamnesa dengan data existing -->            <h2>Rumah Sakit Hewan Pendidikan</h2>

            <div class="form-group">        </div>

                <label for="anamnesa">Anamnesa (Wawancara Medis):</label>        <div class="logokanan">

                <textarea name="anamnesa" id="anamnesa" rows="4" required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>            <img src="../../img/rshpp.png" alt="Logo RSHP">

                <small class="form-help">        </div>

                    Catatan: Edit riwayat keluhan dan informasi dari pemilik tentang kondisi hewan    </div>

                </small>

                @error('anamnesa')    <!-- NAVIGATION BAR: Menu navigasi dan logout -->

                    <span class="error-message">{{ $message }}</span>    <div class="navbar">

                @enderror        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

            </div>        <div class="navbar-nav">

            <a href="detail_rekam_medis.php?id=<?php echo $rekam_id; ?>">Back</a>

            <!-- Field Temuan Klinis dengan data existing -->            <a href="../../logic/login.php?action=logout">Logout</a>

            <div class="form-group">        </div>

                <label for="temuan_klinis">Temuan Klinis:</label>    </div>

                <textarea name="temuan_klinis" id="temuan_klinis" rows="4" required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>

                <small class="form-help">    <!-- MAIN CONTENT: Container untuk semua konten halaman -->

                    Catatan: Edit hasil pemeriksaan fisik dan observasi klinis pada hewan    <div class="container">

                </small>        <h1>Edit Rekam Medis #<?php echo $rekam_id; ?></h1>

                @error('temuan_klinis')        

                    <span class="error-message">{{ $message }}</span>        <!-- SECTION 1: Informasi Pasien (Read-Only Reference) -->

                @enderror        <div class="info-card">

            </div>            <h3>Informasi Pasien</h3>

            <div class="info-grid">

            <!-- Field Diagnosa dengan data existing -->                <div class="info-item">

            <div class="form-group">                    <strong>Tanggal:</strong> 

                <label for="diagnosa">Diagnosa:</label>                    <?php echo date('d/m/Y H:i', strtotime($rekamData['created_at'])); ?>

                <textarea name="diagnosa" id="diagnosa" rows="3" required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>                </div>

                <small class="form-help">                <div class="info-item">

                    Catatan: Edit kesimpulan diagnosa berdasarkan anamnesa dan temuan klinis                    <strong>No. Urut:</strong> 

                </small>                    <?php echo htmlspecialchars($rekamData['no_urut'] ?? '-'); ?>

                @error('diagnosa')                </div>

                    <span class="error-message">{{ $message }}</span>                <div class="info-item">

                @enderror                    <strong>Nama Pet:</strong> 

            </div>                    <?php echo htmlspecialchars($rekamData['nama_pet'] ?? '-'); ?>

                </div>

            <!-- Action buttons -->                <div class="info-item">

            <div class="form-actions">                    <strong>Pemilik:</strong> 

                <button type="submit" class="btn btn-primary">Update Rekam Medis</button>                    <?php echo htmlspecialchars($rekamData['nama_pemilik'] ?? '-'); ?>

                <a href="{{ route('perawat.detail-rekam-medis', $rekamMedis->idrekam_medis) }}" class="btn btn-secondary">Batal</a>                </div>

            </div>                <div class="info-item">

        </form>                    <strong>Dokter:</strong> 

    </div>                    <?php echo htmlspecialchars($rekamData['nama_dokter'] ?? '-'); ?>

</body>                </div>

</html>            </div>

        </div>

        <!-- SECTION 2: Form Edit Rekam Medis -->
        <form action="../../logic/perawat/rekam_medis_process.php" method="POST" class="form-container">
            <!-- Hidden fields untuk identifikasi update -->
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="idrekam_medis" value="<?php echo $rekam_id; ?>">
            
            <!-- Field Anamnesa dengan data existing -->
            <div class="form-group">
                <label for="anamnesa">Anamnesa (Wawancara Medis):</label>
                <textarea name="anamnesa" id="anamnesa" rows="4" required><?php echo htmlspecialchars($rekamData['anamnesa'] ?? ''); ?></textarea>
                <small class="form-help">
                    Catatan: Edit riwayat keluhan dan informasi dari pemilik tentang kondisi hewan
                </small>
            </div>

            <!-- Field Temuan Klinis dengan data existing -->
            <div class="form-group">
                <label for="temuan_klinis">Temuan Klinis:</label>
                <textarea name="temuan_klinis" id="temuan_klinis" rows="4" required><?php echo htmlspecialchars($rekamData['temuan_klinis'] ?? ''); ?></textarea>
                <small class="form-help">
                    Catatan: Edit hasil pemeriksaan fisik dan observasi klinis pada hewan
                </small>
            </div>

            <!-- Field Diagnosa dengan data existing -->
            <div class="form-group">
                <label for="diagnosa">Diagnosa:</label>
                <textarea name="diagnosa" id="diagnosa" rows="3" required><?php echo htmlspecialchars($rekamData['diagnosa'] ?? ''); ?></textarea>
                <small class="form-help">
                    Catatan: Edit kesimpulan diagnosa berdasarkan anamnesa dan temuan klinis
                </small>
            </div>

            <!-- Action buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Rekam Medis</button>
                <a href="detail_rekam_medis.php?id=<?php echo $rekam_id; ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <?php
    // CATATAN UNTUK PENGEMBANG:
    // 1. WORKFLOW EDIT: User datang dari detail_rekam_medis.php dengan ID rekam medis, system validasi ID dan load data existing, form ter-populate dengan data yang sudah ada, user edit field yang diperlukan, submit untuk update data
    // 2. KEAMANAN: Session validation untuk authentication, ID validation untuk mencegah akses illegal, data sanitization untuk output, required fields validation
    // 3. USER EXPERIENCE: Data existing ter-populate untuk kemudahan edit, informasi pasien sebagai referensi, form help text untuk guidance, clear navigation back ke detail
    ?>
</body>
</html>