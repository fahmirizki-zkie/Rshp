<!DOCTYPE html><?php

<html lang="id">

<head>// ========== AUTHENTICATION & SESSION MANAGEMENT ==========

    <meta charset="UTF-8">// Mulai session untuk mengelola login user

    <meta name="viewport" content="width=device-width, initial-scale=1.0">session_start();

    <title>Detail Rekam Medis - Dokter RSHP UNAIR</title>

    // Cek apakah user sudah login atau belum

    <!-- CSS STYLESHEETS -->if (!isset($_SESSION['user'])) {

    <link rel="stylesheet" href="{{ asset('css/st.css') }}">    // Jika belum login, redirect ke halaman login

</head>    header('Location: login.php');

<body>    exit;

    <!-- HEADER NAVIGATION SECTION -->}

    <div class="nav-content">

        <div class="logokiri">// ========== DEPENDENCIES & CLASS INCLUDES ==========

            <img src="{{ asset('img/unair.avif') }}" alt="Logo UNAIR">// Include class yang diperlukan untuk operasi database

        </div>require_once __DIR__ . '/../../class/RekamMedis.php';

        <div class="text">require_once __DIR__ . '/../../class/DetailRekamMedis.php';

            <h2>Universitas Airlangga |</h2>

        </div>// ========== DATA USER PROCESSING ==========

        <div class="text2">// Ambil data user dari session dengan validasi keamanan

            <h2>Rumah Sakit Hewan Pendidikan</h2>$user = $_SESSION['user'];

        </div>

        <div class="logokanan">// Ambil nama user dengan aman, jika tidak ada gunakan default 'Pengguna'

            <img src="{{ asset('img/medical.avif') }}" alt="Logo RSHP">$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

        </div>

    </div>// ========== PARAMETER VALIDATION ==========

