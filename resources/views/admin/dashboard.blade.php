<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard Administrator - RSHP UNAIR</title>
	<link rel="stylesheet" href="{{ asset('css/style_dashboard.css') }}">
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
			<a href="{{ route('admin.data-master') }}">Data Master</a>
			<form method="POST" action="{{ route('logout') }}" style="display: inline;">
				@csrf
				<button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit;">Logout</button>
			</form>
		</div>
	</div>
	<!-- ========== MAIN CONTENT ========== -->
	<div class="dashboard-container">
		<!-- Welcome Header -->
		<h1 class="dashboard-welcome">
			Selamat Datang, {{ $user_nama ?? auth()->user()->nama ?? 'Admin' }}!
		</h1>
		
		<!-- User Info -->
		<p class="dashboard-user-info">
			Anda berhasil login sebagai <span class="role-highlight">{{ $nama_role ?? 'Administrator' }} RSHP UNAIR</span>.
		</p>
		
		<!-- Action Guide -->
		<div class="dashboard-action-guide">
			<a href="{{ route('admin.data-master') }}" class="dashboard-action-btn">
				Akses Data Master di menu atas
			</a>
		</div>
		
		<!-- Quick Stats atau Info Tambahan -->
		<div class="dashboard-footer-info">
			<p>
				Sistem Manajemen Rumah Sakit Hewan Pendidikan<br>
				Universitas Airlangga
			</p>
		</div>
	</div>
</body>
</html>
