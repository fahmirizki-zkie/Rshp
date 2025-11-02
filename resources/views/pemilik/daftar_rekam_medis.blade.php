<!DOCTYPE html><?php

<html lang="id">// Import class yang diperlukan

<head>require_once __DIR__ . '/../../class/Pemilik.php';

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// Memulai session untuk tracking user login

    <title>Rekam Medis - RS Hewan UNAIR</title>if (session_status() === PHP_SESSION_NONE) {

        session_start();

    <!-- CSS Styling External -->}

    <link rel="stylesheet" href="{{ asset('css/vm.css') }}">

    // Import semua class yang dibutuhkan

    <!-- Font Google (Inter) untuk typography modern -->require_once __DIR__ . '/../../class/RekamMedis.php';

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">require_once __DIR__ . '/../../connection/DBconnection.php';

    require_once __DIR__ . '/../../logic/pemilik/pemilik_process.php';

    <!-- Font Awesome untuk icons -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">// =================================================================================

</head>// SECTION 1: VALIDASI AUTENTIKASI DAN AUTORISASI

<body>// =================================================================================

    <!-- HEADER SECTION: Navigation dan Logo -->

    <header class="header">/**

        <div class="container"> * Validasi apakah user sudah login

            <!-- Logo dan nama rumah sakit --> * Jika belum login, redirect ke halaman login

            <div class="logo"> */

                <img src="{{ asset('img/medical.avif') }}" alt="RS Hewan UNAIR">if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

                <span>RS Hewan UNAIR</span>    header('Location: ../login.php');

            </div>    exit;

            }

            <!-- Navigation menu untuk pemilik -->

            <nav class="nav-menu">/**

                <a href="{{ route('pemilik.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a> * Validasi role user harus 'pemilik'

                <a href="{{ route('pemilik.daftar-pet') }}"><i class="fas fa-paw"></i> Daftar Pet</a> * Hanya pemilik yang boleh mengakses halaman ini

                <a href="{{ route('pemilik.reservasi') }}"><i class="fas fa-calendar"></i> Reservasi</a> */

                <a href="{{ route('pemilik.rekam-medis') }}" class="active"><i class="fas fa-file-medical"></i> Rekam Medis</a>if (!isset($_SESSION['user']['nama_role']) || strtolower($_SESSION['user']['nama_role']) !== 'pemilik') {

            </nav>    header('Location: ../login.php');

        </div>    exit;

    </header>}



    <!-- MAIN CONTENT: Konten utama halaman rekam medis -->// =================================================================================

    <main class="main-content">// SECTION 2: INISIALISASI DATA USER DAN KONEKSI DATABASE

        <div class="container">// =================================================================================

            <!-- Header halaman dengan judul dan deskripsi -->

            <div class="page-header">/**

                <h1><i class="fas fa-file-medical"></i> Rekam Medis</h1> * Ambil data user dari session

                <p>Riwayat kesehatan dan perawatan hewan peliharaan</p> * Data ini berisi informasi user yang sedang login

            </div> */

