@extends('app')
@section('nav_penduduk')
active
@endsection
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/cleantable.css') }}"/>
@endsection
@section('content')
<div class="container">
    <h4>Daftar Penduduk</h4>
    <div vile-weave='form'>
    </div>
    <div class="table-page" vile-weave='tablePagesTop'>
    </div>
    <div class="overflow-x">
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
                    <th rowspan="2">
                        Action
                    </th>
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
            <tbody>
            </tbody>
        </table>
    </div>
    <div class='table-page' vile-weave='tablePagesBottom'>
    </div>
</div>
<div id='repo'>
    <div class='listUrl'>
        {{ route('penduduk.list') }}
    </div>
    <div class="editUrl">
        {{ route('penduduk.edit','') }}
    </div>
    <div class='pendudukTemplate'>
        {{ json_encode($pendudukTemplate) }}
    </div>
</div>
<script>
var page = {}
$(document).ready(function(){
    AppGlobal.initialize(page)
    Vile.initialize(page)
    page.pendudukTemplate = JSON.parse(page.repo.pendudukTemplate)
    page.list = {}
    page.list.penduduk = []
    page.list.get = function(){
        AppGlobal.ajax.json({
            url:page.repo.listUrl,
            method:'get',
            success:function(data){
                page.list.penduduk = data.data
                page.list.refresh()
                AppGlobal.sorter.activate(page.table)
                AppGlobal.sorter.paginate(page.table,function(pageNo,currentPageNo){
                    var pageBullets = ''
                    for(var i = 1; i<=pageNo; i++){
                        pageBullets+=page.e.make('a', {onclick:'page.table.switchPage(event,)'+(i==currentPageNo?'active':'')},i)
                    }
                    page.tablePagesTop.html(pageBullets)
                    page.tablePagesBottom.html(pageBullets)
                })
            }
        })
    }
    page.list.fromTemplate = function(obj){
        var body = ''
        for(var i = 0; i<page.pendudukTemplate.length; i++){
            var value = obj.data[page.pendudukTemplate[i]]
            body+=page.e.make('td',{'data-sorter':page.pendudukTemplate[i],'data-ori':value},value)
        }
        return body
    }
    
})
</script>
@endsection