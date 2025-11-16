<!-- ========== MAIN NAVIGATION ========== -->
<div class="navbar">
    <a href="{{ route('resepsionis.dashboard') }}" class="logo">RSHP<span> UNAIR.</span></a>
    <div class="navbar-nav">
        <a href="{{ route('resepsionis.dashboard') }}">Home</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;" class="logout-form">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit;">Logout</button>
        </form>
    </div>
</div>
