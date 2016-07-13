<!DOCTYPE html>
<html>
<head>
  @yield('head.before')
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ url('framework/bootstrap/css/bootstrap.min.css') }}"/>
  <link rel="stylesheet" href="{{ url('style/font.css') }}" />
  <link rel="stylesheet" href="{{ url('style/app.css') }}" />
  <script src="{{ url('framework/jquery/jquery-3.0.0.min.js') }}"></script>
  <script src="{{ url('framework/vile/vile.js') }}"></script>
  <script src="{{ url('script/AppGlobal.js') }}"></script>
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
          <a href="{{ route('kk.index') }}" class="@yield('nav_kartu_keluarga')">Kartu Keluarga</a>
          <a class="@yield('nav_penduduk')" href="{{ route('penduduk.index') }}">Penduduk</a>
          <a class="@yield('nav_rt_rws')" href="#">RT/RW</a>
          <a class="" href="#">Template Penduduk</a>
        </nav>
    </div>
  </div>
  @include('globalmessage')
  <div class='content'>
  @yield('content')
  </div>
</body>
</html>
