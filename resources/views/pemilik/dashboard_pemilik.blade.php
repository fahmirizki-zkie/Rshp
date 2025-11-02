<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik - RS Hewan UNAIR</title>
    
    <!-- CSS Styling External -->
    <link rel="stylesheet" href="{{ asset('css/style_dashboard_pemilik.css') }}">
    
    <!-- Font Google (Inter) untuk typography modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- =================================================================== -->
    <!-- HEADER SECTION: Logo, User Info, dan Logout -->
    <!-- =================================================================== -->
    <header class="header">
        <div class="container">
            <!-- Logo dan nama rumah sakit -->
            <div class="logo">
                <img src="{{ asset('img/rshpp.png') }}" alt="RS Hewan UNAIR">
                <span>RS Hewan UNAIR</span>
            </div>
            
            <!-- User information dan logout button -->
            <div class="user-info">
                @if(session('user_id'))
                    <span>Selamat datang, {{ session('user_nama') ?? $pemilikData->user->nama ?? 'Pemilik' }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @else
                    <span>Selamat datang, Guest</span>
                @endif
            </div>
        </div>
    </header>

    <!-- =================================================================== -->
    <!-- MAIN CONTENT: Dashboard Content -->
    <!-- =================================================================== -->
    <main class="main-content">
        <div class="container">
            <!-- Welcome section dengan judul dashboard -->
            <div class="welcome-section">
                <h1>Dashboard Pemilik</h1>
                <p>Kelola informasi hewan peliharaan Anda</p>
            </div>

            <!-- =================================================================== -->
            <!-- MENU CARDS: Navigasi utama ke fitur-fitur pemilik -->
            <!-- =================================================================== -->
            <div class="menu-grid">
                <!-- Menu Daftar Pet -->
                <a href="{{ url('/pemilik/daftar-pet') }}" class="menu-card">
                    <div class="menu-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <h3>Daftar Pet</h3>
                    <p>Lihat daftar hewan peliharaan Anda</p>
                </a>

                <!-- Menu Daftar Reservasi -->
                <a href="{{ url('/pemilik/daftar-reservasi') }}" class="menu-card">
                    <div class="menu-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Daftar Reservasi</h3>
                    <p>Lihat jadwal konsultasi dan pemeriksaan</p>
                </a>

                <!-- Menu Rekam Medis -->
                <a href="{{ url('/pemilik/daftar-rekam-medis') }}" class="menu-card">
                    <div class="menu-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h3>Rekam Medis</h3>
                    <p>Lihat riwayat kesehatan hewan peliharaan</p>
                </a>
            </div>

            <!-- =================================================================== -->
            <!-- PROFILE CARD: Informasi profil pemilik -->
            <!-- =================================================================== -->
            @if(isset($pemilikData))
            <div class="profile-card">
                <h3><i class="fas fa-user"></i> Informasi Profil</h3>
                <div class="profile-info">
                    <!-- Nama pemilik -->
                    <div class="info-item">
                        <label>Nama:</label>
                        <span>{{ $pemilikData->user->nama ?? 'N/A' }}</span>
                    </div>
                    
                    <!-- Email pemilik -->
                    <div class="info-item">
                        <label>Email:</label>
                        <span>{{ $pemilikData->user->email ?? 'N/A' }}</span>
                    </div>
                    
                    <!-- Nomor WhatsApp -->
                    <div class="info-item">
                        <label>No. WhatsApp:</label>
                        <span>{{ $pemilikData->no_wa ?? '-' }}</span>
                    </div>
                    
                    <!-- Alamat pemilik -->
                    <div class="info-item">
                        <label>Alamat:</label>
                        <span>{{ $pemilikData->alamat ?? '-' }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- =================================================================== -->
            <!-- SUMMARY CARD: Ringkasan statistik data -->
            <!-- =================================================================== -->
            @if(isset($summary))
            <div class="summary-card">
                <h3><i class="fas fa-chart-bar"></i> Ringkasan Data</h3>
                
                <!-- Grid statistik utama -->
                <div class="summary-grid">
                    <!-- Total Pet -->
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-number">{{ $summary['total_pets'] ?? 0 }}</span>
                            <span class="summary-label">Total Pet</span>
                        </div>
                    </div>
                    
                    <!-- Total Reservasi -->
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-number">{{ $summary['total_reservations'] ?? 0 }}</span>
                            <span class="summary-label">Total Reservasi</span>
                        </div>
                    </div>
                    
                    <!-- Total Rekam Medis -->
                    <div class="summary-item">
                        <div class="summary-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-number">{{ $summary['total_rekam_medis'] ?? 0 }}</span>
                            <span class="summary-label">Rekam Medis</span>
                        </div>
                    </div>
                </div>
                
                @if(!empty($summary['last_visit']))
                <div class="last-visit">
                    <p>
                        <i class="fas fa-clock"></i> 
                        Kunjungan terakhir: 
                        {{ \Carbon\Carbon::parse($summary['last_visit'])->format('d/m/Y') }}
                    </p>
                </div>
                @endif
                
                @if(!empty($summary['upcoming_reservation']))
                <div class="upcoming-reservation">
                    <p>
                        <i class="fas fa-calendar-check"></i> 
                        Reservasi mendatang: 
                        {{ \Carbon\Carbon::parse($summary['upcoming_reservation']['tanggal_temu'])->format('d/m/Y H:i') }}
                    </p>
                </div>
                @endif
            </div>
            @endif
        </div>
    </main>
</body>
</html>
