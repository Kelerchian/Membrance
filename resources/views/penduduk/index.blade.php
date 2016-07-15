@extends('app')
@section('nav_penduduk')
active
@endsection
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/cleantable.css') }}"/>
  <link rel="stylesheet" href="{{ url('style/specific/kk/index.css')}}" />
@endsection
@section('content')
<div class="container">
    <h4>Daftar Penduduk</h4>
    <a href="#" onclick="page.form.toggle(event)">advanced search</a>
    <div class='row'>
      <div class='col-md-12'>
        <form class='display-none' vile-weave='form' onsubmit="page.form.submit(event)">
          <div class="row">
            <div class='col-sm-12 text-right'>
              <button type="submit">Cari</button>
            </div>
          </div>
          <div class='row'>
            <div class='col-sm-6'>
              <label>Nama Lengkap</label>
              <input type='text' name='nama_lengkap'/>
            </div>
            <div class='col-sm-6'>
              <label>NIK</label>
              <input type='text' name='name'/>
            </div>
          </div>
          <div class='row'>
            <div class='col-sm-6'>
              <label>Jenis Kelamin</label>
              <input type='text' name='jenis_kelamin'/>
            </div>
            <div class='col-sm-6'>
              <label>Tempat Lahir</label>
              <input type='text' name='tempat_lahir'/>
            </div>
          </div>
          <div class='row'>
            <div class='col-sm-3'>
              <label>Tanggal Lahir Dari</label>
              <input type='date' data-compare=">=" name='tanggal_lahir'/>
            </div>
            <div class='col-sm-3'>
              <label>Tanggal Lahir Ke</label>
              <input type='date' data-compare="<=" name='tanggal_lahir'/>
            </div>
            <div class='col-sm-6'>
              <label>Agama</label>
              <input type='text' name='agama'/>
            </div>
          </div>
          <div class='row'>
            <div class='col-sm-6'>
              <label>Pendidikan</label>
              <input type='text' name='pendidikan'/>
            </div>
            <div class='col-sm-6'>
              <label>Jenis Pekerjaan</label>
              <input type='text' name='jenis_pekerjaan'/>
            </div>
          </div>
          <div class='row'>
            <div class='col-sm-6'>
              <label>Status Pernikahan</label>
              <input type='text' name='status_pernikahan'/>
            </div>
            <div class='col-sm-6'>
              <label>Status Hubungan Dalam Keluarga</label>
              <input type='text' name='status_hubungan_dalam_keluarga'/>
            </div>
          </div>
          <div class='row'>
            <div class='col-sm-6'>
              <label>No Paspor</label>
              <input type='text' name='no_paspor'/>
            </div>
            <div class='col-sm-6'>
              <label>No KITAS/KITAP</label>
              <input type='text' name='no_kitas_kitap'/>
            </div>
          </div>
          <div class='row'>
            <div class='col-sm-6'>
              <label>Ayah</label>
              <input type='text' name='ayah'/>
            </div>
            <div class='col-sm-6'>
              <label>Ibu</label>
              <input type='text' name='ibu'/>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-12'>
              <h4>Data Tambahan</h4>
              <div class='row'>
                @foreach($pendudukTemplate as $template)
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
    <div class=' overflow-x'>
      <table class="clean-table important" vile-weave="table">
          <thead>
              <tr>
                  <th rowspan="2" data-sorter="id">
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
                  <th rowspan="2" data-sorter="status_hubungan_dalam_keluarga">
                      Status Hubungan Dalam Keluarga
                  </th>
                  <th colspan="2">
                      Dokumen Imigrasi
                  </th>
                  <th colspan="2">
                      Nama Orang Tua
                  </th>
                  @foreach($pendudukTemplate as $template)
                      <th rowspan="2" data-sorter="{{$template->name}}">
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
    <div class='pageno-container' vile-weave='tablePagesBottom'>
    </div>
</div>
<div id='repo'>
  <div class='pendudukTemplate'>
    {{ json_encode($pendudukTemplate) }}
  </div>
  <div class='listUrl'>
    {{route('penduduk.list')}}
  </div>
  <div class='jumpKKUrl'>
    {{route('penduduk.jumpKK','')}}
  </div>
