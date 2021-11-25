<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tte extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('DigiSignPure');
		$this->load->model('SKMutasi_Hakim_PN_model');
		$this->load->model('SKMutasi_Hakim_model');
   		$this->load->model('SKMutasi_Panitera_model');
	}

	function index(){
		echo "index";
	}


	public function check_status($nip=true){
		$nip = 'Isikan Dengan NIP';
    	if(trim($nip)==''){
			echo json_encode(array('st'=>0,'msg'=>'NIP Belum disertakan'));
			exit;
		}
        $response = $this->digisignpure->check_status($nip);
        var_dump($response);
    }

    public function informasi_pegawai($nip=true){
		$nip = 'Isikan Dengan NIP';
    	if(trim($nip)==''){
			echo json_encode(array('st'=>0,'msg'=>'NIP Belum disertakan'));
			exit;
		}
        $response = $this->digisignpure->info_pegawai($nip);
        var_dump($response);
    }

    
    function signSKMutasiAllHakim(){
		$id_group_sk= $this->input->post('id_group',TRUE);
	   // $nomor_sk= $this->input->post('nomor_sk',TRUE);
	   // $tgl_sk= $this->input->post('tgl_sk',TRUE);
	   // $tgl_tpm= $this->input->post('tgl_tpm',TRUE);
	    $passphrase= $this->input->post('passphrase',TRUE);
		$where  = array('id_group_sk' => $id_group_sk );
		$datask= $this->SKMutasi_Hakim_PN_model->getDataSKSync($where);
		//var_dump($datask);
	    foreach ($datask as $dt) {
	    	$this->signSKMutasiHakimPN2($id_group_sk, $dt['id_sk'], $passphrase);
	    }
	}

    //function untuk signSKMutasi
    function signSKMutasiHakimPN(){
			//$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));
		$nip 		= $text = str_replace(' ', '', '198209182009121003');
		$id_group_sk= $this->input->post('id_group',TRUE);
	    $id_sk= $this->input->post('id_sk',TRUE);
	      
	    	//echo $nip;
	    $passphrase= $this->input->post('passphrase',TRUE);

	    $where = array('id_group_sk' => $id_group_sk,'id_sk'=>$id_sk);
 		$where_group = array('skmutasinoid' => $id_group_sk);

	    $datask= $this->SKMutasi_Hakim_PN_model->getDataSKSync($where);
	    $datagroup= $this->SKMutasi_Hakim_PN_model->getDataGroupSKSync($where_group);
	    
	    var_dump($datask);

	    $dokumen 			= '';
		$jenis				='';

	    if($this->session->userdata('level_name')==='Direktur'){
        		$dokumen= $datask[0]['file_loc_salinan'];
        		//$dokumen='C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Salinan_13_1_19670203 199212 1 001.pdf';
        		$jenis='Salinan';

        		
	    }elseif($this->session->userdata('level_name')==='Dirjen'){
	       		$dokumen= $datask[0]['file_loc_petikan'];
	       		$jenis='Petikan';

	    }else{

	      		echo $this->session->set_flashdata('error','Maaf anda tidak berwenang untuk menandatangani Surat Keputusan');
	         
	    }

		$infoSignature 		= array(
			'reason' 		=> $jenis. ' Surat Keputusan Mutasi Hakim Pengadilan Negeri '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'location' 		=> 'Jakarta',
			'title' 		=> $jenis. ' Surat Keputusan Mutasi Hakim Pengadilan Negeri '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			//'namalengkap'=>$this->session->userdata('username'),
			//'jabatan'=>$this->session->userdata('jabatan')
			'namalengkap'=>'Affan Ahmad, S.Kom',
			'jabatan'=>'Kasubag Bimbingan Teknis'


		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $dokumen, $infoSignature, $doc_prop);
		if($signed->status){
		$id_status='13';
		$filesigned= '';
		$dtnip= str_replace(' ', '', $datask[0]['nip']);
		if($jenis==='Salinan'){
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/HAKIM/PN/Salinan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_salinan' =>$filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn_data', $data, $where);
				

        	//		redirect('SKMutasi_Hakim_PN/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/13');
        			// cek url sk salinan lalu update file locnya menjadi file yang udah ditanda tangani
        }else{
			$id_status='14';
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/HAKIM/PN/Petikan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_petikan' => $filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn_data', $data, $where);
        			
        			//redirect('SKMutasi_Hakim_PN/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/14');
				
        			// cek url sk petikan yang sudah di ttd, lalu update status menjadi sudah ditandatangani dan update url file yang sudah di sign tte kedalam database
        }
		//var_dump($signed);
		//echo $signed->path;
		shell_exec('curl '.$signed->path.' --output '.$filesigned);
		redirect('SKMutasi_Hakim_PN/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/'.$id_status);
				
        	//redirect('SKMutasi_Hakim_PN/download/'.$signed->path.'/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/'.$id_status);
        	//redirect('SKMutasi_Hakim_PN/download?url='.$signed->path);
			//echo $signed->path;

              }else {
        	echo $this->session->set_flashdata('error',$signed->message);
        	redirect('SKMutasi_Hakim_PN/listDataGroup/'.$id_group_sk);

    		}

	}

	//function untuk signSKMutasi
    function signSKMutasiHakimPN2($id_group_sk, $id_sk, $passphrase){
			//$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));
		$nip 		= $text = str_replace(' ', '', '198209182009121003');
		//$id_group_sk= $this->input->post('id_group',TRUE);
	    //$id_sk= $this->input->post('id_sk',TRUE);
	      
	    	//echo $nip;
	    //$passphrase= $this->input->post('passphrase',TRUE);

	    $where = array('id_group_sk' => $id_group_sk,'id_sk'=>$id_sk);
 		$where_group = array('skmutasinoid' => $id_group_sk);

	    $datask= $this->SKMutasi_Hakim_PN_model->getDataSKSync($where);
	    $datagroup= $this->SKMutasi_Hakim_PN_model->getDataGroupSKSync($where_group);
	    
	    var_dump($datask);

	    $dokumen 			= '';
		$jenis				='';

	    if($this->session->userdata('level_name')==='Direktur'){
        		$dokumen= $datask[0]['file_loc_salinan'];
        		//$dokumen='C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Salinan_13_1_19670203 199212 1 001.pdf';
        		$jenis='Salinan';

        		
	    }elseif($this->session->userdata('level_name')==='Dirjen'){
	       		$dokumen= $datask[0]['file_loc_petikan'];
	       		$jenis='Petikan';

	    }else{

	      		echo $this->session->set_flashdata('error','Maaf anda tidak berwenang untuk menandatangani Surat Keputusan');
	         
	    }

		$infoSignature 		= array(
			'reason' 		=> $jenis. ' Surat Keputusan Mutasi Hakim Pengadilan Negeri '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'location' 		=> 'Jakarta',
			'title' 		=> $jenis. ' Surat Keputusan Mutasi Hakim Pengadilan Negeri '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			//'namalengkap'=>$this->session->userdata('username'),
			//'jabatan'=>$this->session->userdata('jabatan')
			'namalengkap'=>'Affan Ahmad, S.Kom',
			'jabatan'=>'Kasubag Bimbingan Teknis'


		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $dokumen, $infoSignature, $doc_prop);
		if($signed->status){
		$id_status='13';
		$filesigned= '';
		$dtnip= str_replace(' ', '', $datask[0]['nip']);
		if($jenis==='Salinan'){
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/HAKIM/PN/Salinan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_salinan' =>$filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn_data', $data, $where);
				

        	//		redirect('SKMutasi_Hakim_PN/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/13');
        			// cek url sk salinan lalu update file locnya menjadi file yang udah ditanda tangani
        }else{
			$id_status='14';
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/HAKIM/PN/Petikan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_petikan' => $filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn_data', $data, $where);
        			
        			//redirect('SKMutasi_Hakim_PN/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/14');
				
        			// cek url sk petikan yang sudah di ttd, lalu update status menjadi sudah ditandatangani dan update url file yang sudah di sign tte kedalam database
        }
		//var_dump($signed);
		//echo $signed->path;
		shell_exec('curl '.$signed->path.' --output '.$filesigned);
		redirect('SKMutasi_Hakim_PN/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/'.$id_status);
				
        	//redirect('SKMutasi_Hakim_PN/download/'.$signed->path.'/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/'.$id_status);
        	//redirect('SKMutasi_Hakim_PN/download?url='.$signed->path);
			//echo $signed->path;

              }else {
        	//echo "Gagal !! "."<br/>".$signed->message;
        	echo $this->session->set_flashdata('error',$signed->message);
        	redirect('SKMutasi_Hakim_PN/listDataGroup/'.$id_group_sk);
		
    		}

	}

	 //function untuk signSKMutasi
    function signSKMutasiAutentikHakimPN(){
		$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));
		$id_group_sk= $this->input->post('id_group',TRUE);
	    $tgl_tpm	= $this->input->post('tgl_tpm',TRUE);
	    $tgl_sk		= $this->input->post('tgl_sk',TRUE);
	    $nomor_sk	= $this->input->post('nomor_sk',TRUE);
	     
	    	//echo $nip;
	    $passphrase= $this->input->post('passphrase',TRUE);

	    $where 		= array('skmutasinoid' => $id_group_sk);
 		$datagroup 	= $this->SKMutasi_Hakim_PN_model->getDataGroupSKSync($where);
	    var_dump($datagroup);
	    
	    $otentik 			= '';
		$lampiran 			= '';
	  	foreach ($datagroup as $dt) {
			# code...
		
        		$otentik= $dt['file_loc_otentik'];
        		$lampiran=$dt['lampiran'];
        		
        }
	   

		$infoSignature 		= array(
			'reason' 		=> ' Surat Keputusan Mutasi Hakim Peradilan Umum Nomor '.$nomor_sk.' tanggal '.$tgl_sk,
			'location' 		=> 'Jakarta',
			'title' 		=> ' Surat Keputusan Mutasi Hakim Peradilan Umum Nomor  '.$nomor_sk.' tanggal '.$tgl_sk,
			'namalengkap'=>$this->session->userdata('username'),
			'jabatan'=>$this->session->userdata('jabatan')

		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $otentik, $infoSignature, $doc_prop);
		$id_status='14';
		if($signed->status){
        //$this->pdfstream($signed->path);

        	echo $signed->path;
        	$filesigned='var/www/html/sifora/application/docx/SK/MUTASI/HAKIM/PN/Otentik_'.$id_group_sk.'_signed.pdf';
			$this->SKMutasi_Panitera_model->verifyGroupSK($id_group_sk, '14');
			$where = array('skmutasinoid' =>$id_group_sk );
			$data = array('file_loc_otentik' => $filesigned );
			$this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn', $data, $where);
        	// cek url sk otentik lalu update file locnya menjadi file yang udah ditanda tangani
        	shell_exec('curl '.$signed->path.' --output '.$filesigned);
			
        }else {
        	echo "Gagal !! "."<br/>".$signed->message;
    	}
    	$signedLampiran = $this->digisignpure->sign_doc($nip, $passphrase, $lampiran, $infoSignature, $doc_prop);
		
    	if($signedLampiran->status){
        	$this->pdfstream($signedLampiran->path);
        	echo $signedLampiran->path;
        	$filesignedlampiran= 'var/www/html/sifora/application/docx/SK/MUTASI/HAKIM/PN/Lampiran_'.$id_group_sk.'_signed.pdf';
        	$where = array('skmutasinoid' =>$id_group_sk );
			$data = array('lampiran' => $filesignedlampiran );
			$this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn', $data, $where);
        	
        	// cek url sk lampiran lalu update file locnya menjadi file yang udah ditanda tangani
        	shell_exec('curl '.$signedLampiran->path.' --output '.$filesignedlampiran);
			
        	redirect('SKMutasi_Hakim_PN/verifyGroupSK/'.$id_group_sk.'/'.$id_status);
		
        }else {
        	echo "Gagal !! "."<br/>".$signedLampiran->message;

        	echo $this->session->set_flashdata('error',$signed->message);
        	redirect('SKMutasi_Hakim_PN/listDataGroup/'.$id_group_sk);
    	}
    	
	}


	//function untuk signSKMutasi
    function signSKMutasiHakimPT(){
		$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));
		$id_group_sk= $this->input->post('id_group',TRUE);
	    $id_sk= $this->input->post('id_sk',TRUE);
	      
	    	//echo $nip;
	    $passphrase= $this->input->post('passphrase',TRUE);

	    $where = array('id_group_sk' => $id_group_sk,'id_sk'=>$id_sk);
 		$where_group = array('skmutasinoid' => $id_group_sk);

	    $datask= $this->SKMutasi_Hakim_model->getDataSKSync($where);
	    $datagroup= $this->SKMutasi_Hakim_model->getDataGroupSKSync($where_group);
	    
	    var_dump($datask);

	    $dokumen 			= '';
		$jenis				='';

	    if($this->session->userdata('level_name')==='Direktur'){
        		$dokumen= $datask[0]['file_loc_salinan'];
        		//$dokumen='C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Salinan_13_1_19670203 199212 1 001.pdf';
        		$jenis='Salinan';

        		
	    }elseif($this->session->userdata('level_name')==='Dirjen'){
	       		$dokumen= $datask[0]['file_loc_petikan'];
	       		$jenis='Petikan';

	    }else{

	      		echo $this->session->set_flashdata('error','Maaf anda tidak berwenang untuk menandatangani Surat Keputusan');
	         
	    }

		$infoSignature 		= array(
			'reason' 		=> $jenis. ' Surat Keputusan Mutasi Hakim Pengadilan Tinggi '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'location' 		=> 'Jakarta',
			'title' 		=> $jenis. ' Surat Keputusan Mutasi Hakim Pengadilan Tinggi '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'namalengkap'=>$this->session->userdata('username'),
			'jabatan'=>$this->session->userdata('jabatan')

		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $dokumen, $infoSignature, $doc_prop);
		if($signed->status){
        	$this->pdfstream($signed->path);
        	echo $signed->path;


        	if($jenis==='Salinan'){
        			$this->SKMutasi_Hakim_model->verifySK($id_group_sk, $id_sk, $datask[0]['id_stage'],'13');
        			// cek url sk salinan lalu update file locnya menjadi file yang udah ditanda tangani
        	}else{
        			$this->SKMutasi_Hakim_model->verifySK($id_group_sk, $id_sk, $datask[0]['id_stage'],'14');
        			// cek url sk petikan yang sudah di ttd, lalu update status menjadi sudah ditandatangani dan update url file yang sudah di sign tte kedalam database
        	}
        }else {
        	echo "Gagal !! "."<br/>".$signed->message;

    	}
	}

	 //function untuk signSKMutasi
    function signSKAutentikMutasiHakimPT(){
		$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));
		$id_group_sk= $this->input->post('id_group',TRUE);
	    $tgl_tpm	= $this->input->post('tgl_tpm',TRUE);
	    $tgl_sk		= $this->input->post('tgl_sk',TRUE);
	    $nomor_sk	= $this->input->post('nomor_sk',TRUE);
	     
	    	//echo $nip;
	    $passphrase= $this->input->post('passphrase',TRUE);

	    $where 		= array('skmutasinoid' => $id_group_sk);
 		$datagroup 	= $this->SKMutasi_Hakim_model->getDataGroupSKSync($where);
	    var_dump($datagroup);
	    
	    $otentik 			= '';
		$lampiran 			= '';
	  	foreach ($datagroup as $dt) {
			# code...
		
        		$otentik= $dt['file_loc_otentik'];
        		$lampiran=$dt['lampiran'];
        		
        }
	   

		$infoSignature 		= array(
			'reason' 		=> ' Surat Keputusan Mutasi Hakim Pengadilan Tinggi Nomor '.$nomor_sk.' tanggal '.$tgl_sk,
			'location' 		=> 'Jakarta',
			'title' 		=> ' Surat Keputusan Mutasi Hakim Pengadilan Tinggi Nomor '.$nomor_sk.' tanggal '.$tgl_sk,
			'namalengkap'=>$this->session->userdata('username'),
			'jabatan'=>$this->session->userdata('jabatan')

		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $otentik, $infoSignature, $doc_prop);

		if($signed->status){
        	$this->pdfstream($signed->path);
        	echo $signed->path;
			$this->SKMutasi_Hakim_model->verifyGroupSK($id_group_sk, '14');
        	// cek url sk otentik lalu update file locnya menjadi file yang udah ditanda tangani
        	
        }else {
        	echo "Gagal !! "."<br/>".$signed->message;
    	}
    	$signedLampiran = $this->digisignpure->sign_doc($nip, $passphrase, $lampiran, $infoSignature, $doc_prop);
		
    	if($signedLampiran->status){
        	$this->pdfstream($signedLampiran->path);
        	echo $signedLampiran->path;
        	// cek url sk lampiran lalu update file locnya menjadi file yang udah ditanda tangani
        	

        }else {
        	echo "Gagal !! "."<br/>".$signedLampiran->message;
    	}
	}


	function signSKMutasiAllPanitera(){
		$id_group_sk= $this->input->post('id_group',TRUE);
	   // $nomor_sk= $this->input->post('nomor_sk',TRUE);
	   // $tgl_sk= $this->input->post('tgl_sk',TRUE);
	   // $tgl_tpm= $this->input->post('tgl_tpm',TRUE);
	    $passphrase= $this->input->post('passphrase',TRUE);
		$where  = array('id_group_sk' => $id_group_sk );
		$datask= $this->SKMutasi_Panitera_model->getDataSKSync($where);
		//var_dump($datask);
	    foreach ($datask as $dt) {
	    	$this->signSKMutasiPanitera2($id_group_sk, $dt['id_sk'], $passphrase);
	    }
	}
 //function untuk signSKMutasi
    function signSKMutasiPanitera(){
		$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));
		$id_group_sk= $this->input->post('id_group',TRUE);
	    $id_sk= $this->input->post('id_sk',TRUE);
	      
	    	//echo $nip;
	    $passphrase= $this->input->post('passphrase',TRUE);

	    $where = array('id_group_sk' => $id_group_sk,'id_sk'=>$id_sk);
 		$where_group = array('skmutasinoid' => $id_group_sk);

	    $datask= $this->SKMutasi_Panitera_model->getDataSKSync($where);
	    $datagroup= $this->SKMutasi_Panitera_model->getDataGroupSKSync($where_group);
	    
	    var_dump($datask);

	    $dokumen 			= '';
		$jenis				='';

	    if($this->session->userdata('level_name')==='Direktur'){
        		$dokumen= $datask[0]['file_loc_salinan'];
        		//$dokumen='C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Salinan_13_1_19670203 199212 1 001.pdf';
        		$jenis='Salinan';

        		
	    }elseif($this->session->userdata('level_name')==='Dirjen'){
	       		$dokumen= $datask[0]['file_loc_petikan'];
	       		$jenis='Petikan';

	    }else{
	    		
	      		echo $this->session->set_flashdata('error','Maaf anda tidak berwenang untuk menandatangani Surat Keputusan');
	         
	    }

		$infoSignature 		= array(
			'reason' 		=> $jenis. ' Surat Keputusan Mutasi Kepaniteraan Peradilan Umum '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'location' 		=> 'Jakarta',
			'title' 		=> $jenis. ' Surat Keputusan Mutasi Kepaniteraan Peradilan Umum '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'namalengkap'=>$this->session->userdata('username'),
			'jabatan'=>$this->session->userdata('jabatan')

		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $dokumen, $infoSignature, $doc_prop);
		if($signed->status){
		$id_status='13';
		$filesigned= '';
		$dtnip= str_replace(' ', '', $datask[0]['nip']);
		if($jenis==='Salinan'){
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/PANITERA/Salinan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_salinan' =>$filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera_data', $data, $where);
		}else{
			$id_status='14';
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/PANITERA/Petikan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_petikan' => $filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera_data', $data, $where);
        }
		shell_exec('curl '.$signed->path.' --output '.$filesigned);
		redirect('SKMutasi_Panitera/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/'.$id_status);
		

              }else {
              	echo $this->session->set_flashdata('error',$signed->message);
              		redirect('SKMutasi_Panitera/listDataGroup/'.$id_group_sk);
        		//echo "Gagal !! "."<br/>".$signed->message;
    		}

	}

