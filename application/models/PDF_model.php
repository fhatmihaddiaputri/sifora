<?php  
/**
 * 
 */
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use NcJoes\OfficeConverter\OfficeConverter;

class PDF_model extends CI_Model
{
	
	
	function generateSKKPPanitera($data, $jenis_kp){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		//var_dump($data);
		$unitkerja='';
					//$no=1; foreach ($datask as $data): 
		      

		/*$data = array('id' => '',
  							'skpangkatnoid'=>$hasil['skpangkatnoid'],
  							'skpangkatindx'=>$hasil['skpangkatindx'],
  							'nip'=>$hasil['nipnmrc'],
  							'nama'=>$hasil['nama'],
  							'tempat_lahir'=>$hasil['tptlhr'],
  							'tgl_lahir'=>$hasil['tgllhr'],
  							'sknmrpertek'=>$hasil['sknmrkeputusn'],
  							'sktglpertek'=>$hasil['sktglkeputusn'],
  							'sknomor'=>$hasil['sknmrskkenaikn'] ,
  							'sktgl'=>$hasil['sktgltdkenaikn'],
  							'gol_baru'=>$hasil['skpangkatbaru'],
  							'tmt_gol_baru'=>$hasil['sktglskkenaikn'],
  							'mk_tahun'=>$hasil['skpangkatlthn'],
  							'mk_bulan'=>$hasil['skpangkatlbln'],
  							'tmt_gol_lama'=>$hasil['skpangkatltmt'],
  							'gol_lama'=>$hasil['skpangkatlama'],
  							'pt'=>$hasil['ptnama'],
  							'pn'=>$hasil['pnnama'],
  							'jabatan'=>$hasil['jabatan'],
  							'pendidikan'=>$pdk,
  							'gaji'=>$hasil['skpangkatgaji'],
  							'tunjangan'=>$hasil['skpangkattunj'],
  							'qrcode'=>$hasil['skpangkatcatat'],
  							'id_stage'=>$stage[0]['start_stage'],
  							'id_status'=>'7',
  							'updated_date'=>$update_date,
  							'updated_user_id'=>$this->session->userdata('userid'),
  							'keterangan'=>'syncronized',
  							'file_loc'=>''
  						);*/
  				$pangkat_lama = $this->pangkat_model->get_pangkat($data['gol_lama']);
  				$pangkat_baru = $this->pangkat_model->get_pangkat($data['gol_baru']);
  				//var_dump($pangkat_lama);
  				//echo $pangkat_lama[0]['pangkat'];
  				$unitkerja ='Pengadilan Tinggi '.$data['pt'];
  				if($data['pn']!==''){
  					$unitkerja='Pengadilan Negeri '.$data['pn'];
  				}
				$filename= APPPATH."docx\SK_KPO_PANITERA.doc";
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TanggalSK',$this->tgl_indo($data['sktgl']));
					$templateProcessor->setValue('NomorSK',$data['sknomor']);
					$templateProcessor->setValue('NoPertek',$data['sknmrpertek']);
					$templateProcessor->setValue('TglPertek',$this->tgl_indo($data['sktglpertek']));
					$templateProcessor->setValue('Nama',$data['nama']);
					$templateProcessor->setValue('TptLahir',$data['tempat_lahir']);
					$templateProcessor->setValue('TglLahir',$this->tgl_indo($data['tgl_lahir']));
					$templateProcessor->setValue('NIP',$data['nip']);
					$templateProcessor->setValue('Pendidikan',$data['pendidikan']);
					$templateProcessor->setValue('PangkatLama',$pangkat_lama[0]['pangkat']);
					$templateProcessor->setValue('GolLama',$data['gol_lama']);
					$templateProcessor->setValue('TmtGolLama',$this->tgl_indo($data['tmt_gol_lama']));
					$templateProcessor->setValue('TmtGolBaru',$this->tgl_indo($data['tmt_gol_baru']));
					$templateProcessor->setValue('Jabatan',$data['jabatan']);
					$templateProcessor->setValue('UnitKerja',$unitkerja);
					$templateProcessor->setValue('PangkatBaru',$pangkat_baru[0]['pangkat']);
					$templateProcessor->setValue('GolBaru',$data['gol_baru']);
					$templateProcessor->setValue('mkTahun',$data['mk_tahun']);
					$templateProcessor->setValue('mkBulan',$data['mk_bulan']);
					$templateProcessor->setValue('Gapok',convRupiah($data['gaji']));
					$templateProcessor->setValue('TerbilangGapok',terbilang($data['gaji']).' rupiah ');
					//$templateProcessor->setValue('QrCode','112');
					

					//* *******************menu tambahin qrcode************************
					$qrloc=$this->qrcode($data['qrcode']);
					$templateProcessor->setImageValue('QrCode', $qrloc);
					// ************* end create qrcode ****************/

					//echo terbilang($data['gaji']);

					
					$pathToSave = APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.docx';
					echo $pathToSave;
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo($data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf'); //generates pdf file in same directory as test-file.docx
	//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('skpangkatnoid' => $data['skpangkatnoid'], 'skpangkatindx'=>$data['skpangkatindx'] );
		$this->db->where($where);


		//  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
    
		//$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		
				if($jenis_kp==='kpo'){

					$this->db->update('tbl_skkpo_panitera_data',$data_update);
				}else{
						$this->db->update('tbl_skkp_panitera_data',$data_update);

				}
			
	
	}




public function qrcode($data)
	{
		$this->load->library('ciqrcode'); //meload library barcode
		$this->load->helper('url'); //meload helper url untuk aktifkan base urlnya
        $barcode_create=$data; // membuat code barcode yang nilainya 123456789

        //settingang pada barcode 
        $params['data'] = $barcode_create;
		$params['level'] = 'H';
		$params['size'] =9;

		//settingan untuk membuat file barcode dalam format .png dan di simpan dalam folder assets
		$params['savename'] = FCPATH . "assets/".$barcode_create.".png";
		//mulai menggenerate barcode
		$this->ciqrcode->generate($params);

		//mencoba mengeluarkan nilai barcode yang baru saja di generate
		echo '<img src="'.base_url().'assets/'.$barcode_create.'.png" />';
		echo $params['savename'] ;
		return $params['savename'] ;
	}
public function qrcodeSurat($data, $name)
	{
		$this->load->library('ciqrcode'); //meload library barcode
		$this->load->helper('url'); //meload helper url untuk aktifkan base urlnya
        $barcode_create=$data; // membuat code barcode yang nilainya 123456789

        //settingang pada barcode 
        $params['data'] = $barcode_create;
//		$params['level'] = 'M';
		 $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
       
		//settingan untuk membuat file barcode dalam format .png dan di simpan dalam folder assets
		$params['savename'] = FCPATH . "assets/".$name.".png";
		//mulai menggenerate barcode
		$this->ciqrcode->generate($params);

		//mencoba mengeluarkan nilai barcode yang baru saja di generate
		//echo '<img src="'.base_url().'assets/'.$name.'.png" />';
		//echo $params['savename'] ;
		return $params['savename'] ;
	}

function generateSurat($data, $kode_surat){
	//var_dump($data);
	$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		$unitkerja='';
					
  		$pangkat = $this->pangkat_model->get_pangkat($data[0]['gol']);
  	//	var_dump($pangkat);
  				$unitkerja ='Pengadilan Tinggi '.$data[0]['pt'];
  				if($data[0]['pn']!==''){
  					$unitkerja='Pengadilan Negeri '.$data[0]['pn'];
  				}
		$filename= APPPATH."docx\Surat Izin Belajar.docx";

					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
		//echo "masuk sini :".$filename.'|'.$data[0]['nip'];
				//	echo $data[0]['no_surat'];
					$templateProcessor->setValue('Nomor',$data[0]['no_surat']);
					$templateProcessor->setValue('Nama',$data[0]['nama']);
					$templateProcessor->setValue('NIP',$data[0]['nip']);
					$templateProcessor->setValue('Gol',$data[0]['gol']);
					$templateProcessor->setValue('Tanggal',$this->tgl_indo($data[0]['tgl_surat'],'D F Y'));
					$templateProcessor->setValue('Pangkat',$pangkat[0]['pangkat']);
					$templateProcessor->setValue('Jabatan',ucwords(strtolower($data[0]['jabatan'])));
					$templateProcessor->setValue('UnitKerja',ucwords(strtolower($unitkerja)));
					$templateProcessor->setValue('ProgramStudi',ucwords(strtolower($data[0]['pendidikan'])));
					$templateProcessor->setValue('PerguruanTinggi',$data[0]['universitas']);
					$templateProcessor->setValue('NamaPT','Pengadilan Tinggi '.ucwords(strtolower($data[0]['pt'])));
					$templateProcessor->setValue('NamaPN','Pengadilan Tinggi '.ucwords(strtolower($data[0]['pn'])));
				
					//* *******************menu tambahin qrcode************************
					$qrcode = 'Jenis Surat : '.$kode_surat.'| NIP : '. $data[0]['nip'].'| Nama : '. $data[0]['nama'].'| No Surat :'.$data[0]['no_surat'].'| tgl Surat : '.$data[0]['tgl_surat'].'| pembuat : '.$data[0]['create_name'];
					$name= $data[0]['id'].'_'.$kode_surat.'_'.$data[0]['nip'];
					$qrloc=$this->qrcodeSurat($qrcode, $name);
					$templateProcessor->setImageValue('QrCode', $qrloc);
					$templateProcessor->setImageValue('QrCode', array('src' => $qrloc, 'width' => 100, 'height' => 100, 'ratio' => false));
					//$templateProcessor->setImageValue('QrCode',array('src' => $qrloc,'swh'=>'1000', 'size'=>array(0=>10, 1=>10)));

					// ************* end create qrcode ****************/

		
					$pathToSave = APPPATH.'docx\SURAT\PANITERA\\'.$data[0]['id'].'_'.$kode_surat.'_'.$data[0]['nip'].'.docx';
					//echo $pathToSave;
					$templateProcessor->saveAs($pathToSave);
					// if you are using composer, just use this
					
					$converter = new OfficeConverter($pathToSave);
					$converter->convertTo($data[0]['id'].'_'.$kode_surat.'_'.$data[0]['nip'].'.pdf'); //generates pdf file in same directory as test-file.docx
					$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
					$where = array('id' => $data[0]['id'] );
					$this->db->where($where);


					$data_update = array('file_loc' => APPPATH.'docx\SURAT\PANITERA\\'.$data[0]['id'].'_'.$kode_surat.'_'.$data[0]['nip'].'.pdf' );
					$table = 'tbl_'.$this->session->userdata('group_name').'_'.$kode_surat;
					$this->db->update($table,$data_update);
					$this->load->helper('download');
			  		force_download(APPPATH.'docx\SURAT\PANITERA\\'.$data[0]['id'].'_'.$kode_surat.'_'.$data[0]['nip'].'.pdf' , null);
				}



function generateSKMutasiPanitera2($data,$datagroup, $jenis){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		$this->load->model('SKMutasi_Panitera_model');

		$temp_sk = $this->SKMutasi_Panitera_model->getTemplate($datagroup[0]['id_jenis']);
		
		
		// array(1) { [0]=> array(14) { ["id"]=> string(2) "24" ["skmutasinoid"]=> string(2) "10" ["tgl_tpm"]=> string(10) "2019-07-03" ["nomor_sk"]=> string(26) "2503/DJU/SK/KP.04.5/7/2019" ["tgl_sk"]=> string(10) "2019-07-23" ["dirjen"]=> string(14) "HERRI SWANTORO" ["direktur"]=> string(8) "HASWANDI" ["kasubdit"]=> string(13) "J. KAMALUDDIN" ["nama_dipa"]=> string(78) "Segala biaya yang bertalian dengan pemindahan ini tidak ditanggung oleh Negara" ["desc"]=> NULL ["updated_date"]=> string(19) "2021-04-29 18:50:42" ["updated_user_id"]=> string(2) "16" ["jumlah"]=> string(1) "4" ["file_loc_otentik"]=> string(0) "" } } 
		/*
		array(1) {
		  [0]=>
		  array(26) {
		    ["id"]=>
		    string(1) "9"
		    ["id_group_sk"]=>
		    string(2) "10"
		    ["id_sk"]=>
		    string(1) "3"
		    ["no_urut"]=>
		    string(1) "3"
		    ["nip"]=>
		    string(21) "19750918 199903 1 005"
		    ["nama"]=>
		    string(21) "ABDUL SHOMAD, SH., MH"
		    ["jabatan_lama"]=>
		    string(18) "Panitera Pengganti"
		    ["pt_lama"]=>
		    string(7) "Jakarta"
		    ["pn_lama"]=>
		    string(13) "Jakarta Pusat"
		    ["kelas_lama"]=>
		    string(5) "I.A.K"
		    ["jabatan_baru"]=>
		    string(18) "Panitera Pengganti"
		    ["pt_baru"]=>
		    string(6) "Banten"
		    ["pn_baru"]=>
		    string(6) "Serang"
		    ["tunjangan"]=>
		    string(6) "360000"
		    ["pangkat"]=>
		    string(12) "Penata Tk. I"
		    ["gol"]=>
		    string(5) "III/d"
		    ["kelas_baru"]=>
		    string(3) "I.A"
		    ["kppn_lama"]=>
		    string(10) "Jakarta VI"
		    ["kppn_baru"]=>
		    string(6) "Serang"
		    ["id_stage"]=>
		    string(1) "5"
		    ["id_status"]=>
		    string(1) "7"
		    ["keterangan"]=>
		    string(1) "0"
		    ["file_loc_petikan"]=>
		    string(0) ""
		    ["file_loc_salinan"]=>
		    string(0) ""
		    ["updated_user_id"]=>
		    string(2) "16"
		    ["updated_date"]=>
		    string(19) "2021-04-29 18:50:42"
		  }
		}

		*/
		//echo $jenis;// Salinan
		if($jenis==='Salinan'){
			//$filename= APPPATH."docx\\temp_sk\mutasi\panitera\Salinan.docx";
			$filename= $temp_sk[0]['url_salinan'];
		}elseif($jenis==='Petikan'){
			//$filename= APPPATH."docx\\temp_sk\mutasi\panitera\Petikan.docx";
			$filename= $temp_sk[0]['url_petikan'];
		}else{
			
		}
		$satkerLama= 'Pengadilan Tinggi '.$data['pt_lama'];
		$pnlama='-';
		$kelaslama=  ''; 
		if($data['pn_lama']!=='-'){
			$satkerLama= 'Pengadilan Negeri '.$data['pn_lama'];
			$kelaslama = 'Kelas '.$data['kelas_lama']; 
			$pnlama= $data['pn_lama'];

		}
		/*$satkerBaru= 'Pengadilan Tinggi '.$data[0]['pt_baru'];
		$pnbaru='-';
		$kelasbaru = ''; 
		if($data[0]['pn_baru']!=='-'){
			$satkerBaru= 'Pengadilan Negeri '.$data[0]['pn_baru'];
			$pnbaru=$data[0]['pn_baru'];
			$kelasbaru = 'Kelas '.$data[0]['kelas_baru']; 
		}
		*/
		$satkerBaru= 'Pengadilan Tinggi '.$data['pt_baru'];
		$pnbaru='.';
		$kelasbaru = 'Tipe '.$data['kelas_baru']; 
		if($data['pn_baru']!=='-'&&$data['pn_baru']!==$data['pn_lama']){
			$satkerBaru= 'Pengadilan Negeri '.$data['pn_baru'];
			if($pnlama!=='-'){
				$pnbaru=' dan '.$data['pn_baru'].'.';
			}else{
				$pnlama='';
				$pnbaru=$data['pn_baru'].'.';
			}
			
			$kelasbaru = 'Kelas '.$data['kelas_baru']; 
		}elseif($data['pn_baru']!=='-'&&$data['pn_baru']===$data['pn_lama']){
			$satkerBaru= 'Pengadilan Negeri '.$data['pn_baru'];
			//if($pnlama!=='-'){
				$pnbaru='.';
			//}else{
			//	$pnbaru=$data['pn_baru'].'.';
			//}
			
			$kelasbaru = 'Kelas '.$data['kelas_baru']; 

		}
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					$templateProcessor->setValue('nourut',$data['no_urut']);
					$no_awal='1. s.d. ';
					$no_akhir= $datagroup[0]['jumlah'];
					if($data['no_urut']==='1'){
						$no_awal='';
						$noakhir =(int)$data['no_urut']+1;
						$no_akhir= $noakhir.' s.d. '. $no_akhir.'.';
					}elseif($data['no_urut']===$no_akhir){
						$noakhir= (int)$no_akhir-1;
						$no_awal = '1. s.d. '. $noakhir.'.';
						$no_akhir= '';

					}else{

						$noawal = (int)$data['no_urut']-1;
						if($noawal===1){
							$no_awal='1.';
						}else{
							$no_awal= $no_awal .$noawal.'.';
						}
						$noakhir= (int)$data['no_urut']+1;
						
						if($noakhir===(int)$no_akhir){
							$no_akhir=$no_akhir.'.';
						}else{
							$no_akhir= $noakhir.'. s.d. '.  $no_akhir.'.';
						}
						

					}
					$templateProcessor->setValue('noawal',$no_awal);
					$templateProcessor->setValue('noakhir',$no_akhir);
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('Nama',$data['nama']);
					$templateProcessor->setValue('NIP',$data['nip']);
					$templateProcessor->setValue('Pangkat',$data['pangkat']);
					$templateProcessor->setValue('Gol',$data['gol']);
					//$templateProcessor->setValue('Gol',$data[0]['gol']);
					$templateProcessor->setValue('jablama',$data['jabatan_lama']);
					$templateProcessor->setValue('satkerLama',$satkerLama);
					$templateProcessor->setValue('NamaPNLama',$pnlama);
					$templateProcessor->setValue('NamaPTLama',$data['pt_lama']);
					$templateProcessor->setValue('nourut',$data['no_urut']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					$templateProcessor->setValue('jabbaru',$data['jabatan_baru']);
					$templateProcessor->setValue('satkerBaru',$satkerBaru);
					$templateProcessor->setValue('NamaPNBaru',$pnbaru);
					$namaptbaru= ' dan '.$data['pt_baru'].'.';
					if($data['pt_baru']===$data['pt_lama']){
							$namaptbaru='.';
					}
					$templateProcessor->setValue('NamaPTBaru',$namaptbaru);
					
					//$templateProcessor->setValue('NamaPTBaru',' dan '.$data['pt_baru']);
					$templateProcessor->setValue('NamaKPPNLama',$data['kppn_lama']);
					
					$templateProcessor->setValue('NamaKPPNBaru',' dan '.$data['kppn_baru']);
				


					$templateProcessor->setValue('NamaKPPNBaru',$data['kppn_baru']);
					$templateProcessor->setValue('NamaKPPNLama',$data['kppn_lama'].' ');
					$templateProcessor->setValue('tunjanganLama',convRupiah($data['tunjangan']));
					$templateProcessor->setValue('ejaanLama',terbilang($data['tunjangan']).' rupiah ');
					$templateProcessor->setValue('tunjanganBaru',convRupiah($data['tunjangan']));
					$templateProcessor->setValue('ejaanBaru',terbilang($data['tunjangan']).' rupiah ');
					if($kelasbaru==='Tipe B'){
						$kelasbaru='';
					}
					$templateProcessor->setValue('kelasBaru',$kelasbaru);
					

					//* *******************menu tambahin qrcode************************//
					$qrcode= "Dokumen ini ditandatangani secara Elektronik oleh:\n";
					if($jenis==='Salinan'){
						$qrcode= $qrcode." Nama : ".$datagroup[0]['direktur']."\n Jabatan : Direktur Pembinaan Tenaga Teknis Peradilan Umum.\n";
					//	$qrloc=$this->qrcodeMutasiHakim($qrcode, 'Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
					//	$templateProcessor->setImageValue('qrcode', $qrloc);
					
					}else{
						$qrcode= $qrcode." Nama : ".$datagroup[0]['dirjen']."\n Jabatan : Direktur Jenderal Badan Peradilan Umum.\n";
						//$qrloc=$this->qrcodeMutasiHakim($qrcode, 'Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
						
					}
					$qrcode= $qrcode."SK Mutasi Kepaniteraan a.n. \n Nama : ".$data['nama']."\n Nip :".$data['nip']."\n Nomor SK : ".$datagroup[0]['nomor_sk']."\n Tanggal SK : ".$datagroup[0]['tgl_sk'];
					
					$qrloc=$this->qrcodeMutasiPanitera($qrcode, $jenis.'_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip']);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					
					// ************* end create qrcode ****************/
					//if($jenis==='Salinan'){
						$pathToSave = APPPATH.'docx\SK\MUTASI\PANITERA\\'.$jenis.'_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.docx';
						
						
				//	}elseif($jenis==='Petikan'){
				//		$pathToSave = APPPATH.'docx\SK\MUTASI\PANITERA\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.docx';
					
				//	}else{
						
				//	}
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		//if($jenis==='Salinan'){
		$converter->convertTo($jenis.'_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.pdf'); //generates pdf file in same directory as test-file.docx
		//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx
		//}elseif($jenis==='Petikan'){
		//	$converter->convertTo('Petikan_'.$data['id_group_sk'].'_'.$data['id_sk'].'_'.$data['nip'].'.pdf');
		//}else{
			

		//}

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		unlink($pathToSave);

		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('id_group_sk' => $data['id_group_sk'], 'id_sk'=>$data['id_sk'] );
		$this->db->where($where);


		//  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
    
		//$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		if($jenis==='Salinan'){
			$data_update = array('file_loc_salinan' => APPPATH.'docx\SK\MUTASI\PANITERA\Salinan_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.pdf' );

		}else{
			$data_update = array('file_loc_petikan' => APPPATH.'docx\SK\MUTASI\PANITERA\Petikan_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_panitera_data',$data_update);
	
	
	}

function generateSKMutasiPanitera($data,$datagroup, $jenis){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		$this->load->model('SKMutasi_Panitera_model');

		$temp_sk = $this->SKMutasi_Panitera_model->getTemplate($datagroup[0]['id_jenis']);
		
		
		
		if($jenis==='Salinan'){
			//$filename= APPPATH."docx\\temp_sk\mutasi\panitera\Salinan.docx";
			$filename= $temp_sk[0]['url_salinan'];
		}elseif($jenis==='Petikan'){
			//$filename= APPPATH."docx\\temp_sk\mutasi\panitera\Petikan.docx";
			$filename= $temp_sk[0]['url_petikan'];
		}else{
			
		}
		$satkerLama= 'Pengadilan Tinggi '.$data[0]['pt_lama'];
		$pnlama='-';
		$kelaslama=  ''; 
		if($data[0]['pn_lama']!=='-'){
			$satkerLama= 'Pengadilan Negeri '.$data[0]['pn_lama'];
			$kelaslama = 'Kelas '.$data[0]['kelas_lama']; 
			$pnlama= $data[0]['pn_lama'];

		}
		/*$satkerBaru= 'Pengadilan Tinggi '.$data[0]['pt_baru'];
		$pnbaru='-';
		$kelasbaru = ''; 
		if($data[0]['pn_baru']!=='-'){
			$satkerBaru= 'Pengadilan Negeri '.$data[0]['pn_baru'];
			$pnbaru=$data[0]['pn_baru'];
			$kelasbaru = 'Kelas '.$data[0]['kelas_baru']; 
		}
		*/
		$satkerBaru= 'Pengadilan Tinggi '.$data[0]['pt_baru'];
		$pnbaru='.';
		$kelasbaru = 'Tipe '.$data[0]['kelas_baru']; 
		if($data[0]['pn_baru']!=='-'&&$data[0]['pn_baru']!==$data[0]['pn_lama']){
			$satkerBaru= 'Pengadilan Negeri '.$data[0]['pn_baru'];
			if($pnlama!=='-'){
				$pnbaru=' dan '.$data[0]['pn_baru'].'.';
			}else{
				$pnlama='';
				$pnbaru=$data[0]['pn_baru'].'.';
			}
			
			$kelasbaru = 'Kelas '.$data[0]['kelas_baru']; 
		}elseif($data[0]['pn_baru']!=='-'&&$data[0]['pn_baru']===$data[0]['pn_lama']){
			$satkerBaru= 'Pengadilan Negeri '.$data[0]['pn_baru'];
			//if($pnlama!=='-'){
				$pnbaru='.';
			//}else{
			//	$pnbaru=$data['pn_baru'].'.';
			//}
			
			$kelasbaru = 'Kelas '.$data[0]['kelas_baru']; 

		}
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					$templateProcessor->setValue('nourut',$data[0]['no_urut']);
					$no_awal='1. s.d. ';
					$no_akhir= $datagroup[0]['jumlah'];
					if($data[0]['no_urut']==='1'){
						$no_awal='';
						$noakhir =(int)$data[0]['no_urut']+1;
						$no_akhir= $noakhir.' s.d. '. $no_akhir.'.';
					}elseif($data[0]['no_urut']===$no_akhir){
						$noakhir= (int)$no_akhir-1;
						$no_awal = '1. s.d. '. $noakhir.'.';
						$no_akhir= '';

					}else{

						$noawal = (int)$data[0]['no_urut']-1;
						if($noawal===1){
							$no_awal='1.';
						}else{
							$no_awal= $no_awal .$noawal.'.';
						}
						$noakhir= (int)$data[0]['no_urut']+1;
						
						if($noakhir===(int)$no_akhir){
							$no_akhir=$no_akhir.'.';
						}else{
							$no_akhir= $noakhir.'. s.d. '.  $no_akhir.'.';
						}
						

					}
					$templateProcessor->setValue('noawal',$no_awal);
					$templateProcessor->setValue('noakhir',$no_akhir);
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('Nama',$data[0]['nama']);
					$templateProcessor->setValue('NIP',$data[0]['nip']);
					$templateProcessor->setValue('Pangkat',$data[0]['pangkat']);
					$templateProcessor->setValue('Gol',$data[0]['gol']);
					//$templateProcessor->setValue('Gol',$data[0]['gol']);
					$templateProcessor->setValue('jablama',$data[0]['jabatan_lama']);
					$templateProcessor->setValue('satkerLama',$satkerLama);
					$templateProcessor->setValue('NamaPNLama',$pnlama);
					$templateProcessor->setValue('NamaPTLama',$data[0]['pt_lama']);
					$templateProcessor->setValue('nourut',$data[0]['no_urut']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					$templateProcessor->setValue('jabbaru',$data[0]['jabatan_baru']);
					$templateProcessor->setValue('satkerBaru',$satkerBaru);
					$templateProcessor->setValue('NamaPNBaru',$pnbaru);
					$namaptbaru= ' dan '.$data[0]['pt_baru'].'.';
					if($data[0]['pt_baru']===$data[0]['pt_lama']){
							$namaptbaru='.';
					}
					$templateProcessor->setValue('NamaPTBaru',$namaptbaru);
					
					//$templateProcessor->setValue('NamaPTBaru',' dan '.$data['pt_baru']);
					$templateProcessor->setValue('NamaKPPNLama',$data[0]['kppn_lama']);
					
					$templateProcessor->setValue('NamaKPPNBaru',' dan '.$data[0]['kppn_baru']);
				


					$templateProcessor->setValue('NamaKPPNBaru',$data[0]['kppn_baru']);
					$templateProcessor->setValue('NamaKPPNLama',$data[0]['kppn_lama'].' ');
					$templateProcessor->setValue('tunjanganLama',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanLama',terbilang($data[0]['tunjangan']).' rupiah ');
					$templateProcessor->setValue('tunjanganBaru',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanBaru',terbilang($data[0]['tunjangan']).' rupiah ');
					if($kelasbaru==='Tipe B'){
						$kelasbaru='';
					}
					$templateProcessor->setValue('kelasBaru',$kelasbaru);
					

					//* *******************menu tambahin qrcode************************//
					$qrcode= "Dokumen ini ditandatangani secara Elektronik oleh:\n";
					if($jenis==='Salinan'){
						$qrcode= $qrcode." Nama : ".$datagroup[0]['direktur']."\n Jabatan : Direktur Pembinaan Tenaga Teknis Peradilan Umum.\n";
					//	$qrloc=$this->qrcodeMutasiHakim($qrcode, 'Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
					//	$templateProcessor->setImageValue('qrcode', $qrloc);
					
					}else{
						$qrcode= $qrcode." Nama : ".$datagroup[0]['dirjen']."\n Jabatan : Direktur Jenderal Badan Peradilan Umum.\n";
						//$qrloc=$this->qrcodeMutasiHakim($qrcode, 'Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
						
					}
					$qrcode= $qrcode."SK Mutasi Kepaniteraan a.n. \n Nama : ".$data[0]['nama']."\n Nip :".$data[0]['nip']."\n Nomor SK : ".$datagroup[0]['nomor_sk']."\n Tanggal SK : ".$datagroup[0]['tgl_sk'];
					
					$qrloc=$this->qrcodeMutasiPanitera($qrcode, $jenis.'_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip']);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					
					// ************* end create qrcode ****************/
					//if($jenis==='Salinan'){
						$pathToSave = APPPATH.'docx\SK\MUTASI\PANITERA\\'.$jenis.'_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.docx';
						
						
				//	}elseif($jenis==='Petikan'){
				//		$pathToSave = APPPATH.'docx\SK\MUTASI\PANITERA\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.docx';
					
				//	}else{
						
				//	}
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		//if($jenis==='Salinan'){
		$converter->convertTo($jenis.'_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.pdf'); //generates pdf file in same directory as test-file.docx
		//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx
		//}elseif($jenis==='Petikan'){
		//	$converter->convertTo('Petikan_'.$data['id_group_sk'].'_'.$data['id_sk'].'_'.$data['nip'].'.pdf');
		//}else{
			

		//}

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		//unlink($pathToSave);

		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('id_group_sk' => $data[0]['id_group_sk'], 'id_sk'=>$data[0]['id_sk'] );
		$this->db->where($where);


		//  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
    
		//$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		if($jenis==='Salinan'){
			$data_update = array('file_loc_salinan' => APPPATH.'docx\SK\MUTASI\PANITERA\Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.pdf' );

		}else{
			$data_update = array('file_loc_petikan' => APPPATH.'docx\SK\MUTASI\PANITERA\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_panitera_data',$data_update);
	
	}


function generateSKMutasiPaniteraOtentik($datagroup){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		echo "ini datanya :";
		var_dump($datagroup);

		// array(1) { [0]=> array(14) { ["id"]=> string(2) "24" ["skmutasinoid"]=> string(2) "10" ["tgl_tpm"]=> string(10) "2019-07-03" ["nomor_sk"]=> string(26) "2503/DJU/SK/KP.04.5/7/2019" ["tgl_sk"]=> string(10) "2019-07-23" ["dirjen"]=> string(14) "HERRI SWANTORO" ["direktur"]=> string(8) "HASWANDI" ["kasubdit"]=> string(13) "J. KAMALUDDIN" ["nama_dipa"]=> string(78) "Segala biaya yang bertalian dengan pemindahan ini tidak ditanggung oleh Negara" ["desc"]=> NULL ["updated_date"]=> string(19) "2021-04-29 18:50:42" ["updated_user_id"]=> string(2) "16" ["jumlah"]=> string(1) "4" ["file_loc_otentik"]=> string(0) "" } } 
			$temp_sk = $this->SKMutasi_Panitera_model->getTemplate($datagroup[0]['id_jenis']);
			$filename= $temp_sk[0]['url_autentik'];	
		
			//$filename= APPPATH."docx\\temp_sk\mutasi\panitera\Autentik.docx";
		
	
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					

					//* *******************menu tambahin qrcode************************//
					$qrcode= "Dokumen ini ditandatangani secara Elektronik oleh:\n";
					
						$qrcode= $qrcode."Nama : ".$datagroup[0]['dirjen']."\nJabatan : Direktur Jenderal Badan Peradilan Umum.\n";
						//$qrloc=$this->qrcodeMutasiHakim($qrcode, 'Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
						
					
					$qrcode= $qrcode."SK Mutasi Kepaniteraan Nomor SK : ".$datagroup[0]['nomor_sk']." Tanggal SK : ".$datagroup[0]['tgl_sk'];
					
					$qrloc=$this->qrcodeMutasiPanitera($qrcode, 'Otentik_'.$data['id_group_sk']);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					
					// ************* end create qrcode ****************/
					
					$pathToSave = APPPATH.'docx\SK\MUTASI\PANITERA\Otentik_'.$datagroup[0]['skmutasinoid'].'.docx';
					
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo('Otentik_'.$datagroup[0]['skmutasinoid'].'.pdf');

		

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('skmutasinoid' => $datagroup[0]['skmutasinoid'] );
		$this->db->where($where);

		$data_update = array('file_loc_otentik' => APPPATH.'docx\SK\MUTASI\PANITERA\Otentik_'.$datagroup[0]['skmutasinoid'].'.pdf' );
		$this->db->update('tbl_skmutasi_panitera',$data_update);
	
	}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}




function generateSKMutasiHakim($data,$datagroup, $jenis){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		echo "ini datanya :";
		//var_dump($data);
		echo "<br/>";
		echo "<br/>";
		var_dump($datagroup);

		
		echo $jenis;// Salinan
		if($jenis==='Salinan'){
		//	$filename= APPPATH."docx\\temp_sk\mutasi\panitera\SK_MUT_SALINAN.doc";
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\PT\Salinan.docx";

		}elseif($jenis==='Petikan'){
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\PT\Petikan.docx";
		}else{
			
		}
		$satkerLama= 'Pengadilan Tinggi '.$data[0]['pt_lama'];
		$pnlama='-';
		$kelaslama=  'Tipe '.$data[0]['kelas_lama']; 
		if($data[0]['pn_lama']!=='-'){
			$satkerLama= 'Pengadilan Negeri '.$data[0]['pn_lama'];
			$kelaslama = 'Kelas '.$data[0]['kelas_lama']; 
			$pnlama= $data[0]['pn_lama'];

		}
		$satkerBaru= 'Pengadilan Tinggi '.$data[0]['pt_baru'];
		$pnbaru='.';
		$kelasbaru = 'Tipe '.$data[0]['kelas_baru']; 
		if($data[0]['pn_baru']!=='-'){
			$satkerBaru= 'Pengadilan Negeri '.$data[0]['pn_baru'];
			if($pnlama!=='-'){
				$pnbaru=' dan '.$data[0]['pn_baru'].'.';
			}else{
				$pnbaru=$data[0]['pn_baru'].'.';
			}
			
			$kelasbaru = 'Kelas '.$data[0]['kelas_baru']; 
		}
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					$templateProcessor->setValue('nourut',$data[0]['no_urut']);
					$no_awal='1. s.d. ';
					$no_akhir= $datagroup[0]['jumlah'];
					if($data[0]['no_urut']==='1'){
						$no_awal='';
						$noakhir =(int)$data[0]['no_urut']+1;
						$no_akhir= $noakhir.'. s.d. '. $no_akhir.'.';
					}elseif($data[0]['no_urut']===$no_akhir){
						$noakhir= (int)$no_akhir-1;
						$no_awal = '1. s.d. '. $noakhir.'.';
						$no_akhir= '';

					}else{

						$noawal = (int)$data[0]['no_urut']-1;
						if($noawal===1){
							$no_awal='1.';
						}else{
							$no_awal= $no_awal .$noawal.'.';
						}
						$noakhir= (int)$data[0]['no_urut']+1;
						
						if($noakhir===(int)$no_akhir){
							$no_akhir=$no_akhir.'.';
						}else{
							$no_akhir= $noakhir.'. s.d. '.  $no_akhir.'.';
						}
						

					}
					$templateProcessor->setValue('noawal',$no_awal);
					$templateProcessor->setValue('noakhir',$no_akhir);
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('Nama',$data[0]['nama']);
					$templateProcessor->setValue('NIP',$data[0]['nip']);
					$templateProcessor->setValue('Pangkat',$data[0]['pangkat'].'/'.$data[0]['gol_relasi']);
					$templateProcessor->setValue('Gol',$data[0]['gol']);
					//$templateProcessor->setValue('Gol',$data[0]['gol']);
					$jablama='';
					if($data['jabatan_lama']==='Hakim'){
						$jablama='';
					}else{
						$jablama=$data[0]['jabatan_lama'].' ';
					}
					$templateProcessor->setValue('jablama',$jablama);
					$templateProcessor->setValue('satkerLama',$satkerLama);
					$templateProcessor->setValue('NamaPNLama',$pnlama.' ');
					$templateProcessor->setValue('NamaPTLama',$data[0]['pt_lama']);
					$templateProcessor->setValue('nourut',$data[0]['no_urut']);
					$templateProcessor->setValue('kma',$datagroup[0]['kma']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					$jabbaru='';
					if($data['jabatan_baru']==='Hakim'){
						$jabbaru='';
					}else{
						$jabbaru=$data[0]['jabatan_baru'].' ';
					}
					$templateProcessor->setValue('jabbaru',$jabbaru);
					$templateProcessor->setValue('satkerBaru',$satkerBaru);
					$templateProcessor->setValue('NamaPNBaru',$pnbaru);

					$templateProcessor->setValue('NamaPTBaru',' dan '.$data[0]['pt_baru']);
					$templateProcessor->setValue('NamaKPPNLama',$data[0]['kppn_lama']);
					
					$templateProcessor->setValue('NamaKPPNBaru',' dan '.$data[0]['kppn_baru']);
					$templateProcessor->setValue('tunjanganLama',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanLama',terbilang($data[0]['tunjangan']).' rupiah ');
					$templateProcessor->setValue('tunjanganBaru',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanBaru',terbilang($data[0]['tunjangan']).' rupiah ');
					if($kelasbaru==='Klas I.A.K'){
						$kelasbaru='Klas I.A.Khusus.';
					}
					$templateProcessor->setValue('kelasBaru',$kelasbaru);
					

					//* *******************menu tambahin qrcode************************//
					//$qrloc=$this->qrcode($data['qrcode']);
					//$templateProcessor->setImageValue('QrCode', $qrloc);


					$qrcode= "Dokumen ini ditandatangani secara Elektronik oleh:\n";
					if($jenis==='Salinan'){
						$qrcode= $qrcode." Nama : ".$datagroup[0]['direktur']."\n Jabatan : Direktur Pembinaan Tenaga Teknis Peradilan Umum.\n";
					}else{
						$qrcode= $qrcode." Nama : ".$datagroup[0]['dirjen']."\n Jabatan : Direktur Jenderal Badan Peradilan Umum.\n";
					}
					$qrcode= $qrcode."SK Mutasi Kepaniteraan a.n. \n Nama : ".$data[0]['nama']."\n Nip :".$data[0]['nip']."\n Nomor SK : ".$datagroup[0]['nomor_sk']."\n Tanggal SK : ".$datagroup[0]['tgl_sk'];
					
					$qrloc=$this->qrcodeMutasiHakim($qrcode, $data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					// ************* end create qrcode ****************/
					if($jenis==='Salinan'){
						$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.docx';
						
						
					}elseif($jenis==='Petikan'){
						$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.docx';
					
					}else{
						
					}
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		if($jenis==='Salinan'){
		$converter->convertTo('Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf'); //generates pdf file in same directory as test-file.docx
		//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx
		}elseif($jenis==='Petikan'){
			$converter->convertTo('Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf');
		}else{
			

		}

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('id_group_sk' => $data[0]['id_group_sk'], 'id_sk'=>$data[0]['id_sk'] );
		$this->db->where($where);


		//  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
    
		//$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		if($jenis==='Salinan'){
			$data_update = array('file_loc_salinan' => APPPATH.'docx\SK\MUTASI\HAKIM\Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf' );

		}else{
			$data_update = array('file_loc_petikan' => APPPATH.'docx\SK\MUTASI\HAKIM\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_hakim_data',$data_update);
	
	}


function generateSKMutasiHakimOtentik($datagroup){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		echo "ini datanya :";
		var_dump($datagroup);

		// array(1) { [0]=> array(14) { ["id"]=> string(2) "24" ["skmutasinoid"]=> string(2) "10" ["tgl_tpm"]=> string(10) "2019-07-03" ["nomor_sk"]=> string(26) "2503/DJU/SK/KP.04.5/7/2019" ["tgl_sk"]=> string(10) "2019-07-23" ["dirjen"]=> string(14) "HERRI SWANTORO" ["direktur"]=> string(8) "HASWANDI" ["kasubdit"]=> string(13) "J. KAMALUDDIN" ["nama_dipa"]=> string(78) "Segala biaya yang bertalian dengan pemindahan ini tidak ditanggung oleh Negara" ["desc"]=> NULL ["updated_date"]=> string(19) "2021-04-29 18:50:42" ["updated_user_id"]=> string(2) "16" ["jumlah"]=> string(1) "4" ["file_loc_otentik"]=> string(0) "" } } 
	
		
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\pt\Autentik.docx";
		
	
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					

					//* *******************menu tambahin qrcode************************//
					//$qrloc=$this->qrcode($data['qrcode']);
					//$templateProcessor->setImageValue('QrCode', $qrloc);


					// ************* end create qrcode ****************/
					
					$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\Otentik_'.$datagroup[0]['skmutasinoid'].'.docx';
					
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo('Otentik_'.$datagroup[0]['skmutasinoid'].'.pdf');

		

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('skmutasinoid' => $datagroup[0]['skmutasinoid'] );
		$this->db->where($where);

		$data_update = array('file_loc_otentik' => APPPATH.'docx\SK\MUTASI\HAKIM\Otentik_'.$datagroup[0]['skmutasinoid'].'.pdf' );
		$this->db->update('tbl_skmutasi_hakim',$data_update);
	
	}


function generateSKMutasiHakimPN($data,$datagroup, $jenis){
	$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		

		
		echo $jenis;// Salinan
		if($jenis==='Salinan'){
		//	$filename= APPPATH."docx\\temp_sk\mutasi\panitera\SK_MUT_SALINAN.doc";
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\PN\Salinan.docx";

		}elseif($jenis==='Petikan'){
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\PN\Petikan.docx";
		}else{
			
		}
		$satkerLama= 'Pengadilan Tinggi '.$data[0]['pt_lama'];
		$pnlama='-';
		$kelaslama=  'Tipe '.$data[0]['kelas_lama']; 
		if($data[0]['pn_lama']!==''){
			if(strpos($data[0]['jabatan_lama'],'Yustisial')){
				$satkerLama= '';
			}elseif(strpos($data[0]['jabatan_lama'],'Non Palu')){
				$satkerLama= '';
				//$satkerBaru= '';
				$pnlama='';
				$kelaslama = ''; 
				//$ketSatker='Pengadilan Tinggi '.$data[0]['pt_lama'];
			}else{
			$satkerLama= 'Pengadilan Negeri '.$data[0]['pnkhususlama'].$data[0]['pn_lama'];
			}
	
			//$satkerLama= 'Pengadilan Negeri '.$data['pn_lama'];
			$kelaslama = 'Kelas '.$data[0]['kelas_lama']; 
			$pnlama= $data[0]['pn_lama'];

		}else{

			if(strpos($data[0]['jabatan_lama'],'Yustisial')){
				$satkerLama= '';
			}elseif(strpos($data[0]['jabatan_lama'],'Non Palu')){
				$satkerLama= '';
				//$satkerBaru= '';
				$pnlama='';
				$kelaslama = ''; 
				//$ketSatker='Pengadilan Tinggi '.$data[0]['pt_lama'];
			}else{
			//$satkerLama= 'Pengadilan Negeri '.$data[0]['pnkhususlama'].$data[0]['pn_lama'];
				$satkerLama='.';
				$kelaslama='';
			}
		}
		$satkerBaru= 'Pengadilan Tinggi '.$data[0]['pt_baru'];
		$ketSatker= $satkerBaru;
		$pnbaru='.';
		$kelasbaru = 'Tipe '.$data[0]['kelas_baru']; 
		if($data[0]['pn_baru']!==''&& $data[0]['pn_baru']!==$data[0]['pn_lama']){
			if(strpos($data[0]['jabatan_baru'],'Yustisial')){
				$satkerBaru= '';
				//$satkerBaru= '';
				$pnbaru='';
				$kelasbaru = ''; 
				$ketSatker='';
			}elseif(strpos($data[0]['jabatan_baru'],'Non Palu')){
				$satkerBaru= '';
				//$satkerBaru= '';
				$pnbaru='';
				$kelasbaru = ''; 
				$ketSatker='';
			}else{
			$satkerBaru= 'Pengadilan Negeri '.$data[0]['pnkhususbaru'].$data[0]['pn_baru'];
			$ketSatker= 'Pengadilan Negeri '.$data[0]['pn_baru'];
				if($pnlama!==''){
					$pnbaru=' dan '.$data[0]['pn_baru'].'.';
					$kelasbaru = 'Klas '.$data[0]['kelas_baru']; 
				}else{
					
				
					$pnbaru=$data[0]['pn_baru'].'.';
				}
			}
			
		}elseif($data[0]['pn_baru']!==''&& $data[0]['pn_baru']===$data[0]['pn_lama']){	
			if(strpos($data[0]['jabatan_baru'],'Yustisial')){
				$satkerBaru= '';
			//	$pnbaru='.';
				$kelasbaru = ''; 
				$ketSatker='';
			}elseif(strpos($data[0]['jabatan_baru'],'Non Palu')){
				$satkerBaru= 'Pengadilan Tinggi '.$data[0]['pt_baru'];
				//$satkerBaru= '';
				$pnbaru='';
				$kelasbaru = ''; 
				$ketSatker='Pengadilan Tinggi '.$data[0]['pt_baru'];
			}else{
				$satkerBaru= 'Pengadilan Negeri '.$data[0]['pnkhususbaru'].$data[0]['pn_baru'];
				$ketSatker='Pengadilan Negeri '.$data[0]['pn_baru'];
				if($pnlama!==''){
						$pnbaru='.';
						$kelasbaru = 'Klas '.$data[0]['kelas_baru']; 
				}
			}
			
			//$satkerBaru= 'Pengadilan Negeri '.$data['pn_baru'];
			//if($pnlama!==''){
			//	$pnbaru='.';
			//	$kelasbaru = 'Kelas '.$data['kelas_baru']; 
			//}
		}else{
			if(strpos($data[0]['jabatan_baru'],'Yustisial')){
				$satkerBaru= '';
			//	$pnbaru='.';
				$kelasbaru = ''; 
				$ketSatker='';
			}elseif(strpos($data[0]['jabatan_baru'],'Non Palu')){
				$satkerBaru= '';
				//$satkerBaru= '';
				$pnbaru='';
				$kelasbaru = ''; 
				$ketSatker='';
			}else{
			$kelasbaru = '.'; 
			$satkerBaru= '.';
			$ketSatker='';
			}
		}
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					$templateProcessor->setValue('nourut',$data[0]['no_urut']);
					$no_awal='1. s.d. ';
					$no_akhir= $datagroup[0]['jumlah'];
					if($data[0]['no_urut']==='1'){
						$no_awal='';
						$noakhir =(int)$data[0]['no_urut']+1;
						$no_akhir= $noakhir.'. s.d. '. $no_akhir.'.';
					}elseif($data[0]['no_urut']===$no_akhir){
						$noakhir= (int)$no_akhir-1;
						$no_awal = '1. s.d. '. $noakhir.'.';
						$no_akhir= '';

					}else{

						$noawal = (int)$data[0]['no_urut']-1;
						if($noawal===1){
							$no_awal='1.';
						}else{
							$no_awal= $no_awal .$noawal.'.';
						}
						$noakhir= (int)$data[0]['no_urut']+1;
						
						if($noakhir===(int)$no_akhir){
							$no_akhir=$no_akhir.'.';
						}else{
							$no_akhir= $noakhir.'. s.d. '.  $no_akhir.'.';
						}
						

					}
					$templateProcessor->setValue('noawal',$no_awal);
					$templateProcessor->setValue('noakhir',$no_akhir);
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('Nama',$data[0]['nama']);
					$templateProcessor->setValue('NIP',$data[0]['nip']);
					$templateProcessor->setValue('Pangkat',$data[0]['pangkat'].' ('.$data[0]['gol'].')/'.$data[0]['gol_relasi']);
					$templateProcessor->setValue('Pangkat2',$data[0]['pangkat']);
					$templateProcessor->setValue('relasi',$data[0]['gol_relasi']);
					$templateProcessor->setValue('Gol',$data[0]['gol']);
					//$templateProcessor->setValue('Gol',$data[0]['gol']);
					$jablama='';
					if($data['jabatan_lama']==='Hakim'){
						$jablama='';
					}else{
						$jablama=$data[0]['jabatan_lama'].' ';
					}
					$templateProcessor->setValue('jablama',$jablama);
					$templateProcessor->setValue('satkerLama',$satkerLama);
					$templateProcessor->setValue('NamaPNLama',$pnlama.' ');
					$templateProcessor->setValue('NamaPTLama',$data[0]['pt_lama']);
					$templateProcessor->setValue('nourut',$data[0]['no_urut']);
					//$templateProcessor->setValue('kma',$datagroup[0]['kma']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					$jabbaru='';
					if($data[0]['jabatan_baru']==='Hakim'){
						$jabbaru='';
					}else{
						$jabbaru=$data[0]['jabatan_baru'].' ';
					}
					$templateProcessor->setValue('jabbaru',$jabbaru);
					$templateProcessor->setValue('satkerBaru',$satkerBaru);
					$namaptbaru='.';
					$namapnbaru='.';
					if($data[0]['pt_lama']!==$data[0]['pt_baru']){
						$namaptbaru=' dan '.$data[0]['pt_baru'].'.';

					}
				
					$templateProcessor->setValue('NamaPNBaru',$pnbaru);
					
					$templateProcessor->setValue('NamaPTBaru',$namaptbaru);
					$templateProcessor->setValue('NamaKPPNLama',$data[0]['kppn_lama']);
					
					$templateProcessor->setValue('NamaKPPNBaru',' dan '.$data[0]['kppn_baru']);
					$templateProcessor->setValue('tunjanganLama',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanLama',terbilang($data[0]['tunjangan']).' rupiah ');
					$templateProcessor->setValue('tunjanganBaru',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanBaru',terbilang($data[0]['tunjangan']).' rupiah ');
					$templateProcessor->setValue('ketSatker',$ketSatker);
					
					if($kelasbaru==='Klas I.A.K'){
						$kelasbaru='Klas I.A.Khusus.';
					}
					$templateProcessor->setValue('kelasBaru',$kelasbaru);
					

					//* *******************menu tambahin qrcode************************//
					//$link = 'https://tte.kominfo.go.id/verifyPDF';

					$qrcode= "Dokumen ini ditandatangani secara Elektronik oleh:\n";
					if($jenis==='Salinan'){
						$qrcode= $qrcode." Nama : ".$datagroup[0]['direktur']."\n Jabatan : Direktur Pembinaan Tenaga Teknis Peradilan Umum.\n";
					}else{
						$qrcode= $qrcode." Nama : ".$datagroup[0]['dirjen']."\n Jabatan : Direktur Jenderal Badan Peradilan Umum.\n";
					}
					$qrcode= $qrcode."SK Mutasi Hakim a.n. \n Nama : ".$data[0]['nama']."\n Nip :".$data[0]['nip']."\n Nomor SK : ".$datagroup[0]['nomor_sk']."\n Tanggal SK : ".$datagroup[0]['tgl_sk'];
					
					$qrloc=$this->qrcodeMutasiHakim($qrcode, $jenis.'_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip']);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					// ************* end create qrcode ****************/
					//if($jenis==='Salinan'){
					//	$qrloc=$this->qrcodeMutasiHakim($link, 'Salinan_PN_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
					//	$templateProcessor->setImageValue('qrcode', $qrloc);
						$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\\'.$jenis.'_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.docx';
						
						
					//}elseif($jenis==='Petikan'){
					//	$qrloc=$this->qrcodeMutasiHakim($link, 'Petikan_PN_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip']);
					//	$templateProcessor->setImageValue('qrcode', $qrloc);
					//	$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.docx';
					
					//}else{
						
					//}
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		//if($jenis==='Salinan'){
		
			$converter->convertTo($jenis.'_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.pdf'); 
			//$converter->convertTo("'Salinan_".$data[0]['id_group_sk']."_".$data[0]['id_sk']."_".$data[0]['nip'].".pdf'"); 
			//generates pdf file in same directory as test-file.docx
		//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx
		//}elseif($jenis==='Petikan'){
		//	$converter->convertTo('Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf');
		//}else{

		//}

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		//unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('id_group_sk' => $data[0]['id_group_sk'], 'id_sk'=>$data[0]['id_sk'] );
		$this->db->where($where);


		//  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
    
		//$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		if($jenis==='Salinan'){
			$data_update = array('file_loc_salinan' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.pdf' );


		}else{
			$data_update = array('file_loc_petikan' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['no_urut'].'_'.$data[0]['nip'].'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_hakim_pn_data',$data_update);
	
	
	}


function generateSKMutasiHakimPNOtentik($datagroup){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		echo "ini datanya :";
		var_dump($datagroup);

		// array(1) { [0]=> array(14) { ["id"]=> string(2) "24" ["skmutasinoid"]=> string(2) "10" ["tgl_tpm"]=> string(10) "2019-07-03" ["nomor_sk"]=> string(26) "2503/DJU/SK/KP.04.5/7/2019" ["tgl_sk"]=> string(10) "2019-07-23" ["dirjen"]=> string(14) "HERRI SWANTORO" ["direktur"]=> string(8) "HASWANDI" ["kasubdit"]=> string(13) "J. KAMALUDDIN" ["nama_dipa"]=> string(78) "Segala biaya yang bertalian dengan pemindahan ini tidak ditanggung oleh Negara" ["desc"]=> NULL ["updated_date"]=> string(19) "2021-04-29 18:50:42" ["updated_user_id"]=> string(2) "16" ["jumlah"]=> string(1) "4" ["file_loc_otentik"]=> string(0) "" } } 
	
		
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\pn\Autentik.docx";
		
	
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					

					//* *******************menu tambahin qrcode************************//

					$link = 'https://tte.kominfo.go.id/verifyPDF';
					$qrloc=$this->qrcodeMutasiHakim($link, 'Otentik_'.$id_group_sk);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					// ************* end create qrcode ****************/
					
					$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\Otentik_'.$datagroup[0]['skmutasinoid'].'.docx';
					
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo('Otentik_'.$datagroup[0]['skmutasinoid'].'.pdf');

		

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('skmutasinoid' => $datagroup[0]['skmutasinoid'] );
		$this->db->where($where);

		$data_update = array('file_loc_otentik' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Otentik_'.$datagroup[0]['skmutasinoid'].'.pdf' );
		$this->db->update('tbl_skmutasi_hakim_pn',$data_update);
	
	}

	public function qrcodeMutasiHakim($data, $name)
	{
		$this->load->library('ciqrcode'); //meload library barcode
		$this->load->helper('url'); //meload helper url untuk aktifkan base urlnya
        $barcode_create=$data; // membuat code barcode yang nilainya 123456789

        //settingang pada barcode 
        $params['data'] = $barcode_create;
		$params['level'] = 'M';
		 $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
       
		//settingan untuk membuat file barcode dalam format .png dan di simpan dalam folder assets
		$params['savename'] = FCPATH . "assets/MutasiHakim/".$name.".png";
		//mulai menggenerate barcode
		$this->ciqrcode->generate($params);

		//mencoba mengeluarkan nilai barcode yang baru saja di generate
		//echo '<img src="'.base_url().'assets/'.$name.'.png" />';
		
		return $params['savename'] ;
	}

	public function qrcodeMutasiPanitera($data, $name)
	{
		$this->load->library('ciqrcode'); //meload library barcode
		$this->load->helper('url'); //meload helper url untuk aktifkan base urlnya
        $barcode_create=$data; // membuat code barcode yang nilainya 123456789

        //settingang pada barcode 
        $params['data'] = $barcode_create;
		$params['level'] = 'M';
		 $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
       
		//settingan untuk membuat file barcode dalam format .png dan di simpan dalam folder assets
		$params['savename'] = FCPATH . "assets/MutasiPanitera/".$name.".png";
		//mulai menggenerate barcode
		$this->ciqrcode->generate($params);

		//mencoba mengeluarkan nilai barcode yang baru saja di generate
		//echo '<img src="'.base_url().'assets/'.$name.'.png" />';
		
		return $params['savename'] ;
	}
	 
	function generatePDFSKMutasiHakimPNUpload($filepath,$jenis, $id_group_sk,$nip, $id_sk){
			$this->load->helper('my_helper');
		$this->load->model('SKMutasi_Hakim_PN_model');
		$where = array('id_group_sk' =>$id_group_sk ,'id_sk'=>$id_sk );
		$data=$this->SKMutasi_Hakim_PN_model->getDataSKSync($where);
		
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filepath);
					
					//* *******************menu tambahin qrcode************************//
					$qrcode= "Dokumen ini ditandatangani secara Elektronik oleh:\n";
					if($jenis==='Salinan'){
						$qrcode= $qrcode." Nama : ".$datagroup[0]['direktur']."\n Jabatan : Direktur Pembinaan Tenaga Teknis Peradilan Umum.\n";
					}else{
						$qrcode= $qrcode." Nama : ".$datagroup[0]['dirjen']."\n Jabatan : Direktur Jenderal Badan Peradilan Umum.\n";
					}
					$qrcode= $qrcode."SK Mutasi Hakim a.n. \n Nama : ".$data['nama']."\n Nip :".$data['nip']."\n Nomor SK : ".$datagroup[0]['nomor_sk']."\n Tanggal SK : ".$datagroup[0]['tgl_sk'];
					
					$qrloc=$this->qrcodeMutasiHakim($qrcode, $jenis.'_'.$data['id_group_sk'].'_'.$data['id_sk'].'_'.$data['nip']);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					// ************* end create qrcode ****************/
					//if($jenis==='Salinan'){
					//	$qrloc=$this->qrcodeMutasiHakim($link, 'Salinan_PN_'.$id_group_sk.'_'.$id_sk.'_'.$nip);
					//	$templateProcessor->setImageValue('qrcode', $qrloc);
						$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\\'.$jenis.'_'.$id_group_sk.'_'.$id_sk.'_'.$nip.'.docx';
						
						
				//	}elseif($jenis==='Petikan'){
				//		$qrloc=$this->qrcodeMutasiHakim($link, 'Petikan_PN_'.$id_group_sk.'_'.$id_sk.'_'.$nip);
			//		$templateProcessor->setImageValue('qrcode', $qrloc);
			//			$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\Petikan_'.$id_group_sk.'_'.$id_sk.'_'.$nip.'.docx';
					
			//		}else{
						
			//		}
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		//if($jenis==='Salinan'){
		$converter->convertTo($jenis.'_'.$id_group_sk.'_'.$data['no_urut'].'_'.$nip.'.pdf'); //generates pdf file in same directory as test-file.docx
		//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx
		//}elseif($jenis==='Petikan'){
		//	$converter->convertTo('Petikan_'.$id_group_sk.'_'.$id_sk.'_'.$nip.'.pdf');
		//}else{
			

		//}

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('id_group_sk' => $id_group_sk, 'id_sk'=>$id_sk);
		$this->db->where($where);
		if($jenis==='Salinan'){
			$data_update = array('file_loc_salinan' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Salinan_'.$id_group_sk.'_'.$id_sk.'_'.$nip.'.pdf' );

		}else{
			$data_update = array('file_loc_petikan' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Petikan_'.$id_group_sk.'_'.$id_sk.'_'.$nip.'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_hakim_pn_data',$data_update);

	}

	function generatePDFSKAutentikMutasiHakimPNUpload($filepath,$jenis, $id_group_sk){
			$this->load->helper('my_helper');
		//$this->load->model('pangkat_model');
		
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filepath);
					
					//* *******************menu tambahin qrcode************************//
					$link = 'https://tte.kominfo.go.id/verifyPDF';
					// ************* end create qrcode ****************/
					if($jenis==='Lampiran'){
						$qrloc=$this->qrcodeMutasiHakim($link, 'Lampiran_'.$id_group_sk);
						$templateProcessor->setImageValue('qrcode', $qrloc);
						$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\Lampiran_'.$id_group_sk.'.docx';
						
						
					}elseif($jenis==='Autentik'){
						$qrloc=$this->qrcodeMutasiHakim($link, 'Autentik_'.$id_group_sk);
					$templateProcessor->setImageValue('qrcode', $qrloc);
						$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\Autentik_'.$id_group_sk.'.docx';
					
					}else{
						
					}
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		if($jenis==='Lampiran'){
		$converter->convertTo('Lampiran_'.$id_group_sk.'.pdf'); //generates pdf file in same directory as test-file.docx
		//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx
			
		}else{
			$converter->convertTo('Autentik_'.$id_group_sk.'.pdf');

		}

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('skmutasinoid' => $id_group_sk);
		$this->db->where($where);
		if($jenis==='Lampiran'){
			$data_update = array('lampiran' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Lampiran_'.$id_group_sk.'.pdf' );

		}else{
			$data_update = array('file_loc_otentik' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Autentik_'.$id_group_sk.'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_hakim_pn',$data_update);

	}

	function generateSKMutasiHakimPN2($data,$datagroup, $jenis){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		

		
		echo $jenis;// Salinan
		if($jenis==='Salinan'){
		//	$filename= APPPATH."docx\\temp_sk\mutasi\panitera\SK_MUT_SALINAN.doc";
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\PN\Salinan.docx";

		}elseif($jenis==='Petikan'){
			$filename= APPPATH."docx\\temp_sk\mutasi\hakim\PN\Petikan.docx";
		}else{
			
		}
		$satkerLama= 'Pengadilan Tinggi '.$data['pt_lama'];
		$pnlama='-';
		$kelaslama=  'Tipe '.$data['kelas_lama']; 
		if($data['pn_lama']!==''){
			if(strpos($data['jabatan_lama'],'Yustisial')){
				$satkerLama= '';
			}elseif(strpos($data['jabatan_lama'],'Non Palu')){
				$satkerLama='';
				//$satkerBaru= '';
				$pnlama='';
				$kelaslama = ''; 
			}else{
				if($data['jabatan_lama']==='Hakim'){
					$satkerLama= 'Pengadilan Negeri '.$data['pn_lama'];
				}else{
					$satkerLama= 'Pengadilan Negeri '.$data['pnkhususlama'].$data['pn_lama'];	
				}
				//$satkerLama= 'Pengadilan Negeri '.$data['pnkhususlama'].$data['pn_lama'];
			}
	
			//$satkerLama= 'Pengadilan Negeri '.$data['pn_lama'];
			$kelaslama = 'Kelas '.$data['kelas_lama']; 
			$pnlama= $data['pn_lama'];

		}else{
			$satkerLama='.';
			$kelaslama='';
		}
		$satkerBaru= 'Pengadilan Tinggi '.$data['pt_baru'];
		$ketSatker= $satkerBaru;
		$pnbaru='.';
		$kelasbaru = 'Tipe '.$data['kelas_baru']; 
		if($data['pn_baru']!==''&& $data['pn_baru']!==$data['pn_lama']){
			if(strpos($data['jabatan_baru'],'Yustisial')){
				$satkerBaru= '';
				//$satkerBaru= '';
				$pnbaru='';
				$kelasbaru = ''; 
				$ketSatker='';
			}elseif(strpos($data['jabatan_baru'],'Non Palu')){
				$satkerBaru= 'Pengadilan Tinggi '.$data['pt_baru'];
				//$satkerBaru= '';
				$pnbaru='';
				$kelasbaru = ''; 
				$ketSatker='Pengadilan Tinggi '.$data['pt_baru'];
			}else{
			if($data['jabatan_baru']==='Hakim'){
				$satkerBaru= 'Pengadilan Negeri '.$data['pn_baru'];
				
			}else{
				$satkerBaru= 'Pengadilan Negeri '.$data['pnkhususbaru'].$data['pn_baru'];
			
			}
			//$satkerBaru= 'Pengadilan Negeri '.$data['pnkhususbaru'].$data['pn_baru'];
			$ketSatker= 'Pengadilan Negeri '.$data['pn_baru'];
				if($pnlama!==''){
					$pnbaru=' dan '.$data['pn_baru'].'.';
					$kelasbaru = 'Klas '.$data['kelas_baru']; 
				}else{
					
				
					$pnbaru=$data['pn_baru'].'.';
				}
			}
			
		}elseif($data['pn_baru']!==''&& $data['pn_baru']===$data['pn_lama']){	
			if(strpos($data['jabatan_baru'],'Yustisial')){
				$satkerBaru= '';
			//	$pnbaru='.';
				$kelasbaru = ''; 
				$ketSatker='';
			}elseif(strpos($data['jabatan_baru'],'Non Palu')){
				$satkerBaru= 'Pengadilan Tinggi '.$data['pt_baru'];
				
				$pnbaru='';
				$kelasbaru = ''; 
				$ketSatker='Pengadilan Tinggi '.$data['pt_baru'];
			}else{
				if($data['jabatan_baru']==='Hakim'){
					$satkerBaru= 'Pengadilan Negeri '.$data['pn_baru'];
				
				}else{
					$satkerBaru= 'Pengadilan Negeri '.$data['pnkhususbaru'].$data['pn_baru'];
					
				}
				//$satkerBaru= 'Pengadilan Negeri '.$data['pnkhususbaru'].$data['pn_baru'];
				$ketSatker='Pengadilan Negeri '.$data['pn_baru'];
				if($pnlama!==''){
						$pnbaru='.';
						$kelasbaru = 'Klas '.$data['kelas_baru']; 
				}
			}
			
			
		}else{
			$kelasbaru = '.'; 
			$satkerBaru= '.';
			$ketSatker='';
		}
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',$this->tgl_indo($datagroup[0]['tgl_tpm']));
					$templateProcessor->setValue('nourut',$data['no_urut']);
					$no_awal='1. s.d. ';
					$no_akhir= $datagroup[0]['jumlah'];
					if($data['no_urut']==='1'){
						$no_awal='';
						$noakhir =(int)$data['no_urut']+1;
						$no_akhir= $noakhir.'. s.d. '. $no_akhir.'.';
					}elseif($data['no_urut']===$no_akhir){
						$noakhir= (int)$no_akhir-1;
						$no_awal = '1. s.d. '. $noakhir.'.';
						$no_akhir= '';

					}else{

						$noawal = (int)$data['no_urut']-1;
						if($noawal===1){
							$no_awal='1.';
						}else{
							$no_awal= $no_awal .$noawal.'.';
						}
						$noakhir= (int)$data['no_urut']+1;
						
						if($noakhir===(int)$no_akhir){
							$no_akhir=$no_akhir.'.';
						}else{
							$no_akhir= $noakhir.'. s.d. '.  $no_akhir.'.';
						}
						

					}
					$templateProcessor->setValue('noawal',$no_awal);
					$templateProcessor->setValue('noakhir',$no_akhir);
					$templateProcessor->setValue('TglTTD',$this->tgl_indo($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('Nama',$data['nama']);
					$templateProcessor->setValue('NIP',$data['nip']);
					$templateProcessor->setValue('Pangkat',$data['pangkat'].' ('.$data['gol'].')/'.$data['gol_relasi']);
					$templateProcessor->setValue('Pangkat2',$data['pangkat']);
					$templateProcessor->setValue('relasi',$data['gol_relasi']);
					$templateProcessor->setValue('Gol',$data['gol']);
					//$templateProcessor->setValue('Gol',$data[0]['gol']);
					$jablama=' ';
					if($data['jabatan_lama']==='Hakim'){
						$jablama=' ';
					}else{
						$jablama=', '.$data['jabatan_lama'].' ';
					}
					$templateProcessor->setValue('jablama',$jablama);
					$templateProcessor->setValue('satkerLama',$satkerLama);
					$templateProcessor->setValue('NamaPNLama',$pnlama);
					$templateProcessor->setValue('NamaPTLama',$data['pt_lama']);
					$templateProcessor->setValue('nourut',$data['no_urut']);
					$templateProcessor->setValue('NamaDirjen',$datagroup[0]['dirjen']);
					$templateProcessor->setValue('NamaDirektur',$datagroup[0]['direktur']);
					$jabbaru=' ';
					if($data['jabatan_baru']==='Hakim'){
						$jabbaru=' ';
					}else{
						$jabbaru=', '.$data['jabatan_baru'].' ';
					}
					$templateProcessor->setValue('jabbaru',$jabbaru);
					$templateProcessor->setValue('satkerBaru',' '.$satkerBaru);
					$namaptbaru='.';
					$namapnbaru='.';
					if($data['pt_lama']!==$data['pt_baru']){
						$namaptbaru=' dan '.$data['pt_baru'].'.';

					}
				
					$templateProcessor->setValue('NamaPNBaru',$pnbaru);
					
					$templateProcessor->setValue('NamaPTBaru',$namaptbaru);
					$templateProcessor->setValue('NamaKPPNLama',$data['kppn_lama']);
					
					$templateProcessor->setValue('NamaKPPNBaru',' dan '.$data['kppn_baru']);
					$templateProcessor->setValue('tunjanganLama',convRupiah($data['tunjangan']));
					$templateProcessor->setValue('ejaanLama',terbilang($data['tunjangan']).' rupiah ');
					$templateProcessor->setValue('tunjanganBaru',convRupiah($data['tunjangan']));
					$templateProcessor->setValue('ejaanBaru',terbilang($data['tunjangan']).' rupiah ');
					$templateProcessor->setValue('ketSatker',$ketSatker);
					
					if($kelasbaru==='Klas I.A.K'){
						$kelasbaru='Klas I.A.Khusus.';
					}
					$templateProcessor->setValue('kelasBaru',$kelasbaru);
					

					//* *******************menu tambahin qrcode************************//
					//$link = 'https://tte.kominfo.go.id/verifyPDF';

					$qrcode= "Dokumen ini ditandatangani secara Elektronik oleh:\n";
					if($jenis==='Salinan'){
						$qrcode= $qrcode." Nama : ".$datagroup[0]['direktur']."\n Jabatan : Direktur Pembinaan Tenaga Teknis Peradilan Umum.\n";
					}else{
						$qrcode= $qrcode." Nama : ".$datagroup[0]['dirjen']."\n Jabatan : Direktur Jenderal Badan Peradilan Umum.\n";
					}
					$qrcode= $qrcode."SK Mutasi Hakim a.n. \n Nama : ".$data['nama']."\n Nip :".$data['nip']."\n Nomor SK : ".$datagroup[0]['nomor_sk']."\n Tanggal SK : ".$datagroup[0]['tgl_sk'];
					
					$qrloc=$this->qrcodeMutasiHakim($qrcode, $jenis.'_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip']);
					$templateProcessor->setImageValue('qrcode', $qrloc);
					// ************* end create qrcode ****************/
					
						$pathToSave = APPPATH.'docx\SK\MUTASI\HAKIM\PN\\'.$jenis.'_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.docx';
						
						
					
					$templateProcessor->saveAs($pathToSave);
	
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo($jenis.'_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.pdf'); 
		
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		//unlink($pathToSave);
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('id_group_sk' => $data['id_group_sk'], 'id_sk'=>$data['id_sk'] );
		$this->db->where($where);


		//  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
    
		//$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		if($jenis==='Salinan'){
			$data_update = array('file_loc_salinan' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Salinan_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.pdf' );


		}else{
			$data_update = array('file_loc_petikan' => APPPATH.'docx\SK\MUTASI\HAKIM\PN\Petikan_'.$data['id_group_sk'].'_'.$data['no_urut'].'_'.$data['nip'].'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_hakim_pn_data',$data_update);
	
	}





}
?>