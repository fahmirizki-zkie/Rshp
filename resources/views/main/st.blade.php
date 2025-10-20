<html>
<head>
    <title>RSHP UNAIR</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/st.css') }}">
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
        <h2> Rumah Sakit Hewan Pendidikan</span></h2>
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
<div class="row">
      <div class="content1">
        <h2><strong>DIREKTUR UTAMA</strong></h2>
        <img class="direktur" src="{{ asset('img/direktur.png') }}" alt="direktur" />
        <h3><strong>Dr, Ira Sari Yudaniyanti, M.P., drh.</strong></h3>
      </div>
</div>
<div class="gambar">
      <div class="content1">
        <h2><strong>WAKIL DIREKTUR 1 <br> PELAYANAN MEDIS DAN, <br> PENELITIAN</strong></h2>
        <img class="direktur" src="{{ asset('img/wakil1.png') }}" alt="wakil direktur1" />
        <h3><strong>Dr. Nusdianto Triakoso, M.P., drh.</strong></h3>
      </div>

      <div class="content1">
        <h2><strong>WAKIL DIREKTUR 2 <br> PSUMBER DAYA MANUSIA, <br> SARANA PRASRANA DAN KEUANGAN</strong></h2>
        <img class="direktur" src="{{ asset('img/wakil2.png') }}" alt="wakil direktur2" />
        <h3><strong>Dr Miyayu Soneta S., M.Vet., Drh.</strong></h3>
      </div>
    </div>
<!-- content end -->

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