@extends('app')
@section('nav_penduduk')
active
@endsection
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/cleantable.css') }}"/>
@endsection
@section('content')
<div class="container overflow-x">
    <h4>Daftar Penduduk</h4>
    <div vile-weave='form'>
    </div>
    <table class="clean-table important" vile-weave="table">
        <thead>
            <tr>
                <th colspan="2" rowspan="2">
                    No
                </th>
                <th rowspan="2">
                    Nama Lengkap
                </th>
                <th rowspan="2">
                    NIK
                </th>
                <th rowspan="2">
                    Jenis Kelamin
                </th>
                <th rowspan="2">
                    Tempat Lahir
                </th>
                <th rowspan="2">
                    Tanggal Lahir
                </th>
                <th rowspan="2">
                    Agama
                </th>
                <th rowspan="2">
                    Pendidikan
                </th>
                <th rowspan="2">
                    Jenis Pekerjaan
                </th>
                <th rowspan="2">
                    Status Pernikahan
                </th>
                <th rowspan="2">
                    Status Hubungan Dalam Keluarga
                </th>
                <th colspan="2">
                    Dokumen Imigrasi
                </th>
                <th colspan="2">
                    Nama Orang Tua
                </th>
                <th>
                    No Paspor
                </th>
                <th>
                    No KITAS/KITAP
                </th>
                <th>
                    Ayah
                </th>
                <th>
                    Ibu
                </th>
            </tr>
        </thead>
    </table>
</div>
@endsection