// Ambil ID rekam medis dari URL parameter

    <!-- MAIN NAVIGATION BAR -->$rekam_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    <div class="navbar">

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>// Validasi ID rekam medis, harus lebih dari 0

        <div class="navbar-nav">if ($rekam_id == 0) {

            <a href="{{ route('dokter.rekam-medis') }}" class="back-link">Back</a>    // Jika ID tidak valid, redirect ke halaman utama dengan error

            <a href="{{ route('logout') }}">Logout</a>    header('Location: rekam_medis_dokter.php?error=invalid_id');

        </div>    exit;

    </div>}



    <!-- MAIN CONTENT CONTAINER -->// ========== DATABASE OPERATIONS ==========

    <div class="container">// Inisialisasi class untuk mengambil data rekam medis

        <!-- PAGE HEADER SECTION -->$rekamMedis = new RekamMedis();

        <div class="header-section">$rekamData = $rekamMedis->getById($rekam_id);

            <h1>📋 Detail Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h1>

        </div>// Validasi apakah data rekam medis ditemukan

        if (!$rekamData) {

        <!-- PATIENT INFORMATION SECTION -->    // Jika data tidak ditemukan, redirect dengan error

        <div class="info-card">    header('Location: rekam_medis_dokter.php?error=record_not_found');

            <h3>Informasi Pasien & Pemeriksaan</h3>    exit;

            <div class="info-grid">}

                <!-- Tanggal pemeriksaan -->

                <div class="info-item">// Ambil detail tindakan terapi dari rekam medis

                    <strong>Tanggal Pemeriksaan:</strong> $detailRekamMedis = new DetailRekamMedis();

                    <span>{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y, H:i') }} WIB</span>$detailData = $detailRekamMedis->getByRekamMedis($rekam_id);

                </div>$totalDetails = $detailRekamMedis->countByRekamMedis($rekam_id);

                ?>

                <!-- Nomor urut antrian --><!DOCTYPE html>

                <div class="info-item"><html lang="id">

                    <strong>No. Urut Antrian:</strong> <head>

                    <span>{{ $rekamMedis->temuDokter->no_urut ?? '-' }}</span>    <meta charset="UTF-8">

                </div>    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                    <title>Detail Rekam Medis - Dokter RSHP UNAIR</title>

                <!-- Nama hewan pasien -->    

                <div class="info-item">    <!-- ========== CSS STYLESHEETS ========== -->

                    <strong>Nama Hewan (Pet):</strong>     <!-- Menggunakan shared CSS untuk rekam medis -->

                    <span>{{ $rekamMedis->temuDokter->pet->nama ?? '-' }}</span>    <link rel="stylesheet" href="../../css/shared/style_rekam_medis.css">

                </div></head>

                <body>

                <!-- Nama pemilik hewan -->    <!-- ========== HEADER NAVIGATION SECTION ========== -->

                <div class="info-item">    <!-- Logo Start -->

                    <strong>Nama Pemilik:</strong>     <div class="nav-content">

                    <span>{{ $rekamMedis->temuDokter->pet->pemilik->user->nama ?? '-' }}</span>        <!-- Logo Universitas Airlangga (kiri) -->

                </div>        <div class="logokiri">

                            <img src="../../img/unairr.png" alt="Logo UNAIR">

                <!-- Dokter yang memeriksa -->        </div>

                <div class="info-item">

                    <strong>Dokter Pemeriksa:</strong>         <!-- Text header utama -->

                    <span>{{ $rekamMedis->dokter->nama ?? '-' }}</span>        <div class="text">

                </div>            <h2>Universitas Airlangga |</h2>

                        </div>

                <!-- Waktu jadwal temu dokter -->

                <div class="info-item">        <!-- Text header sekunder -->

                    <strong>Waktu Temu Dokter:</strong>         <div class="text2">

                    <span>            <h2>Rumah Sakit Hewan Pendidikan</h2>

                        @if($rekamMedis->temuDokter->waktu_daftar)        </div>

                            {{ \Carbon\Carbon::parse($rekamMedis->temuDokter->waktu_daftar)->format('d F Y, H:i') }} WIB

                        @else        <!-- Logo RSHP (kanan) -->

                            -        <div class="logokanan">

                        @endif            <img src="../../img/rshpp.png" alt="Logo RSHP">

                    </span>        </div>

                </div>    </div>

            </div>    <!-- Logo End -->

        </div>

    <!-- ========== MAIN NAVIGATION BAR ========== -->

        <!-- MEDICAL EXAMINATION DETAILS SECTION -->    <!-- navbar start -->

        <div class="medical-details-section">    <div class="navbar">

            <h3>Detail Pemeriksaan Medis</h3>        <!-- Brand logo/text -->

                    <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

            <!-- Anamnesa (wawancara medis) -->

            <div class="medical-detail-card">        <!-- Navigation menu items -->

                <h4>🗣️ Anamnesa (Wawancara Medis)</h4>        <div class="navbar-nav">

                <div class="medical-content">            <!-- Menu Back - kembali ke daftar rekam medis -->

                    @if($rekamMedis->anamnesa)            <a href="rekam_medis_dokter.php" class="back-link">Back</a>

                        {!! nl2br(e($rekamMedis->anamnesa)) !!}            

                    @else            <!-- Menu Logout - keluar dari sistem -->

                        <em>Tidak ada catatan anamnesa</em>            <a href="../../logic/login.php?action=logout">Logout</a>

                    @endif        </div>

                </div>    </div>

            </div>    <!-- navbar end -->

            

            <!-- Temuan klinis -->    <!-- ========== MAIN CONTENT CONTAINER ========== -->

            <div class="medical-detail-card">    <div class="container">

                <h4>🔍 Temuan Klinis</h4>        <!-- ========== PAGE HEADER SECTION ========== -->

                <div class="medical-content">        <div class="header-section">

                    @if($rekamMedis->temuan_klinis)            <h1>📋 Detail Rekam Medis #<?php echo $rekam_id; ?></h1>

                        {!! nl2br(e($rekamMedis->temuan_klinis)) !!}        </div>

                    @else        

                        <em>Tidak ada catatan temuan klinis</em>        <!-- ========== PATIENT INFORMATION SECTION ========== -->

                    @endif        <!-- Card informasi pasien dan pemeriksaan -->

                </div>        <div class="info-card">

            </div>            <h3>Informasi Pasien & Pemeriksaan</h3>

                        <div class="info-grid">

            <!-- Diagnosa -->                <!-- Tanggal pemeriksaan -->

            <div class="medical-detail-card">                <div class="info-item">

                <h4>🩺 Diagnosa</h4>                    <strong>Tanggal Pemeriksaan:</strong> 

                <div class="medical-content diagnosa">                    <span><?php echo date('d F Y, H:i', strtotime($rekamData['created_at'])); ?> WIB</span>

                    @if($rekamMedis->diagnosa)                </div>

                        {!! nl2br(e($rekamMedis->diagnosa)) !!}                

                    @else                <!-- Nomor urut antrian -->

                        <em>Tidak ada diagnosa</em>                <div class="info-item">

                    @endif                    <strong>No. Urut Antrian:</strong> 

                </div>                    <span><?php echo htmlspecialchars($rekamData['no_urut'] ?? '-'); ?></span>

            </div>                </div>

        </div>                

                <!-- Nama hewan pasien -->

        <!-- THERAPY ACTIONS SECTION -->                <div class="info-item">

        <div class="therapy-section">                    <strong>Nama Hewan (Pet):</strong> 

            <h3>💉 Tindakan Terapi yang Dilakukan</h3>                    <span><?php echo htmlspecialchars($rekamData['nama_pet'] ?? '-'); ?></span>

                            </div>

            <!-- Summary total tindakan -->                

            <div class="therapy-summary">                <!-- Nama pemilik hewan -->

                <p><strong>Total Tindakan:</strong> {{ $rekamMedis->detailRekamMedis->count() }} tindakan terapi</p>                <div class="info-item">

            </div>                    <strong>Nama Pemilik:</strong> 

                                <span><?php echo htmlspecialchars($rekamData['nama_pemilik'] ?? '-'); ?></span>

            <!-- Daftar tindakan terapi -->                </div>

            @if($rekamMedis->detailRekamMedis->isNotEmpty())                

            <div class="therapy-list">                <!-- Dokter yang memeriksa -->

                @foreach($rekamMedis->detailRekamMedis as $index => $detail)                <div class="info-item">

                <div class="therapy-item">                    <strong>Dokter Pemeriksa:</strong> 

                    <!-- Header tindakan dengan nomor urut -->                    <span><?php echo htmlspecialchars($rekamData['nama_dokter'] ?? '-'); ?></span>

                    <div class="therapy-header">                </div>

                        <h4>Tindakan #{{ $index + 1 }}</h4>                

                        <span class="therapy-code">{{ $detail->kodeTindakan->kode ?? '-' }}</span>                <!-- Waktu jadwal temu dokter -->

                    </div>                <div class="info-item">

                                        <strong>Waktu Temu Dokter:</strong> 

                    <!-- Informasi detail tindakan -->                    <span><?php echo $rekamData['waktu_daftar'] ? date('d F Y, H:i', strtotime($rekamData['waktu_daftar'])) . ' WIB' : '-'; ?></span>

                    <div class="therapy-info">                </div>

                        <!-- Kategori tindakan -->            </div>

                        <div class="therapy-row">        </div>

                            <strong>Kategori:</strong> 

                            <span>{{ $detail->kodeTindakan->kategori->nama_kategori ?? '-' }}</span>        <!-- ========== MEDICAL EXAMINATION DETAILS SECTION ========== -->

                        </div>        <div class="medical-details-section">

                                    <h3>Detail Pemeriksaan Medis</h3>

                        <!-- Kategori klinis -->            

                        <div class="therapy-row">            <!-- Anamnesa (wawancara medis) -->

                            <strong>Kategori Klinis:</strong>             <div class="medical-detail-card">

                            <span>{{ $detail->kodeTindakan->kategoriKlinis->nama_kategori_klinis ?? '-' }}</span>                <h4>🗣️ Anamnesa (Wawancara Medis)</h4>

                        </div>                <div class="medical-content">

                                            <?php 

                        <!-- Deskripsi tindakan -->                    // Tampilkan anamnesa atau pesan default jika kosong

                        <div class="therapy-row">                    echo $rekamData['anamnesa'] ? nl2br(htmlspecialchars($rekamData['anamnesa'])) : '<em>Tidak ada catatan anamnesa</em>'; 

                            <strong>Deskripsi Tindakan:</strong>                     ?>

                            <span>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi ?? '-' }}</span>                </div>

                        </div>            </div>

                    </div>            

                </div>            <!-- Temuan klinis -->

                @endforeach            <div class="medical-detail-card">

            </div>                <h4>🔍 Temuan Klinis</h4>

            @else                <div class="medical-content">

            <!-- Pesan jika tidak ada tindakan terapi -->                    <?php 

            <div class="no-therapy">                    // Tampilkan temuan klinis atau pesan default jika kosong

                <p><em>Belum ada tindakan terapi yang tercatat untuk rekam medis ini.</em></p>                    echo $rekamData['temuan_klinis'] ? nl2br(htmlspecialchars($rekamData['temuan_klinis'])) : '<em>Tidak ada catatan temuan klinis</em>'; 

            </div>                    ?>

            @endif                </div>

        </div>            </div>

    </div>            

