<!DOCTYPE html><?php

<html lang="id">// Mulai session untuk mengelola login user

<head>session_start();

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// Cek apakah user sudah login atau belum

    <title>Rekam Medis - Dokter RSHP UNAIR</title>if (!isset($_SESSION['user'])) {

        // Jika belum login, redirect ke halaman login

    <!-- CSS STYLESHEETS -->    header('Location: login.php');

    <link rel="stylesheet" href="{{ asset('css/st.css') }}">    exit;

</head>}

<body>

    <!-- HEADER NAVIGATION SECTION -->// ========== DEPENDENCIES & CLASS INCLUDES ==========

    <div class="nav-content">// Include class yang diperlukan untuk operasi database

        <div class="logokiri">require_once __DIR__ .'/../../class/RekamMedis.php';

            <img src="{{ asset('img/unair.avif') }}" alt="Logo UNAIR">require_once __DIR__ .'/../../class/DetailRekamMedis.php';

        </div>

        <div class="text">// ========== DATA USER PROCESSING ==========

            <h2>Universitas Airlangga |</h2>// Ambil data user dari session dengan validasi keamanan

        </div>$user = $_SESSION['user'];

        <div class="text2">

            <h2>Rumah Sakit Hewan Pendidikan</h2>// Ambil nama user dengan aman, jika tidak ada gunakan default 'Pengguna'

        </div>$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

        <div class="logokanan">

            <img src="{{ asset('img/medical.avif') }}" alt="Logo RSHP">// ========== DATABASE OPERATIONS ==========

        </div>// Inisialisasi objek untuk mengambil data rekam medis

    </div>$rekamMedis = new RekamMedis();



    <!-- MAIN NAVIGATION BAR -->// Ambil semua data rekam medis dengan data yang ter-join

    <div class="navbar">$dataRekamMedis = $rekamMedis->getAllJoined();

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

        <div class="navbar-nav">// ========== FILTER PROCESSING ==========

            <a href="{{ route('dokter.dashboard') }}">Back</a>// Ambil parameter filter dari URL (GET request)

            <a href="{{ route('logout') }}">Logout</a>$filter_date = isset($_GET['date']) ? $_GET['date'] : '';

        </div>$filter_pet = isset($_GET['pet']) ? $_GET['pet'] : '';

    </div>

