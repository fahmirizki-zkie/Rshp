<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nama Pet - Administrator</title>
    
    <!-- CSS Files untuk styling -->
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_pemilik.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}">
</head>
<body>
    <!-- ========== MAIN CONTAINER ========== -->
    <div class="container-small">
        <!-- Navigation link kembali -->
        <a href="{{ route('admin.pet.index') }}" class="back-link">&larr; Kembali ke Data Pet</a>
        
        <!-- ========== FORM EDIT NAMA PET ========== -->
        <div class="form-box">
            <h3>Edit Nama Pet</h3>
            <p class="form-info">Form ini digunakan untuk mengubah nama pet. Hanya administrator yang dapat mengakses halaman ini.</p>
            
            <!-- Form untuk update nama pet -->
            <form method="POST" action="{{ route('admin.pet.update', $pet->id) }}">
                @csrf
                @method('PUT')
                
                <!-- Input field untuk nama pet -->
                <div class="form-group">
                    <label for="nama">Nama Pet</label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           class="@error('nama') is-invalid @enderror"
                           value="{{ old('nama', $pet->nama) }}" 
                           required 
                           autofocus
                           placeholder="Masukkan nama pet">
                    @error('nama')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Action buttons -->
                <div class="modal-actions right">
                    <a class="btn secondary" href="{{ route('admin.pet.index') }}">Batal</a>
                    <button type="submit" class="btn">Update Nama</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