</body>            <!-- Diagnosa -->

</html>            <div class="medical-detail-card">

                <h4>🩺 Diagnosa</h4>
                <div class="medical-content diagnosa">
                    <?php 
                    // Tampilkan diagnosa atau pesan default jika kosong
                    echo $rekamData['diagnosa'] ? nl2br(htmlspecialchars($rekamData['diagnosa'])) : '<em>Tidak ada diagnosa</em>'; 
                    ?>
                </div>
            </div>
        </div>

        <!-- ========== THERAPY ACTIONS SECTION ========== -->
        <div class="therapy-section">
            <h3>💉 Tindakan Terapi yang Dilakukan</h3>
            
            <!-- Summary total tindakan -->
            <div class="therapy-summary">
                <p><strong>Total Tindakan:</strong> <?php echo $totalDetails; ?> tindakan terapi</p>
            </div>
            
            <!-- Daftar tindakan terapi -->
            <?php if (!empty($detailData)): ?>
            <div class="therapy-list">
                <?php foreach ($detailData as $index => $detail): ?>
                <div class="therapy-item">
                    <!-- Header tindakan dengan nomor urut -->
                    <div class="therapy-header">
                        <h4>Tindakan #<?php echo ($index + 1); ?></h4>
                        <span class="therapy-code"><?php echo htmlspecialchars($detail['kode'] ?? '-'); ?></span>
                    </div>
                    
                    <!-- Informasi detail tindakan -->
                    <div class="therapy-info">
                        <!-- Kategori tindakan -->
                        <div class="therapy-row">
                            <strong>Kategori:</strong> 
                            <span><?php echo htmlspecialchars($detail['nama_kategori'] ?? '-'); ?></span>
                        </div>
                        
                        <!-- Kategori klinis -->
                        <div class="therapy-row">
                            <strong>Kategori Klinis:</strong> 
                            <span><?php echo htmlspecialchars($detail['nama_kategori_klinis'] ?? '-'); ?></span>
                        </div>
                        
                        <!-- Deskripsi tindakan -->
                        <div class="therapy-row">
                            <strong>Deskripsi Tindakan:</strong> 
                            <span><?php echo htmlspecialchars($detail['deskripsi_tindakan_terapi'] ?? '-'); ?></span>
                        </div>
                        
                        <!-- Detail pelaksanaan -->
                        <div class="therapy-row">
                            <strong>Detail Pelaksanaan:</strong> 
                            <div class="therapy-detail">
                                <?php 
                                // Tampilkan detail pelaksanaan atau pesan default
                                echo $detail['detail'] ? nl2br(htmlspecialchars($detail['detail'])) : '<em>Tidak ada detail khusus</em>'; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <!-- Pesan jika tidak ada tindakan terapi -->
            <div class="no-therapy">
                <p><em>Belum ada tindakan terapi yang tercatat untuk rekam medis ini.</em></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>