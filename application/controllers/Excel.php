<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }

  function index(){

  	$this->load->model('Excel_model');
  	$data = array();
  	$this->Excel_model->exportToExcel('sk_kpo.xlsx', $data);
  }

}