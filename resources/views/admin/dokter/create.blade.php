@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.navbar')

<div class="content-wrapper">
    <div class="container">
        <div class="main-content">
            <!-- ========== PAGE HEADER ========== -->
            <div class="page-header">
                <h1 class="page-title">Tambah Dokter Baru</h1>
                <p class="page-subtitle">Registrasi dokter dan assign role ke user yang dipilih.</p>
            </div>
            
            <!-- ========== BUTTON SECTION ========== -->
            <div class="button-section">
                <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <!-- ========== ALERT MESSAGES ========== -->
            @if(session('error'))
                <div class="alert alert--error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- ========== FORM TAMBAH DOKTER ========== -->
            <div class="form-container">
                <form method="POST" action="{{ route('admin.dokter.store') }}" class="form-modern">
                    @csrf
                    
                    <!-- Pilih User -->
                    <div class="form-group">
                        <label for="iduser" class="form-label">Pilih User <span class="required">*</span></label>
                        <select name="iduser" id="iduser" class="form-control @error('iduser') is-invalid @enderror" required>
                            <option value="">-- Pilih User --</option>
                            @foreach($availableUsers as $user)
                                <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                    {{ $user->nama }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('iduser')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bidang Dokter -->
                    <div class="form-group">
                        <label for="bidang_dokter" class="form-label">Bidang/Spesialisasi <span class="required">*</span></label>
                        <input type="text" 
                               name="bidang_dokter" 
                               id="bidang_dokter"
                               value="{{ old('bidang_dokter') }}"
                               class="form-control @error('bidang_dokter') is-invalid @enderror" 
                               placeholder="Contoh: Dokter Hewan Umum, Spesialis Bedah, dll"
                               maxlength="100"
                               required>
                        @error('bidang_dokter')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div class="form-group">
                        <label for="no_hp" class="form-label">No. HP <span class="required">*</span></label>
                        <input type="text" 
                               name="no_hp" 
                               id="no_hp"
                               value="{{ old('no_hp') }}"
                               class="form-control @error('no_hp') is-invalid @enderror" 
                               placeholder="Contoh: 081234567890"
                               maxlength="45"
                               required>
                        @error('no_hp')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat <span class="required">*</span></label>
                        <textarea name="alamat" 
                                  id="alamat"
                                  class="form-control @error('alamat') is-invalid @enderror" 
                                  placeholder="Masukkan alamat lengkap"
                                  rows="3"
                                  maxlength="100"
                                  required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="required">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Simpan Dokter</button>
                        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.06);
            margin-top: 14px;
            max-width: 760px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-modern {
            width: 100%;
            max-width: 720px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .required {
            color: #e53e3e;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .form-control.is-invalid {
            border-color: #fc8181;
        }

        .error-message {
            color: #e53e3e;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }

        textarea.form-control {
            resize: vertical;
            font-family: inherit;
        }
    </style>
</div>

@include('layouts.admin.footer')
@include('layouts.admin.scripts')
