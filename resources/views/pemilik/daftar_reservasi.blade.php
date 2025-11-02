<!DOCTYPE html><?php

<html lang="id">// Import class yang diperlukan

<head>require_once __DIR__ . '/../../class/Pemilik.php';

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// Memulai session untuk tracking user login

    <title>Daftar Reservasi - RS Hewan UNAIR</title>if (session_status() === PHP_SESSION_NONE) {

        session_start();

    <!-- CSS Styling External -->}

    <link rel="stylesheet" href="{{ asset('css/vm.css') }}">

    // Import semua class yang dibutuhkan

    <!-- Font Google (Inter) untuk typography modern -->require_once __DIR__ . '/../../class/TemuDokter.php';

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">require_once __DIR__ . '/../../connection/DBconnection.php';

    require_once __DIR__ . '/../../logic/pemilik/pemilik_process.php';

    <!-- Font Awesome untuk icons -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">// SECTION 1: VALIDASI AUTENTIKASI DAN AUTORISASI

</head>

<body>

    <!-- HEADER SECTION: Navigation dan Logo -->//Validasi apakah user sudah login

    <header class="header">// Jika belum login, redirect ke halaman login

        <div class="container">

            <!-- Logo dan nama rumah sakit -->if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

            <div class="logo">    header('Location: ../login.php');

                <img src="{{ asset('img/medical.avif') }}" alt="RS Hewan UNAIR">    exit;

                <span>RS Hewan UNAIR</span>}

            </div>

            /**

            <!-- Navigation menu untuk pemilik --> * Validasi role user harus 'pemilik'

            <nav class="nav-menu"> * Hanya pemilik yang boleh mengakses halaman ini

                <a href="{{ route('pemilik.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a> */

                <a href="{{ route('pemilik.daftar-pet') }}"><i class="fas fa-paw"></i> Daftar Pet</a>if (!isset($_SESSION['user']['nama_role']) || strtolower($_SESSION['user']['nama_role']) !== 'pemilik') {

                <a href="{{ route('pemilik.reservasi') }}" class="active"><i class="fas fa-calendar"></i> Reservasi</a>    header('Location: ../login.php');

                <a href="{{ route('pemilik.rekam-medis') }}"><i class="fas fa-file-medical"></i> Rekam Medis</a>    exit;

            </nav>}

        </div>

    </header>// =================================================================================

// SECTION 2: INISIALISASI DATA USER DAN KONEKSI DATABASE

    <!-- MAIN CONTENT: Konten utama halaman reservasi -->// =================================================================================

    <main class="main-content">

        <div class="container">/**

            <!-- Header halaman dengan judul dan deskripsi --> * Ambil data user dari session

            <div class="page-header"> * Data ini berisi informasi user yang sedang login

                <h1><i class="fas fa-calendar"></i> Daftar Reservasi</h1> */

                <p>Riwayat jadwal konsultasi dan pemeriksaan</p>$userData = $_SESSION['user'];

            </div>

