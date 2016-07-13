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
      <table class='clean-table important' vile-weave='table'>
        <thead>
          <tr>
            <th colspan="4" class='buttons float-right'>
              <a href="{{ route('kk.add') }}"><span class='glyphicon glyphicon-plus'></span> Daftarkan Kartu Keluarga
              </a>
            </th>
          </tr>
          <tr>
            <th>
              No
            </th>
            <th>
              Nomor KK
            </th>
            <th>
              Kepala Keluarga
            </th>
            <th>
              Action
            </th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
  </div>
  <div id="repo">
    <div class="listUrl">
      {{ route('kk.list') }}
    </div>
    <div class="editUrl">
      {{ route('kk.edit','') }}
    </div>
  </div>
  <script>
  var page = {}
  $(document).ready(function(){
    AppGlobal.initialize(page)
    Vile.initialize(page)
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
    page.list.refresh = function(){
      var body = ''
      var kk = page.list.kk
      for(var i = 0; i<kk.length; i++){
        body+=page.e.make('tr',{},(
          page.e.make('td',i+1)
          +page.e.make('td',kk[i].name)
          +page.e.make('td',kk[i].data.nama_kepala_keluarga)
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
  })
  </script>
@endsection
