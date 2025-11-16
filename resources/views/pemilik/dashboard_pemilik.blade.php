@include('layouts.pemilik.head')
@include('layouts.pemilik.header')

<!-- ========== MAIN CONTENT SECTION ========== -->
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

                <!-- No WhatsApp -->
                <div class="info-item">
                    <label>No WhatsApp:</label>
                    <span>{{ $pemilikData->no_whatsapp ?? 'N/A' }}</span>
                </div>

                <!-- Alamat -->
                <div class="info-item">
                    <label>Alamat:</label>
                    <span>{{ $pemilikData->alamat ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- =================================================================== -->
        <!-- QUICK STATS: Ringkasan data penting -->
        <!-- =================================================================== -->
        @if(isset($summary))
        <div class="stats-grid">
            <!-- Total Pet -->
            <div class="stat-card">
                <i class="fas fa-paw"></i>
                <h4>Total Pet</h4>
                <p class="stat-number">{{ $summary['total_pets'] ?? 0 }}</p>
                <small>Hewan peliharaan terdaftar</small>
            </div>

            <!-- Total Reservasi -->
            <div class="stat-card">
                <i class="fas fa-calendar-check"></i>
                <h4>Total Reservasi</h4>
                <p class="stat-number">{{ $summary['total_reservations'] ?? 0 }}</p>
                <small>Jadwal konsultasi</small>
            </div>

            <!-- Total Rekam Medis -->
            <div class="stat-card">
                <i class="fas fa-file-medical-alt"></i>
                <h4>Rekam Medis</h4>
                <p class="stat-number">{{ $summary['total_rekam_medis'] ?? 0 }}</p>
                <small>Riwayat kesehatan</small>
            </div>
        </div>

        <!-- =================================================================== -->
        <!-- UPCOMING RESERVATION ALERT (if any) -->
        <!-- =================================================================== -->
        @if(isset($summary['upcoming_reservation']) && $summary['upcoming_reservation'])
        <div class="alert-info">
            <i class="fas fa-info-circle"></i>
            <p>
                <strong>Reservasi Mendatang:</strong> 
                {{ \Carbon\Carbon::parse($summary['upcoming_reservation']['tanggal_temu'])->format('d/m/Y H:i') }}
            </p>
        </div>
        @endif
        @endif
        @endif
    </div>
</main>

@include('layouts.pemilik.footer')
@include('layouts.pemilik.scripts')
