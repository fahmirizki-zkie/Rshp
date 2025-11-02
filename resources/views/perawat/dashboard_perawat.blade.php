<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perawat - RS Hewan UNAIR</title>
    <!-- CSS Styling External -->
    <link rel="stylesheet" href="{{ asset('css/style_dashboard.css') }}">
    <!-- Font Google untuk typography yang konsisten -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- =================================================================== -->
    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->
    <!-- =================================================================== -->
    <div class="nav-content">
        <!-- Logo Universitas Airlangga (kiri) -->
        <div class="logokiri">
            <img src="{{ asset('img/unair.avif') }}" alt="Logo UNAIR">
        </div>
        <!-- Text header utama -->
        <div class="text">
            <h2>Universitas Airlangga |</h2>
        </div>
        <!-- Text header secondary -->
        <div class="text2">
            <h2>Rumah Sakit Hewan Pendidikan</h2>
        </div>
        <!-- Logo Rumah Sakit Hewan (kanan) -->
        <div class="logokanan">
            <img src="{{ asset('img/medical.avif') }}" alt="Logo RSHP">
        </div>
    </div>
    <!-- =================================================================== -->
    <!-- NAVIGATION BAR: Menu utama dan logout -->
    <!-- =================================================================== -->
    <div class="navbar">
        <!-- Brand logo/text -->
        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>
        <!-- Navigation menu -->
        <div class="navbar-nav">
            <a href="{{ route('perawat.dashboard') }}">Home</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
    <!-- =================================================================== -->
    <!-- MAIN CONTENT: Dashboard content container -->
    <!-- =================================================================== -->
    <div class="container" style="max-width:600px; margin:60px auto 0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 32px rgba(38,82,149,0.10); padding:40px 32px; text-align:center;">
        <!-- Welcome section dengan nama user -->
        <h1 style="font-size:2.4rem; font-weight:700; color:#265295; margin-bottom:18px; letter-spacing:1px;">
            Selamat Datang, {{ $user_nama }}!
        </h1>
        <!-- Role information dan deskripsi -->
        <p style="font-size:1.18rem; color:#4eb1cf; margin-bottom:12px; font-weight:500;">
            Anda berhasil login sebagai 
            <span style="color:#265295; font-weight:600;">Perawat RSHP UNAIR</span>.
        </p>
        <!-- Action prompt untuk user -->
        <div style="margin:24px 0;">
            <span style="display:inline-block; background:linear-gradient(90deg,#4eb1cf 0%,#265295 100%); color:#fff; padding:10px 28px; border-radius:12px; font-size:1.08rem; font-weight:600; box-shadow:0 2px 8px rgba(38,82,149,0.10);">
                Kelola Rekam Medis di menu bawah.
            </span>
        </div>
        <!-- =================================================================== -->
        <!-- MENU CARDS: Fitur-fitur utama untuk perawat -->
        <!-- =================================================================== -->
        <div style="display:flex; gap:20px; justify-content:center; margin-top:30px; flex-wrap:wrap;">
            <!-- Menu Card: Rekam Medis -->
            <a href="{{ route('perawat.rekam-medis') }}" 
               style="text-decoration:none; display:block; width:200px; padding:20px; background:linear-gradient(135deg, #4eb1cf 0%, #265295 100%); border-radius:15px; color:white; text-align:center; transition:transform 0.3s ease; box-shadow:0 4px 15px rgba(38,82,149,0.2);">
                <!-- Icon untuk visual appeal -->
                <div style="font-size:2.5rem; margin-bottom:10px;">📋</div>
                <!-- Judul menu -->
                <h3 style="margin:0; font-size:1.1rem; font-weight:600;">Rekam Medis</h3>
                <!-- Deskripsi singkat -->
                <p style="margin:5px 0 0 0; font-size:0.9rem; opacity:0.9;">
                    Kelola rekam medis pasien
                </p>
            </a>
        </div>
    </div>
</body>
</html>