</div>
<script>
var page = {}
$(document).ready(function(){
  Vile.initialize(page)
  AppGlobal.initialize(page)
  page.form.submit = function(e){
    e.preventDefault()
    page.list.get();
  }
  page.pendudukTemplate = JSON.parse(page.repo.pendudukTemplate)
  page.list = {}
  page.list.penduduk = []
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
        page.list.penduduk = data.data
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
  page.list.fromTemplateLoad = function(obj){
    var body = ''
    for(var i = 0; i<page.pendudukTemplate.length; i++){
      var printval = (obj.data[page.pendudukTemplate[i].name] || '')
      printval = (page.pendudukTemplate[i].type == 'date' && printval!='' ? dateEx.print(printval):printval)
      body+=page.e.make('td',{'data-sorter':page.pendudukTemplate[i].name,'data-ori':obj.data[page.pendudukTemplate[i].name]},printval)
    }
    return body
  }
  page.list.loadRow = function(obj,index){
  var dateval = (obj.data.tanggal_lahir || '')
  printval = (dateval!='' ? dateEx.print(dateval):dateval)
    return page.e.make('tr',(
      page.e.make('td',{'data-sorter':'id','data-ori':obj.id},index+1)+
      page.e.make('td',{'data-sorter':'nama_lengkap','data-ori':obj.data.nama_lengkap},obj.data.nama_lengkap)+
      page.e.make('td',{'data-sorter':'nik','data-ori':obj.name},obj.name)+
      page.e.make('td',{'data-sorter':'jenis_kelamin','data-ori':obj.data.jenis_kelamin},obj.data.jenis_kelamin)+
      page.e.make('td',{'data-sorter':'tempat_lahir','data-ori':obj.data.tempat_lahir},obj.data.tempat_lahir)+
      page.e.make('td',{'data-sorter':'tanggal_lahir','data-ori':obj.data.tanggal_lahir},dateval)+
      page.e.make('td',{'data-sorter':'agama','data-ori':obj.data.agama},obj.data.agama)+
      page.e.make('td',{'data-sorter':'pendidikan','data-ori':obj.data.pendidikan},obj.data.pendidikan)+
      page.e.make('td',{'data-sorter':'jenis_pekerjaan','data-ori':obj.data.jenis_pekerjaan},obj.data.jenis_pekerjaan)+
      page.e.make('td',{'data-sorter':'status_pernikahan','data-ori':obj.data.status_pernikahan},obj.data.status_pernikahan)+
      page.e.make('td',{'data-sorter':'status_hubungan_dalam_keluarga','data-ori':obj.data.status_hubungan_dalam_keluarga},obj.data.status_hubungan_dalam_keluarga)+
      page.e.make('td',{'data-sorter':'no_paspor','data-ori':obj.data.no_paspor},obj.data.no_paspor)+
      page.e.make('td',{'data-sorter':'no_kitas_kitap','data-ori':obj.data.no_kitas_kitap},obj.data.no_kitas_kitap)+
      page.e.make('td',{'data-sorter':'ayah','data-ori':obj.data.ayah},obj.data.ayah)+
      page.e.make('td',{'data-sorter':'ibu','data-ori':obj.data.ibu},obj.data.ibu)+
      page.list.fromTemplateLoad(obj)+
      page.e.make('td',(
        page.e.make('a',{href:page.repo.jumpKKUrl+'/'+obj.id},'Lihat Kartu Keluarga')
      ))
    ))
  }
  page.list.refresh = function(){
    var body = ''
    var penduduk = page.list.penduduk
    for(var i = 0; i<penduduk.length; i++){
      body+=page.list.loadRow(penduduk[i],i)
    }
    if(penduduk.length == 0){
      body+=page.e.make('tr',
        (page.e.make('td',{colspan:5,class:'text-center'},'belum ada kartu keluarga yang terdaftar'))+
        (page.e.make('td',{colspan:page.pendudukTemplate.length+9,class:'text-center'},'belum ada kartu keluarga yang terdaftar'))
      )
    }
    page.table.find('tbody').html(body)
  }
  page.list.get()
})
</script>
@endsection
