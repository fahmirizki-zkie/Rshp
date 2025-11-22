@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
	<div class="container">
		<div class="main-content">
			<!-- PAGE HEADER -->
			<div class="page-header">
				<h1 class="page-title">Edit Ras Hewan</h1>
				<p class="page-subtitle">Ubah data ras hewan yang sudah ada.</p>
			</div>
			
			<!-- BUTTON SECTION -->
			<div class="button-section">
				<a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Kembali</a>
			</div>
			
			<!-- FORM EDIT -->
			<div class="form-container">
				<form method="POST" action="{{ route('admin.ras-hewan.update', $ras->idras_hewan) }}" class="edit-form">
					@csrf
					@method('PUT')
					
					<div class="form-group">
						<label for="idjenis_hewan">Jenis Hewan:</label>
						<select name="idjenis_hewan" id="idjenis_hewan" class="form-control" required>
							<option value="">-- Pilih Jenis Hewan --</option>
							@foreach($jenisList as $jenis)
								<option value="{{ $jenis->idjenis_hewan }}" 
									{{ $ras->idjenis_hewan == $jenis->idjenis_hewan ? 'selected' : '' }}>
									{{ $jenis->nama_jenis_hewan }}
								</option>
							@endforeach
						</select>
					</div>
					
					<div class="form-group">
						<label for="nama_ras">Nama Ras:</label>
						<input type="text" 
						       name="nama_ras" 
						       id="nama_ras" 
						       class="form-control" 
						       value="{{ old('nama_ras', $ras->nama_ras) }}" 
						       maxlength="100"
						       required>
					</div>
					
					@if($errors->any())
						<div class="alert alert--error">
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Batal</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
