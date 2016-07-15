<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MDb;
use Excel;

class ExportController extends Controller
{
    public function exportKK(){

      $file = Excel::create(date('Y_m_d__h_i_s'),function($excel){
        $excel->setTitle('Daftar Kartu Keluarga per '.date('d-m-Y'));
        $excel->setCreator(config('kk.creator_header'));
        $excel->setCompany(config('kk.company_header'));
        $excel->setDescription('A demonstration to change the file properties');

        $kkTemplate = MDb::getFirstTypeName('template','kk');
        if($kkTemplate == null){$kkTemplate = array();}
        else{$kkTemplate = $kkTemplate->data->template;}
        $kks = MDb::getType('kk');

        $sheet1 = $excel->sheet('Daftar Kartu Keluarga',function($sheet)use($kks,$kkTemplate){
          $rowNo = 1;
          $index = 1;
          $sheet->row($rowNo,array('Daftar Kartu Keluarga'));
          $sheet->row($rowNo,function($row){
            $row->setFontSize(18);
          });
          $rowNo++;
          $sheet->row($rowNo,array('Dicetak oleh :','',config('kk.company_header')));
          $rowNo++;
          $sheet->row($rowNo,array('Pada tanggal :','',date('d-M-Y')));
          $rowNo++;
          $sheet->row($rowNo,array('Pukul :','',date('H:i:s')));
          $rowNo++;

          $headerArray = array();
          $headerArray[] = 'No';
          $headerArray[] = 'Nomor Kartu Keluarga';
          $headerArray[] = 'Nama_kepala_keluarga';
          $headerArray[] = 'Alamat';
          $headerArray[] = 'Rt';
          $headerArray[] = 'Rw';
          $headerArray[] = 'Desa';
          $headerArray[] = 'Kelurahan';
          $headerArray[] = 'Kecamatan';
          $headerArray[] = 'Kabupaten';
          $headerArray[] = 'Kota';
          $headerArray[] = 'Kode pos';
          $headerArray[] = 'Provinsi';
          foreach($kkTemplate as $template){
            $headerArray[] = $template->name;
          }
          $sheet->row($rowNo,$headerArray);

          $sheet->row($rowNo,function($row){
            $row->setBackground('#666666');
            $row->setFontColor('#eeeeee');
            $row->setFontWeight('bold');
          });
          $rowNo++;
          foreach($kks as $kk){
            $rowArray = array();
            $rowArray[] = $index;
            $rowArray[] = $kk->name;
            $rowArray[] = $kk->data->nama_kepala_keluarga;
            $rowArray[] = $kk->data->alamat;
            $rowArray[] = $kk->data->rt;
            $rowArray[] = $kk->data->rw;
            $rowArray[] = $kk->data->desa;
            $rowArray[] = $kk->data->kelurahan;
            $rowArray[] = $kk->data->kecamatan;
            $rowArray[] = $kk->data->kabupaten;
            $rowArray[] = $kk->data->kota;
            $rowArray[] = $kk->data->kode_pos;
            $rowArray[] = $kk->data->provinsi;
            foreach($kkTemplate as $template){
              $rowArray[] = $kk->data->{$template->name};
            }
            $sheet->row($rowNo,$rowArray);
            $index++;
            $rowNo++;
          }
          $sheet->setAutosize(true);
          $sheet->setWidth('A',5);

        });

        $sheet2 = $excel->sheet('Detail Penduduk',function($sheet)use($kks,$kkTemplate){
          $pendudukTemplate = MDb::getFirstTypeName('template','penduduk');
          if($pendudukTemplate == null){
            $pendudukTemplate = array();
          }else{
            $pendudukTemplate = $pendudukTemplate->data->template;
          }

          $headerArray = array();
          $headerArray[] = 'No';
          $headerArray[] = 'Nomor Kartu Keluarga';
          $headerArray[] = 'Nama_kepala_keluarga';
          $headerArray[] = 'Alamat';
          $headerArray[] = 'Rt';
          $headerArray[] = 'Rw';
          $headerArray[] = 'Desa';
          $headerArray[] = 'Kelurahan';
          $headerArray[] = 'Kecamatan';
          $headerArray[] = 'Kabupaten';
          $headerArray[] = 'Kota';
          $headerArray[] = 'Kode pos';
          $headerArray[] = 'Provinsi';
          foreach($kkTemplate as $template){
            $headerArray[] = $template->name;
          }
          $sheet->row(1,$headerArray);

          $headerArray = array();
          $headerArray[] = 'No';
          $headerArray[] = 'Nama Lengkap';
          $headerArray[] = 'NIK';
          $headerArray[] = 'Jenis Kelamin';
          $headerArray[] = 'Tempat Lahir';
          $headerArray[] = 'Tanggal Lahir';
          $headerArray[] = 'Agama';
          $headerArray[] = 'Pendidikan';
          $headerArray[] = 'Jenis Pekerjaan';
          $headerArray[] = 'Status Pernikahan';
          $headerArray[] = 'Status Hubungan Dalam Keluarga';
          $headerArray[] = 'No Paspor';
          $headerArray[] = 'No KITAS/KITAP';
          $headerArray[] = 'Ayah';
          $headerArray[] = 'Ibu';
          foreach($pendudukTemplate as $template){
            $headerArray[] = $template->name;
          }
          $sheet->row(2,$headerArray);

          $sheet->row(1,function($row){
            $row->setBackground('#666666');
            $row->setFontColor('#eeeeee');
            $row->setFontWeight('bold');
          });
          $sheet->row(2,function($row){
            $row->setBackground('#333333');
            $row->setFontColor('#eeeeee');
            $row->setFontWeight('bold');
          });
          $rowNo = 3;
          $bigIndex = 1;
          $index = 1;

          foreach($kks as $kk){
            $rowArray = array();
            $rowArray[] = $bigIndex;
            $rowArray[] = $kk->name;
            $rowArray[] = $kk->data->nama_kepala_keluarga;
            $rowArray[] = $kk->data->alamat;
            $rowArray[] = $kk->data->rt;
            $rowArray[] = $kk->data->rw;
            $rowArray[] = $kk->data->desa;
            $rowArray[] = $kk->data->kelurahan;
            $rowArray[] = $kk->data->kecamatan;
            $rowArray[] = $kk->data->kabupaten;
            $rowArray[] = $kk->data->kota;
            $rowArray[] = $kk->data->kode_pos;
            $rowArray[] = $kk->data->provinsi;
            foreach($kkTemplate as $template){
              $rowArray[] = $kk->data->{$template->name};
            }
            $sheet->row($rowNo,$rowArray);
            $sheet->row($rowNo,function($row){
              $row->setBackground('#dddddd');
            });
            $bigIndex++;
            $rowNo++;


            $penduduk = MDb::getTos('kk-penduduk',$kk->id);
            foreach ($penduduk as $sPenduduk) {
              $rowArray = array();
              $rowArray[] = $index;
              $rowArray[] = $sPenduduk->data->nama_lengkap;
              $rowArray[] = $sPenduduk->name;
              $rowArray[] = $sPenduduk->data->jenis_kelamin;
              $rowArray[] = $sPenduduk->data->tempat_lahir;
              $rowArray[] = $sPenduduk->data->tanggal_lahir;
              $rowArray[] = $sPenduduk->data->agama;
              $rowArray[] = $sPenduduk->data->pendidikan;
              $rowArray[] = $sPenduduk->data->jenis_pekerjaan;
              $rowArray[] = $sPenduduk->data->status_pernikahan;
              $rowArray[] = $sPenduduk->data->status_hubungan_dalam_keluarga;
              $rowArray[] = $sPenduduk->data->no_paspor;
              $rowArray[] = $sPenduduk->data->no_kitas_kitap;
              $rowArray[] = $sPenduduk->data->ayah;
              $rowArray[] = $sPenduduk->data->ibu;
              foreach($pendudukTemplate as $template){
                $rowArray[] = $sPenduduk->data->{$template->name};
              }
              $sheet->row($rowNo,$rowArray);
              $rowNo++;
              $index++;
            }
            $rowNo++;
          }
        });
      });
      $file->export('xls');
    }
}