$userData = $_SESSION['user'];

            @if($rekamMedisList->isEmpty())

                <!-- Empty state ketika belum ada rekam medis -->/**

                <div class="empty-state"> * Buat koneksi database untuk mengambil data pemilik

                    <i class="fas fa-file-medical-alt"></i> */

                    <h3>Belum Ada Rekam Medis</h3>$dbconn = new DBconnection();

                    <p>Rekam medis akan muncul setelah hewan peliharaan Anda menjalani pemeriksaan.</p>

                </div>// =================================================================================

            @else// SECTION 3: VALIDASI DAN PENGAMBILAN DATA PEMILIK

                <!-- Daftar rekam medis dalam bentuk cards -->// =================================================================================

                <div class="rekam-medis-list">

                    @foreach($rekamMedisList as $rekam)// Ambil ID pemilik berdasarkan user ID

                        <div class="rekam-medis-card">$pemilikObj = new Pemilik();

                            <!-- Header card: informasi hewan dan tanggal pemeriksaan -->$pemilikId = $pemilikObj->getPemilikIdByUserId($userData['id']);

                            <div class="rekam-header">

                                <div class="pet-info">// Validasi data pemilik

                                    <!-- Nama hewan yang diperiksa -->if ($pemilikId === null) {

                                    <h3>{{ $rekam->temuDokter->pet->nama ?? '-' }}</h3>    echo "Data pemilik tidak ditemukan";

                                        exit;

                                    <!-- Informasi jenis dan ras hewan -->}

                                    <span class="pet-type">

                                        {{ $rekam->temuDokter->pet->rasHewan->jenisHewan->nama_jenis ?? '' }} - // =================================================================================

                                        {{ $rekam->temuDokter->pet->rasHewan->nama_ras ?? '' }}// SECTION 4: PENGAMBILAN DATA REKAM MEDIS MENGGUNAKAN HELPER FUNCTION

                                    </span>// =================================================================================

                                </div>

                                /**

                                <!-- Tanggal pemeriksaan --> * Ambil daftar rekam medis lengkap dengan informasi hewan dan dokter

                                <div class="exam-date"> * Data sudah ter-join dengan tabel pet, dokter, jenis hewan, dan ras

                                    <i class="fas fa-calendar"></i> */

                                    {{ \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y') }}$userId = $userData['id'];

                                </div>$rekamMedisList = getRekamMedisList($userId);

                            </div>?>

                            

                            <!-- Content card: detail pemeriksaan --><!DOCTYPE html>

                            <div class="rekam-content"><html lang="id">

                                <!-- Informasi dokter pemeriksa --><head>

                                <div class="detail-section">    <meta charset="UTF-8">

                                    <label><i class="fas fa-user-md"></i> Dokter Pemeriksa:</label>    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                                    <span>{{ $rekam->dokter->nama ?? '-' }}</span>    <title>Rekam Medis - RS Hewan UNAIR</title>

                                </div>    

                                    <!-- CSS Styling External -->

                                <!-- Diagnosa dari dokter -->    <link rel="stylesheet" href="../../css/pemilik/style_daftar_rekam_medis.css">

                                <div class="detail-section">    

                                    <label><i class="fas fa-stethoscope"></i> Diagnosa:</label>    <!-- Font Google (Inter) untuk typography modern -->

                                    <span>    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

                                        @if($rekam->diagnosa)    

                                            {!! nl2br(e($rekam->diagnosa)) !!}    <!-- Font Awesome untuk icons -->

                                        @else    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

                                            -</head>

                                        @endif<body>

                                    </span>    <!-- =================================================================== -->

                                </div>    <!-- HEADER SECTION: Navigation dan Logo -->

                                    <!-- =================================================================== -->

                                <!-- Anamnesa (hanya tampil jika ada data) -->    <header class="header">

                                @if($rekam->anamnesa)        <div class="container">

                                <div class="detail-section">            <!-- Logo dan nama rumah sakit -->

                                    <label><i class="fas fa-pills"></i> Anamnesa:</label>            <div class="logo">

                                    <span>{!! nl2br(e($rekam->anamnesa)) !!}</span>                <img src="../../img/rshpp.png" alt="RS Hewan UNAIR">

                                </div>                <span>RS Hewan UNAIR</span>

                                @endif            </div>

                                            

                                <!-- Temuan klinis (hanya tampil jika ada data) -->            <!-- Navigation menu untuk pemilik -->

                                @if($rekam->temuan_klinis)            <nav class="nav-menu">

                                <div class="detail-section">                <a href="dashboard_pemilik.php"><i class="fas fa-home"></i> Dashboard</a>

                                    <label><i class="fas fa-sticky-note"></i> Temuan Klinis:</label>                <a href="daftar_pet.php"><i class="fas fa-paw"></i> Daftar Pet</a>

                                    <span>{!! nl2br(e($rekam->temuan_klinis)) !!}</span>                <a href="daftar_reservasi.php"><i class="fas fa-calendar"></i> Reservasi</a>

                                </div>                <a href="daftar_rekam_medis.php" class="active"><i class="fas fa-file-medical"></i> Rekam Medis</a>

                                @endif            </nav>

                            </div>        </div>

                        </div>    </header>

                    @endforeach

                </div>    <!-- =================================================================== -->

            @endif    <!-- MAIN CONTENT: Konten utama halaman rekam medis -->

        </div>    <!-- =================================================================== -->

    </main>    <main class="main-content">

</body>        <div class="container">

</html>            <!-- Header halaman dengan judul dan deskripsi -->

            <div class="page-header">
                <h1><i class="fas fa-file-medical"></i> Rekam Medis</h1>
                <p>Riwayat kesehatan dan perawatan hewan peliharaan</p>
            </div>

            <?php 
            /**
             * Kondisional display berdasarkan ada tidaknya data rekam medis
             * Jika tidak ada rekam medis, tampilkan empty state
             * Jika ada rekam medis, tampilkan dalam bentuk card list
             */
            ?>
            <?php if (empty($rekamMedisList)): ?>
                <!-- Empty state ketika belum ada rekam medis -->
                <div class="empty-state">
                    <i class="fas fa-file-medical-alt"></i>
                    <h3>Belum Ada Rekam Medis</h3>
                    <p>Rekam medis akan muncul setelah hewan peliharaan Anda menjalani pemeriksaan.</p>
                </div>
            <?php else: ?>
                <!-- Daftar rekam medis dalam bentuk cards -->
                <div class="rekam-medis-list">
                    <?php 
                    /**
                     * Loop untuk menampilkan setiap rekam medis
                     * Setiap rekam medis ditampilkan dalam bentuk card dengan informasi lengkap
                     */
                    foreach ($rekamMedisList as $rekam): 
                    ?>
                        <div class="rekam-medis-card">
                            <!-- Header card: informasi hewan dan tanggal pemeriksaan -->
                            <div class="rekam-header">
                                <div class="pet-info">
                                    <!-- Nama hewan yang diperiksa -->
                                    <h3><?php echo htmlspecialchars($rekam['nama_pet']); ?></h3>
                                    
                                    <!-- Informasi jenis dan ras hewan -->
                                    <span class="pet-type">
                                        <?php echo htmlspecialchars($rekam['nama_jenis_hewan'] ?? ''); ?> - 
                                        <?php echo htmlspecialchars($rekam['nama_ras'] ?? ''); ?>
                                    </span>
                                </div>
                                
                                <!-- Tanggal pemeriksaan -->
                                <div class="exam-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php 
                                    /**
                                     * Format tanggal dari database (YYYY-MM-DD) ke format Indonesia (dd/mm/yyyy)
                                     * Menggunakan fungsi date() dan strtotime() untuk konversi
                                     */
                                    echo date('d/m/Y', strtotime($rekam['created_at'])); 
                                    ?>
                                </div>
                            </div>
                            
                            <!-- Content card: detail pemeriksaan -->
                            <div class="rekam-content">
                                <!-- Informasi dokter pemeriksa -->
                                <div class="detail-section">
                                    <label><i class="fas fa-user-md"></i> Dokter Pemeriksa:</label>
                                    <span><?php echo htmlspecialchars($rekam['nama_dokter'] ?? '-'); ?></span>
                                </div>
                                
                                <!-- Diagnosa dari dokter -->
                                <div class="detail-section">
                                    <label><i class="fas fa-stethoscope"></i> Diagnosa:</label>
                                    <span>
                                        <?php 
                                        /**
                                         * Tampilkan diagnosa dengan nl2br untuk convert newline ke <br>
                                         * htmlspecialchars untuk mencegah XSS attack
                                         */
                                        echo nl2br(htmlspecialchars($rekam['diagnosa'] ?? '-')); 
                                        ?>
                                    </span>
                                </div>
                                
                                <?php 
                                /**
                                 * Tampilkan anamnesa hanya jika ada data
                                 * Anamnesa adalah riwayat penyakit yang diceritakan pemilik
                                 */
                                if ($rekam['anamnesa']): 
                                ?>
                                <div class="detail-section">
                                    <label><i class="fas fa-pills"></i> Anamnesa:</label>
                                    <span><?php echo nl2br(htmlspecialchars($rekam['anamnesa'])); ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <?php 
                                /**
                                 * Tampilkan temuan klinis hanya jika ada data
                                 * Temuan klinis adalah hasil pemeriksaan fisik oleh dokter
                                 */
                                if ($rekam['temuan_klinis']): 
                                ?>
                                <div class="detail-section">
                                    <label><i class="fas fa-sticky-note"></i> Temuan Klinis:</label>
                                    <span><?php echo nl2br(htmlspecialchars($rekam['temuan_klinis'])); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- =================================================================== -->
    <!-- FOOTER: Penutup halaman -->
    <!-- =================================================================== -->
</body>
</html>