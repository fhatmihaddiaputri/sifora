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
					$templateProcessor->setValue('TanggalSK',dateformat($data['sktgl']));
					$templateProcessor->setValue('NomorSK',$data['sknomor']);
					$templateProcessor->setValue('NoPertek',$data['sknmrpertek']);
					$templateProcessor->setValue('TglPertek',dateformat($data['sktglpertek']));
					$templateProcessor->setValue('Nama',$data['nama']);
					$templateProcessor->setValue('TptLahir',$data['tempat_lahir']);
					$templateProcessor->setValue('TglLahir',dateformat($data['tgl_lahir']));
					$templateProcessor->setValue('NIP',$data['nip']);
					$templateProcessor->setValue('Pendidikan',$data['pendidikan']);
					$templateProcessor->setValue('PangkatLama',$pangkat_lama[0]['pangkat']);
					$templateProcessor->setValue('GolLama',$data['gol_lama']);
					$templateProcessor->setValue('TmtGolLama',dateformat($data['tmt_gol_lama']));
					$templateProcessor->setValue('TmtGolBaru',dateformat($data['tmt_gol_baru']));
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
					$templateProcessor->setValue('Tanggal',dateformat($data[0]['tgl_surat'],'D F Y'));
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



function generateSKMutasiPanitera($data,$datagroup, $jenis){
		$this->load->helper('my_helper');
		$this->load->model('pangkat_model');
		var_dump($data);
		var_dump($datagroup);

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
		echo $jenis;// Salinan
		if($jenis==='Salinan'){
		//	$filename= APPPATH."docx\\temp_sk\mutasi\panitera\SK_MUT_SALINAN.doc";
			$filename= APPPATH."docx\\temp_sk\mutasi\panitera\Salinan.docx";

		}else{
			$filename= APPPATH."docx\\temp_sk\mutasi\panitera\Petikan.doc";
		}
		$satkerLama= 'Pengadilan Tinggi '.$data[0]['pt_lama'];
		$pnlama='-';
		$kelaslama=  'Tipe '.$data[0]['kelas_lama']; 
		if($data[0]['pn_lama']!=='-'){
			$satkerLama= 'Pengadilan Negeri '.$data[0]['pn_lama'];
			$kelaslama = 'Kelas '.$data[0]['kelas_lama']; 

		}
		$satkerBaru= 'Pengadilan Tinggi '.$data[0]['pt_baru'];
		$pnbaru='-';
		$kelasbaru = 'Tipe '.$data[0]['kelas_baru']; 
		if($data[0]['pn_baru']!=='-'){
			$satkerBaru= 'Pengadilan Negeri '.$data[0]['pn_baru'];
			$kelasbaru = 'Kelas '.$data[0]['kelas_baru']; 
		}
				//	echo date('H:i:s') , ' Creating new TemplateProcessor instance...' ;
					$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($filename);
					$templateProcessor->setValue('TglKeputusan',dateformat($datagroup[0]['tgl_tpm']));
					$templateProcessor->setValue('TglTTD',dateformat($datagroup[0]['tgl_sk']));
					$templateProcessor->setValue('NomorSK',$datagroup[0]['nomor_sk']);
					$templateProcessor->setValue('biaya',$datagroup[0]['nama_dipa']);
					$templateProcessor->setValue('Nama',$data[0]['nama']);
					$templateProcessor->setValue('NIP',$data[0]['nip']);
					$templateProcessor->setValue('Pangkat',$data[0]['pangkat']);
					$templateProcessor->setValue('Gol',$data[0]['gol']);
					$templateProcessor->setValue('GolRg',$data[0]['gol']);
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
					$templateProcessor->setValue('NamaPTBaru',$data[0]['pt_baru']);

					$templateProcessor->setValue('NamaKPPNBaru',$data[0]['kppn_baru']);
					$templateProcessor->setValue('NamaKPPNLama',$data[0]['kppn_lama']);
					$templateProcessor->setValue('tunjanganLama',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanLama',terbilang($data[0]['tunjangan']).' rupiah ');
					$templateProcessor->setValue('tunjanganBaru',convRupiah($data[0]['tunjangan']));
					$templateProcessor->setValue('ejaanBaru',terbilang($data[0]['tunjangan']).' rupiah ');
					$templateProcessor->setValue('kelasBaru',$kelasbaru);
					

					//* *******************menu tambahin qrcode************************//
					//$qrloc=$this->qrcode($data['qrcode']);
					//$templateProcessor->setImageValue('QrCode', $qrloc);
					// ************* end create qrcode ****************/
					if($jenis==='Salinan'){
						$pathToSave = APPPATH.'docx\SK\MUTASI\PANITERA\Salinan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.docx';
						
						
					}else{
						$pathToSave = APPPATH.'docx\SK\MUTASI\PANITERA\Petikan_'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.docx';
					
					}
					$templateProcessor->saveAs($pathToSave);
		// if you are using composer, just use this
		
		$converter = new OfficeConverter($pathToSave);
		$converter->convertTo($data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf'); //generates pdf file in same directory as test-file.docx
	//$converter->convertTo('output-file.html'); //generates html file in same directory as test-file.docx

		//to specify output directory, specify it as the second argument to the constructor
		$converter = new OfficeConverter($pathToSave, 'path-to-outdir');
		//$converter = new OfficeConverter('test-file.docx', APPPATH.'docx');

		// tambahkan update ke db untuk menambahkan file_loc pdf
		$where = array('id_group_sk' => $data[0]['id_group_sk'], 'id_sk'=>$data[0]['id_sk'] );
		$this->db->where($where);


		//  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
    
		//$data_update = array('file_loc' => APPPATH.'docx\SKKP_Panitera\\'.$data['skpangkatnoid'].'_'.$data['skpangkatindx'].'_'.$data['nip'].'.pdf' );
		if($jenis==='Salinan'){
			$data_update = array('file_loc_salinan' => APPPATH.'docx\SK\MUTASI\PANITERA\Salinan_\\'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf' );

		}else{
			$data_update = array('file_loc_petikan' => APPPATH.'docx\SK\MUTASI\PANITERA\Petikan_\\'.$data[0]['id_group_sk'].'_'.$data[0]['id_sk'].'_'.$data[0]['nip'].'.pdf' );
		}


		
		$this->db->update('tbl_skmutasi_panitera_data',$data_update);
	
	}

}
?>