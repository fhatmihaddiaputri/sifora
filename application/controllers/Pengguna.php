<?php
class Pengguna extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
    $this->load->model('pengguna_model');
     $this->load->model('jabatan_model');
  }

  function index(){

  	  $data['pengguna'] = $this->pengguna_model->getData();
  	  $data['jabatan']= $this->jabatan_model->get_data();
       // var_dump($data);
  	    $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('pengguna/pengguna_view',$data);
        $this->load->view('admin_template/footer');
  }

  function hapus($id){
  		$where = array('user_id' => $id );
  		$this->pengguna_model->hapus_data($where,'tbl_user');
  		redirect('pengguna/index');

  }

  function edit($id){
		$where = array('user_id' => $id );
		var_dump($where);
  		
  		$data['pengguna']= $this->pengguna_model->edit_data($where, 'tbl_user')->result_array();
  		$data['jabatan']= $this->jabatan_model->get_data();
    	$this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('pengguna/pengguna_edit_view',$data);
        $this->load->view('admin_template/footer');

  }

  function tambah_aksi(){

  	$user_name= $this->input->post('user_name');
    $user_password= md5($this->input->post('user_password'));
  	$user_email= $this->input->post('user_email');
  	$user_id_jab= $this->input->post('user_id_jab');

  	$data = array('user_id' =>'' ,
  					'user_name'=>$user_name,
  					'user_password'=>$user_password,
  					'user_email'=>$user_email,
  					'user_id_jab'=>$user_id_jab );
  	$this->pengguna_model->input_data($data,'tbl_user');
  	redirect('pengguna/index');
  		
  }

function edit_aksi(){
		
	$user_id= $this->input->post('user_id');
    $user_name= $this->input->post('user_name');
    $user_password= md5($this->input->post('user_password'));
  	$user_email= $this->input->post('user_email');
  	$user_id_jab= $this->input->post('user_id_jab');

  	$data = array('user_id' =>'' ,
  					'user_name'=>$user_name,
  					'user_password'=>$user_password,
  					'user_email'=>$user_email,
  					'user_id_jab'=>$user_id_jab );
  	$where = array('user_id' => $user_id );
  	$this->pengguna_model->update_data($data,$where,'tbl_user');
  	redirect('pengguna/index');
  		
  }

}
 ?>