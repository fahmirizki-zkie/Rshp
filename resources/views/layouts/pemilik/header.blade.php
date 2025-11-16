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
            <a href="{{ route('pemilik.dashboard') }}" class="{{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('pemilik.daftar-pet') }}" class="{{ request()->routeIs('pemilik.daftar-pet') ? 'active' : '' }}">
                <i class="fas fa-paw"></i> Daftar Pet
            </a>
            <a href="{{ route('pemilik.reservasi') }}" class="{{ request()->routeIs('pemilik.reservasi') ? 'active' : '' }}">
                <i class="fas fa-calendar"></i> Reservasi
            </a>
            <a href="{{ route('pemilik.rekam-medis') }}" class="{{ request()->routeIs('pemilik.rekam-medis') ? 'active' : '' }}">
                <i class="fas fa-file-medical"></i> Rekam Medis
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0.5rem 1rem;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </div>
</header>
