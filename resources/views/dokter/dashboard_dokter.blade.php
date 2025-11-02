<!DOCTYPE html>

<html lang="id">// Mulai session untuk mengelola login user

<head>session_start();

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">// Cek apakah user sudah login atau belum

    <title>Dashboard Dokter - RSHP UNAIR</title>if (!isset($_SESSION['user'])) {

        // Jika belum login, redirect ke halaman login

    <!-- CSS STYLESHEETS -->    header('Location: login.php');

    <link rel="stylesheet" href="{{ asset('css/dokter/style_dashboard_dokter.css') }}">    exit;

</head>}

<body>

    <!-- HEADER -->// ========== DATA USER PROCESSING ==========

    <div class="nav-content">// Ambil data user dari session dengan validasi keamanan

        <div class="logokiri">$user = $_SESSION['user'];

            <img src="{{ asset('img/unair.avif') }}" alt="Logo UNAIR">

        </div>// Ambil nama user dengan aman, jika tidak ada gunakan default 'Pengguna'

        <div class="text">$user_nama = isset($user['nama']) ? htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') : 'Pengguna';

            <h2>Universitas Airlangga |</h2>

        </div>// Ambil role aktif user (untuk pengembangan future features)

        <div class="text2">$role_aktif = isset($user['role_aktif']) ? $user['role_aktif'] : null;

            <h2>Rumah Sakit Hewan Pendidikan</h2>?>

        </div><!DOCTYPE html>

        <div class="logokanan"><html lang="id">

            <img src="{{ asset('img/medical.avif') }}" alt="Logo RSHP"><head>

        </div>    <meta charset="UTF-8">

    </div>    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Dokter - RSHP UNAIR</title>

    <!-- NAVIGATION BAR -->    

    <div class="navbar">    <!-- ========== CSS STYLESHEETS ========== -->

        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>    <!-- Menggunakan shared CSS untuk konsistensi design -->

        <div class="navbar-nav">    <link rel="stylesheet" href="../../css/shared/style_dashboard.css">

            <a href="{{ route('dokter.dashboard') }}">Home</a>    

            <a href="{{ route('logout') }}">Logout</a>    <!-- CSS khusus untuk dashboard dokter -->

        </div>    <link rel="stylesheet" href="../../css/dokter/style_dashboard_dokter.css">

    </div></head>

<body>

    <!-- MAIN DASHBOARD CONTENT -->    <!-- ========== HEADER NAVIGATION SECTION ========== -->

    <div class="dashboard-container" style="max-width:600px; margin:60px auto 0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 32px rgba(38,82,149,0.10); padding:40px 32px; text-align:center;">    <!-- Logo Start -->

        <!-- WELCOME SECTION -->    <div class="nav-content">

        <h1 style="font-size:2.4rem; font-weight:700; color:#265295; margin-bottom:18px;">        <!-- Logo Universitas Airlangga (kiri) -->

            Selamat Datang, Dr. {{ $user_nama }}!        <div class="logokiri">

        </h1>            <img src="../../img/unairr.png" alt="Logo UNAIR">

        </div>

        <!-- ROLE INFO -->

        <p style="font-size:1.18rem; color:#4eb1cf; margin-bottom:12px; font-weight:500;">        <!-- Text header utama -->

            Anda berhasil login sebagai         <div class="text">

            <span style="color:#265295; font-weight:600;">Dokter RSHP UNAIR</span>.            <h2>Universitas Airlangga |</h2>

        </p>        </div>



        <!-- INFO BADGE -->        <!-- Text header sekunder -->

        <div style="margin:24px 0;">        <div class="text2">

            <span style="display:inline-block; background:linear-gradient(90deg,#4eb1cf 0%,#265295 100%); color:#fff; padding:10px 28px; border-radius:12px; font-size:1.08rem; font-weight:600;">            <h2>Rumah Sakit Hewan Pendidikan</h2>

                Akses Rekam Medis di menu bawah.        </div>

            </span>

        </div>        <!-- Logo RSHP (kanan) -->

                <div class="logokanan">

        <!-- DOCTOR MENU -->            <img src="../../img/rshpp.png" alt="Logo RSHP">

        <div style="display:flex; gap:20px; justify-content:center; margin-top:30px; flex-wrap:wrap;">        </div>

            <!-- Menu Card: Rekam Medis -->    </div>

            <a href="{{ route('dokter.rekam-medis') }}"     <!-- Logo End -->

               style="text-decoration:none; display:block; width:200px; padding:20px; background:linear-gradient(135deg, #4eb1cf 0%, #265295 100%); border-radius:15px; color:white; text-align:center; transition:transform 0.3s ease; box-shadow:0 4px 15px rgba(38,82,149,0.2);">

                <div style="font-size:2.5rem; margin-bottom:10px;">📋</div>    <!-- ========== MAIN NAVIGATION BAR ========== -->

                <h3 style="margin:0; font-size:1.1rem; font-weight:600;">Rekam Medis</h3>    <!-- navbar start -->

                <p style="margin:5px 0 0 0; font-size:0.9rem; opacity:0.9;">    <div class="navbar">

                    Lihat rekam medis pasien        <!-- Brand logo/text -->

                </p>        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>

            </a>

        </div>        <!-- Navigation menu items -->

    </div>        <div class="navbar-nav">

</body>            <!-- Menu Home - mengarah ke dashboard dokter -->

</html>            <a href="dashboard_dokter.php">Home</a>

            
            <!-- Menu Logout - keluar dari sistem -->
            <a href="../../logic/login.php?action=logout">Logout</a>
        </div>
    </div>
    <!-- navbar end -->

    <!-- ========== MAIN DASHBOARD CONTENT ========== -->
    <div class="dashboard-container">
        <!-- ========== WELCOME SECTION ========== -->
        <!-- Judul utama dengan greeting personal -->
        <h1 class="dashboard-welcome">
            Selamat Datang, Dr. <?php echo $user_nama; ?>!
        </h1>

        <!-- Informasi role dan status login -->
        <p class="dashboard-user-info">
            Anda berhasil login sebagai 
            <span class="role-highlight">Dokter RSHP UNAIR</span>.
        </p>

        <!-- Informational message untuk user -->
        <div class="dashboard-info-badge">
            <span class="info-text">
                Akses Rekam Medis di menu bawah.
            </span>
        </div>
        
        <!-- ========== DOCTOR MENU SECTION ========== -->
        <!-- Container untuk menu cards dokter -->
        <div class="doctor-menu-container">
            <!-- Card Menu: Rekam Medis -->
            <a href="rekam_medis_dokter.php" class="doctor-menu-card">
                <!-- Icon untuk rekam medis -->
                <div class="card-icon">📋</div>
                
                <!-- Title menu -->
                <h3 class="card-title">Rekam Medis</h3>
                
                <!-- Description menu -->
                <p class="card-description">Lihat rekam medis pasien</p>
            </a>
        </div>
    </div>
</body>
</html>