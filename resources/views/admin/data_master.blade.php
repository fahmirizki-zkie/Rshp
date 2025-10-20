<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Master - Admin RSHP</title>
	<link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}">
</head>
<body>
	<!-- ========== NAVIGATION HEADER ========== -->
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

	<!-- ========== MAIN NAVIGATION ========== -->
	<div class="navbar">
		<a href="#" class="logo">RSHP<span> UNAIR.</span></a>
		<div class="navbar-nav">
			<a href="{{ route('admin.dashboard') }}">Dashboard</a>
			<form method="POST" action="{{ route('logout') }}" style="display: inline;">
				@csrf
				<button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; padding: 0;">Logout</button>
			</form>
		</div>
	</div>

	<!-- ========== MAIN CONTENT - DATA MASTER MENU ========== -->
	<div class="menu-container">
		<!-- Page Title -->
		<h1 class="menu-title">Data Master</h1>
		
		<!-- Menu Grid -->
		<div class="menu-grid">
			<!-- User Management -->
			<a class="feature-card" href="{{ route('admin.user.index') }}">
				<div class="card-icon">👤</div>
				<h3 class="card-title">Data User</h3>
				<p class="card-description">Kelola data pengguna sistem</p>
			</a>
			
			<!-- Role Management -->
			<a class="feature-card" href="{{ route('admin.role.index') }}">
				<div class="card-icon">🛡️</div>
				<h3 class="card-title">Manajemen Role</h3>
				<p class="card-description">Atur peran dan hak akses</p>
			</a>
			
			<!-- Animal Species -->
			<a class="feature-card" href="{{ route('jenis-hewan.index') }}">
				<div class="card-icon">🐾</div>
				<h3 class="card-title">Jenis Hewan</h3>
				<p class="card-description">Master data jenis hewan</p>
			</a>
			
			<!-- Animal Breeds -->
			<a class="feature-card" href="{{ route('admin.ras-hewan.index') }}">
				<div class="card-icon">🐶</div>
				<h3 class="card-title">Ras Hewan</h3>
				<p class="card-description">Master data ras hewan</p>
			</a>
			
			<!-- Owner Data -->
			<a class="feature-card" href="{{ route('admin.pemilik.index') }}">
				<div class="card-icon">🏠</div>
				<h3 class="card-title">Data Pemilik</h3>
				<p class="card-description">Informasi pemilik hewan</p>
			</a>
			
			<!-- Pet Data -->
			<a class="feature-card" href="{{ route('admin.pet.index') }}">
				<div class="card-icon">🐕</div>
				<h3 class="card-title">Data Pet</h3>
				<p class="card-description">Database hewan peliharaan</p>
			</a>
			
			<!-- Service Categories -->
			<a class="feature-card" href="{{ route('admin.kategori.index') }}">
				<div class="card-icon">📂</div>
				<h3 class="card-title">Data Kategori</h3>
				<p class="card-description">Kategori layanan medis</p>
			</a>
			
			<!-- Clinical Categories -->
			<a class="feature-card" href="{{ route('admin.kategori-klinis.index') }}">
				<div class="card-icon">🩺</div>
				<h3 class="card-title">Kategori Klinis</h3>
				<p class="card-description">Kategori pemeriksaan klinis</p>
			</a>
			
			<!-- Medical Procedure Codes -->
			<a class="feature-card" href="{{ route('admin.kode-tindakan.index') }}">
				<div class="card-icon">💉</div>
				<h3 class="card-title">Kode Tindakan</h3>
				<p class="card-description">Kode tindakan terapi medis</p>
			</a>
		</div>
	</div>
</body>
</html>
