@extends('app')
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/specific/index.css') }}"/>
@endsection
@section('content')
  <div class='container'>
    <h1 class='text-center'>
      Selamat Datang
    </h1>
    <p class="text-center">
      /deskripsi/
      <br />
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at est ex. Duis lectus libero, feugiat id rutrum eu, dapibus ac mauris. Nulla facilisi. Etiam mollis nulla at nisl ultricies viverra. Suspendisse dictum eget erat at cursus. Vestibulum consequat vulputate laoreet. Curabitur ornare nulla quam, id semper justo luctus vitae. Aliquam iaculis tincidunt ultrices. Nullam maximus augue sapien, at ultricies odio pellentesque sed.
      <br />
      /deskripsi/
    </p>
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
        <a href="#">
          <h4>Penduduk</h3>
          <p class='description'>
              Lihat dan cari daftar penduduk
          </p>
        </a>
      </div>
      <div class='col-md-4 text-center'>
        <a href="#">
          <h4>RT/RW</h3>
          <p class='description'>
            Lihat dan cari data berdasarkan RT dan RW
          </p>
        </a>
      </div>
    </div>
  </div>
@endsection
