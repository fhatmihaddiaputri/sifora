<?php
class SKMutasi_Panitera extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
    $this->load->model('SKMutasi_Panitera_model');
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
  	   $data['skmut'] = $this->SKMutasi_Panitera_model->getData();
     // var_dump($data['skmut']);
      
    
  	    $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('SK/Mutasi/SKMutasi_view',$data);
        $this->load->view('admin_template/footer');
       // $where = array('mutasinoid' => '9' , 'mutasiindx'=>'200');
        //$data['skmut'] = $this->SKMutasi_Panitera_model->getListDataSK($where);
        //var_dump($data['skmut']);
  }
 function getCountListDataSK($idgroupsk){
  var_dump($idgroupsk);
    $where = array('mutasinoid' =>$idgroupsk );

   $data = $this->SKMutasi_Panitera_model->getCountListDataSK($where);
   $hasil = array('mutasinoid' => $idgroupsk, 'count'=>$data[0]['count'] );
    return $hasil;
  }

   function sync($id_group, $jml_sk){
    echo $id_group;
    if($jml_sk!=='0'){
        $where  = array('mutasinoid' => $id_group );
        $data['skmut'] = $this->SKMutasi_Panitera_model->getWhere($where);
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

       // var_dump($data['skmut']);

        //5array(1) { [0]=> array(27) { ["mutasinoid"]=> string(1) "5" ["tanggaltpm"]=> string(10) "2019-03-29" ["mutasidate"]=> string(10) "2019-04-01" ["mutasinomor"]=> string(27) "1154A/DJU/SK/KP.04.5/4/2019" ["mutasidescr"]=> string(8) "MEMO KMA" ["mutasifiles"]=> string(8) "MEMO KMA" ["mutasidirjen"]=> string(14) "HERRI SWANTORO" ["mutasidirtng"]=> string(8) "HASWANDI" ["mutasidirjennip"]=> NULL ["mutasidirtngnip"]=> NULL ["mutasikplsubdir"]=> string(13) "J. KAMALUDDIN" ["mutasikplsubdirnip"]=> string(1) "-" ["namadipa01"]=> string(72) "Segala biaya yang bertalian dengan pemindahan ini ditanggung oleh Negara" ["namadipa02"]=> NULL ["jumlahkata"]=> string(1) "6" ["jumlahdlmsk"]=> string(1) "4" ["jumlahcheck"]=> string(1) "3" ["statusupdate"]=> string(1) "Y" ["statusnoid"]=> string(1) "6" ["statusdate"]=> string(26) "2019-07-03 20:56:05.535532" ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2019-05-01 11:28:43.083" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2019-05-01 11:28:43.417" ["lockflag"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL } }


       $dataGroup = array('id' =>'' ,
                  'skmutasinoid' => $data['skmut'][0]['mutasinoid'] ,
                  'tgl_tpm' => $data['skmut'][0]['tanggaltpm'] ,
                  'nomor_sk' => $data['skmut'][0]['mutasinomor'] ,
                  'tgl_sk' => $data['skmut'][0]['mutasidate'] ,
                  'dirjen' => $data['skmut'][0]['mutasidirjen'] ,
                  'direktur' => $data['skmut'][0]['mutasidirtng'] ,
                  'kasubdit' => $data['skmut'][0]['mutasikplsubdir'] ,
                  'nama_dipa' => $data['skmut'][0]['namadipa01'] ,
                  'desc' => $data['skmut'][0]['mutasidescr'] ,
                  'updated_date' => $update_date ,
                  'updated_user_id'=> $userid,
                  'jumlah'=> $data['skmut'][0]['jumlahdlmsk']
                   );
         // var_dump($dataGroup);
          $this->SKMutasi_Panitera_model->addData($dataGroup, 'tbl_skmutasi_panitera'); 

         $data['skmut'] = $this->SKMutasi_Panitera_model->getDataDBSync('tbl_skmutasi_panitera');
         $cond = array('kategori_surat' => 'SKMUT','id_group'=>'2' );
         $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
         $sksync=$this->SKMutasi_Panitera_model->addDataSK('tbl_skmutasi_panitera_data', $where, $stage) ;
         //var_dump($sksync);
        // var_dump($data['skmut']);

        $this->load->view('admin_template/head');
         $this->load->view('admin_template/sidebar');
         $this->load->view('SK/Mutasi/SKMutasi_sincronized_view',$data);
         $this->load->view('admin_template/footer');

    }else{

         echo $this->session->set_flashdata('error','Sinkronisasi gagal! tidak ada data dalam group');
         redirect('SKMutasi_Panitera');
    }
    
     

  }

  function viewDataSK($stage){
      

         // array(2) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(4) "STAF" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(5) { ["id_stage"]=> string(2) "11" ["stage_name"]=> string(11) "FINAL/ARSIP" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(2) "11" } }
          //$where = array('id_stage' => $stage );
            //   $data['skkp']=$this->SKKP_model->getWhereDBSync($where, 'tbl_skkp_panitera_data');
          $data['skmut']=$this->SKMutasi_Panitera_model->getDataGroupSKSync();
              // var_dump($data);
          $data['stage']=$this->getStage();
          $data['jenis']=$this->SKMutasi_Panitera_model->getJenis();
          


          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/Mutasi/SKMutasi_sincronized_view',$data);
          $this->load->view('admin_template/footer');

  }

  function listDataGroup($id_group){

      $where = array('id_group_sk'=>$id_group);
      $data['skmut']=$this->SKMutasi_Panitera_model->getDataSKSync($where);
      
      $data['stage']=$this->getStage();
      $table='tbl_skmutasi_panitera';
      $where2 = array('skmutasinoid' => $id_group );
      $data['skgroup']=$this->SKMutasi_Panitera_model->getWhereDBSync($where2, $table);
    // var_dump($data['skgroup']);


      $this->load->view('admin_template/head');
      $this->load->view('admin_template/sidebar');
      $this->load->view('SK/Mutasi/SKMutasi_data_view',$data);
      $this->load->view('admin_template/footer');

  }

  //function untuk menampilkan start_stage dan end_stage dari SK
  function getStage(){

      $cond = array('kategori_surat' => 'SKMUT','id_group'=>'2' );
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
      $data['skmut']= $this->SKMutasi_Panitera_model->getWhereDBSync($where, 'tbl_skmutasi_panitera_data');
      $data['history']=  $this->SKMutasi_Panitera_model->getHistory($where2);
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
          $this->load->view('SK/Mutasi/SKMutasi_History_view',$data);
          $this->load->view('admin_template/footer');
  }

  function fileSK($jenis, $id_group_sk, $id_sk){
        $where = array('id_group_sk' =>$id_group_sk , 'id_sk'=>$id_sk );
        $where2 = array('skmutasinoid' =>$id_group_sk);
        $data =$this->SKMutasi_Panitera_model->getWhereDBSync($where, 'tbl_skmutasi_panitera_data');
        $datagroup =$this->SKMutasi_Panitera_model->getWhereDBSync($where2, 'tbl_skmutasi_panitera');
        
       
        
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
               $this->PDF_model->generateSKMutasiPaniteraOtentik($datagroup);
               $this->fileSK($jenis, $id_group_sk, '0');
               die();
             }else{
               $this->PDF_model->generateSKMutasiPanitera($data,$datagroup, $jenis);
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
        $config['upload_path'] = './upload/mutasi/panitera/';
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
                    $this->SKMutasi_Panitera_model->uploadLampiran($where,'tbl_skmutasi_panitera', $datalampiran);
                 // $file_location = $data['formFile']['file_path'].$data['formFile']['file_name'];
           // echo "<br/> file loc :".$file_location;
          redirect('SKMutasi_Panitera/viewDataSK/5');
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
      $data = array('id_stage' => $next_Stage[0]['id_stage'] , 'id_status'=> $id_status ,'updated_date'=>$update_date,'keterangan'=>'di setujui oleh '.$this->session->userdata('username'),'updated_user_id'=>$this->session->userdata('userid'));

      //var_dump($data);
      $where = array('id_group_sk' => $idgroupsk,'id_sk'=>$idx );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera_data', $data, $where);

     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
     $this->SKMutasi_Panitera_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di proses/verifikasi');
        
    // if($this->session->userdata('end_stage')!==''){
        redirect('SKMutasi_Panitera/listDataGroup/'.$idgroupsk);
     //}else{
      //  redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}

     //insert history status



    //redirect('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));
 }

 function verifyGroupSK($idgroupsk, $status){
     
      $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
     
      $data = array('status_group' =>$status , 'update_date'=>$update_date, 'updated_user_id'=>$this->session->userdata('userid'));
      $where = array('skmutasinoid' => $idgroupsk );

     $this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera', $data, $where);

      
     echo $this->session->set_flashdata('msg','SK berhasil di proses/verifikasi');
      
        redirect('SKMutasi_Panitera/listDataGroup/'.$idgroupsk);
     
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
     $this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_sk'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>$ket);
     $this->SKMutasi_Panitera_model->insertHistory($dataHistory);

     //if($this->session->userdata('end_stage')!==''){
        redirect('SKMutasi_Panitera/listDataGroup/'.$idgroupsk);
     //}else{
       // redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}
 }

 function editJenis(){
    $this->load->helper('form');
    $id_group= $this->input->post('id_group',TRUE);
    $jenis= $this->input->post('jenis',TRUE);
   
    echo $id_group.' |'.$jenis; 
    $data = array('id_jenis' => $jenis);
    $where = array('skmutasinoid' =>$id_group );
    $this->SKMutasi_Panitera_model->update_data('tbl_skmutasi_panitera', $data, $where);  
    echo $this->session->set_flashdata('msg','data berhasil disimpan');
    redirect('SKMutasi_Panitera/viewDataSK/'.$this->session->userdata('start_stage'));
 }
 function drop($id_group_sk){

    $stage= $this->getStage();
    echo $stage[0]['start_stage'];
    echo $stage[0]['end_stage'];

 }

 function signSK(){

      $id_group_sk= $this->input->post('id_group',TRUE);
      $id_sk= $this->input->post('id_sk',TRUE);
      

      $passphrase= $this->input->post('passphrase',TRUE);

      echo $id_group_sk.'| id_sk :'.$id_sk.'| passphrase='.$passphrase;

     $where = array('id_group_sk' => $id_group_sk,'id_sk'=>$id_sk);

     $datask= $this->SKMutasi_Panitera_model->getDataSKSync($where);
     var_dump($datask);

     //array(1) { [0]=> array(36) { ["id"]=> string(3) "490" ["id_group_sk"]=> string(2) "13" ["id_sk"]=> string(1) "1" ["no_urut"]=> string(1) "1" ["nip"]=> string(21) "19670203 199212 1 001" ["nama"]=> string(25) "LUCKY ROMBOT KALALO, S.H." ["jabatan_lama"]=> string(5) "Hakim" ["pt_lama"]=> string(5) "Ambon" ["pn_lama"]=> string(5) "Ambon" ["kelas_lama"]=> string(3) "I.A" ["jabatan_baru"]=> string(5) "Hakim" ["pt_baru"]=> string(6) "Banten" ["pn_baru"]=> string(9) "Tangerang" ["tunjangan"]=> string(8) "21000000" ["pangkat"]=> string(18) "Pembina Utama Muda" ["gol"]=> string(4) "IV/c" ["gol_relasi"]=> string(17) "Hakim Madya Utama" ["kelas_baru"]=> string(5) "I.A.K" ["kppn_lama"]=> string(5) "Ambon" ["kppn_baru"]=> string(9) "Tangerang" ["id_stage"]=> string(1) "8" ["id_status"]=> string(2) "13" ["keterangan"]=> string(6) "proses" ["file_loc_petikan"]=> string(97) "C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Petikan_13_1_19670203 199212 1 001.pdf" ["file_loc_salinan"]=> string(97) "C:\xampp\htdocs\sifora\application\docx\SK\MUTASI\HAKIM\PN\Salinan_13_1_19670203 199212 1 001.pdf" ["updated_user_id"]=> string(2) "13" ["updated_date"]=> string(19) "2021-09-16 18:13:41" ["user_id"]=> string(2) "13" ["NIP"]=> string(0) "" ["user_name"]=> string(8) "direktur" ["user_password"]=> string(32) "e10adc3949ba59abbe56e057f20f883e" ["user_email"]=> string(18) "direktur@gmail.com" ["user_id_jab"]=> string(1) "2" ["reset_key"]=> string(0) "" ["status"]=> string(20) "MENUNGGU PERSETUJUAN" ["alert_color"]=> string(4) "info" } }
    $fileloc= '';
    if($this->session->userdata('level_name')==='Direktur'){
        $fileloc= $datask[0]['file_loc_salinan'];
        $this->SKMutasi_Panitera_model->verifySK($id_group_sk, $id_sk, $datask[0]['id_stage'], '14');
    }elseif($this->session->userdata('level_name')==='Dirjen'){
        $fileloc= $datask[0]['file_loc_petikan'];

    }else{

      echo $this->session->set_flashdata('error','Maaf anda tidak berwenang untuk menandatangani Surat Keputusan');
         
    }
    echo $fileloc;

         // cek sk petikan udah ada atau belum, kalo belum di createkan, jika sudah langsung call api

      // call api esign
      // update status menjadi sudah ditandatangani
      // update file petikan menjadi file yang sudah ditandatangani
            
 }
function getTemplate(){
        $temp=$this->SKMutasi_Panitera_model->getTemplate('1');
        //var_dump($temp);
        echo $temp[0]['url_salinan'];
      }




function generateAllSKMutasi( $id_group_sk, $jenis_sk){
    //if($jenis_group==='Panitera'){
        $where = array('id_group_sk' =>$id_group_sk);
        $data =$this->SKMutasi_Panitera_model->getWhereDBSync($where, 'tbl_skmutasi_panitera_data');
        //var_dump($data);
        //echo "<br/>";
        $where2 = array('skmutasinoid' => $id_group_sk );
        $datagroup =$this->SKMutasi_Panitera_model->getWhereDBSync($where2, 'tbl_skmutasi_panitera');
        //var_dump($datagroup);
        
          // $this->PDF_model->generateSKMutasiHakimPN($dtsk,$datagroup, $jenis_sk);
        $num = count($data);
        for($i=0;$i<$num;$i++){
          //var_dump($data);
          $this->PDF_model->generateSKMutasiPanitera2($data[$i],$datagroup, $jenis_sk);
        }
        //$this->PDF_model->generateSKMutasiHakimPN($data,$datagroup, $jenis_sk);
    

    }
     
    
  }