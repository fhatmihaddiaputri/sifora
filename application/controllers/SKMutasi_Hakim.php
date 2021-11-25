<?php
class SKMutasi_Hakim extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
    $this->load->model('SKMutasi_Hakim_model');
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
  	   $data['skmut'] = $this->SKMutasi_Hakim_model->getData();
      //var_dump($data['skmut']);
      
    
  	    $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('SK/Mutasi/SKMutasi_Hakim_view',$data);
        $this->load->view('admin_template/footer');
       // $where = array('mutasinoid' => '9' , 'mutasiindx'=>'200');
        //$data['skmut'] = $this->SKMutasi_Panitera_model->getListDataSK($where);
        //var_dump($data['skmut']);
  }
 function getCountListDataSK($idgroupsk){
  var_dump($idgroupsk);
    $where = array('mutasinoid' =>$idgroupsk );

   $data = $this->SKMutasi_Hakim_model->getCountListDataSK($where);
   $hasil = array('mutasinoid' => $idgroupsk, 'count'=>$data[0]['count'] );
    return $hasil;
  }

   function sync($id_group, $jml_sk){
    echo $id_group;
    if($jml_sk!=='0'){
        $where  = array('mutasinoid' => $id_group );
        $data['skmut'] = $this->SKMutasi_Hakim_model->getWhere($where);
    // var_dump($data);

    // if($data['skmut'][0]['mutasinoid']!=null){
       /* $dataGroup = array('skpangkatnoid' => $data['skkp'][0]['skpangkatnoid'] ,
                            'skpangkatnama' => $data['skkp'][0]['skpangkatnama'] ,
                            'skpangkatdate' => $data['skkp'][0]['skpangkatdate'] ,
                            'skpangkatdirjen' => $data['skkp'][0]['skpangkatdirjen'] ,
                            'skpangkatdirektur' => $data['skkp'][0]['skpangkatdirektur'] ,
                            'skpangkatkepalasub' => $data['skkp'][0]['skpangkatkepalasub'] ,
                            'createdate' => $data['skkp'][0]['createdate'] ,
                          );
*/
        $userid = $this->session->userdata('userid');
       // echo $userid;
        $now = new DateTime();

        $update_date= $now->format('Y-m-d H:i:s'); 

        //var_dump($data['skmut']);

        //syn6array(1) { [0]=> array(28) { ["mutasinoid"]=> string(1) "6" ["mutasidate"]=> string(10) "2020-08-31" ["mutasinomor"]=> string(20) "213/KMA/SK/VIII/2020" ["rapatpim"]=> string(3) "TPM" ["jabatan"]=> string(22) "Ketua, Wakil Dan Hakim" ["judulsk"]=> NULL ["mutasidescr"]=> NULL ["mutasifiles"]=> string(12) "RAPIM 310820" ["mutasiketua"]=> string(19) "MUHAMMAD SYAFRUDDIN" ["mutasidirjen"]=> string(12) "PRIM HARYADI" ["mutasidirtng"]=> string(13) "LUCAS PRAKOSO" ["jumlahkata"]=> string(1) "6" ["namadipa01"]=> NULL ["namadipa02"]=> NULL ["namadipa03"]=> NULL ["tanggalotk"]=> string(10) "2020-10-02" ["tanggalttd"]=> string(10) "2020-08-31" ["printotentik"]=> string(1) "N" ["jumlahhakim"]=> string(2) "15" ["jumlahsalin"]=> string(1) "0" ["jumlahpetik"]=> string(1) "0" ["jumlahcheck"]=> string(1) "0" ["statusupdate"]=> string(1) "Y" ["statuslocked"]=> string(1) "N" ["createnoid"]=> string(1) "6" ["createdate"]=> string(23) "2020-09-14 08:51:45.033" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(23) "2020-09-14 08:51:45.051" } }


       $dataGroup = array('id' =>'' ,
                  'skmutasinoid' => $data['skmut'][0]['mutasinoid'] ,
                  'tgl_tpm' => $data['skmut'][0]['tanggalotk'] ,
                  'nomor_sk' => $data['skmut'][0]['mutasinomor'] ,
                  'tgl_sk' => $data['skmut'][0]['mutasidate'] ,
                  'dirjen' => $data['skmut'][0]['mutasidirjen'] ,
                  'direktur' => $data['skmut'][0]['mutasidirtng'] ,
                  'kma' => $data['skmut'][0]['mutasiketua'] ,
                  'nama_dipa' => $data['skmut'][0]['namadipa01'] ,
                  'desc' => $data['skmut'][0]['mutasidescr'] ,
                  'updated_date' => $update_date,
                  'updated_user_id'=> $userid,
                  'jumlah'=> $data['skmut'][0]['jumlahhakim'],
                   'jenis_rapat'=> $data['skmut'][0]['rapatpim']
                   );
         // var_dump($dataGroup);
          $this->SKMutasi_Hakim_model->addData($dataGroup, 'tbl_skmutasi_hakim'); 

         $data['skmut'] = $this->SKMutasi_Hakim_model->getDataDBSync('tbl_skmutasi_hakim');
         $cond = array('kategori_surat' => 'SKMUT','id_group'=>'1' );
         $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
         $sksync=$this->SKMutasi_Hakim_model->addDataSK('tbl_skmutasi_hakim_data', $where, $stage) ;
         //var_dump($sksync);
        // var_dump($data['skmut']);

        $this->load->view('admin_template/head');
         $this->load->view('admin_template/sidebar');
         $this->load->view('SK/Mutasi/SKMutasi_Hakim_sincronized_view',$data);
         $this->load->view('admin_template/footer');


    }else{

         echo $this->session->set_flashdata('error','Sinkronisasi gagal! tidak ada data dalam group');
         redirect('SKMutasi_Hakim');
    }
    
     

  }

  function viewDataSK($stage){
      

         // array(2) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(4) "STAF" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(5) { ["id_stage"]=> string(2) "11" ["stage_name"]=> string(11) "FINAL/ARSIP" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(2) "11" } }
          //$where = array('id_stage' => $stage );
            //   $data['skkp']=$this->SKKP_model->getWhereDBSync($where, 'tbl_skkp_panitera_data');
          $data['skmut']=$this->SKMutasi_Hakim_model->getDataGroupSKSync();
            //   var_dump($data);
          $data['stage']=$this->getStage();



          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/Mutasi/SKMutasi_Hakim_sincronized_view',$data);
          $this->load->view('admin_template/footer');

  }

  function listDataGroup($id_group){

      $where = array('id_group_sk'=>$id_group);
      $data['skmut']=$this->SKMutasi_Hakim_model->getDataSKSync($where);
      
      $data['stage']=$this->getStage();
      $table='tbl_skmutasi_hakim';
      $where2 = array('skmutasinoid' => $id_group );
      $data['skgroup']=$this->SKMutasi_Hakim_model->getWhereDBSync($where2, $table);
    // var_dump($data['skgroup']);


      $this->load->view('admin_template/head');
      $this->load->view('admin_template/sidebar');
      $this->load->view('SK/Mutasi/SKMutasi_hakim_data_view',$data);
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
      $data['skmut']= $this->SKMutasi_Hakim_model->getWhereDBSync($where, 'tbl_skmutasi_hakim_data');
      $data['history']=  $this->SKMutasi_Hakim_model->getHistory($where2);
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
          $this->load->view('SK/Mutasi/SKMutasi_Hakim_History_view',$data);
          $this->load->view('admin_template/footer');
  }

  function fileSK($jenis, $id_group_sk, $id_sk){
        $where = array('id_group_sk' =>$id_group_sk , 'id_sk'=>$id_sk );
        $where2 = array('skmutasinoid' =>$id_group_sk);
        $data =$this->SKMutasi_Hakim_model->getWhereDBSync($where, 'tbl_skmutasi_hakim_data');
        $datagroup =$this->SKMutasi_Hakim_model->getWhereDBSync($where2, 'tbl_skmutasi_hakim');
        
       
        
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
               $this->PDF_model->generateSKMutasiHakimOtentik($datagroup);
               $this->fileSK($jenis, $id_group_sk, '0');
               die();
             }else{
               $this->PDF_model->generateSKMutasiHakim($data,$datagroup, $jenis);
               $this->fileSK($jenis, $id_group_sk, $id_sk);
              die();
             }
             

            
        }else{
            if(($jenis==='Otentik')||($jenis==='Lampiran')){

                $this->load->helper('download');
                force_download($file, null);
            } else{
                  //nama file untuk tampilan
               $filename='skmutasi_'.$id_group_sk.'.pdf';
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
        $config['upload_path'] = './upload/mutasi/hakim/';
        $config['allowed_types'] = 'pdf';
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
            $data = array('image_metadata' => $this->upload->data());
 
            //$this->load->view('imageupload_success', $data);
            print_r( $data);

            /*
            synArray ( [formFile] => Array ( [name] => SK KP-min.pdf [type] => application/pdf [tmp_name] => C:\xampp\tmp\php749F.tmp [error] => 0 [size] => 415090 ) ) array(1) { ["image_metadata"]=> array(14) { ["file_name"]=> string(23) "1628862937SK_KP-min.pdf" ["file_type"]=> string(15) "application/pdf" ["file_path"]=> string(30) "C:/xampp/htdocs/sifora/upload/" ["full_path"]=> string(53) "C:/xampp/htdocs/sifora/upload/1628862937SK_KP-min.pdf" ["raw_name"]=> string(19) "1628862937SK_KP-min" ["orig_name"]=> string(23) "1628862937SK_KP-min.pdf" ["client_name"]=> string(13) "SK KP-min.pdf" ["file_ext"]=> string(4) ".pdf" ["file_size"]=> float(405.36) ["is_image"]=> bool(false) ["image_width"]=> NULL ["image_height"]=> NULL ["image_type"]=> string(0) "" ["image_size_str"]=> string(0) "" } }
            */
           
                   $file_loc =  $data['image_metadata']['file_path'].$data['image_metadata']['file_name'];
                    echo "<br/>".$id_group ."|".$file_loc;
                    $where= array('skmutasinoid' =>$id_group);
                    $datalampiran = array('lampiran' =>$file_loc);
                    $this->SKMutasi_Hakim_model->uploadLampiran($where,'tbl_skmutasi_hakim', $datalampiran);
                 // $file_location = $data['formFile']['file_path'].$data['formFile']['file_name'];
           // echo "<br/> file loc :".$file_location;
          redirect('SKMutasi_Hakim/viewDataSK/5');
        }
    
    }

    function verifySK($idgroupsk, $idx, $stage){
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
      $data = array('id_stage' => $next_Stage[0]['id_stage'] , 'id_status'=> '13' ,'updated_date'=>$update_date,'keterangan'=>'proses');

      //var_dump($data);
      $where = array('id_group_sk' => $idgroupsk,'id_sk'=>$idx );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKMutasi_Hakim_model->update_data('tbl_skmutasi_hakim_data', $data, $where);

     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
     $this->SKMutasi_Hakim_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di proses/verifikasi');
        
    // if($this->session->userdata('end_stage')!==''){
        redirect('SKMutasi_Hakim/listDataGroup/'.$idgroupsk);
     //}else{
      //  redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}

     //insert history status



    //redirect('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));
 }

 function verifyGroupSK($idgroupsk, $stage){
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
      $data = array('id_stage' => $next_Stage[0]['id_stage'] , 'id_status'=> '13' ,'updated_date'=>$update_date,'keterangan'=>'proses');

      //var_dump($data);
      $where = array('skmutasinoid' => $idgroupsk );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKMutasi_Hakim_model->update_data('tbl_skmutasi_hakim', $data, $where);

     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>'0', 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
     $this->SKMutasi_Hakim_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di proses/verifikasi');
        
    // if($this->session->userdata('end_stage')!==''){
        redirect('SKMutasi_Hakim/viewDataSK/'.$stage);
     //}else{
      //  redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}

     //insert history status



    //redirect('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));
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
      $data = array('id_stage' => $prevStage[0]['id_stage'] , 'id_status'=> '6' ,'updated_date'=>$update_date, 'keterangan'=>$ket);

      //var_dump($data);

      //update stage dan status sk
      $where = array('id_group_sk' => $idgroupsk,'id_sk'=>$idx );
     $this->SKMutasi_Hakim_model->update_data('tbl_skmutasi_hakim_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>$ket);
     $this->SKMutasi_Hakim_model->insertHistory($dataHistory);

     //if($this->session->userdata('end_stage')!==''){
        redirect('SKMutasi_Hakim/viewDataSK/'.$stage);
     //}else{
       // redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}
 }


}