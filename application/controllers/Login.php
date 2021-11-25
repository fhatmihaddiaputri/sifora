<?php
class Login extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('login_model');
    $this->load->model('Stage_model');

    $this->load->helper('my_helper');
    $this->load->library('form_validation'); 
  }

  function index(){
    $this->load->view('login_view2');
  }

  function auth(){
    $email    = $this->input->post('email',TRUE);
    $password = md5($this->input->post('password',TRUE));
    $validate = $this->login_model->validate($email,$password);
	//var_dump($validate);
    if($validate->num_rows() > 0){
        $data  = $validate->row_array();
		//var_dump($data);
        $user_id  = $data['user_id'];
       
        $name  = $data['user_name'];
        $nip  = $data['NIP'];
        $email = $data['user_email'];
        $id_jab = $data['user_id_jab'];
        $desc = $data['user_id_jab'];
        $start_stage='';
          $start_stage_name='';
          $end_stage='';
          $end_stage_name='';
          
		  //echo $level;
      if($id_jab === '0'){
        $level='1';
           

      }else{

           $getlevel = $this->login_model->getLevel($id_jab);
            var_dump($getlevel);
            if($getlevel->num_rows() > 0){
              $lvl  = $getlevel->row_array();
              $level= $lvl['id_level'];
              $level_name= $lvl['level'];
              $id_group= $lvl['id_group'];
              $group_name= $lvl['group_name'];
              $jabatan= $lvl['jabatan'];
              
              }
             $where = array('id_level' => $level ); 
            $getStage = $this->Stage_model->get_where('tbl_ref_stage', $where);
          //var_dump($getStage);

          //
          //array(2) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(4) "STAF" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(5) { ["id_stage"]=> string(2) "11" ["stage_name"]=> string(11) "FINAL/ARSIP" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(2) "11" } }
         // echo count($getStage);
          if(count($getStage)===2){

            $start_stage=$getStage[0]['id_stage'];
           $start_stage_name=$getStage[0]['stage_name'];
            $end_stage=$getStage[1]['id_stage'];
            $end_stage_name=$getStage[1]['stage_name'];
           

          }else{
              $start_stage=$getStage[0]['id_stage'];
             $start_stage_name=$getStage[0]['stage_name'];
            $end_stage='';
            $end_stage_name='';
           

          }
      }

        $sesdata = array(
            'userid'=> $user_id,
            'username'  => $name,
            'email'     => $email,
            'nip'     => $nip,
            'level'     => $level,
            'desc'     => $desc,
            'level_name'=>$level_name,
            'id_group'=>$id_group,
            'group_name'=>$group_name,
            'jabatan'=>$jabatan,
            'start_stage'=>$start_stage,
            'start_stage_name'=>$start_stage_name,
            'end_stage'=>$end_stage,
            'end_stage_name'=>$end_stage_name,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($sesdata);
        var_dump($this->session->userdata());
        log_message("debug", "login uer :".$name);
        // tambahkan logger

        // access login for admin
        if($level === '1'){
            redirect('page');

        // access login for other user
        }elseif($level !=null){
         
          redirect('page/dashboard');

        // access login for pt
        }else{
            redirect('login');
        }
    }else{
        echo $this->session->set_flashdata('error','Username atau Password salah');
        redirect('login');
    }
  }

  function logout(){
      $this->session->sess_destroy();
      redirect('login');
  }

 function reset_view(){
    $this->load->view('reset_view');

 }

 function reset_password($reset_key){
    $data['reset_key']= $reset_key;
    $this->load->view('reset_password_view', $data);

 }

 function reset_action(){
      $this->form_validation->set_rules('password','password', 'required|min_length[6]|matches[retype_password]');  
      $this->form_validation->set_rules('retype_password','retype_password', 'required|min_length[6]|matches[password]');
      $reset_key= $this->input->post('reset_key');
            
      if($this->form_validation->run()){
            echo $reset_key;
            $password= md5($this->input->post('password',TRUE));
            echo "password sama : ". $password;
            $data = array('user_password' =>$password );
            $where = array('reset_key' => $reset_key );
            $table= 'tbl_user';
            if($this->login_model->update_data($data, $where, $table)){

                echo $this->session->set_flashdata('msg','Reset Password berhasil');
                redirect('login');
            }else{
                echo $this->session->set_flashdata('error','Terjadi kesalahan silahkan coba lagi');
                redirect('login/reset_password/'.$reset_key);

            }

      }else{
         echo $this->session->set_flashdata('error','Password minimal 6 karakter');
            redirect('login/reset_password/'.$reset_key);
       
        //echo "password tidak sesuai";
      }
 
  //if()
 }
 function reset_validation(){
    $email = $this->input->post('email');
    $reset_key = random_strings(50);
    echo $reset_key;
    // update db user set reset_key 
    $data = array('reset_key' =>$reset_key);
    $where = array('user_email' => $email);
    $table='tbl_user';
    if($this->login_model->update_data($data, $where, $table)){
      //  $this->load->library('email');
        $config = array();
        $config['charset']='utf-8';
        $config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "5";
        $config['smtp_user']= "subditpaniterajurusita@gmail.com"; //isi dengan email anda
        $config['smtp_pass']= "1sampai21"; // isi dengan password dari email anda
        $config['crlf']="\r\n";
        $config['newline']="\r\n";

        $config['wordwrap'] = TRUE;

        $this->load->library('email', $config);

       // $this->email->initialize($config);
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject('Reset Password Aplikasi SIFORA Binganis');
        $message= "<p>Anda melakukan permintaan untuk reset password</p>";
        $message.= "<a href='".site_url('login/reset_password/'.$reset_key)."'>klik reset password</a>";
        $this->email->message($message);
        $this->email->send();
       //echo $this->session->set_flashdata('msg','silahkan cek email anda');
         //   redirect('login/reset_view');
        
        if($this->email->send()){
            echo $this->session->set_flashdata('msg','silahkan cek email anda');
            redirect('login/reset_view');
        }else{

           echo $this->session->set_flashdata('error','Gagal mengirim email terjadi error');
           redirect('login/reset_view');
        }
        
    }else{

      echo $this->session->set_flashdata('error','Email belum terdaftar');
           redirect('login/reset_view');
     

    }



 }
}
