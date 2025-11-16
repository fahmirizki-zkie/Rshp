@include('layouts.admin.head')

<!-- Additional Styles -->
<link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}">

@include('layouts.admin.header')
@include('layouts.admin.navbar')

<!-- ========== MAIN CONTENT ========== -->
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
		<a class="feature-card" href="{{ route('admin.jenis-hewan.index') }}">
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
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