function signSKMutasiPanitera2($id_group_sk, $id_sk, $passphrase){
		$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));

	    $where = array('id_group_sk' => $id_group_sk,'id_sk'=>$id_sk);
 		$where_group = array('skmutasinoid' => $id_group_sk);

	    $datask= $this->SKMutasi_Panitera_model->getDataSKSync($where);
	    $datagroup= $this->SKMutasi_Panitera_model->getDataGroupSKSync($where_group);
	    
	    var_dump($datask);

	    $dokumen 			= '';
		$jenis				='';

	    if($this->session->userdata('level_name')==='Direktur'){
        		$dokumen= $datask[0]['file_loc_salinan'];
        		//$dokumen='C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Salinan_13_1_19670203 199212 1 001.pdf';
        		$jenis='Salinan';

        		
	    }elseif($this->session->userdata('level_name')==='Dirjen'){
	       		$dokumen= $datask[0]['file_loc_petikan'];
	       		$jenis='Petikan';

	    }else{
	    		
	      		echo $this->session->set_flashdata('error','Maaf anda tidak berwenang untuk menandatangani Surat Keputusan');
	         
	    }

		$infoSignature 		= array(
			'reason' 		=> $jenis. ' Surat Keputusan Mutasi Kepaniteraan Peradilan Umum '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'location' 		=> 'Jakarta',
			'title' 		=> $jenis. ' Surat Keputusan Mutasi Kepaniteraan Peradilan Umum '.$datask[0]['nip'].' atas nama '.$datask[0]['nama'].' tanggal '.$datagroup[0]['tgl_tpm'],
			'namalengkap'=>$this->session->userdata('username'),
			'jabatan'=>$this->session->userdata('jabatan')

		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $dokumen, $infoSignature, $doc_prop);
		if($signed->status){
		$id_status='13';
		$filesigned= '';
		$dtnip= str_replace(' ', '', $datask[0]['nip']);
		if($jenis==='Salinan'){
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/PANITERA/Salinan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_salinan' =>$filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera_data', $data, $where);
		}else{
			$id_status='14';
			$filesigned= '/var/www/html/sifora/application/docx/SK/MUTASI/PANITERA/Petikan_'.$id_group_sk.'_'.$id_sk.'_'.$dtnip.'_signed.pdf';
        		
			$data = array('file_loc_petikan' => $filesigned );
        		$where = array('id_group_sk' => $id_group_sk , 'id_sk'=> $id_sk);
        		$this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera_data', $data, $where);
        }
		shell_exec('curl '.$signed->path.' --output '.$filesigned);
		redirect('SKMutasi_Panitera/verifySK/'.$id_group_sk.'/'.$id_sk.'/'.$datask[0]['id_stage'].'/'.$id_status);
		

              }else {
        	//echo "Gagal !! "."<br/>".$signed->message;
        		echo $this->session->set_flashdata('error',$signed->message);
              		redirect('SKMutasi_Panitera/listDataGroup/'.$id_group_sk);
        		
    		}

	}


	 //function untuk signSKMutasi
    function signSKMutasiAutentikPanitera(){
		$nip 		= $text = str_replace(' ', '', $this->session->userdata('nip'));
		$id_group_sk= $this->input->post('id_group',TRUE);
	    $tgl_tpm	= $this->input->post('tgl_tpm',TRUE);
	    $tgl_sk		= $this->input->post('tgl_sk',TRUE);
	    $nomor_sk	= $this->input->post('nomor_sk',TRUE);
	     
	    	//echo $nip;
	    $passphrase= $this->input->post('passphrase',TRUE);

	    $where 		= array('skmutasinoid' => $id_group_sk);
 		$datagroup 	= $this->SKMutasi_Panitera_model->getDataGroupSKSync($where);
	    var_dump($datagroup);
	    
	    $otentik 			= '';
		$lampiran 			= '';
	  	foreach ($datagroup as $dt) {
			# code...
		
        		$otentik= $dt['file_loc_otentik'];
        		$lampiran=$dt['lampiran'];
        		
        }
	   

		$infoSignature 		= array(
			'reason' 		=> ' Surat Keputusan Mutasi Kepaniteraan Peradilan Umum Nomor '.$nomor_sk.' tanggal '.$tgl_sk,
			'location' 		=> 'Jakarta',
			'title' 		=> ' Surat Keputusan Mutasi Kepaniteraan Peradilan Umum Nomor  '.$nomor_sk.' tanggal '.$tgl_sk,
			'namalengkap'=>$this->session->userdata('username'),
			'jabatan'=>$this->session->userdata('jabatan')

		);

	
		$doc_prop = array(
			'document_owner_id' => 6,
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $otentik, $infoSignature, $doc_prop);
		$id_status='14';
		if($signed->status){
        //$this->pdfstream($signed->path);

        	echo $signed->path;
        	$filesigned='var/www/html/sifora/application/docx/SK/MUTASI/PANITERA/Otentik_'.$id_group_sk.'_signed.pdf';
			$this->SKMutasi_Panitera_model->verifyGroupSK($id_group_sk, '14');
			$where = array('skmutasinoid' =>$id_group_sk );
			$data = array('file_loc_otentik' => $filesigned );
			$this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera', $data, $where);
        	// cek url sk otentik lalu update file locnya menjadi file yang udah ditanda tangani
        	shell_exec('curl '.$signed->path.' --output '.$filesigned);
			
        }else {
        	echo "Gagal !! "."<br/>".$signed->message;
    	}
    	$signedLampiran = $this->digisignpure->sign_doc($nip, $passphrase, $lampiran, $infoSignature, $doc_prop);
		
    	if($signedLampiran->status){
        	$this->pdfstream($signedLampiran->path);
        	echo $signedLampiran->path;
        	$filesignedlampiran= 'var/www/html/sifora/application/docx/SK/MUTASI/PANITERA/Lampiran_'.$id_group_sk.'_signed.pdf';
        	$where = array('skmutasinoid' =>$id_group_sk );
			$data = array('lampiran' => $filesignedlampiran );
			$this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera', $data, $where);
        	
        	// cek url sk lampiran lalu update file locnya menjadi file yang udah ditanda tangani
        	shell_exec('curl '.$signedLampiran->path.' --output '.$filesignedlampiran);
			

        }else {
        	echo "Gagal !! "."<br/>".$signedLampiran->message;
    	}
    	redirect('SKMutasi_Panitera/verifyGroupSK/'.$id_group_sk.'/'.$id_status);
		
	}


	function sign(){
		$nip 			= 'Isikan Dengan NIP';
		$passphrase 	= 'Isikan Dengan Passphrase';

		$dokumen 			= 'Isikan Dengan Path File PDF-nya';
		$infoSignature 		= array(
			'reason' 		=> 'Isikan Alasan Tandatangan Elektronik',
			'location' 		=> 'Isikan Lokasi Penandatanganan Elektronik',
			'title' 		=> 'Judul Saja'
		);

		$doc_prop = array(
			'document_owner_id' => 'Ini diisi angka, ID diprovide oleh Bagian Pengembangan SI',
			'document_restricted' => 1
		);

		$signed = $this->digisignpure->sign_doc($nip, $passphrase, $dokumen, $infoSignature, $doc_prop);
		if($signed->status){
        	$this->pdfstream($signed->path);
        }else {
        	echo "Gagal !! "."<br/>".$signed->message;
    	}
	}

	public function pdfstream($url, $filename=false, $chunks=40960, $force_download=true){
		@set_time_limit(0);
		$size = $this->get_size($url);
	    if($size <=0 ){
	    	$size = $this->getRemoteFilesize($url);
	    	if($size <=0 ){
		    	print('Could\'t get file size of remote file. ('.$url.')');
		    	var_dump($this->head);
		    	return false;
		    }
	    }

	    ($force_download)?header('Content-Type: application/octet-stream'):header('Content-Type: application/pdf');
		if($force_download)header("Content-Transfer-Encoding: Binary");
		header("Content-Length: ".$size);
		header("Content-Disposition: ".(($force_download)?"attachment;":"")." filename=\"".((!$filename)?basename($url).".pdf":$filename)."\"");

		$i = 0;
	    while($i<=$size){
	        //Output the chunk
	        $this->get_chunk($url, (($i==0)?$i:$i+1), ((($i+$chunks)>$size)?$size:$i+$chunks));
	        $i = ($i+$chunks);
	        	
	    }
	    return true;
	}

	// Get Total Size of file by head
	private function getRemoteFilesize($url, $formatSize = true, $useHead = true){
	    if (false !== $useHead) {
	        stream_context_set_default(array(
	        			'http' => array(
	        				'method'		 	=> 'HEAD',
	        				'user_agent'		=> 'TeamDevelMARI'
	        			)
	        	));
	    }
	    $head = array_change_key_case(get_headers($url, 1));
	    $this->head = $head;
	    // var_dump($head);
	    // content-length of download (in bytes), read from Content-Length: field
	    $clen = isset($head['content-length']) ? $head['content-length'] : 0;

	    // cannot retrieve file size, return "-1"
	    if (!$clen) {
	        return -1;
	    }

	    if (!$formatSize) {
	        return $clen;
	    }

	    $size = $clen;
	    switch ($clen) {
	        case $clen < 1024:
	            $size = $clen .' B'; break;
	        case $clen < 1048576:
	            $size = round($clen / 1024, 2) .' KiB'; break;
	        case $clen < 1073741824:
	            $size = round($clen / 1048576, 2) . ' MiB'; break;
	        case $clen < 1099511627776:
	            $size = round($clen / 1073741824, 2) . ' GiB'; break;
	    }

	    return $size;
	}

	//Get total size of file
	private function get_size($url){
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, true);
	    curl_setopt($ch, CURLOPT_NOBODY, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    curl_exec($ch);
	    $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
	    return intval($size);
	}
	//Function to get a range of bytes from the remote file
	private function get_chunk($url,$start,$end){
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($ch, CURLOPT_RANGE, $start.'-'.$end);
	    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_WRITEFUNCTION, array($this, "chunk"));
	    $result = curl_exec($ch);
	    curl_close($ch);
	    
	}

	//Callback function for CURLOPT_WRITEFUNCTION, This is what prints the chunk
	private function chunk($ch, $str) {
	    print($str);
	    return strlen($str);
	}
}