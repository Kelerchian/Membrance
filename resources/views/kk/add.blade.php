@extends('app')
@section('nav_kartu_keluarga')
active
@endsection
@section('head.after')
  <link rel="stylesheet" href="{{ url('style/cleantable.css') }}"/>
  <link rel="stylesheet" href="{{ url('style/specific/kk/add.css') }}"/>
@endsection
@section('content')
  <div class='container'>
      <h4>Kartu Keluarga Baru</h4>
      <form onsubmit="page.list.submit(event)" vile-weave='form'>
        <div class="row">
          <div class='col-sm-12 text-right'>
            <button type="submit">Simpan</button>
          </div>
        </div>
        <div class="row form-group">
          <div class='col-sm-12'>
            <label>Nomor Kartu Keluarga</label>
            <input type='text' name='nomor' pattern="\d*" required/>
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
          <div class='col-sm-12 overflow-x'>
            <table class='mini-input clean-table' vile-weave="table">
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
                  @foreach($pendudukTemplate as $template)
                    <th rowspan="2">
                      {{ $template->name }}
                    </th>
                  @endforeach
                </tr>
                <tr>
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
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class='row'>
          <div class='col-sm-8'>
            <p>
              Catatan:
              <ul>
                <li>
                  Klik hapus dua kali untuk menghapus anggota keluarga
                </li>
              </ul>
            </p>
          </div>
          <div class="col-sm-4 text-right">
            <button type='button' onclick="page.list.add()">Tambah Anggota Keluarga</button>
          </div>
        </div>
        <div class='row'>
          <div class='col-md-12'>
            <h4>Data Tambahan</h4>
            <div class='row'>
              @foreach($kkTemplate as $template)
                <div class='col-sm-6'>
                  <label>{{ $template->name }}</label>
                  <input type='{{ $template->type }}' name='{{ $template->name }}'/>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </form>
  </div>
  <datalist id='datalist-kepala' vile-weave="datalistKepala">
  </datalist>
  <datalist id='datalist-ibu' vile-weave="datalistIbu">
  </datalist>
  <datalist id='datalist-ayah' vile-weave="datalistAyah">
  </datalist>
  <datalist id='datalist-gender' vile-weave="datalistGender">
    <option value='Laki-laki'></option>
    <option value='Perempuan'></option>
  </datalist>
  <datalist id='datalist-agama' vile-weave="datalistAgama">
  </datalist>
  <datalist id='datalist-pendidikan' vile-weave="datalistPendidikan">
  </datalist>
  <datalist id='datalist-pekerjaan' vile-weave="datalistPekerjaan">
  </datalist>
  <datalist id='datalist-pernikahan' vile-weave="datalistPernikahan">
  </datalist>
  <div id="repo">
    <div class='submitUrl'>
      {{ route('kk.add') }}
    </div>
    <div class='indexUrl'>
      {{ route('kk.index') }}
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
      page.list = {}
      page.pendudukTemplate = JSON.parse(page.repo.pendudukTemplate)
      page.list.delete = function(event,element){
        if($(element).hasClass('deleteable')){
          $(element).parents('tr').remove()
          page.list.refresh()
        }else{
          page.table.find('.deleteable').removeClass('deleteable')
          $(element).addClass('deleteable')
        }
      }
      page.list.makeOption = function(string){
        return page.e.make('option',{value:string})
      }
      page.list.refreshDatalist = function(){
        page.datalistAyah.children().remove()
        page.datalistIbu.children().remove()
        page.datalistKepala.children().remove()
        if(page.table.children('tbody').children('tr.dummy').length > 0){
          return;
        }
        page.table.children('tbody').children('tr').each(function(){

          var jk = $(this).find("input[data-name='jenis_kelamin']").val()
          var name = $(this).find("input[data-name='nama_lengkap']").val()
          if(jk.toLowerCase() == 'laki-laki'){
            page.datalistAyah.append(page.list.makeOption(name))
          }else if(jk.toLowerCase()=='perempuan'){
            page.datalistIbu.append(page.list.makeOption(name))
          }
          page.datalistKepala.append(page.list.makeOption(name))
        })
      }
      page.list.refresh = function(){
          page.table.children('tbody').children('tr.dummy').remove();
          var i = 1;
          page.table.children('tbody').children('tr').each(function(){
            $(this).children('td:nth-child(2)').text(i);
            $(this).find('.deleteable').removeClass('deleteable')
            i++;
          })
          if(i==1){
            page.table.children('tbody').append(
              page.e.make('tr',{class:'dummy text-center'},(
                page.e.make('td',{colspan:6},'Belum ada data')+
                page.e.make('td',{colspan:5},'Belum ada data')+
                page.e.make('td',{colspan:5+page.pendudukTemplate.length},'Belum ada data')
              ))
            )
          }
      }
      page.list.fromTemplate = function(){
        var body = ''
        for(var i = 0; i<page.pendudukTemplate.length; i++){
          body+=page.e.make('td',page.e.make('input',{type:page.pendudukTemplate[i].type,'data-name':page.pendudukTemplate[i].name}))
        }
        return body
      }
      page.list.newRow = function(){
        return page.e.make('tr',(
          page.e.make('td',page.e.make('button',{type:'button',onclick:'page.list.delete(event,this)'},'&times; hapus'))+
          page.e.make('td','')+
          page.e.make('td',page.e.make('input',{type:'text',onblur:'page.list.refreshDatalist()','data-name':'nama_lengkap'}))+
          page.e.make('td',page.e.make('input',{type:'text','data-name':'nik',pattern:'[0-9]*'}))+
          page.e.make('td',page.e.make('input',{type:'text',onblur:'page.list.refreshDatalist()',list:'datalist-gender','data-name':'jenis_kelamin'}))+
          page.e.make('td',page.e.make('input',{type:'text','data-name':'tempat_lahir'}))+
          page.e.make('td',page.e.make('input',{type:'date','data-name':'tanggal_lahir'}))+
          page.e.make('td',page.e.make('input',{type:'text',list:'datalist-agama','data-name':'agama'}))+
          page.e.make('td',page.e.make('input',{type:'text',list:'datalist-pendidikan','data-name':'pendidikan'}))+
          page.e.make('td',page.e.make('input',{type:'text',list:'datalist-pekerjaan','data-name':'jenis_pekerjaan'}))+
          page.e.make('td',page.e.make('input',{type:'text',list:'datalist-pernikahan','data-name':'status_pernikahan'}))+
          page.e.make('td',page.e.make('input',{type:'text','data-name':'status_hubungan_dalam_keluarga'}))+
          page.e.make('td',page.e.make('input',{type:'text','data-name':'no_paspor'}))+
          page.e.make('td',page.e.make('input',{type:'text','data-name':'no_kitas_kitap'}))+
          page.e.make('td',page.e.make('input',{type:'text',list:'datalist-ayah','data-name':'ayah'}))+
          page.e.make('td',page.e.make('input',{type:'text',list:'datalist-ibu','data-name':'ibu'}))+
          page.list.fromTemplate()
        ))
      }
      page.list.add = function(){
        var newrow = page.list.newRow()
        page.table.children('tbody').append(page.list.newRow())
        page.list.refresh()
      }
      page.list.submit = function(e){
        e.preventDefault()
        if(page.table.children('tbody').children('tr.dummy').length > 0){
          AppGlobal.postMessage('warning','Anggota Keluarga masih kosong')
          return;
        }
        var kk = {}
        kk.data = {}
        page.form.find('input[name]').each(function(){
          var val = $(this).val();
          var name = $(this).attr('name');
          if(name == 'nomor'){
            kk.name = val
          }else{
            kk.data[name] = val
          }
        })

        var penduduk = []
        try{
          page.table.children('tbody').children('tr').each(function(){
            var single = {}
            single.data = {}
            $(this).find('input[data-name]').each(function(){
              var name = $(this).attr('data-name')
              var val = $(this).val()
              if(name == 'nik'){
                single.name = val
                if(single.name.trim().length == 0){
                  var focuselement = this
                  setTimeout(function(){
                    focuselement.focus();
                  },1000)
                  throw 'NIK harus diisi';
                }
              }
              else if(name=='id'){
                single.id = val
              }
              else{
                single.data[name] = val
              }
            })
            penduduk.push(single)
          })
        }catch(e){
          AppGlobal.postMessage('warning',e);
          return;
        }
        AppGlobal.ajax.json({
          method: 'post',
          data: {kk:JSON.stringify(kk),penduduk:JSON.stringify(penduduk)},
          url: page.submitUrl,
          success: function(data){
            AppGlobal.storage.store('success',data.message)
            window.location = page.repo.indexUrl
          },
          error: AppGlobal.ajax.ajaxError
        })
      }
      page.list.refresh()
  })
  </script>
@endsection