//Buat koneksi database untuk mengambil data pemilik

            @if($reservations->isEmpty()) 

                <!-- Empty state ketika belum ada reservasi -->$dbconn = new DBconnection();

                <div class="empty-state">

                    <i class="fas fa-calendar-alt"></i>

                    <h3>Belum Ada Reservasi</h3>// SECTION 3: VALIDASI DAN PENGAMBILAN DATA PEMILIK

                    <p>Anda belum memiliki riwayat reservasi konsultasi atau pemeriksaan.</p>

                </div>

            @else// Ambil ID pemilik berdasarkan user ID

                <!-- Daftar reservasi dalam bentuk cards -->$pemilikObj = new Pemilik();

                <div class="reservations-list">$pemilikId = $pemilikObj->getPemilikIdByUserId($userData['id']);

                    @foreach($reservations as $reservasi)

                        <div class="reservation-card">// Validasi data pemilik

                            <!-- Header card: informasi hewan dan status reservasi -->if ($pemilikId === null) {

                            <div class="reservation-header">    echo "Data pemilik tidak ditemukan";

                                <div class="pet-info">    exit;

                                    <!-- Nama hewan yang direservasi -->}

                                    <h3>{{ $reservasi->pet->nama }}</h3>

                                    

                                    <!-- Informasi jenis dan ras hewan -->// SECTION 4: PENGAMBILAN DATA RESERVASI MENGGUNAKAN HELPER FUNCTION

                                    <span class="pet-type">

                                        {{ $reservasi->pet->rasHewan->jenisHewan->nama_jenis ?? '' }} - 

                                        {{ $reservasi->pet->rasHewan->nama_ras ?? '' }}//Ambil daftar reservasi lengkap dengan informasi hewan dan dokter

                                    </span>//Data sudah ter-join dengan tabel pet, dokter, jenis hewan, dan ras

                                </div> 

                                $userId = $userData['id'];

                                <!-- Status badge dengan color coding -->$reservations = getReservasiList($userId);

                                <span class="status-badge status-{{ strtolower($reservasi->status) }}">?>

                                    @switch($reservasi->status)

                                        @case('A')<!DOCTYPE html>

                                            Antri<html lang="id">

                                            @break<head>

                                        @case('D')    <meta charset="UTF-8">

                                            Dipanggil    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                                            @break    <title>Daftar Reservasi - RS Hewan UNAIR</title>

                                        @case('S')    

                                            Selesai    <!-- CSS Styling External -->

                                            @break    <link rel="stylesheet" href="../../css/pemilik/style_daftar_reservasi.css">

                                        @default    

                                            {{ $reservasi->status }}    <!-- Font Google (Inter) untuk typography modern -->

                                    @endswitch    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

                                </span>    

                            </div>    <!-- Font Awesome untuk icons -->

                                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

                            <!-- Detail reservasi --></head>

                            <div class="reservation-details"><body>

                                <!-- Tanggal dan waktu reservasi -->

                                <div class="detail-row">    <!-- HEADER SECTION: Navigation dan Logo -->

                                    <label><i class="fas fa-calendar"></i> Tanggal & Waktu:</label>

                                    <span>    <header class="header">

                                        @if($reservasi->waktu_daftar)        <div class="container">

                                            {{ \Carbon\Carbon::parse($reservasi->waktu_daftar)->format('d/m/Y H:i') }}            <!-- Logo dan nama rumah sakit -->

                                        @else            <div class="logo">

                                            -                <img src="../../img/rshpp.png" alt="RS Hewan UNAIR">

                                        @endif                <span>RS Hewan UNAIR</span>

                                    </span>            </div>

                                </div>            

                                            <!-- Navigation menu untuk pemilik -->

                                <!-- Dokter yang menangani -->            <nav class="nav-menu">

                                <div class="detail-row">                <a href="dashboard_pemilik.php"><i class="fas fa-home"></i> Dashboard</a>

                                    <label><i class="fas fa-user-md"></i> Dokter:</label>                <a href="daftar_pet.php"><i class="fas fa-paw"></i> Daftar Pet</a>

                                    <span>{{ $reservasi->roleUser->user->nama ?? 'Belum ditentukan' }}</span>                <a href="daftar_reservasi.php" class="active"><i class="fas fa-calendar"></i> Reservasi</a>

                                </div>                <a href="daftar_rekam_medis.php"><i class="fas fa-file-medical"></i> Rekam Medis</a>

                                            </nav>

                                <!-- Jenis kelamin hewan -->        </div>

                                <div class="detail-row">    </header>

                                    <label><i class="fas fa-venus-mars"></i> Jenis Kelamin:</label>

                                    <span>{{ $reservasi->pet->jenis_kelamin === 'J' ? 'Jantan' : 'Betina' }}</span>    <!-- MAIN CONTENT: Konten utama halaman reservasi -->

                                </div>

                                    <main class="main-content">

                                <!-- Nomor urut antrian -->        <div class="container">

                                <div class="detail-row">            <!-- Header halaman dengan judul dan deskripsi -->

                                    <label><i class="fas fa-list-ol"></i> No. Urut:</label>            <div class="page-header">

                                    <span>{{ $reservasi->no_urut ?? '-' }}</span>                <h1><i class="fas fa-calendar"></i> Daftar Reservasi</h1>

                                </div>                <p>Riwayat jadwal konsultasi dan pemeriksaan</p>

                            </div>            </div>

                        </div>

                    @endforeach            <?php 

                </div>            // Kondisional display berdasarkan ada tidaknya data reservasi

            @endif

        </div>            ?>

    </main>                <?php if (empty($reservations)): ?>

