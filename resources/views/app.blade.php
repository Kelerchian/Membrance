<!DOCTYPE html>
<html>
<head>
  @yield('head.before')
  <link rel="stylesheet" href="{{ url('framework/bootstrap/css/bootstrap.min.css') }}"/>
  <link rel="stylesheet" href="{{ url('style/font.css') }}" />
  <link rel="stylesheet" href="{{ url('style/app.css') }}" />
  <script src="{{ url('framework/jquery/jquery-3.0.0.min.js') }}"></script>
  <script src="{{ url('framework/vile/vile.js') }}"></script>
  @yield('head.after')
</head>
<body>
  <div class="container-fluid">
    <div class='row app-header'>
        <a href="{{ route('index')}}" class="col-md-4">
          <div class='app-title'>
            Data Warga Dusun
          </div>
          <div class='app-title-region'>
            <span class='app-title-dusun'>{{ config('kk.nama_dusun') }}</span>, <span class="app-title-desa">{{ config('kk.nama_desa') }}</span>
          </div>
        </a>
        <nav class="col-md-8">
          <a class="@yield('nav_kartu_keluarga')" href="#">Kartu Keluarga</a>
          <a class="@yield('nav_penduduk')" href="#">Penduduk</a>
          <a class="@yield('nav_rt_rws')" href="#">RT/RW</a>
        </nav>
    </div>
  </div>
  <div class='content'>
  @yield('content')
  </div>
</body>
</html>