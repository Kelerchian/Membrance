@extends('app')
@section('nav_kartu_keluarga')
active
@endsection
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/cleantable.css') }}"/>
@endsection
@section('content')
  <div class='container'>
      <h4>Daftar Kartu Keluarga</h4>
      <div vile-weave='form'>
      </div>
      <div class='overflow-x'>
        <table class='clean-table important' vile-weave='table'>
          <thead>
            <tr>
              <th colspan="{{14+count($kkTemplate)}}" class='buttons float-left'>
                <a href="{{ route('kk.add') }}"><span class='glyphicon glyphicon-plus'></span> Daftarkan Kartu Keluarga
                </a>
              </th>
            </tr>
            <tr>
              <th data-sorter="id">
                No
              </th>
              <th data-sorter="nomor">
                Nomor KK
              </th>
              <th data-sorter="nama_kepala_keluarga">
                Kepala Keluarga
              </th>
              <th data-sorter="alamat">
                Alamat
              </th>
              <th data-sorter="rt">
                RT
              </th>
              <th data-sorter="rw">
                RW
              </th>
              <th data-sorter="desa">
                Desa
              </th>
              <th data-sorter="kelurahan">
                Kelurahan
              </th>
              <th data-sorter="kecamatan">
                Kecamatan
              </th>
              <th data-sorter="kabupaten">
                Kabupaten
              </th>
              <th data-sorter="kota">
                Kota
              </th>
              <th data-sorter="kode pos">
                Kode Pos
              </th>
              <th data-sorter="provinsi">
                Provinsi
              </th>
              @foreach($kkTemplate as $template)
              <th data-sorter="{{$template->name}}">
                {{$template->name}}
              </th>
              @endforeach
              <th>
                Action
              </th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
  </div>
  <div id="repo">
    <div class="listUrl">
      {{ route('kk.list') }}
    </div>
    <div class="editUrl">
      {{ route('kk.edit','') }}
    </div>
    <div class='kkTemplate'>
      {{ json_encode($kkTemplate) }}
    </div>
  </div>
  <script>
  var page = {}
  $(document).ready(function(){
    AppGlobal.initialize(page)
    Vile.initialize(page)
    page.kkTemplate = JSON.parse(page.repo.kkTemplate)
    page.list = {}
    page.list.kk = []
    page.list.get = function(){
      AppGlobal.ajax.json({
        url:page.repo.listUrl,
        method:'get',
        success: function(data){
          page.list.kk = data.data
          page.list.refresh();
        }
      })
    }
    page.list.fromTemplate = function(obj){
      var body = ''
      for(var i = 0; i<page.kkTemplate.length; i++){
        var value = obj.data[page.kkTemplate[i]]
        body+=page.e.make('td',{'data-sorter':page.kkTemplate[i],'data-ori':value},value)
      }
      return body
    }
    page.list.refresh = function(){
      var body = ''
      var kk = page.list.kk
      for(var i = 0; i<kk.length; i++){
        body+=page.e.make('tr',{},(
          page.e.make('td',{'data-sorter':'id','data-ori':kk[i].id},i+1)
          +page.e.make('td',{'data-sorter':'name','data-ori':kk[i].name},kk[i].name)
          +page.e.make('td',{'data-sorter':'nama_kepala_keluarga','data-ori':kk[i].data.nama_kepala_keluarga},kk[i].data.nama_kepala_keluarga)
          +page.e.make('td',{'data-sorter':'alamat','data-ori':kk[i].data.alamat},kk[i].data.alamat)
          +page.e.make('td',{'data-sorter':'rt','data-ori':kk[i].data.rt},kk[i].data.rt)
          +page.e.make('td',{'data-sorter':'rw','data-ori':kk[i].data.rw},kk[i].data.rw)
          +page.e.make('td',{'data-sorter':'desa','data-ori':kk[i].data.desa},kk[i].data.desa)
          +page.e.make('td',{'data-sorter':'kelurahan','data-ori':kk[i].data.kelurahan},kk[i].data.kelurahan)
          +page.e.make('td',{'data-sorter':'kecamatan','data-ori':kk[i].data.kecamatan},kk[i].data.kecamatan)
          +page.e.make('td',{'data-sorter':'kabupaten','data-ori':kk[i].data.kabupaten},kk[i].data.kabupaten)
          +page.e.make('td',{'data-sorter':'kota','data-ori':kk[i].data.kota},kk[i].data.kota)
          +page.e.make('td',{'data-sorter':'kode_pos','data-ori':kk[i].data.kode_pos},kk[i].data.kode_pos)
          +page.e.make('td',{'data-sorter':'provinsi','data-ori':kk[i].data.provinsi},kk[i].data.provinsi)
          +page.list.fromTemplate(kk[i])
          +page.e.make('td',page.e.make('a',{href:page.repo.editUrl+'/'+kk[i].id},'Ubah'))
        ))
      }
      if(kk.length == 0){
        body+=page.e.make('tr',
          (page.e.make('td',{colspan:4,class:'text-center'},'belum ada kartu keluarga yang terdaftar'))
        )
      }
      page.table.find('tbody').html(body)
    }
    page.list.get();
    AppGlobal.sorter.activate(page.table)
  })
  </script>
@endsection
