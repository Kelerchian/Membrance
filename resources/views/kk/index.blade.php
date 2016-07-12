@extends('app')
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/specific/index.css') }}"/>')
  <link rel="stylesheet" href="{{ url('style/cleantable.css') }}"/>
@endsection
@section('content')
  <div class='container'>
      <h4>Daftar Kartu Keluarga</h4>
      <table class='clean-table'>
        <thead>
          <th>
            No
          </th>
          <th>
            Nomor KK
          </th>
          <th>
            Kepala Keluarga
          </th>
        </thead>
      </table>
  </div>
  <script>

  </script>
@endsection
