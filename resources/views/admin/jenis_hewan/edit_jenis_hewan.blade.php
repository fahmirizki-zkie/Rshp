@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
    <div class="container">
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Edit Jenis Hewan</h1>
                <p class="page-subtitle">Update data jenis hewan</p>
            </div>
            
            <div class="button-section">
                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="form-container" style="max-width: 600px; margin: 20px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <form method="POST" action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="nama_jenis_hewan" style="display: block; margin-bottom: 8px; font-weight: 600;">Nama Jenis Hewan <span style="color: red;">*</span></label>
                        <input type="text" 
                               name="nama_jenis_hewan" 
                               id="nama_jenis_hewan"
                               value="{{ old('nama_jenis_hewan', $jenisHewan->nama_jenis_hewan) }}"
                               required
                               maxlength="100"
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;"
                               class="@error('nama_jenis_hewan') is-invalid @enderror">
                        @error('nama_jenis_hewan')
                            <span style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions" style="display: flex; gap: 10px;">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary" style="padding: 10px 20px; background: #6b7280; color: white; text-decoration: none; border-radius: 4px; display: inline-block;">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
