<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pet - RS Hewan UNAIR</title>
    
    <!-- ========== CSS STYLESHEETS ========== -->
    <!-- CSS khusus untuk halaman daftar pet -->
    <link rel="stylesheet" href="{{ asset('css/pemilik/style_daftar_pet.css') }}">
    
    <!-- Google Fonts untuk typography yang lebih baik -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- ========== HEADER NAVIGATION SECTION ========== -->
    <header class="header">
        <div class="container">
            <!-- Logo dan brand name -->
            <div class="logo">
                <img src="{{ asset('img/rshpp.png') }}" alt="RS Hewan UNAIR">
                <span>RS Hewan UNAIR</span>
            </div>
            
            <!-- Navigation menu untuk pemilik -->
            <nav class="nav-menu">
                <!-- Menu Dashboard -->
                <a href="{{ route('pemilik.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                
                <!-- Menu Daftar Pet (active) -->
                <a href="{{ route('pemilik.daftar-pet') }}" class="active"><i class="fas fa-paw"></i> Daftar Pet</a>
                
                <!-- Menu Reservasi -->
                <a href="#"><i class="fas fa-calendar"></i> Reservasi</a>
                
                <!-- Menu Rekam Medis -->
                <a href="#"><i class="fas fa-file-medical"></i> Rekam Medis</a>
            </nav>
        </div>
    </header>

    <!-- ========== MAIN CONTENT SECTION ========== -->
    <main class="main-content">
        <div class="container">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1><i class="fas fa-paw"></i> Daftar Pet Saya</h1>
                <p>Informasi hewan peliharaan yang terdaftar</p>
            </div>

            <!-- ========== PET LIST CONTENT ========== -->
            @if($pets->isEmpty())
                <!-- Tampilan jika belum ada pet terdaftar -->
                <div class="empty-state">
                    <i class="fas fa-paw"></i>
                    <h3>Belum Ada Pet Terdaftar</h3>
                    <p>Anda belum memiliki hewan peliharaan yang terdaftar di sistem kami.</p>
                </div>
            @else
                <!-- Grid untuk menampilkan daftar pet -->
                <div class="pets-grid">
                    @foreach($pets as $pet)
                        <!-- Card untuk setiap pet -->
                        <div class="pet-card">
                            <!-- Header card dengan nama dan jenis kelamin -->
                            <div class="pet-header">
                                <h3>{{ $pet->nama }}</h3>
                                <span class="gender-badge {{ strtolower($pet->jenis_kelamin) }}">
                                    {{ $pet->jenis_kelamin === 'J' ? 'Jantan' : 'Betina' }}
                                </span>
                            </div>
                            
                            <!-- Informasi detail pet -->
                            <div class="pet-info">
                                <!-- Informasi jenis dan ras -->
                                <div class="info-row">
                                    <label><i class="fas fa-dna"></i> Jenis & Ras:</label>
                                    <span>
                                        {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }} - 
                                        {{ $pet->rasHewan->nama_ras ?? '-' }}
                                    </span>
                                </div>
                                
                                <!-- Informasi tanggal lahir dan umur -->
                                <div class="info-row">
                                    <label><i class="fas fa-birthday-cake"></i> Tanggal Lahir:</label>
                                    <span>
                                        @if($pet->tanggal_lahir)
                                            {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}
                                            ({{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun)
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                                
                                <!-- Informasi warna/tanda khusus (opsional) -->
                                @if($pet->warna_tanda)
                                <div class="info-row">
                                    <label><i class="fas fa-palette"></i> Warna/Tanda:</label>
                                    <span>{{ $pet->warna_tanda }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
</body>
</html>