</body>                <!-- Empty state ketika belum ada reservasi -->

</html>                <div class="empty-state">

                    <i class="fas fa-calendar-alt"></i>
                    <h3>Belum Ada Reservasi</h3>
                    <p>Anda belum memiliki riwayat reservasi konsultasi atau pemeriksaan.</p>
                </div>
            <?php else: ?>
                <!-- Daftar reservasi dalam bentuk cards -->
                <div class="reservations-list">
                    <?php 
                    //Loop untuk menampilkan setiap reservasi
                    

                    foreach ($reservations as $reservasi): 
                    ?>
                        <div class="reservation-card">
                            <!-- Header card: informasi hewan dan status reservasi -->
                            <div class="reservation-header">
                                <div class="pet-info">
                                    <!-- Nama hewan yang direservasi -->
                                    <h3><?php echo htmlspecialchars($reservasi['nama_pet']); ?></h3>
                                    
                                    <!-- Informasi jenis dan ras hewan -->
                                    <span class="pet-type">
                                        <?php echo htmlspecialchars($reservasi['nama_jenis_hewan'] ?? ''); ?> - 
                                        <?php echo htmlspecialchars($reservasi['nama_ras'] ?? ''); ?>
                                    </span>
                                </div>
                                
                                <!-- Status badge dengan color coding -->
                                <span class="status-badge status-<?php echo strtolower($reservasi['status']); ?>">
                                    <?php 
                                    //Konversi kode status ke teks yang user-friendly
                                    //A = Antri (menunggu dipanggil)
                                    //D = Dipanggil (sedang dalam pemeriksaan)
                                    //S = Selesai (pemeriksaan selesai)
                                     
                                    $statusText = '';
                                    switch($reservasi['status']) {
                                        case 'A': $statusText = 'Antri'; break;
                                        case 'D': $statusText = 'Dipanggil'; break;
                                        case 'S': $statusText = 'Selesai'; break;
                                        default: $statusText = $reservasi['status'];
                                    }
                                    echo $statusText;
                                    ?>
                                </span>
                            </div>
                            
                            <!-- Detail reservasi -->
                            <div class="reservation-details">
                                <!-- Tanggal dan waktu reservasi -->
                                <div class="detail-row">
                                    <label><i class="fas fa-calendar"></i> Tanggal & Waktu:</label>
                                    <span>
                                        <?php 
                                        /**
                                         * Format tanggal dan waktu dari database ke format Indonesia
                                         * Format: dd/mm/yyyy HH:mm
                                         */
                                        if ($reservasi['waktu_daftar']) {
                                            echo date('d/m/Y H:i', strtotime($reservasi['waktu_daftar']));
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </span>
                                </div>
                                
                                <!-- Dokter yang menangani -->
                                <div class="detail-row">
                                    <label><i class="fas fa-user-md"></i> Dokter:</label>
                                    <span><?php echo htmlspecialchars($reservasi['nama_dokter'] ?? 'Belum ditentukan'); ?></span>
                                </div>
                                
                                <!-- Jenis kelamin hewan -->
                                <div class="detail-row">
                                    <label><i class="fas fa-venus-mars"></i> Jenis Kelamin:</label>
                                    <span>
                                        <?php 
                                        /**
                                         * Konversi kode jenis kelamin ke teks
                                         * J = Jantan, B = Betina
                                         */
                                        echo $reservasi['jenis_kelamin'] === 'J' ? 'Jantan' : 'Betina'; 
                                        ?>
                                    </span>
                                </div>
                                
                                <!-- Nomor urut antrian -->
                                <div class="detail-row">
                                    <label><i class="fas fa-list-ol"></i> No. Urut:</label>
                                    <span><?php echo htmlspecialchars($reservasi['no_urut'] ?? '-'); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>    
</body>
</html>