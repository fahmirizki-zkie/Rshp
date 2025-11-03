<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - RSHP UNAIR</title>
    <link rel="stylesheet" href="{{ asset('css/style_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dokter/style_dashboard_dokter.css') }}">
</head>
<body>
    <div class="nav-content">
        <div class="logokiri">
            <img src="{{ asset('img/unairr.png') }}" alt="Logo UNAIR">
        </div>
        <div class="text">
            <h2>Universitas Airlangga |</h2>
        </div>
        <div class="text2">
            <h2>Rumah Sakit Hewan Pendidikan</h2>
        </div>
        <div class="logokanan">
            <img src="{{ asset('img/rshpp.png') }}" alt="Logo RSHP">
        </div>
    </div>

    <div class="navbar">
        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>
        <div class="navbar-nav">
            <a href="{{ route('dokter.dashboard') }}">Home</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <div class="dashboard-container">
        <h1 class="dashboard-welcome">
            Selamat Datang, Dr. {{ session('user_name', 'Dokter') }}!
        </h1>
        <p class="dashboard-user-info">
            Anda berhasil login sebagai 
            <span class="role-highlight">Dokter RSHP UNAIR</span>.
        </p>
        <div class="dashboard-info-badge">
            <span class="info-text">Akses Rekam Medis di menu bawah.</span>
        </div>
        <div class="doctor-menu-container">
            <a href="{{ route('dokter.rekam-medis') }}" class="doctor-menu-card">
                <div class="card-icon"></div>
                <h3 class="card-title">Rekam Medis</h3>
                <p class="card-description">Lihat rekam medis pasien</p>
            </a>
        </div>
    </div>
</body>
</html>