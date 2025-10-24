<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Kategori Klinis - Administrator</title>
	<link rel="stylesheet" href="{{ asset('css/admin/style_kategori_klinis_new.css') }}" />
</head>
<body>
	<!-- ========== MAIN CONTENT ========== -->
	<div class="container">
		<!-- ========== MAIN CONTENT WRAPPER ========== -->
		<div class="main-content">
			<!-- ========== PAGE HEADER ========== -->
			<div class="page-header">
				<h1 class="page-title">Data Kategori Klinis</h1>
				<p class="page-subtitle">Kelola kategori klinis untuk pemeriksaan medis hewan.</p>
			</div>
			
			<!-- ========== BUTTON SECTION ========== -->
			<div class="button-section">
				<a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
			</div>

			<!-- ========== FORM TAMBAH KATEGORI KLINIS ========== -->
			<div class="add-form-section">
				<h3 class="form-title">Tambah Kategori Klinis Baru</h3>
				<form class="form-row" method="POST" action="{{ route('admin.kategori-klinis.store') }}">
					@csrf
					
					<!-- Input nama kategori klinis -->
					<input type="text" 
					       name="nama_kategori_klinis" 
					       placeholder="Masukkan nama kategori klinis baru" 
					       required 
					       maxlength="100"
					       class="form-input @error('nama_kategori_klinis') is-invalid @enderror"
					       value="{{ old('nama_kategori_klinis') }}" />
					       
					<!-- Tombol submit -->
					<button type="submit" class="btn-add">+ Tambah Kategori</button>
				</form>
				@error('nama_kategori_klinis')
					<span class="error-message">{{ $message }}</span>
				@enderror
			</div>

			<!-- ========== TABEL DATA KATEGORI KLINIS ========== -->
			<div class="table-container">
				<table class="data-table">
					<!-- Header tabel -->
					<thead>
						<tr>
							<th class="col-id">ID KATEGORI KLINIS</th>
							<th class="col-name">NAMA KATEGORI KLINIS</th>
							<th class="col-action">AKSI</th>
						</tr>
					</thead>
					
					<!-- Data rows -->
					<tbody>
						@forelse($kategoriKlinises as $kategoriKlinis)
							<tr>
								<!-- ID Kategori Klinis -->
								<td class="col-id">{{ $kategoriKlinis->id }}</td>
								
								<!-- Nama Kategori Klinis -->
								<td class="col-name">{{ $kategoriKlinis->nama_kategori_klinis }}</td>
								
								<!-- Tombol Aksi -->
								<td class="col-action">
									<div class="actions-inline">
										<!-- Tombol Edit -->
										<a class="btn-edit" href="{{ route('admin.kategori-klinis.edit', $kategoriKlinis->id) }}">Edit</a>
										
										<!-- Form Hapus -->
										<form method="POST" action="{{ route('admin.kategori-klinis.destroy', $kategoriKlinis->id) }}" class="delete-form" onsubmit="return confirm('Yakin ingin menghapus kategori klinis ini?');">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn-delete">Hapus</button>
										</form>
									</div>
								</td>
							</tr>
						@empty
							<tr class="empty-row">
								<td colspan="3">Belum ada data kategori klinis. Silakan tambah kategori klinis baru.</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<!-- END MAIN CONTENT WRAPPER -->
		</div>
	</div>
</body>
</html>