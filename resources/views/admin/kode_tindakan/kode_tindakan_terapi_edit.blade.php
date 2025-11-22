@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
	<div class="container">
		<div class="main-content">
			<!-- ========== PAGE HEADER ========== -->
			<div class="page-header">
				<h1 class="page-title">Edit Kode Tindakan/Terapi</h1>
				<p class="page-subtitle">Perbarui informasi kode tindakan dan terapi medis.</p>
			</div>
			
			<!-- ========== BUTTON SECTION ========== -->
			<div class="button-section">
				<a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
			</div>

			<!-- ========== FORM EDIT KODE TINDAKAN/TERAPI ========== -->
			<div class="edit-form-section">
				<h3 class="form-title">Form Edit Kode Tindakan/Terapi</h3>
				<form class="form-vertical" method="POST" action="{{ route('admin.kode-tindakan.update', $kodeTindakan->idkode_tindakan_terapi) }}">
					@csrf
					@method('PUT')
					
					<!-- Input kode tindakan -->
					<div class="form-group">
						<label for="kode" class="form-label">Kode Tindakan <span class="required">*</span></label>
						<input type="text" 
						       id="kode"
						       name="kode" 
						       value="{{ old('kode', $kodeTindakan->kode) }}"
						       placeholder="Masukkan kode tindakan" 
						       required 
						       maxlength="50"
						       class="form-input @error('kode') input-error @enderror" />
						@error('kode')
							<span class="error-message">{{ $message }}</span>
						@enderror
					</div>
					
					<!-- Dropdown kategori -->
					<div class="form-group">
						<label for="idkategori" class="form-label">Kategori <span class="required">*</span></label>
						<select id="idkategori" name="idkategori" required class="form-select @error('idkategori') input-error @enderror">
							<option value="">-- Pilih Kategori --</option>
							@foreach($kategoris as $k)
								<option value="{{ $k->idkategori }}" 
								        {{ old('idkategori', $kodeTindakan->idkategori) == $k->idkategori ? 'selected' : '' }}>
									{{ $k->nama_kategori }}
								</option>
							@endforeach
						</select>
						@error('idkategori')
							<span class="error-message">{{ $message }}</span>
						@enderror
					</div>
					
					<!-- Dropdown kategori klinis -->
					<div class="form-group">
						<label for="idkategori_klinis" class="form-label">Kategori Klinis <span class="required">*</span></label>
						<select id="idkategori_klinis" name="idkategori_klinis" required class="form-select @error('idkategori_klinis') input-error @enderror">
							<option value="">-- Pilih Kategori Klinis --</option>
							@foreach($kategoriKlinises as $kk)
								<option value="{{ $kk->idkategori_klinis }}" 
								        {{ old('idkategori_klinis', $kodeTindakan->idkategori_klinis) == $kk->idkategori_klinis ? 'selected' : '' }}>
									{{ $kk->nama_kategori_klinis }}
								</option>
							@endforeach
						</select>
						@error('idkategori_klinis')
							<span class="error-message">{{ $message }}</span>
						@enderror
					</div>
					
					<!-- Textarea untuk deskripsi -->
					<div class="form-group">
						<label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi Tindakan/Terapi</label>
						<textarea id="deskripsi_tindakan_terapi"
						          name="deskripsi_tindakan_terapi" 
						          rows="5" 
						          placeholder="Deskripsi tindakan/terapi (opsional)"
						          maxlength="500"
						          class="form-textarea @error('deskripsi_tindakan_terapi') input-error @enderror">{{ old('deskripsi_tindakan_terapi', $kodeTindakan->deskripsi_tindakan_terapi) }}</textarea>
						@error('deskripsi_tindakan_terapi')
							<span class="error-message">{{ $message }}</span>
						@enderror
					</div>
					
					<!-- Tombol submit -->
					<div class="form-actions">
						<button type="submit" class="btn-update">💾 Update Data</button>
						<a href="{{ route('admin.kode-tindakan.index') }}" class="btn-cancel">Batal</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')