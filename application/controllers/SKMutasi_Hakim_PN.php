<?php
class SKMutasi_Hakim_PN extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
    $this->load->model('SKMutasi_Hakim_PN_model');
    $this->load->model('Surat_model');
    $this->load->model('Stage_model');
    $this->load->model('PDF_model');
    $this->load->helper('my_helper');
    $this->load->library('ciqrcode'); //meload library barcode

    $this->load->model('Excel_model'); //meload library barcode    
  }

  function index(){
     /*if($this->session->userdata('level_name')!=='Staf'){
        redirect('SKMutasi_Panitera/viewDataSK/'.$stage);

     }*/
  	   $data['skmut'] = $this->SKMutasi_Hakim_PN_model->getData();
      //var_dump($data['skmut']);

      //array(11) { [0]=> array(27) { ["mutasinoid"]=> string(1) "4" ["mutasidate"]=> string(10) "2020-08-31" ["mutasinomor"]=> string(25) "853/DJU/SK/KP.04.5/8/2020" ["rapatpim"]=> NULL ["jabatan"]=> NULL ["judulsk"]=> NULL ["mutasidescr"]=> NULL ["mutasifiles"]=> string(19) "SK RAPIM AGUST 2020" ["mutasidirjen"]=> string(12) "PRIM HARYADI" ["mutasidirtng"]=> string(13) "LUCAS PRAKOSO" ["jumlahkata"]=> string(1) "4" ["namadipa01"]=> NULL ["namadipa02"]=> NULL ["namadipa03"]=> NULL ["tanggalotk"]=> string(10) "2020-08-31" ["tanggalttd"]=> string(10) "2020-08-31" ["printotentik"]=> string(1) "N" ["jumlahhakim"]=> string(2) "33" ["jumlahsalin"]=> string(1) "0" ["jumlahpetik"]=> string(1) "0" ["jumlahcheck"]=> string(1) "0" ["statusupdate"]=> string(1) "Y" ["statuslocked"]=> string(1) "Y" ["createnoid"]=> string(2) "10" ["createdate"]=> string(23) "2020-06-10 23:56:39.145" ["updatenoid"]=> string(2) "10" ["updatedate"]=> string(23) "2020-06-10 23:56:41.191" }
      
    
  	    $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('SK/Mutasi/SKMutasi_Hakim_PN_view',$data);
        $this->load->view('admin_template/footer');
       // $where = array('mutasinoid' => '9' , 'mutasiindx'=>'200');
        //$data['skmut'] = $this->SKMutasi_Panitera_model->getListDataSK($where);
        //var_dump($data['skmut']);
  }
 function getCountListDataSK($idgroupsk){
  var_dump($idgroupsk);
    $where = array('mutasinoid' =>$idgroupsk );

   $data = $this->SKMutasi_Hakim_PN_model->getCountListDataSK($where);
   $hasil = array('mutasinoid' => $idgroupsk, 'count'=>$data[0]['count'] );
    return $hasil;
  }

   function sync($id_group, $jml_sk){
    echo $id_group;
    if($jml_sk!=='0'){
        $where  = array('mutasinoid' => $id_group );
        $data['skmut'] = $this->SKMutasi_Hakim_PN_model->getWhere($where);
     var_dump($data);


        $userid = $this->session->userdata('userid');
       // echo $userid;
        $now = new DateTime();

        $update_date= $now->format('Y-m-d H:i:s'); 


        //array(1) { ["skmut"]=> array(1) { [0]=> array(27) { ["mutasinoid"]=> string(2) "12" ["mutasidate"]=> string(10) "2021-07-16" ["mutasinomor"]=> string(26) "1410/DJU/SK/KP.04.5/7/2021" ["rapatpim"]=> NULL ["jabatan"]=> NULL ["judulsk"]=> NULL ["mutasidescr"]=> string(23) "Mutasi Karena Huru Hara" ["mutasifiles"]=> string(0) "" ["mutasidirjen"]=> string(12) "PRIM HARYADI" ["mutasidirtng"]=> string(13) "LUCAS PRAKOSO" ["jumlahkata"]=> string(1) "6" ["namadipa01"]=> NULL ["namadipa02"]=> NULL ["namadipa03"]=> NULL ["tanggalotk"]=> string(10) "2021-07-16" ["tanggalttd"]=> string(10) "2021-07-16" ["printotentik"]=> string(1) "N" ["jumlahhakim"]=> string(1) "3" ["jumlahsalin"]=> string(1) "0" ["jumlahpetik"]=> string(1) "0" ["jumlahcheck"]=> string(1) "0" ["statusupdate"]=> string(1) "Y" ["statuslocked"]=> string(1) "Y" ["createnoid"]=> string(2) "12" ["createdate"]=> string(23) "2021-07-14 19:24:45.798" ["updatenoid"]=> string(2) "12" ["updatedate"]=> string(23) "2021-07-14 19:24:47.349" } } }


       $dataGroup = array('id' =>'' ,
                  'skmutasinoid' => $data['skmut'][0]['mutasinoid'] ,
                  'tgl_tpm' => $data['skmut'][0]['tanggalotk'] ,
                  'nomor_sk' => $data['skmut'][0]['mutasinomor'] ,
                  'tgl_sk' => $data['skmut'][0]['mutasidate'] ,
                  'dirjen' => $data['skmut'][0]['mutasidirjen'] ,
                  'direktur' => $data['skmut'][0]['mutasidirtng'],
                  
                  'nama_dipa' => $data['skmut'][0]['namadipa01'] ,
                  'desc' => $data['skmut'][0]['mutasidescr'] ,
                  'updated_date' => $update_date,
                  'updated_user_id'=> $userid,
                  'jumlah'=> $data['skmut'][0]['jumlahhakim'],
                   'jenis_rapat'=> $data['skmut'][0]['rapatpim']
                   );
         
          $this->SKMutasi_Hakim_PN_model->addData($dataGroup, 'tbl_skmutasi_hakim_pn'); 

         $data['skmut'] = $this->SKMutasi_Hakim_PN_model->getDataDBSync('tbl_skmutasi_hakim_pn');
         $cond = array('kategori_surat' => 'SKMUT','id_group'=>'1' );
         $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
         $sksync=$this->SKMutasi_Hakim_PN_model->addDataSK('tbl_skmutasi_hakim_pn_data', $where, $stage) ;
       

        $this->load->view('admin_template/head');
         $this->load->view('admin_template/sidebar');
         $this->load->view('SK/Mutasi/SKMutasi_Hakim_PN_sincronized_view',$data);
         $this->load->view('admin_template/footer');


    }else{

         echo $this->session->set_flashdata('error','Sinkronisasi gagal! tidak ada data dalam group');
         redirect('SKMutasi_Hakim_PN');
    }
    
     

  }

  function viewDataSK($stage){
      

         // array(2) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(4) "STAF" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(5) { ["id_stage"]=> string(2) "11" ["stage_name"]=> string(11) "FINAL/ARSIP" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(2) "11" } }
          //$where = array('id_stage' => $stage );
            //   $data['skkp']=$this->SKKP_model->getWhereDBSync($where, 'tbl_skkp_panitera_data');
          $data['skmut']=$this->SKMutasi_Hakim_PN_model->getDataGroupSKSync();
             //  var_dump($data);
          $data['stage']=$this->getStage();



          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/Mutasi/SKMutasi_Hakim_PN_sincronized_view',$data);
          $this->load->view('admin_template/footer');

  }

  function listDataGroup($id_group){

      $where = array('id_group_sk'=>$id_group);
      $data['skmut']=$this->SKMutasi_Hakim_PN_model->getDataSKSync($where);
      
      $data['stage']=$this->getStage();
      $table='tbl_skmutasi_hakim_pn';
      $where2 = array('skmutasinoid' => $id_group );
      $data['skgroup']=$this->SKMutasi_Hakim_PN_model->getWhereDBSync($where2, $table);
    // var_dump($data['skgroup']);


      $this->load->view('admin_template/head');
      $this->load->view('admin_template/sidebar');
      $this->load->view('SK/Mutasi/SKMutasi_Hakim_PN_data_view',$data);
      $this->load->view('admin_template/footer');

  }

  //function untuk menampilkan start_stage dan end_stage dari SK
  function getStage(){

      $cond = array('kategori_surat' => 'SKMUT','id_group'=>'1' );
      $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
      return $stage;
      var_dump($stage);
      //array(1) { [0]=> array(5) { ["id_kategori_surat"]=> string(1) "2" ["kategori_surat"]=> string(4) "SKKP" ["id_group"]=> string(1) "2" ["start_stage"]=> string(1) "5" ["end_stage"]=> string(2) "10" } }
      echo $stage[0]['start_stage'];
      echo $stage[0]['end_stage'];


  }

  function viewHistory($id_group_sk, $id_sk, $stage, $menu){

      $where = array('id_group_sk' =>$id_group_sk ,'id_sk'=>$id_sk );

      $where2 = array('id_group' =>$id_group_sk ,'id_sk'=>$id_sk );
      $data['skmut']= $this->SKMutasi_Hakim_PN_model->getWhereDBSync($where, 'tbl_skmutasi_hakim_pn_data');
      $data['history']=  $this->SKMutasi_Hakim_PN_model->getHistory($where2);
      $data['stage']= $stage;
      $data['menu']=$menu;
      $data['id_group_sk']= $id_group_sk;
      /*
            synarray(1) {
        [0]=>
        array(13) {
          ["id_history"]=>
          string(1) "9"
          ["id_group"]=>
          string(2) "26"
          ["id_sk"]=>
          string(1) "1"
          ["id_stage"]=>
          string(1) "5"
          ["id_status"]=>
          string(1) "7"
          ["tgl"]=>
          string(19) "2021-04-29 20:31:16"
          ["keterangan"]=>
          string(11) "syncronized"
          ["status"]=>
          string(6) "PROSES"
          ["alert_color"]=>
          string(7) "success"
          ["stage_name"]=>
          string(11) "STAF-PROSES"
          ["id_level"]=>
          string(1) "6"
          ["stage_status"]=>
          string(1) "1"
          ["stage_order"]=>
          string(1) "5"
        }
      }
      
      */

          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/Mutasi/SKMutasi_Hakim_PN_History_view',$data);
          $this->load->view('admin_template/footer');
  }

  function fileSK($jenis, $id_group_sk, $id_sk){
        $where = array('id_group_sk' =>$id_group_sk , 'id_sk'=>$id_sk );
        $where2 = array('skmutasinoid' =>$id_group_sk);
        $data =$this->SKMutasi_Hakim_PN_model->getWhereDBSync($where, 'tbl_skmutasi_hakim_pn_data');
        $datagroup =$this->SKMutasi_Hakim_PN_model->getWhereDBSync($where2, 'tbl_skmutasi_hakim_pn');
        
       
        
        $file='';
        if($jenis==='Salinan'){
          $file = $data[0]['file_loc_salinan'];
        }elseif($jenis==='Petikan'){
          $file = $data[0]['file_loc_petikan'];

        }else{
             if($jenis==='Otentik'){
                $file= $datagroup[0]['file_loc_otentik'];
             
             }else{
              //  ini untuk melihat file daftar lampiran.. nnti harus ditambahkan menu untuk upload daftar lampiran dan view daftar lampiran
                $file= $datagroup[0]['lampiran'];
                echo "lampiran ". $file;
             
             
             }
          
         
        }
        
       

        if (!file_exists($file)) {

            echo "The file $file does not exist";
            //die();
            // call function to create sk
            if($jenis==='Otentik'){
               $this->PDF_model->generateSKMutasiHakimPNOtentik($datagroup);
               $this->fileSK($jenis, $id_group_sk, '0');
               die();
             }else{
               $this->PDF_model->generateSKMutasiHakimPN($data,$datagroup, $jenis);
               $this->fileSK($jenis, $id_group_sk, $id_sk);
              die();
             }
             

            
        }else{
            if(($jenis==='Otentik')||($jenis==='Lampiran')){

                $this->load->helper('download');
                force_download($file, null);
            } else{
                  //nama file untuk tampilan
               $filename='skmutasi_pn_'.$id_group_sk.'.pdf';
                //echo $file;
               header('Content-type:application/pdf');
               header('Content-disposition: inline; filename="'.$filename.'"');
               header('content-Transfer-Encoding:binary');
               header('Accept-Ranges:bytes');
               //membaca dan menampilkan file
               readfile($file);

            }  
      
     }

    }
    function uploadDaftar($stage){
        $this->load->helper('form');
        $id_group= $this->input->post('id_group',TRUE);
        $config['upload_path'] = APPPATH.'docx\SK\MUTASI\HAKIM\PN';
        $config['allowed_types'] = 'docx';
        $config['max_size'] = 2000;
        $new_name= time()."_".$_FILES["formFile"]['name'];
        $config['file_name'] = $new_name;
        print_r($_FILES);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('formFile')) 
        {
            $error = array('error' => $this->upload->display_errors());
 
            //$this->load->view('imageupload_form', $error);
            var_dump($error);
        } 
        else 
        {


          $jenis='Lampiran';
           $data = array('image_metadata' => $this->upload->data());
 
           $where= array('skmutasinoid' =>$id_group);

           //$this->SKMutasi_Hakim_PN_model->uploadSK($where,'tbl_skmutasi_hakim_pn_data', $data_update);

           $filepath=$config['upload_path'] .'\\'. $config['file_name']; 
           $this->PDF_model->generatePDFSKAutentikMutasiHakimPNUpload($filepath,$jenis, $id_group);
                 
           echo $this->session->set_flashdata('msg','SK '.$jenis.' berhasil diupload');
           redirect('SKMutasi_Hakim_PN/listDataGroup/'.$id_group);

            
        }
    
    }

    function uploadSK($jenis){
        $this->load->helper('form');
        $id_group_sk= $this->input->post('id_group',TRUE);
        $id_sk= $this->input->post('id_sk',TRUE);
        $nip= $this->input->post('nip',TRUE);
        echo $nip;
        $config['upload_path'] =APPPATH.'docx\SK\MUTASI\HAKIM\PN';
        $config['allowed_types'] = 'docx';
        $config['max_size'] = 4000;

        //$new_name= time()."_".$_FILES["formFile"]['name'];
        if($jenis==='Salinan'){
             $config['file_name'] = 'Salinan_'.$id_group_sk.'_'.$id_sk.'.docx';
       
           // $data_update = array('file_loc_salinan' => $config['upload_path'] .'\\'. $config['file_name'] );
        }elseif($jenis==='Petikan'){
             $config['file_name'] = 'Petikan_'.$id_group_sk.'_'.$id_sk.'.docx';
            
            // $data_update = array('file_loc_petikan' => $config['upload_path'] .'\\'. $config['file_name']);
        }
        print_r($_FILES);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('formFile')) 
        {
            $error = array('error' => $this->upload->display_errors());
 
            //$this->load->view('imageupload_form', $error);
            var_dump($error);
        } 
        else 
        {
            $data = array('image_metadata' => $this->upload->data());
 
           $where= array('id_group_sk' =>$id_group_sk, 'id_sk'=>$id_sk);

           //$this->SKMutasi_Hakim_PN_model->uploadSK($where,'tbl_skmutasi_hakim_pn_data', $data_update);

           $filepath=$config['upload_path'] .'\\'. $config['file_name']; 
           $this->PDF_model->generatePDFSKMutasiHakimPNUpload($filepath,$jenis, $id_group_sk,$nip, $id_sk);
                 
           echo $this->session->set_flashdata('msg','SK '.$jenis.' nip :'. $nip.' berhasil diupload');
           redirect('SKMutasi_Hakim_PN/listDataGroup/'.$id_group_sk);
        }
    
    }


    function verifySK($idgroupsk, $idx, $stage, $id_status){
      $where = array('id_stage' => $stage );
      $nextStage='';
      $nextStage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($nextStage);
      // array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } }
      $nextStage = intval($nextStage[0]['stage_order'])+1;
      $where = array('stage_order' =>$nextStage, 'stage_status'=>'1');
      $next_Stage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($nextStage);
      //array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } } array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "6" ["stage_name"]=> string(15) "KASI-VERIFIKASI" ["id_level"]=> string(1) "5" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "6" } }
      
      $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
      
      if(!empty($nextStage)){

        

      }else{

          $where2 = array('stage_order' =>$nextStage, 'stage_status'=>'1');
          $nextStage= $this->Stage_model->get_where('tbl_ref_stage', $where2);
        
      }

        //var_dump($next_Stage);
      $data = array('id_stage' => $next_Stage[0]['id_stage'] , 'id_status'=> $id_status ,'updated_date'=>$update_date,'keterangan'=>'di setujui oleh '.$this->session->userdata('username'), 'updated_user_id'=>$this->session->userdata('userid'));

      //var_dump($data);
      $where = array('id_group_sk' => $idgroupsk,'id_sk'=>$idx );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn_data', $data, $where);

     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
     $this->SKMutasi_Hakim_PN_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di proses/verifikasi');
        
    // if($this->session->userdata('end_stage')!==''){
        redirect('SKMutasi_Hakim_PN/listDataGroup/'.$idgroupsk);
     //}else{
      //  redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}

     //insert history status



    //redirect('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));
 }


