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
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7410075551015!2d112.78555967481299!3d-7.270285392736694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbd40a9784f5%3A0xe756f6ae03eab99!2sRumah%20Sakit%20Hewan%20Pendidikan%20Universitas%20Airlangga!5e0!3m2!1sid!2sid!4v1761053157152!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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