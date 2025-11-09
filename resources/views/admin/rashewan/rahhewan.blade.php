<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Ras Hewan - Admin RSHP</title>
	<link rel="stylesheet" href="{{ asset('css/style_ras_hewan_new.css') }}">
</head>
<body>
	<!-- ========== MAIN CONTENT ========== -->
	<div class="container">
		<!-- ========== MAIN CONTENT WRAPPER ========== -->
		<div class="main-content">
			<!-- ========== PAGE HEADER ========== -->
			<div class="page-header">
				<h1 class="page-title">Manajemen Ras Hewan</h1>
				<p class="page-subtitle">Kelola jenis dan ras hewan yang tersedia di sistem.</p>
			</div>
			
			<!-- ========== BUTTON SECTION ========== -->
			<div class="button-section">
				<a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
			</div>
			
			<!-- ========== ALERT MESSAGES ========== -->
			@if(session('success'))
				<div class="alert alert--success">
					{{ session('success') }}
				</div>
			@endif
			
			@if(session('error'))
				<div class="alert alert--error">
					{{ session('error') }}
				</div>
			@endif
			
			<!-- ========== TABEL RAS HEWAN PER JENIS ========== -->
			<div class="table-container">
				<table class="data-table">
					<!-- Header tabel -->
					<thead>
						<tr>
							<th class="col-jenis">JENIS HEWAN</th>
							<th class="col-ras">NAMA RAS</th>
							<th class="col-action">AKSI</th>
						</tr>
					</thead>
					
					<!-- Data rows -->
					<tbody>
						@forelse($jenisList as $jenis)
							<!-- Header row untuk jenis hewan -->
							<tr class="group-row">
								<td colspan="3">
									<div class="group-header">
										<!-- Nama jenis hewan -->
										<div class="jenis-name">Jenis: {{ $jenis->nama_jenis_hewan }}</div>
										
										<!-- Form tambah ras baru -->
										<form method="POST" action="{{ route('admin.ras-hewan.store') }}" class="add-ras-form">
											@csrf
											<input type="hidden" name="idjenis_hewan" value="{{ $jenis->idjenis_hewan }}">
											<input type="text" 
											       name="nama_ras" 
											       placeholder="Tambah ras baru" 
											       maxlength="100"
											       required
											       class="form-input-inline @error('nama_ras') is-invalid @enderror">
											<button type="submit" class="btn-add-inline">+ Tambah</button>
										</form>
									</div>
									@error('nama_ras')
										<span style="color: red; font-size: 12px; margin-left: 10px;">{{ $message }}</span>
									@enderror
								</td>
							</tr>
							
							<!-- Daftar ras untuk jenis ini -->
							@php
								$rasList = $rasByJenis[$jenis->idjenis_hewan] ?? [];
							@endphp
							
							@forelse($rasList as $ras)
								<tr class="ras-row">
									<td></td>
									<td class="ras-name">{{ $ras->nama_ras }}</td>
									<td class="col-action">
										<a href="{{ route('admin.ras-hewan.edit', $ras->idras_hewan) }}" class="btn-edit">Edit</a>
										<form method="POST" action="{{ route('admin.ras-hewan.destroy', $ras->idras_hewan) }}" style="display: inline;" onsubmit="return confirm('Yakin hapus ras {{ $ras->nama_ras }}?');">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn-delete">Hapus</button>
										</form>
									</td>
								</tr>
							@empty
								<!-- Pesan jika tidak ada ras -->
								<tr class="empty-ras">
									<td></td>
									<td colspan="2">Belum ada ras untuk jenis ini.</td>
								</tr>
							@endforelse
						@empty
							<!-- Pesan jika tidak ada data jenis -->
							<tr class="empty-row">
								<td colspan="3">Belum ada data jenis hewan.</td>
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
