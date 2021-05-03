

<?php
class Surat_Panitera extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
		$this->load->model('Surat_model');
		$this->load->model('Stage_model');
		$this->load->model('PDF_model');
		$this->load->model('panitera/pegawai_model');
		$this->load->model('Excel_model');
		$this->load->helper('my_helper');
		$this->load->library('ciqrcode'); //meload library barcode

  	}
  	function index($stage){

  		$data['surat']= $this->Surat_model->getAllSurat($kode_surat, $stage);
        $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('Surat/Panitera/IzinBelajar',$data);
        $this->load->view('admin_template/footer');
  	}

  	function viewSurat($kode_surat,$stage, $id_group){
  		//$kode_surat='IB';
  		$data['pegawai']=$this->pegawai_model->get_data();
  		//var_dump($data['pegawai']);
  		$data['surat']= $this->Surat_model->getAllSurat($kode_surat, $stage);
  		var_dump($data['surat']);
  		/*$no= 1;
  		foreach ($data['surat'] as $srt) {
  			$no++;
  			$where = array('id' => $srt['id'], );
  			$data['surat_id'][$no]=$this->Surat_model->getSuratWhere($kode_surat, $where);
  			# code...
  		}
  		var_dump($data['surat_id']);
*/

  		/* array(1) {
  [2]=>
  array(1) {
    [0]=>
    array(27) {
      ["id"]=>
      string(1) "1"
      ["nip"]=>
      string(18) "198911162015032003"
      ["nama"]=>
      string(19) "FHATMI HADDIA PUTRI"
      ["jabatan"]=>
      string(2) "PP"
      ["pt"]=>
      string(7) "JAKARTA"
      ["pn"]=>
      string(13) "JAKARTA PUSAT"
      ["no_surat"]=>
      string(7) "123/DJU"
      ["tgl_surat"]=>
      string(10) "2021-04-04"
      ["pendidikan"]=>
      string(13) "SARJANA HUKUM"
      ["universitas"]=>
      string(20) "UNIVERSITAS JAYABAYA"
      ["id_stage"]=>
      string(1) "5"
      ["created_user_id"]=>
      string(1) "2"
      ["created_date"]=>
      string(10) "2021-04-04"
      ["updated_date"]=>
      string(10) "2021-04-04"
      ["updated_user_id"]=>
      string(1) "2"
      ["file_loc"]=>
      string(1) "-"
      ["id_status"]=>
      string(1) "7"
      ["keterangan"]=>
      string(1) "-"
      ["user_id"]=>
      string(1) "2"
      ["NIP"]=>
      string(0) ""
      ["user_name"]=>
      string(13) "administrator"
      ["user_password"]=>
      string(32) "e10adc3949ba59abbe56e057f20f883e"
      ["user_email"]=>
      string(15) "admin@gmail.com"
      ["user_id_jab"]=>
      string(1) "0"
      ["reset_key"]=>
      string(0) ""
      ["status"]=>
      string(6) "PROSES"
      ["alert_color"]=>
      string(7) "success"
    }
  }
}*/
  		//var_dump($data['surat']);
  		// array(1) { [0]=> array(18) { ["id"]=> string(1) "1" ["nip"]=> string(18) "198911162015032003" ["nama"]=> string(19) "FHATMI HADDIA PUTRI" ["jabatan"]=> string(2) "PP" ["pt"]=> string(7) "JAKARTA" ["pn"]=> string(13) "JAKARTA PUSAT" ["no_surat"]=> string(7) "123/DJU" ["tgl_surat"]=> string(10) "2021-04-04" ["pendidikan"]=> string(13) "SARJANA HUKUM" ["universitas"]=> string(20) "UNIVERSITAS JAYABAYA" ["id_stage"]=> string(1) "5" ["created_user_id"]=> string(1) "2" ["created_date"]=> string(10) "2021-04-04" ["updated_date"]=> string(10) "2021-04-04" ["updated_user_id"]=> string(1) "2" ["file_loc"]=> string(1) "-" ["id_status"]=> string(1) "7" ["keterangan"]=> string(1) "-" } }

  		$this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
  		//if($kode_surat==='IB'){
        echo "masuk sini";
  			 $this->load->view('Surat/'.$this->session->userdata('group_name').'/'.$kode_surat,$data);
        
		//}
        $this->load->view('admin_template/footer');
  	}

  	function editSurat($kode_surat){
  		$data = array();
  		if($kode_surat==='IB'){
  			$pn = '';
  			$id= $this->input->post('id');
	  		$nip= $this->input->post('nip');
	  		$nama= $this->input->post('nama');
	  		$gol= $this->input->post('gol');
	  		$jabatan= $this->input->post('jabatan');
	  		$pt= $this->input->post('pt');
	  		$pn= $this->input->post('pn');
	  		$pendidikan= $this->input->post('pendidikan');
	  		$universitas= $this->input->post('universitas');
	  		$no_surat= $this->input->post('nomorSurat');
	  		$tgl_surat= $this->input->post('tglSurat');
	  		$sebutan_tujuan_surat= $this->input->post('sebutan_tujuan_surat');
	  		$no_surat_usul= $this->input->post('nomorSuratUsul');
	  		$tgl_surat_usul= $this->input->post('tglSuratUsul');
	  		$stage= $this->input->post('id_stage');
	  		//echo $id." | ".$nip." | ".$nama." | ".$jabatan." | ".$pt." | ".$pn." | ".$pendidikan." | ".$universitas;
			$now = new DateTime();
		    $update_date= $now->format('Y-m-d H:i:s'); 
		    $user_id = $this->session->userdata('userid');
	  	
 
	  		$data = array('nip' =>$nip ,
	  						'nama'=>$nama,
	  						'gol'=>$gol,
	  						'jabatan'=>$jabatan,
	  						'pt'=>$pt,
	  						'pn'=>$pn,
	  						'pendidikan'=>$pendidikan,
	  						'universitas'=>$universitas,
	  						'no_surat'=>$no_surat,
	  						'tgl_surat'=>$tgl_surat,
	  						'updated_date'=>$update_date,
	  						'updated_user_id'=>$user_id,
	  						'no_surat_usul'=>$no_surat_usul,
	  						'tgl_surat_usul'=>$tgl_surat_usul,
	  						'sebutan_tujuan_surat'=>$sebutan_tujuan_surat
	  						 );
	  		$where = array('id' =>$id  );
  		}
  		
  		if($this->Surat_model->updateData($kode_surat, $data, $where)){

  				 echo $this->session->set_flashdata('msg','Data berhasil diubah');
      
		}else{
			 echo $this->session->set_flashdata('error','edit data gagal');

		}
		redirect('Surat_Panitera/viewSurat/'.$kode_surat.'/'.$stage.'/'.$this->session->userdata('id_group'));
  			
  	}

  	function edit($kode_surat, $id){


  	}

  	function getDataPegawai(){

  		$data['pegawai']=$this->Surat_model->get();
  		var_dump($data);
  	
  }


  function tambah_aksi($kode_surat){

  	if($kode_surat==='IB'){
  		$pn='';
	 	$nip = $this->input->post('nip_t');
	  	$nama = $this->input->post('nama_t');
	  	$gol = $this->input->post('gol_t');
	  	$jabatan = $this->input->post('jabatan_t');
	  	$pt = $this->input->post('pt_t');
	  	$pn = $this->input->post('pn_t');
	  	$pendidikan = $this->input->post('pendidikan_t');
	  	$universitas = $this->input->post('universitas_t');
	  	$stage = $this->session->userdata('start_stage');
	  	$user_id = $this->session->userdata('userid');
	  	$now = new DateTime();
	    $update_date= $now->format('Y-m-d H:i:s'); 
      
	  	$data = array('id' =>'' , 
	  					'nip'=>$nip,
	  					'nama'=>$nama,
	  					'gol'=>$gol,
	  					'jabatan'=>$jabatan,
	  					'pt'=>$pt,
	  					'pn'=>$pn,
	  					'pendidikan'=>$pendidikan,
	  					'universitas'=>$universitas,
	  					'id_stage'=>$stage,
	  					'created_user_id'=>$user_id,
	  					'created_date'=>$update_date,
	  					'id_status'=>'7'
	  	);
	  	if($this->Surat_model->insertData($kode_surat,$data)){
	  		echo $this->session->set_flashdata('msg','Data berhasil ditambahkan');
      
	  	}else{
	  		echo $this->session->set_flashdata('error','Data gagal ditambahkan');
      
	  	}
	  		redirect('Surat_Panitera/viewSurat/'.$kode_surat.'/'.$stage.'/'.$this->session->userdata('id_group'));

  	}else{
  		// tamnbahkan untuk kategori surat lainnya
  	}
 
  	
  }

  function fileSurat($kode_surat, $id){
  	$where = array('id' => $id);
  	$data= $this->Surat_model->getSuratWhere($kode_surat, $where);
  	//var_dump($data);
  	$this->PDF_model->generateSurat($data, $kode_surat);
  }
 }
