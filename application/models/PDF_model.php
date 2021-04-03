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

}
 ?>