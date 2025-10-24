{{-- 
    EDIT KATEGORI - ADMINISTRATOR
    ==============================
    Form untuk edit nama kategori.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Administrator</title>
    
    <!-- CSS Files untuk styling -->
    <link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_kategori.css') }}" />
</head>
<body>
    <!-- ========== MAIN CONTAINER ========== -->
    <div class="container-padded">
        <!-- ========== HEADER SECTION ========== -->
        <div class="section-card">
            <h2 class="heading">Edit Kategori</h2>
            <p class="section-info">Ubah nama kategori: <strong>{{ $kategori->nama_kategori }}</strong></p>
            
            <!-- Navigation toolbar -->
            <div class="toolbar">
                <a class="btn" href="{{ route('admin.kategori.index') }}">Kembali ke Data Kategori</a>
            </div>
        </div>

        <!-- ========== FORM EDIT KATEGORI ========== -->
        <div class="add-form">
            <h3>Form Edit Kategori</h3>
            <form class="row-form" method="POST" action="{{ route('admin.kategori.update', $kategori->id) }}">
                @csrf
                @method('PUT')
                
                <!-- Input nama kategori -->
                <input type="text" 
                       name="nama_kategori" 
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                       placeholder="Masukkan nama kategori"
                       class="@error('nama_kategori') is-invalid @enderror"
                       required 
                       autofocus
                       maxlength="100" />
                
                @error('nama_kategori')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                       
                <!-- Tombol submit -->
                <button type="submit" class="btn">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>
