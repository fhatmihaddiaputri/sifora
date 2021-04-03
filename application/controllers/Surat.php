<?php
class Surat extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }

  function suratMasuk(){
    //Allowing akses to admin only
      if($this->session->userdata('level')!=null){
          
          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('daftar_surat_masuk');
          $this->load->view('admin_template/footer');
      }else{
          echo "Access Denied";
      }

  }
  function suratMasukInput(){

    $data = array(
      'id_surat' => '',
      'nama'=>'',
      'jabatan'=>'',
      'satker'=>'',
      'kategori_surat'=>'',
      'asalSurat'=> '',
      'hal'=>'',
      'no_surat'=>'',
      'tgl_surat'=>''
      );
    if($this->session->userdata('level')!=null){
          
          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('form_surat_masuk',$data);
          $this->load->view('admin_template/footer');
      }else{
          echo "Access Denied";
      }
  }

  function suratKeluar(){
    //Allowing akses to staff only
    if($this->session->userdata('level')!=null){
        //$this->load->view('dashboard_view2');
          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('daftar_surat_keluar');
          $this->load->view('admin_template/footer');
    }else{
        echo "Access Denied";
    }
  }

  function author(){
    //Allowing akses to author only
    if($this->session->userdata('level')==='3'){
          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('dashboard');
          $this->load->view('admin_template/footer');

      //$this->load->view('dashboard_view2');
    }else{
        echo "Access Denied";
    }
  }

}