function signedSK($idgroupsk, $idx, $stage){
      $where = array('id_stage' => $stage );
      $nextStage='';
      $nextStage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($nextStage);
      // array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } }
      $nextStage = intval($nextStage[0]['stage_order'])+1;
      $where = array('stage_order' =>$nextStage, 'stage_status'=>'1');
      $next_Stage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($nextStage);
      //array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } } array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "6" ["stage_name"]=> string(15) "KASI-VERIFIKASI" ["id_level"]=> string(1) "5" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "6" } }
      
      $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
      
      if(!empty($nextStage)){

        

      }else{

          $where2 = array('stage_order' =>$nextStage, 'stage_status'=>'1');
          $nextStage= $this->Stage_model->get_where('tbl_ref_stage', $where2);
        
      }

        //var_dump($next_Stage);
      $data = array('id_stage' => $next_Stage[0]['id_stage'] , 'id_status'=> '14' ,'updated_date'=>$update_date,'keterangan'=>'proses', 'updated_user_id'=>$this->session->userdata('userid'));

      //var_dump($data);
      $where = array('id_group_sk' => $idgroupsk,'id_sk'=>$idx );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn_data', $data, $where);

     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
     $this->SKMutasi_Hakim_PN_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di tanda tangani');
        
        redirect('SKMutasi_Hakim_PN/listDataGroup/'.$idgroupsk);
   
 }
 function signedGroupSK($idgroupsk, $stage){
      $where = array('id_stage' => $stage );
      $nextStage='';
      $nextStage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($nextStage);
      // array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } }
      $nextStage = intval($nextStage[0]['stage_order'])+1;
      $where = array('stage_order' =>$nextStage, 'stage_status'=>'1');
      $next_Stage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($nextStage);
      //array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } } array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "6" ["stage_name"]=> string(15) "KASI-VERIFIKASI" ["id_level"]=> string(1) "5" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "6" } }
      
      $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
      
      if(!empty($nextStage)){

        

      }else{

          $where2 = array('stage_order' =>$nextStage, 'stage_status'=>'1');
          $nextStage= $this->Stage_model->get_where('tbl_ref_stage', $where2);
        
      }

        //var_dump($next_Stage);
      $data = array('id_stage' => $next_Stage[0]['id_stage'] , 'id_status'=> '14' ,'updated_date'=>$update_date,'keterangan'=>'proses', 'updated_user_id'=>$this->session->userdata('userid'));

      //var_dump($data);
      $where = array('id_group_sk' => $idgroupsk,'id_sk'=>$idx );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn', $data, $where);

     // tambahkan data history sk
     //$dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
   //  $this->SKMutasi_Hakim_PN_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di tanda tangani');
        
        redirect('SKMutasi_Hakim_PN/listDataGroup/'.$idgroupsk);
   
 }

 function verifyGroupSK($idgroupsk, $status){
        
      $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
     
      $data = array('id_status'=> $status ,'updated_date'=>$update_date, 'updated_user_id'=>$this->session->userdata('userid'));

      //var_dump($data);
      $where = array('skmutasinoid' => $idgroupsk );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn', $data, $where);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di tanda tangani');
        
    // if($this->session->userdata('end_stage')!==''){
        redirect('SKMutasi_Hakim_PN/listDataGroup/'.$idgroupsk);
  
 }

    function revisiSK(){
      //ambil data
      $stage=$this->input->post('stage');
      $idgroupsk= $this->input->post('id_group');
      $idx= $this->input->post('id_sk');
      $ket= $this->input->post('keterangan');

      echo $stage.' '.$idgroupsk.' '.$idx.' '.$ket;

      $where = array('id_stage' => $stage );
      $prevStage='';
      $prevStage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($prevStage);
      // array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } }
      $prevStage = intval($prevStage[0]['stage_order'])-1;
      $where = array('stage_order' =>$prevStage, 'stage_status'=>'1');
      $prevStage= $this->Stage_model->get_where('tbl_ref_stage', $where);
      var_dump($prevStage);
      //array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } } array(1) { [0]=> array(5) { ["id_stage"]=> string(1) "6" ["stage_name"]=> string(15) "KASI-VERIFIKASI" ["id_level"]=> string(1) "5" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "6" } }
      
      $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
      
      if(!empty($prevStage)){

        

      }else{

          $where2 = array('stage_order' =>$prevStage, 'stage_status'=>'1');
          $prevStage= $this->Stage_model->get_where('tbl_ref_stage', $where2);
        
      }

        //var_dump($next_Stage);
      $data = array('id_stage' => $prevStage[0]['id_stage'] , 'id_status'=> '6' ,'updated_date'=>$update_date, 'keterangan'=>$ket , 'updated_user_id'=>$this->session->userdata('userid'));

      //var_dump($data);

      //update stage dan status sk
      $where = array('id_group_sk' => $idgroupsk,'id_sk'=>$idx );
     $this->SKMutasi_Hakim_PN_model->update_data('tbl_skmutasi_hakim_pn_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>$ket);
     $this->SKMutasi_Hakim_PN_model->insertHistory($dataHistory);

     //if($this->session->userdata('end_stage')!==''){

        redirect('SKMutasi_Hakim_PN/listDataGroup/'.$idgroupsk);
     //}else{
       // redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}
 }

 function signSK(){

      $id_group_sk= $this->input->post('id_group',TRUE);
      $id_sk= $this->input->post('id_sk',TRUE);
      

      $passphrase= $this->input->post('passphrase',TRUE);

      echo $id_group_sk.'| id_sk :'.$id_sk.'| passphrase='.$passphrase;

     $where = array('id_group_sk' => $id_group_sk,'id_sk'=>$id_sk);

     $datask= $this->SKMutasi_Hakim_PN_model->getDataSKSync($where);
     var_dump($datask);

     //array(1) { [0]=> array(36) { ["id"]=> string(3) "490" ["id_group_sk"]=> string(2) "13" ["id_sk"]=> string(1) "1" ["no_urut"]=> string(1) "1" ["nip"]=> string(21) "19670203 199212 1 001" ["nama"]=> string(25) "LUCKY ROMBOT KALALO, S.H." ["jabatan_lama"]=> string(5) "Hakim" ["pt_lama"]=> string(5) "Ambon" ["pn_lama"]=> string(5) "Ambon" ["kelas_lama"]=> string(3) "I.A" ["jabatan_baru"]=> string(5) "Hakim" ["pt_baru"]=> string(6) "Banten" ["pn_baru"]=> string(9) "Tangerang" ["tunjangan"]=> string(8) "21000000" ["pangkat"]=> string(18) "Pembina Utama Muda" ["gol"]=> string(4) "IV/c" ["gol_relasi"]=> string(17) "Hakim Madya Utama" ["kelas_baru"]=> string(5) "I.A.K" ["kppn_lama"]=> string(5) "Ambon" ["kppn_baru"]=> string(9) "Tangerang" ["id_stage"]=> string(1) "8" ["id_status"]=> string(2) "13" ["keterangan"]=> string(6) "proses" ["file_loc_petikan"]=> string(97) "C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Petikan_13_1_19670203 199212 1 001.pdf" ["file_loc_salinan"]=> string(97) "C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Salinan_13_1_19670203 199212 1 001.pdf" ["updated_user_id"]=> string(2) "13" ["updated_date"]=> string(19) "2021-09-16 18:13:41" ["user_id"]=> string(2) "13" ["NIP"]=> string(0) "" ["user_name"]=> string(8) "direktur" ["user_password"]=> string(32) "e10adc3949ba59abbe56e057f20f883e" ["user_email"]=> string(18) "direktur@gmail.com" ["user_id_jab"]=> string(1) "2" ["reset_key"]=> string(0) "" ["status"]=> string(20) "MENUNGGU PERSETUJUAN" ["alert_color"]=> string(4) "info" } }
    $fileloc= '';
    if($this->session->userdata('level_name')==='Direktur'){

        $fileloc= $datask[0]['file_loc_salinan'];
        $this->SKMutasi_Hakim_PN_model->verifySK($id_group_sk, $id_sk, $datask[0]['id_stage'], '14');
    }elseif($this->session->userdata('level_name')==='Dirjen'){
        $fileloc= $datask[0]['file_loc_petikan'];

    }else{

      echo $this->session->set_flashdata('error','Maaf anda tidak berwenang untuk menandatangani Surat Keputusan');
         
    }
    echo $fileloc;

         // cek sk petikan udah ada atau belum, kalo belum di createkan, jika sudah langsung call api

      // call api esign
   // redirect('Tte/signSKMutasiHakimPN');
      // update status menjadi sudah ditandatangani
      // update file petikan menjadi file yang sudah ditandatangani
            
 }

 function download(){
          $data = file_get_contents("http://192.168.112.35/download/811ba7b2-5cef-4bdc-baff-4e2ff545e480");
      echo $path;
          header("Content-type: application/octet-stream");
          header("Content-disposition: attachment;filename=barusan.pdf");
        //  $data['link']= $path;
     // redirect('SKMutasi_Hakim_PN/listDataGroup/13'.$idgroupsk, $data);

        }

function generateAllSKMutasi($id_group, $jenis_sk){
    //if($jenis_group==='Hakim'){
        $where = array('id_group_sk' =>$id_group);
        $data =$this->SKMutasi_Hakim_PN_model->getWhereDBSync($where, 'tbl_skmutasi_hakim_pn_data');
        //var_dump($data);
        //echo "<br/>";
        $where2 = array('skmutasinoid' => $id_group );
        $datagroup =$this->SKMutasi_Hakim_PN_model->getWhereDBSync($where2, 'tbl_skmutasi_hakim_pn');
        //var_dump($datagroup);
        
          // $this->PDF_model->generateSKMutasiHakimPN($dtsk,$datagroup, $jenis_sk);
        $num = count($data);
        for($i=331;$i<$num;$i++){
          //var_dump($data);
          $this->PDF_model->generateSKMutasiHakimPN2($data[$i],$datagroup, $jenis_sk);
        }
        //$this->PDF_model->generateSKMutasiHakimPN($data,$datagroup, $jenis_sk);
    

   // }
     
    
  }

  function getSamaPN($id_group_sk, $jenis_sk){
      $where = "id_group_sk=".$id_group_sk ." AND pt_lama=pt_baru";
      
     // $where = array('id_group_sk' =>$id_group_sk);
      $data =$this->SKMutasi_Hakim_PN_model->getWhereDBSync($where, 'tbl_skmutasi_hakim_pn_data');
      $where2 = array('skmutasinoid' => $id_group_sk );
        $datagroup =$this->SKMutasi_Hakim_PN_model->getWhereDBSync($where2, 'tbl_skmutasi_hakim_pn');
        //var_dump($datagroup);
        
          // $this->PDF_model->generateSKMutasiHakimPN($dtsk,$datagroup, $jenis_sk);
        $num = count($data);
        for($i=0;$i<$num;$i++){
          //var_dump($data);
          $this->PDF_model->generateSKMutasiHakimPN2($data[$i],$datagroup, $jenis_sk);
        }
      //var_dump($data);
        

  }

  function getkhusus($id_pn){
    $this->SKMutasi_Hakim_PN_model->getKhusus($id_pn);
  }


}