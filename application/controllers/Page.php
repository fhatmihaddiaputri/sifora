<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }

  function index(){
    echo  "masuk ".$this->session->userdata('logged_in');
    //Allowing akses to admin only
      if($this->session->userdata('level')==='1'){
          
          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('dashboard');
          $this->load->view('admin_template/footer');
      }else{
          echo "Access Denied";
      }

  }
/*
  function staff(){
    //Allowing akses to staff only
    if($this->session->userdata('level')==='6'){
      //$this->load->view('dashboard_view2');
          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('dashboard_staf');
          $this->load->view('admin_template/footer');
    }else{
        echo "Access Denied";
    }
  }
*/
  function dashboard_old(){
    //Allowing akses to author only
    if($this->session->userdata('level')!=null){

          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('dashboard');
          $this->load->view('admin_template/footer');

      //$this->load->view('dashboard_view2');
    }else{
        echo "Access Denied";
    }
  }

  function dashboard(){
      if($this->session->userdata('level')!=null){


       /* $data['skkp_start_stage_hakim']=$this->SKKP_Hakim_model->getAllDataSync('kp', $this->session->userdata('start_stage'));
        $data['skmut_start_stage_hakim']=$this->SKMutasi_Hakim_model->getAllDataSync('mutasi', $this->session->userdata('start_stage'));
        $data['skkp_end_stage_hakim']=$this->SKKP_Hakim_model->getAllDataSync('kp', $this->session->userdata('end_stage'));
        $data['skmut_end_stage_hakim']=$this->SKMutasi_Hakim_model->getAllDataSync('mutasi', $this->session->userdata('end_stage'));
        


        $data['skkp_start_stage_panitera']=$this->SKKP_model->getAllDataSync('kp', $this->session->userdata('start_stage'));
        $data['skmut_start_stage_panitera']=$this->SKMutasi_model->getAllDataSync('mutasi', $this->session->userdata('start_stage'));
        $data['skkp_end_stage_panitera']=$this->SKKP_model->getAllDataSync('kp', $this->session->userdata('end_stage'));
        $data['skmut_end_stage_panitera']=$this->SKMutasi_model->getAllDataSync('mutasi', $this->session->userdata('start_stage'));
        */


        $data['skkp_start_stage_hakim']='50';
        $data['skmut_start_stage_hakim']='50';
        $data['skkp_end_stage_hakim']='50';
        $data['skmut_end_stage_hakim']='50';
        


        $data['skkp_start_stage_panitera']='50';
        $data['skmut_start_stage_panitera']='50';
        $data['skkp_end_stage_panitera']='50';
        $data['skmut_end_stage_panitera']='50';
        /*if($this->session->userdata('group_name')==='All'){

          $this->load->view('admin_template/head');
          $this->load->view('user_template/dirjen_sidebar');
          $this->load->view('dashboard', $data);
          $this->load->view('admin_template/footer');
        }else{*/
               $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar', $data);
          $this->load->view('dashboard', $data);
          $this->load->view('admin_template/footer');

        //}
          

      //$this->load->view('dashboard_view2');
//        }
    }else{
        echo "Access Denied";
    }

  }

}
