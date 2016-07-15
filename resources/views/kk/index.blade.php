@extends('app')
@section('nav_kartu_keluarga')
active
@endsection
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/cleantable.css') }}"/>
  <link rel="stylesheet" href="{{ url('style/specific/kk/index.css')}}" />
@endsection
@section('content')
  <div class='container'>
    <h4>Daftar Kartu Keluarga</h4>
    <a href="#" onclick="page.form.toggle(event)">advanced search</a>
    <div class='row'>
      <div class='col-md-12'>
        <form class='display-none' vile-weave='form' onsubmit="page.form.submit(event)">
            <div class="row">
              <div class='col-sm-12 text-right'>
                <button type="submit">Cari</button>
              </div>
            </div>
            <div class="row form-group">
              <div class='col-sm-12'>
                <label>Nomor Kartu Keluarga</label>
                <input type='text' name='nomor'/>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-6">
                <div class='row form-group'>
                  <div class='col-sm-12'>
                    <label>Nama Kepala Keluarga</label>
                    <input list='datalist-kepala' type='text' name='nama_kepala_keluarga'/>
                  </div>
                </div>
                <div class='row form-group'>
                  <div class='col-sm-12'>
                    <label>Alamat</label>
                    <input type='text' name='alamat'/>
                  </div>
                </div>
                <div class='row form-group'>
                  <div class='col-sm-6'>
                    <label>RT</label>
                    <input type='number' min="0" name='rt'/>
                  </div>
                  <div class='col-sm-6'>
                    <label>RW</label>
                    <input type='number' min="0" name='rw'/>
                  </div>
                </div>
                <div class='row form-group'>
                  <div class='col-sm-6'>
                    <label>Desa</label>
                    <input type='text' name='desa'/>
                  </div>
                  <div class='col-sm-6'>
                    <label>Kelurahan</label>
                    <input type='text' name='kelurahan'/>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class='row form-group'>
                  <div class='col-sm-12'>
                    <label>Kecamatan</label>
                    <input type='text' name='kecamatan'/>
                  </div>
                </div>
                <div class='row form-group'>
                  <div class='col-sm-6'>
                    <label>Kabupaten</label>
                    <input type='text' name='kabupaten'/>
                  </div>
                  <div class='col-sm-6'>
                    <label>Kota</label>
                    <input type='text' name='kota'/>
                  </div>
                </div>
                <div class='row form-group'>
                  <div class='col-sm-12'>
                    <label>Kode Pos</label>
                    <input type='text' name='kode_pos' pattern="\d*"/>
                  </div>
                </div>
                <div class='row form-group'>
                  <div class='col-sm-12'>
                    <label>Provinsi</label>
                    <input type='text' name='provinsi'/>
                  </div>
                </div>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-12'>
                <h4>Data Tambahan</h4>
                <div class='row'>
                  @foreach($kkTemplate as $template)
                    @if($template->type == 'date')
                    <div class='col-sm-3'>
                      <label>{{ $template->name }} Dari</label>
                      <input type='{{ $template->type }}' data-compare='>=' name='{{ $template->name }}'/>
                    </div>
                    <div class='col-sm-3'>
                      <label>{{ $template->name }} Ke</label>
                      <input type='{{ $template->type }}' data-compare='<=' name='{{ $template->name }}'/>
                    </div>
                    @else
                    <div class='col-sm-6'>
                      <label>{{ $template->name }}</label>
                      <input type='{{ $template->type }}' name='{{ $template->name }}'/>
                    </div>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
    <div class='pageno-container' vile-weave='tablePagesTop'>
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
    <div class='pageno-container' vile-weave='tablePagesBottom'>
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
    page.form.submit = function(e){
      e.preventDefault()
      page.list.get();
    }
    page.kkTemplate = JSON.parse(page.repo.kkTemplate)
    page.list = {}
    page.list.kk = []
    page.list.get = function(){
      var query = []
      page.form.find('input[name]').each(function(){
        var dataCompare = $(this).attr('data-compare') || 'like'
        var name = $(this).attr('name')
        var value = $(this).val()
        if(value.trim().length > 0){
          query.push([name,dataCompare,value])
        }
      })
      AppGlobal.ajax.json({
        url:page.repo.listUrl,
        method:'get',
        data:{query:JSON.stringify(query)},
        success: function(data){
          page.list.kk = data.data
          page.list.refresh();
          AppGlobal.sorter.activate(page.table)
          AppGlobal.sorter.paginate(page.table,function(pageNo,currentPageNo){
            var pageBullets = ''
            for(var i = 1; i<=pageNo; i++){
              pageBullets+=page.e.make('a',{onclick:'page.table.switchPage(event,'+i+')',class:'pageno'+(i==currentPageNo?' active':'')},i)
            }
            page.tablePagesTop.html(pageBullets)
            page.tablePagesBottom.html(pageBullets)
          })
          page.form.hide()
        }
      })
    }
    page.list.fromTemplate = function(obj){
      var body = ''
      for(var i = 0; i<page.kkTemplate.length; i++){
        var value = obj.data[page.kkTemplate[i]] || ''
        var printval = (page.kkTemplate[i].type == 'date' && value!='' ? dateEx.print(value):value)
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
          (page.e.make('td',{colspan:5,class:'text-center'},'belum ada kartu keluarga yang terdaftar'))+
          (page.e.make('td',{colspan:page.kkTemplate.length+9,class:'text-center'},'belum ada kartu keluarga yang terdaftar'))
        )
      }
      page.table.find('tbody').html(body)
    }
    page.list.get();
  })
  </script>
@endsection
