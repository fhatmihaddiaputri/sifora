<?php
class SKMutasi_Panitera_2 extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
    $this->load->model('SKMutasi_Panitera2_model');
    $this->load->model('Surat_model');
    $this->load->model('Stage_model');
    $this->load->model('PDF_model');
    $this->load->helper('my_helper');
    $this->load->library('ciqrcode'); //meload library barcode
    $this->load->model('Excel_model'); //meload library barcode    
  }

  function index(){
     
  	   $data['skmut'] = $this->SKMutasi_Panitera2_model->getDataAll('tbl_skmutasi_panitera_lain');
      var_dump($data['skmut']);
      
    
  	    $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
     //   $this->load->view('SK/Mutasi/SKMutasi_Panitera_view',$data);
        $this->load->view('admin_template/footer');
       // $where = array('mutasinoid' => '9' , 'mutasiindx'=>'200');
        //$data['skmut'] = $this->SKMutasi_Panitera_model->getListDataSK($where);
        //var_dump($data['skmut']);
  }

  function viewDataSK($stage){
    $where = array('id_stage' => $stage );
      $data['skmut'] = $this->SKMutasi_Panitera2_model->getDataWhere($where, 'tbl_skmutasi_panitera_lain');
      var_dump($data['skmut']);
      
    
        $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('SK/Mutasi/SKMutasi_Panitera_view',$data);
        $this->load->view('admin_template/footer');

  }
}