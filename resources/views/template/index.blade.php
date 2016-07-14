@extends('app')
@section('nav_template')
active
@endsection
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/specific/template/index.css') }}"/>
@endsection
@section('content')
  <div class='container'>
    <div class='row'>
      <div class='col-sm-6 templateContainer'>
        <h4>Template Kartu Keluarga</h4>
        <p>
          Menentukan field tambahan yang bisa dimasukkan ke dalam kartu keluarga
        </p>
        <div class='optional row'>
          <div class='col-md-12'>
            <h5>Field Tambahan</h5>
            <form vile-weave='formKK' onsubmit='page.template.submitKK(event,this)'>
              <div class='text-right'>
                <button type='submit'>Simpan</button>
              </div>
              <div class='list' vile-weave="listKK">
              </div>
              <div class='control text-right'>
                <button onclick='page.template.addKK(event,this)' type='button'>Tambah</button>
              </div>
            </form>
          </div>
        </div>
        <div class='mandatory row'>
          <div class='col-md-12'>
            <h5>Field Wajib</h5>
            <input type="text" value="Nomor Kartu Keluarga" disabled />
            <input type="text" value="Nama Kepala Keluarga" disabled />
            <input type="text" value="Alamat" disabled />
            <input type="text" value="RT" disabled />
            <input type="text" value="RW" disabled />
            <input type="text" value="Desa" disabled />
            <input type="text" value="Kelurahan" disabled />
            <input type="text" value="Kecamatan" disabled />
            <input type="text" value="Kabupaten" disabled />
            <input type="text" value="Kota" disabled />
            <input type="text" value="Kode Pos" disabled />
            <input type="text" value="Provinsi" disabled />
          </div>
        </div>
      </div>
      <div class='col-sm-6 templateContainer'>
        <h4>Template Penduduk</h4>
        <p>
          Menentukan data-data tambahan yang bisa dimasukkan ke dalam data penduduk
        </p>
        <div class='optional row'>
          <div class='col-md-12'>
            <h5>Field Tambahan</h5>
            <form vile-weave='formPenduduk' onsubmit='page.template.submitPenduduk(event,this)'>
              <div class='text-right'>
                <button type='submit'>Simpan</button>
              </div>
              <div class='list' vile-weave="listPenduduk">
              </div>
              <div class='control text-right'>
                <button onclick='page.template.addPenduduk(event,this)' type='button'>Tambah</button>
              </div>
            </form>
          </div>
        </div>
        <div class='mandatory row'>
          <div class='col-md-12'>
            <h5>Field Wajib</h5>
            <input type="text" value="Nama Lengkap" disabled />
            <input type="text" value="NIK" disabled />
            <input type="text" value="Jenis Kelamin" disabled />
            <input type="text" value="Tempat Lahir" disabled />
            <input type="text" value="Tanggal Lahir" disabled />
            <input type="text" value="Agama" disabled />
            <input type="text" value="Pendidikan" disabled />
            <input type="text" value="Jenis Pekerjaan" disabled />
            <input type="text" value="Status Pernikahan" disabled />
            <input type="text" value="Status Hubungan Dalam Keluarga" disabled />
            <input type="text" value="No Paspor" disabled />
            <input type="text" value="No KITAP/KITAS" disabled />
            <input type="text" value="Ayah" disabled />
            <input type="text" value="Ibu" disabled />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="repo">
    <div class='kkTemplate'>
      {{ json_encode($kkTemplate) }}
    </div>
      <div class='pendudukTemplate'>
        {{ json_encode($pendudukTemplate) }}
      </div>
    <div class='storekkUrl'>
      {{ route('template.storekk') }}
    </div>
    <div class='storePendudukUrl'>
      {{ route('template.storependuduk') }}
    </div>
  </div>
  <script>
  var page = {}
  $(document).ready(function(){
    AppGlobal.initialize(page)
    Vile.initialize(page)
    page.template = {}
    page.template.add = {}
    page.template.kk = []
    page.template.penduduk = []
    page.loadTemplate = function(){
      page.template.kk = JSON.parse(page.repo.kkTemplate)
      page.template.penduduk = JSON.parse(page.repo.pendudukTemplate)
      page.template.refreshKK();
      page.template.refreshPenduduk();
    }
    page.template.addInput = function(templateObj){
      return (
        page.e.make('div',{class:'row field-row'},(
          page.e.make('div',{class:'col-xs-2'},(
            page.e.make('button','&times;',{type:'button',onclick:'page.template.deleteField(event,this)'})
          ))+
          page.e.make('div',{class:'col-xs-6'},(
            page.e.make('input',{value:templateObj.name,type:'text',placeholder:'Nama field'})
          ))+
          page.e.make('div',{class:'col-xs-4'},(
            page.e.make('select',{value:templateObj.type},(
              page.e.make('option',{value:'text'},'text')+
              page.e.make('option',{value:'number'},'number')+
              page.e.make('option',{value:'date'},'date')
            ))
          ))
        ))
      )
    }
    page.template.deleteField = function(e,element){
      if($(element).hasClass('deletable')){
        $(element).parents('.field-row').remove()
      }else{
        $(element).addClass('deletable')
        setTimeout(function(){
          $(element).removeClass('deletable')
        },1000)
      }
    }
    page.template.addKK = function(e,element){
      e.preventDefault()
      page.listKK.append(page.template.addInput({type:'text',name:''}))
    }
    page.template.addPenduduk = function(e,element){
      e.preventDefault()
      page.listPenduduk.append(page.template.addInput({type:'text',name:''}))
    }
    page.template.submitKK = function(e,element){
      e.preventDefault()
      var template = []
      page.formKK.find('.field-row').each(function(){
        var name = $(this).find('input').val();
        var type = $(this).find('select').val();
        if(name.trim().length>0){
          template.push({name:name,type:type})
        }
      })
      AppGlobal.ajax.json({
        url:page.repo.storekkUrl,
        method:'post',
        data:{data:JSON.stringify({template:template})},
        success: AppGlobal.ajax.ajaxSuccess,
        error: AppGlobal.ajax.ajaxError
      })
    }
    page.template.submitPenduduk = function(e,element){
      e.preventDefault()
      var template = []
      page.formPenduduk.find('.field-row').each(function(){
        var name = $(this).find('input').val();
        var type = $(this).find('select').val();
        if(name.trim().length>0){
          template.push({name:name,type:type})
        }
      })
      AppGlobal.ajax.json({
        url:page.repo.storePendudukUrl,
        method:'post',
        data:{data:JSON.stringify({template:template})},
        success: AppGlobal.ajax.ajaxSuccess,
        error: AppGlobal.ajax.ajaxError
      })
    }
    page.template.refreshKK = function(){
      var body = ''
      for(var i = 0; i<page.template.kk.length; i++){
        body+=page.template.addInput(page.template.kk[i],i)
      }
      page.listKK.html(body)
    }
    page.template.refreshPenduduk = function(){
      var body = ''
      for(var i = 0; i<page.template.penduduk.length; i++){
        body+=page.template.addInput(page.template.penduduk[i],i)
      }
      page.listPenduduk.html(body)
    }
    page.loadTemplate()
  })
  </script>
@endsection