// Proses filtering jika ada parameter filter

    <!-- MAIN CONTENT CONTAINER -->if ($filter_date || $filter_pet) {

    <div class="container">    $filteredData = [];

        <!-- PAGE HEADER -->    

        <h1>📋 Rekam Medis Pasien</h1>    // Loop through setiap rekam medis untuk filtering

            foreach ($dataRekamMedis as $rekam) {

        <!-- MEDICAL RECORDS LIST SECTION -->        $includeRecord = true;

        <div class="section">        

            <h2>Daftar Rekam Medis</h2>        // Filter berdasarkan tanggal jika ada

                    if ($filter_date && !empty($filter_date)) {

            <!-- Tampilkan daftar rekam medis jika ada data -->            $recordDate = date('Y-m-d', strtotime($rekam['created_at']));

            @if($dataRekamMedis->isNotEmpty())            if ($recordDate !== $filter_date) {

            <div class="records-grid">                $includeRecord = false;

                @foreach($dataRekamMedis as $rekam)            }

                <!-- Card untuk setiap rekam medis -->        }

                <div class="record-card">        

                    <!-- Header card dengan ID dan tanggal -->        // Filter berdasarkan nama pet jika ada

                    <div class="record-header">        if ($filter_pet && !empty($filter_pet)) {

                        <h3>Rekam Medis #{{ $rekam->idrekam_medis }}</h3>            if (stripos($rekam['nama_pet'], $filter_pet) === false) {

                        <span class="record-date">{{ \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y H:i') }}</span>                $includeRecord = false;

                    </div>            }

                            }

                    <!-- Informasi dasar pasien -->        

                    <div class="record-info">        // Tambahkan ke hasil filter jika memenuhi kriteria

                        <!-- Nama pet -->        if ($includeRecord) {

                        <div class="info-row">            $filteredData[] = $rekam;

                            <span class="label">Pet:</span>        }

                            <span class="value">{{ $rekam->temuDokter->pet->nama ?? '-' }}</span>    }

                        </div>    

                            // Update data dengan hasil filter

                        <!-- Nama pemilik -->    $dataRekamMedis = $filteredData;

                        <div class="info-row">}

                            <span class="label">Pemilik:</span>?>

                            <span class="value">{{ $rekam->temuDokter->pet->pemilik->user->nama ?? '-' }}</span><!DOCTYPE html>

                        </div><html lang="id">

                        <head>

                        <!-- Dokter pemeriksa -->    <meta charset="UTF-8">

                        <div class="info-row">    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                            <span class="label">Dokter:</span>    <title>Rekam Medis - Dokter RSHP UNAIR</title>

                            <span class="value">{{ $rekam->dokter->nama ?? '-' }}</span>    

                        </div>    <!-- ========== CSS STYLESHEETS ========== -->

                            <!-- Menggunakan shared CSS untuk rekam medis -->

                        <!-- Nomor urut antrian -->    <link rel="stylesheet" href="../../css/shared/style_rekam_medis.css">

                        <div class="info-row"></head>

                            <span class="label">No. Urut:</span><body>

                            <span class="value">{{ $rekam->temuDokter->no_urut ?? '-' }}</span>    <!-- ========== HEADER NAVIGATION SECTION ========== -->

                        </div>    <!-- Logo Start -->

                    </div>    <div class="nav-content">

                            <!-- Logo Universitas Airlangga (kiri) -->

                    <!-- Preview diagnosa dan anamnesa -->        <div class="logokiri">

                    <div class="record-preview">            <img src="../../img/unairr.png" alt="Logo UNAIR">

                        <!-- Preview diagnosa -->        </div>

                        <div class="preview-section">

                            <strong>Diagnosa:</strong>        <!-- Text header utama -->

                            <p>{{ $rekam->diagnosa ? Str::limit($rekam->diagnosa, 100) : '-' }}</p>        <div class="text">

                        </div>            <h2>Universitas Airlangga |</h2>

                                </div>

                        <!-- Preview anamnesa -->

                        <div class="preview-section">        <!-- Text header sekunder -->

                            <strong>Anamnesa:</strong>        <div class="text2">

                            <p>{{ $rekam->anamnesa ? Str::limit($rekam->anamnesa, 100) : '-' }}</p>            <h2>Rumah Sakit Hewan Pendidikan</h2>

                        </div>        </div>

                    </div>

                            <!-- Logo RSHP (kanan) -->

                    <!-- Tombol aksi untuk melihat detail -->        <div class="logokanan">

                    <div class="record-actions">            <img src="../../img/rshpp.png" alt="Logo RSHP">

                        <a href="{{ route('dokter.detail-rekam-medis', $rekam->idrekam_medis) }}" class="btn btn-primary">Lihat Detail</a>        </div>

                    </div>    </div>

                </div>    <!-- Logo End -->

                @endforeach

            </div>    <!-- ========== MAIN NAVIGATION BAR ========== -->

                <!-- navbar start -->

            <!-- STATISTICS SECTION -->    <div class="navbar">

            <div class="statistics">        <!-- Brand logo/text -->

                <!-- Total rekam medis -->        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

                <div class="stat-card">

                    <h4>Total Rekam Medis</h4>        <!-- Navigation menu items -->

                    <p class="stat-number">{{ $dataRekamMedis->count() }}</p>        <div class="navbar-nav">

                </div>            <!-- Menu Back - kembali ke dashboard dokter -->

                            <a href="dashboard_dokter.php">Back</a>

                <!-- Rekam medis hari ini -->            

                <div class="stat-card">            <!-- Menu Logout - keluar dari sistem -->

                    <h4>Hari Ini</h4>            <a href="../../logic/login.php?action=logout">Logout</a>

                    <p class="stat-number">        </div>

                        {{ $dataRekamMedis->filter(function($rekam) {    </div>

                            return \Carbon\Carbon::parse($rekam->created_at)->isToday();    <!-- navbar end -->

                        })->count() }}

                    </p>    <!-- ========== MAIN CONTENT CONTAINER ========== -->

                </div>    <div class="container">

                        <!-- ========== PAGE HEADER ========== -->

                <!-- Rekam medis minggu ini -->        <h1>📋 Rekam Medis Pasien</h1>

                <div class="stat-card">        

                    <h4>Minggu Ini</h4>        <!-- ========== FILTER SECTION ========== -->

                    <p class="stat-number">        <div class="filter-section">

                        {{ $dataRekamMedis->filter(function($rekam) {            <h3>Filter Rekam Medis</h3>

                            return \Carbon\Carbon::parse($rekam->created_at)->isCurrentWeek();            <form method="GET" class="filter-form">

                        })->count() }}                <div class="filter-row">

                    </p>                    <!-- Filter berdasarkan tanggal -->

                </div>                    <div class="filter-group">

            </div>                        <label for="date">Tanggal:</label>

                                    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($filter_date); ?>">

            @else                    </div>

            <!-- Pesan jika tidak ada data rekam medis -->                    

            <div class="no-data">                    <!-- Filter berdasarkan nama pet -->

                <p>Tidak ada rekam medis ditemukan.</p>                    <div class="filter-group">

            </div>                        <label for="pet">Nama Pet:</label>

            @endif                        <input type="text" name="pet" id="pet" placeholder="Masukkan nama pet..." value="<?php echo htmlspecialchars($filter_pet); ?>">

        </div>                    </div>

    </div>                    

</body>                    <!-- Tombol aksi filter -->

</html>                    <div class="filter-actions">

                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="rekam_medis_dokter.php" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- ========== MEDICAL RECORDS LIST SECTION ========== -->
        <div class="section">
            <h2>Daftar Rekam Medis</h2>
            
            <!-- Tampilkan daftar rekam medis jika ada data -->
            <?php if (!empty($dataRekamMedis)): ?>
            <div class="records-grid">
                <?php foreach ($dataRekamMedis as $rekam): ?>
                <!-- Card untuk setiap rekam medis -->
                <div class="record-card">
                    <!-- Header card dengan ID dan tanggal -->
                    <div class="record-header">
                        <h3>Rekam Medis #<?php echo $rekam['idrekam_medis']; ?></h3>
                        <span class="record-date"><?php echo date('d/m/Y H:i', strtotime($rekam['created_at'])); ?></span>
                    </div>
                    
                    <!-- Informasi dasar pasien -->
                    <div class="record-info">
                        <!-- Nama pet -->
                        <div class="info-row">
                            <span class="label">Pet:</span>
                            <span class="value"><?php echo htmlspecialchars($rekam['nama_pet'] ?? '-'); ?></span>
                        </div>
                        
                        <!-- Nama pemilik -->
                        <div class="info-row">
                            <span class="label">Pemilik:</span>
                            <span class="value"><?php echo htmlspecialchars($rekam['nama_pemilik'] ?? '-'); ?></span>
                        </div>
                        
                        <!-- Dokter pemeriksa -->
                        <div class="info-row">
                            <span class="label">Dokter:</span>
                            <span class="value"><?php echo htmlspecialchars($rekam['nama_dokter'] ?? '-'); ?></span>
                        </div>
                        
                        <!-- Nomor urut antrian -->
                        <div class="info-row">
                            <span class="label">No. Urut:</span>
                            <span class="value"><?php echo htmlspecialchars($rekam['no_urut'] ?? '-'); ?></span>
                        </div>
                    </div>
                    
                    <!-- Preview diagnosa dan anamnesa -->
                    <div class="record-preview">
                        <!-- Preview diagnosa -->
                        <div class="preview-section">
                            <strong>Diagnosa:</strong>
                            <p><?php 
                            // Tampilkan diagnosa dengan batasan karakter untuk preview
                            echo htmlspecialchars($rekam['diagnosa'] ? (strlen($rekam['diagnosa']) > 100 ? substr($rekam['diagnosa'], 0, 100) . '...' : $rekam['diagnosa']) : '-'); 
                            ?></p>
                        </div>
                        
                        <!-- Preview anamnesa -->
                        <div class="preview-section">
                            <strong>Anamnesa:</strong>
                            <p><?php 
                            // Tampilkan anamnesa dengan batasan karakter untuk preview
                            echo htmlspecialchars($rekam['anamnesa'] ? (strlen($rekam['anamnesa']) > 100 ? substr($rekam['anamnesa'], 0, 100) . '...' : $rekam['anamnesa']) : '-'); 
                            ?></p>
                        </div>
                    </div>
                    
                    <!-- Tombol aksi untuk melihat detail -->
                    <div class="record-actions">
                        <a href="detail_rekam_medis_dokter.php?id=<?php echo $rekam['idrekam_medis']; ?>" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- ========== STATISTICS SECTION ========== -->
            <div class="statistics">
                <!-- Total rekam medis -->
                <div class="stat-card">
                    <h4>Total Rekam Medis</h4>
                    <p class="stat-number"><?php echo count($dataRekamMedis); ?></p>
                </div>
                
                <!-- Rekam medis hari ini -->
                <div class="stat-card">
                    <h4>Hari Ini</h4>
                    <p class="stat-number">
                        <?php
                        $today = date('Y-m-d');
                        $todayCount = 0;
                        
                        // Hitung rekam medis yang dibuat hari ini
                        foreach ($dataRekamMedis as $rekam) {
                            if (date('Y-m-d', strtotime($rekam['created_at'])) === $today) {
                                $todayCount++;
                            }
                        }
                        echo $todayCount;
                        ?>
                    </p>
                </div>
                
                <!-- Rekam medis minggu ini -->
                <div class="stat-card">
                    <h4>Minggu Ini</h4>
                    <p class="stat-number">
                        <?php
                        $weekStart = date('Y-m-d', strtotime('monday this week'));
                        $weekCount = 0;
                        
                        // Hitung rekam medis yang dibuat minggu ini
                        foreach ($dataRekamMedis as $rekam) {
                            if (date('Y-m-d', strtotime($rekam['created_at'])) >= $weekStart) {
                                $weekCount++;
                            }
                        }
                        echo $weekCount;
                        ?>
                    </p>
                </div>
            </div>
            
            <?php else: ?>
            <!-- Pesan jika tidak ada data rekam medis -->
            <div class="no-data">
                <p>Tidak ada rekam medis ditemukan.</p>
                <?php if ($filter_date || $filter_pet): ?>
                    <a href="rekam_medis_dokter.php" class="btn btn-primary">Lihat Semua</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>