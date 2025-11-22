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
        <h1 class="page-title">Edit Kategori Klinis</h1>
        <p class="page-subtitle">Ubah nama kategori klinis: <strong>{{ $kategoriKlinis->nama_kategori_klinis }}</strong></p>
      </div>
      
      <!-- ========== BUTTON SECTION ========== -->
      <div class="button-section">
        <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">Kembali ke Data Kategori Klinis</a>
      </div>

    <!-- ========== FORM EDIT KATEGORI KLINIS ========== -->
    <div class="edit-form-section">
      <h3 class="form-title">Form Edit Kategori Klinis</h3>
      <form class="edit-form" method="POST" action="{{ route('admin.kategori-klinis.update', $kategoriKlinis->id) }}">
        @csrf
        @method('PUT')
        
        <!-- Form Group untuk Nama Kategori Klinis -->
        <div class="form-group">
          <label for="nama_kategori_klinis" class="form-label">Nama Kategori Klinis:</label>
          <input type="text" 
                 id="nama_kategori_klinis"
                 name="nama_kategori_klinis" 
                 value="{{ old('nama_kategori_klinis', $kategoriKlinis->nama_kategori_klinis) }}"
                 placeholder="Masukkan nama kategori klinis" 
                 required 
                 autofocus
                 maxlength="100"
                 class="form-input @error('nama_kategori_klinis') is-invalid @enderror" />
          
          @error('nama_kategori_klinis')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
        
        <!-- Button Group -->
        <div class="button-group">
          <button type="submit" class="btn-save">Simpan Perubahan</button>
          <a href="{{ route('admin.kategori-klinis.index') }}" class="btn-cancel">Batal</a>
        </div>
      </form>
    </div>
    <!-- END MAIN CONTENT WRAPPER -->
    </div>
  </div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
