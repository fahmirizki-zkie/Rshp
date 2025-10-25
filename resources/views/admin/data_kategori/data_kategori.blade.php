<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori - Administrator</title>
    
    <!-- CSS Files untuk styling -->
    <link rel="stylesheet" href="{{ asset('css/admin/style_data_kategori_new.css') }}" />
</head>
<body>
    <!-- ========== MAIN CONTENT ========== -->
    <div class="container">
        <!-- ========== MAIN CONTENT WRAPPER ========== -->
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Data Kategori</h1>
                <p class="page-subtitle">Kelola kategori yang digunakan untuk mengklasifikasikan data dalam sistem.</p>
            </div>
            
            <!-- ========== BUTTON SECTION ========== -->
            <div class="button-section">
                <a href="{{ route('admin.data-master') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>

        <!-- ========== FORM TAMBAH KATEGORI ========== -->
        <div class="add-form-section">
            <h3 class="form-title">Tambah Kategori Baru</h3>
            <form class="form-row" method="POST" action="{{ route('admin.kategori.store') }}">
                @csrf
                
                <!-- Input nama kategori -->
                <input type="text" 
                       name="nama_kategori" 
                       placeholder="Masukkan nama kategori baru" 
                       required 
                       maxlength="100"
                       class="form-input @error('nama_kategori') is-invalid @enderror"
                       value="{{ old('nama_kategori') }}" />
                       
                <!-- Tombol submit -->
                <button type="submit" class="btn-add">+ Tambah Kategori</button>
            </form>
            @error('nama_kategori')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- ========== TABEL DATA KATEGORI ========== -->
        <div class="table-container">
            <table class="data-table">
                <!-- Header tabel -->
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-name">NAMA KATEGORI</th>
                        <th class="col-action">AKSI</th>
                    </tr>
                </thead>
                
                <!-- Data rows -->
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr>
                            <!-- ID Kategori -->
                            <td class="col-id">{{ $kategori->id }}</td>
                            
                            <!-- Nama Kategori -->
                            <td class="col-name">{{ $kategori->nama_kategori }}</td>
                            
                            <!-- Tombol Aksi -->
                            <td class="col-action">
                                <div class="actions-inline">
                                    <!-- Tombol Edit -->
                                    <a class="btn-edit" href="{{ route('admin.kategori.edit', $kategori->id) }}">Edit</a>
                                    
                                    <!-- Form Hapus -->
                                    <form method="POST" action="{{ route('admin.kategori.destroy', $kategori->id) }}" class="delete-form" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="3">Belum ada data kategori. Silakan tambah kategori baru.</td>
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