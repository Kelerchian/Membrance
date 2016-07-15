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
                <th colspan="2" rowspan="2" data-sorter="id">
                    No
                </th>
                <th rowspan="2" data-sorter="nama_lengkap">
                    Nama Lengkap
                </th>
                <th rowspan="2" data-sorter="nik">
                    NIK
                </th>
                <th rowspan="2" data-sorter="jenis_kelamin">
                    Jenis Kelamin
                </th>
                <th rowspan="2" data-sorter="tempat_lahir">
                    Tempat Lahir
                </th>
                <th rowspan="2" data-sorter="tanggal_lahir">
                    Tanggal Lahir
                </th>
                <th rowspan="2" data-sorter="agama">
                    Agama
                </th>
                <th rowspan="2" data-sorter="pendidikan">
                    Pendidikan
                </th>
                <th rowspan="2" data-sorter="jenis_pekerjaan">
                    Jenis Pekerjaan
                </th>
                <th rowspan="2" data-sorter="status_pernikahan">
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
                @foreach($pendudukTemplate as $template)
                    <th rowspan="2">
                      {{ $template->name }}
                    </th>
                @endforeach
            </tr>
            <tr>
                <th data-sorter="no_paspor">
                    No Paspor
                </th>
                <th data-sorter="no_kitas">
                    No KITAS/KITAP
                </th>
                <th data-sorter="ayah">
                    Ayah
                </th>
                <th data-sorter="ibu">
                    Ibu
                </th>
            </tr>
        </thead>
    </table>
</div>
@endsection