@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
	<!-- ========== MAIN CONTENT ========== -->
	<div class="container">
		<!-- ========== MAIN CONTENT WRAPPER ========== -->
		<div class="main-content">
			<!-- ========== PAGE HEADER ========== -->
			<div class="page-header">
				<h1 class="page-title">Data Kode Tindakan/Terapi</h1>
				<p class="page-subtitle">Kelola kode tindakan dan terapi medis untuk hewan.</p>
			</div>
			
			<!-- ========== BUTTON SECTION ========== -->
			<div class="button-section">
				<a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
			</div>

			<!-- ========== FORM TAMBAH KODE TINDAKAN/TERAPI ========== -->
			<div class="add-form-section">
				<h3 class="form-title">Tambah Kode Tindakan/Terapi Baru</h3>
				<form class="form-row" method="POST" action="{{ route('admin.kode-tindakan.store') }}">
					@csrf
					
					<!-- Input kode tindakan -->
					<input type="text" 
					       name="kode" 
					       value="{{ old('kode') }}"
					       placeholder="Masukkan kode tindakan" 
					       required 
					       maxlength="50"
					       class="form-input @error('kode') input-error @enderror" />
					@error('kode')
						<span class="error-message">{{ $message }}</span>
					@enderror
					
					<!-- Dropdown kategori -->
					<select name="idkategori" required class="form-select @error('idkategori') input-error @enderror">
						<option value="">-- Pilih Kategori --</option>
						@foreach($kategoris as $k)
							<option value="{{ $k->idkategori }}" {{ old('idkategori') == $k->idkategori ? 'selected' : '' }}>
								{{ $k->nama_kategori }}
							</option>
						@endforeach
					</select>
					@error('idkategori')
						<span class="error-message">{{ $message }}</span>
					@enderror
					
					<!-- Dropdown kategori klinis -->
					<select name="idkategori_klinis" required class="form-select @error('idkategori_klinis') input-error @enderror">
						<option value="">-- Pilih Kategori Klinis --</option>
						@foreach($kategoriKlinises as $kk)
							<option value="{{ $kk->idkategori_klinis }}" {{ old('idkategori_klinis') == $kk->idkategori_klinis ? 'selected' : '' }}>
								{{ $kk->nama_kategori_klinis }}
							</option>
						@endforeach
					</select>
					@error('idkategori_klinis')
						<span class="error-message">{{ $message }}</span>
					@enderror
					
					<!-- Textarea untuk deskripsi -->
					<textarea name="deskripsi_tindakan_terapi" 
					          rows="3" 
					          placeholder="Deskripsi tindakan/terapi (opsional)"
					          maxlength="500"
					          class="form-textarea @error('deskripsi_tindakan_terapi') input-error @enderror">{{ old('deskripsi_tindakan_terapi') }}</textarea>
					@error('deskripsi_tindakan_terapi')
						<span class="error-message">{{ $message }}</span>
					@enderror
					
					<!-- Tombol submit -->
					<button type="submit" class="btn-add">+ Tambah Kode Tindakan</button>
				</form>
			</div>

			<!-- ========== TABEL DATA KODE TINDAKAN/TERAPI ========== -->
			<div class="table-container">
				<table class="data-table">
					<!-- Header tabel -->
					<thead>
						<tr>
							<th class="col-id">ID</th>
							<th class="col-kode">KODE</th>
							<th class="col-kategori">KATEGORI</th>
							<th class="col-kategori-klinis">KATEGORI KLINIS</th>
							<th class="col-deskripsi">DESKRIPSI</th>
							<th class="col-action">AKSI</th>
						</tr>
					</thead>
					
					<!-- Data rows -->
					<tbody>
						@forelse($kodeTindakanTerapis as $kodeTindakan)
						<tr>
							<!-- ID Kode Tindakan -->
							<td class="col-id">{{ $kodeTindakan->idkode_tindakan_terapi }}</td>
							
							<!-- Kode -->
							<td class="col-kode">{{ $kodeTindakan->kode }}</td>
							
							<!-- Nama Kategori -->
							<td class="col-kategori">{{ $kodeTindakan->kategori->nama_kategori ?? '-' }}</td>
							
							<!-- Nama Kategori Klinis -->
							<td class="col-kategori-klinis">{{ $kodeTindakan->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
							
							<!-- Deskripsi -->
							<td class="col-deskripsi">{{ $kodeTindakan->deskripsi_tindakan_terapi ?? '-' }}</td>
							
							<!-- Tombol Aksi -->
							<td class="col-action">
								<div class="actions-inline">
									<!-- Tombol Edit -->
									<a class="btn-edit" href="{{ route('admin.kode-tindakan.edit', $kodeTindakan->idkode_tindakan_terapi) }}">Edit</a>
									
									<!-- Form Hapus -->
									<form method="POST" action="{{ route('admin.kode-tindakan.destroy', $kodeTindakan->idkode_tindakan_terapi) }}" class="delete-form" onsubmit="return confirm('Yakin ingin menghapus kode tindakan ini?')">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn-delete">Hapus</button>
									</form>
								</div>
							</td>
						</tr>
						@empty
						<tr class="empty-row">
							<td colspan="6">Belum ada data kode tindakan/terapi. Silakan tambah data baru.</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<!-- END MAIN CONTENT WRAPPER -->
		</div>
	</div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')