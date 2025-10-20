<html>
<head>
    <title>RSHP UNAIR</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/my.css') }}">
</head>


<body>
<!-- Logo Start -->
<div class = "nav-content">
    <div class = "logokiri">
        <img src="{{ asset('img/unairr.png') }}" alt="Logo UNIAR">
    </div>

    <div class = "text">
        <h2>Universitas Airlangga |</h2>
    </div>

    <div class = "text2">
        <h2>Rumah Sakit Hewan Pendidikan</h2>
    </div>

    <div class = "logokanan">
        <img src="{{ asset('img/rshpp.png') }}" alt="Logo RSHP">
    </div>
</div>
<!-- Logo End -->

<!-- navbar start -->
<div class ="navbar">
    <a href="{{ route('home') }}" class="logo">RSHP<span> UNAIR.</span></a>

        <div class="navbar-nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a>
            <a href="{{ route('layanan-umum') }}">Layanan Umum</a>
            <a href="{{ route('visi-misi') }}">Visi Misi dan Tujuan</a>
        </div>
</div>
<!-- navbar end -->

<!-- content start -->
 <div class = "content" id = "home">
    <div class = content1>
        <h2>
        <strong>Your pet's health<br>is our <span>priority</span></strong>
        </h2>
        <p>Yuk, Cek kesehatan si manis agar selalu<br>ceria menemani hari-hari Anda</p>
        <a href = "#" class = "cta">Login</a>
    </div>
 </div>
<!-- content end -->

<!-- about start -->
<div class = "about">
    <h2>Selamat <span>Datang</span></h2>
</div>

<div class = about1>
    <div class = "about2">
        <p>
        Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan, maka dari itu Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai fitur pendaftaran online yang mempermudah untuk mendaftarkan hewan kesayangan anda
        </p>
    </div>

<div class="about3">
  <a href="https://maps.app.goo.gl/5L5bVHZgASq1NKFZA">
    <img src="{{ asset('img/maps.png') }}" alt="maps">
  </a>
</div>
</div>
<!-- about end -->

<!-- footer start -->
<div class = "footer">
    <div class = "footer1">
        <p>Jl. Mulyorejo No. 47, Surabaya, Jawa Timur 60115</p>
        <p>Telp: (031) 599 1234</p>
    </div>
</div>
<!-- footer end -->
 
</body>
</html>