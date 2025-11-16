@include('layouts.resepsionis.head')

<link rel="stylesheet" href="{{ asset('css/resepsionis/style_resepsionis.css') }}">
<link rel="stylesheet" href="{{ asset('css/style_data_master_new.css') }}">

@include('layouts.resepsionis.header')
@include('layouts.resepsionis.navbar')

<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:enter="slideDown" x-transition:leave="slideUp">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:enter="slideDown" x-transition:leave="slideUp">
            {{ session('error') }}
        </div>
    @endif
<div class="container">
    <h1>Tambah Data Pet</h1>

    <div class="form-box">
        <form method="POST" action="{{ route('resepsionis.pet.store') }}">
            @csrf

            <div class="form-group">
                <label for="idpemilik">Pilih Pemilik <span class="required">*</span></label>
                <select name="idpemilik" id="idpemilik" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach($pemilikList as $pemilik)
                        <option value="{{ $pemilik->idpemilik }}" {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>
                            {{ $pemilik->user->nama ?? '-' }}
                        </option>
                    @endforeach
                </select>
                <small class="form-help">Catatan: Pilih pemilik yang sudah terdaftar di sistem</small>
                @error('idpemilik')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="idras_hewan">Ras Hewan <span class="required">*</span></label>
                <select name="idras_hewan" id="idras_hewan" required>
                    <option value="">-- Pilih Ras --</option>
                    @foreach($rasHewanList as $ras)
                        <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                            {{ $ras->jenisHewan->nama ?? '-' }} - {{ $ras->nama }}
                        </option>
                    @endforeach
                </select>
                <small class="form-help">Catatan: Pilih ras hewan yang sesuai</small>
                @error('idras_hewan')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama Pet <span class="required">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Masukkan nama hewan" required>
                <small class="form-help">Catatan: Nama hewan yang mudah diingat dan dipanggil</small>
                @error('nama')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="">-- Pilih Kelamin --</option>
                    <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                    <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                </select>
                <small class="form-help">Catatan: Pilih jenis kelamin hewan</small>
                @error('jenis_kelamin')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                <small class="form-help">Catatan: Tanggal lahir untuk menghitung umur hewan (opsional)</small>
                @error('tanggal_lahir')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="warna">Warna/Tanda Khusus</label>
                <textarea name="warna" id="warna" rows="3" placeholder="Contoh: Hitam putih, tanda di dahi">{{ old('warna') }}</textarea>
                <small class="form-help">Catatan: Deskripsi warna atau tanda khusus untuk identifikasi</small>
                @error('warna')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Data Pet</button>
                <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>

@include('layouts.resepsionis.footer')
@include('layouts.resepsionis.scripts')
