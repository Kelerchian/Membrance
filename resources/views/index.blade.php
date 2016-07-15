@extends('app')
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/specific/index.css') }}"/>
@endsection
@section('content')
  <div class='container'>
    <h1 class='text-center'>
      Selamat Datang
    </h1>
    <div class='row cards important'>
      <div class='col-md-4 text-center'>
        <a href="{{ route('kk.index') }}">
          <h4>Kartu Keluarga</h3>
          <p class='description'>
              Lihat dan cari data kartu keluarga
          </p>
        </a>
      </div>
      <div class='col-md-4 text-center'>
        <a href="{{ route('penduduk.index') }}">
          <h4>Penduduk</h3>
          <p class='description'>
              Lihat dan cari daftar penduduk
          </p>
        </a>
      </div>
      <div class='col-md-4 text-center'>
        <a href="{{ route('template.index') }}">
          <h4>Template</h3>
          <p class='description'>
            Memanage template
          </p>
        </a>
      </div>
    </div>
  </div>
@endsection
