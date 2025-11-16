@include('layouts.resepsionis.head')

<link rel="stylesheet" href="{{ asset('css/resepsionis/style_dashboard_resepsionis.css') }}">

@include('layouts.resepsionis.header')
@include('layouts.resepsionis.navbar')

<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:enter="slideDown" x-transition:leave="slideUp">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:enter="slideDown" x-transition:leave="slideUp">
            {{ session('error') }}
        </div>
    @endif
<div class="main-container">
    <div class="welcome-section">
        <h1 class="welcome-title">Selamat Datang, {{ session('user_name') ?? 'Resepsionis' }}!</h1>
        <p class="welcome-subtitle">
            Anda berhasil login sebagai <span class="role-highlight">Resepsionis RSHP UNAIR</span>.
        </p>
        <p class="welcome-description">
            Pilih menu di bawah ini untuk mengelola data dan layanan rumah sakit hewan.
        </p>
    </div>

    <div class="menu-grid">
        <div class="menu-card">
            <div class="card-icon">
                <i class="icon-user">👤</i>
            </div>
            <div class="card-content">
                <h3 class="card-title">Tambah Pemilik</h3>
                <p class="card-description">
                    Tambah data pemilik hewan baru ke sistem
                </p>
                <a href="{{ route('resepsionis.tambah-pemilik') }}" class="card-button">
                    Tambah Pemilik
                </a>
            </div>
        </div>

        <div class="menu-card">
            <div class="card-icon">
                <i class="icon-pet">🐕</i>
            </div>
            <div class="card-content">
                <h3 class="card-title">Tambah Pet</h3>
                <p class="card-description">
                    Tambah data hewan peliharaan baru untuk layanan kesehatan
                </p>
                <a href="{{ route('resepsionis.tambah-pet') }}" class="card-button">
                    Tambah Pet
                </a>
            </div>
        </div>

        <div class="menu-card">
            <div class="card-icon">
                <i class="icon-appointment">📅</i>
            </div>
            <div class="card-content">
                <h3 class="card-title">Temu Dokter</h3>
                <p class="card-description">
                    Temukan dokter yang sesuai untuk layanan kesehatan hewan
                </p>
                <a href="{{ route('resepsionis.temu-dokter') }}" class="card-button">
                    Temu Dokter
                </a>
            </div>
        </div>
    </div>
</div>
</div>

@include('layouts.resepsionis.footer')
@include('layouts.resepsionis.scripts')
