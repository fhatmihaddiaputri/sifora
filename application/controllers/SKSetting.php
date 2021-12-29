<?php
class SKSetting extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
     $this->load->model('pengguna_model');
     $this->load->model('jabatan_model');
     $this->load->model('SKSetting_model');

  }

  function index(){

  	    $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('setting/setting_view',$data);
        $this->load->view('admin_template/footer');
  }

  function Mutasi(){

      $group_name= $this->session->userdata('group_name');
      
      $data['all_temp']=$this->SKSetting_model->getTemplateMutasibyGroup($group_name);
    //  var_dump($data['all_temp']);
      //echo "Jenis : ".$data['all_temp'][0]['jenis']. " |url_autentik=".$data['all_temp'][0]['url_autentik'];
    //  echo "Jenis : ".$data['all_temp'][1]['jenis']. " |url_autentik=".$data['all_temp'][1]['url_autentik'];

      /*
      array(2) {
  [0]=>
  array(5) {
    ["id_jenis"]=>
    string(1) "1"
    ["jenis"]=>
    string(9) "Mutasi_PT"
    ["url_autentik"]=>
    string(77) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PT\Autentik.docx"
    ["url_petikan"]=>
    string(76) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PT\Petikan.docx"
    ["url_salinan"]=>
    string(76) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PT\Salinan.docx"
  }
  [1]=>
  array(5) {
    ["id_jenis"]=>
    string(1) "2"
    ["jenis"]=>
    string(9) "Mutasi_PN"
    ["url_autentik"]=>
    string(77) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PN\Autentik.docx"
    ["url_petikan"]=>
    string(76) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PN\Petikan.docx"
    ["url_salinan"]=>
    string(76) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PN\Salinan.docx"
  }
}
*/
      
      $data['judul'] = "Template SK Mutasi ".$this->session->userdata('group_name');
        $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('setting/setting_mutasi',$data);
        $this->load->view('admin_template/footer');
      
  }

  function KP(){
       $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('setting/setting_kp',$data);
        $this->load->view('admin_template/footer');
  }

  function viewTemplate($group, $jenis, $id){
    $data_template=$this->SKSetting_model->getTemplateMutasiWhere($group,$id);
    var_dump($data_template);
    $url="";


    /*
      array(1) { [0]=> array(5) { ["id_jenis"]=> string(1) "1" ["jenis"]=> string(9) "Mutasi_PT" ["url_autentik"]=> string(77) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PT\Autentik.docx" ["url_petikan"]=> string(76) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PT\Petikan.docx" ["url_salinan"]=> string(76) "C:\xampp\htdocs\sifora\application\docx\temp_sk\mutasi\hakim\PT\Salinan.docx" } }
    */
    if($jenis==='Otentik'){
      $url= $data_template[0]['url_autentik'];
    }elseif($jenis==='Petikan'){
      $url= $data_template[0]['url_petikan'];
    }else{
      $url= $data_template[0]['url_salinan'];
    }
    echo $url;
    $this->load->helper('download');
    force_download($url, null);
  }


  function upload($group, $jenis, $id){
      echo "do nothing";
      $this->load->helper('form');
        
      $data_template=$this->SKSetting_model->getTemplateMutasiWhere($group,$id);
      if($jenis==='Otentik'){
        $name='';
        $url= $data_template[0]['url_autentik'];
        $name= 'Autentik.docx';
      }elseif($jenis==='Petikan'){
        $url= $data_template[0]['url_petikan'];
        $name='Petikan.docx';
      }else{
        $url= $data_template[0]['url_salinan'];
        $name='Salinan.docx';
      }
      echo "dirname : ".dirname($url);

      $fromFile= "uploadSKMutasi".$this->session->userdata('group_name').$id.$jenis;
      echo $fromFile;
        $config['upload_path'] = dirname($url).'\\';
        $config['allowed_types'] = 'docx';
        $config['max_size'] = 2000;
        $config['overwrite'] = TRUE;

        $new_name= $name;
        $config['file_name'] = $new_name;
        print_r($_FILES);
        var_dump($config);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($fromFile)) 
        { 
            $error = array('error' => $this->upload->display_errors());
            //message jika sukses 
             echo $this->session->set_flashdata('error','Template gagal diupload '.$error);
             //
             
            //$this->load->view('imageupload_form', $error);
            var_dump($error);
        } 
        else 
        {
            $data = array('image_metadata' => $this->upload->data());
             //message jika sukses 
             echo $this->session->set_flashdata('msg','Template berhasil diubah');
             //

            //$this->load->view('imageupload_success', $data);
            print_r( $data);
            redirect('SKSetting/Mutasi');

            /*
            synArray ( [formFile] => Array ( [name] => SK KP-min.pdf [type] => application/pdf [tmp_name] => C:\xampp\tmp\php749F.tmp [error] => 0 [size] => 415090 ) ) array(1) { ["image_metadata"]=> array(14) { ["file_name"]=> string(23) "1628862937SK_KP-min.pdf" ["file_type"]=> string(15) "application/pdf" ["file_path"]=> string(30) "C:/xampp/htdocs/sifora/upload/" ["full_path"]=> string(53) "C:/xampp/htdocs/sifora/upload/1628862937SK_KP-min.pdf" ["raw_name"]=> string(19) "1628862937SK_KP-min" ["orig_name"]=> string(23) "1628862937SK_KP-min.pdf" ["client_name"]=> string(13) "SK KP-min.pdf" ["file_ext"]=> string(4) ".pdf" ["file_size"]=> float(405.36) ["is_image"]=> bool(false) ["image_width"]=> NULL ["image_height"]=> NULL ["image_type"]=> string(0) "" ["image_size_str"]=> string(0) "" } }
            */
           /*
                   $file_loc =  $data['image_metadata']['file_path'].$data['image_metadata']['file_name'];
                    echo "<br/>".$id_group ."|".$file_loc;
                    $where= array('skmutasinoid' =>$id_group);
                    $datalampiran = array('lampiran' =>$file_loc);
                    $this->SKMutasi_Panitera_model->uploadLampiran($where,'tbl_skmutasi_panitera', $datalampiran);
                 // $file_location = $data['formFile']['file_path'].$data['formFile']['file_name'];
           // echo "<br/> file loc :".$file_location;
          redirect('SKMutasi_Panitera/viewDataSK/5');
        }*/
    }

  }
}?>