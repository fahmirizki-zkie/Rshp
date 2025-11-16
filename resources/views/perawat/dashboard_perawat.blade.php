@include('layouts.perawat.head')
@include('layouts.perawat.header')
@include('layouts.perawat.navbar')

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
<div class="container" style="max-width:600px; margin:60px auto 0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 32px rgba(38,82,149,0.10); padding:40px 32px; text-align:center;">
    <h1 style="font-size:2.4rem; font-weight:700; color:#265295; margin-bottom:18px; letter-spacing:1px;">
        Selamat Datang, {{ $user_nama }}!
    </h1>
    <p style="font-size:1.18rem; color:#4eb1cf; margin-bottom:12px; font-weight:500;">
        Anda berhasil login sebagai 
        <span style="color:#265295; font-weight:600;">Perawat RSHP UNAIR</span>.
    </p>
    <div style="margin:24px 0;">
        <span style="display:inline-block; background:linear-gradient(90deg,#4eb1cf 0%,#265295 100%); color:#fff; padding:10px 28px; border-radius:12px; font-size:1.08rem; font-weight:600; box-shadow:0 2px 8px rgba(38,82,149,0.10);">
            Kelola Rekam Medis di menu bawah.
        </span>
    </div>
    <div style="display:flex; gap:20px; justify-content:center; margin-top:30px; flex-wrap:wrap;">
        <a href="{{ route('perawat.rekam-medis') }}" 
           style="text-decoration:none; display:block; width:200px; padding:20px; background:linear-gradient(135deg, #4eb1cf 0%, #265295 100%); border-radius:15px; color:white; text-align:center; transition:transform 0.3s ease; box-shadow:0 4px 15px rgba(38,82,149,0.2);">
            <div style="font-size:2.5rem; margin-bottom:10px;">📋</div>
            <h3 style="margin:0; font-size:1.1rem; font-weight:600;">Rekam Medis</h3>
            <p style="margin:5px 0 0 0; font-size:0.9rem; opacity:0.9;">
                Kelola rekam medis pasien
            </p>
        </a>
    </div>
</div>
</div>

@include('layouts.perawat.footer')
@include('layouts.perawat.scripts')
