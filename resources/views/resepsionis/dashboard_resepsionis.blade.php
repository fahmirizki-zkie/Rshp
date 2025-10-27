<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Resepsionis - RS Hewan UNAIR</title>
    
    <!-- CSS Styling External -->
    <link rel="stylesheet" href="{{ asset('css/resepsionis/style_dashboard_resepsionis.css') }}">
    
    <!-- Font Google untuk typography yang konsisten -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- HEADER SECTION: Logo Universitas dan Rumah Sakit -->
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

    <!-- NAVIGATION BAR: Menu navigasi dan logout -->
    <div class="navbar">
        <a href="#" class="logo">RSHP<span> UNAIR.</span></a>
        <div class="navbar-nav">
            <a href="{{ route('resepsionis.dashboard') }}">Home</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
    
    <!-- MAIN CONTENT: Dashboard content dan menu cards -->
    <div class="main-container">
        <!-- Welcome Section dengan informasi user -->
        <div class="welcome-section">
            <h1 class="welcome-title">Selamat Datang, {{ session('user_name') ?? 'Resepsionis' }}!</h1>
            <p class="welcome-subtitle">
                Anda berhasil login sebagai <span class="role-highlight">Resepsionis RSHP UNAIR</span>.
            </p>
            <p class="welcome-description">
                Pilih menu di bawah ini untuk mengelola data dan layanan rumah sakit hewan.
            </p>
        </div>

        <!-- MENU GRID: Cards untuk akses fitur resepsionis -->
        <div class="menu-grid">
            <!-- Card 1: Data Pemilik - Kelola informasi pemilik hewan -->
            <div class="menu-card">
                <div class="card-icon">
                    <i class="icon-user">👤</i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Data Pemilik</h3>
                    <p class="card-description">
                        Kelola informasi pemilik hewan yang terdaftar di sistem
                    </p>
                    <a href="{{ route('admin.pemilik.index') }}" class="card-button">
                        Buka Data Pemilik
                    </a>
                </div>
            </div>

            <!-- Card 2: Data Pet - Kelola informasi hewan terdaftar -->
            <div class="menu-card">
                <div class="card-icon">
                    <i class="icon-pet">🐕</i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Data Pet</h3>
                    <p class="card-description">
                        Kelola informasi hewan yang terdaftar untuk layanan kesehatan
                    </p>
                    <a href="{{ route('admin.pet.index') }}" class="card-button">
                        Buka Data Pet
                    </a>
                </div>
            </div>

            <!-- Card 3: Temu Dokter - DISABLED (akan diimplementasikan nanti) -->
            <div class="menu-card" style="opacity: 0.5; pointer-events: none;">
                <div class="card-icon">
                    <i class="icon-appointment">📅</i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Temu Dokter</h3>
                    <p class="card-description">
                        Fitur akan segera tersedia
                    </p>
                    <a href="#" class="card-button" style="background: #999; cursor: not-allowed;">
                        Coming Soon
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
