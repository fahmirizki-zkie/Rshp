<!-- ========== MAIN NAVIGATION ========== -->
<div class="navbar">
    <a href="#" class="logo">RSHP<span> UNAIR.</span></a>
    <div class="navbar-nav">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</div>
