@include('layouts.dokter.head')

<link rel="stylesheet" href="{{ asset('css/dokter/style_dashboard_dokter.css') }}">

@include('layouts.dokter.header')
@include('layouts.dokter.navbar')

<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" style="display: none;" x-transition>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
</div>

@include('layouts.dokter.footer')
@include('layouts.dokter.scripts')