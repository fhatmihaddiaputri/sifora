syn<?php
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
      $this->load->view('SK/Mutasi/SKMutasi_Data_view',$data);
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
        
        var_dump($datagroup);

        
        
        $file='';
        if($jenis==='Salinan'){
          $file = $data[0]['file_loc_salinan'];
        }elseif($jenis==='Petikan'){
          $file = $data[0]['file_loc_petikan'];

        }
        
        echo $file;

        //synarray(1) { [0]=> array(26) { ["id"]=> string(1) "9" ["id_group_sk"]=> string(2) "10" ["id_sk"]=> string(1) "3" ["no_urut"]=> string(1) "3" ["nip"]=> string(21) "19750918 199903 1 005" ["nama"]=> string(21) "ABDUL SHOMAD, SH., MH" ["jabatan_lama"]=> string(18) "Panitera Pengganti" ["pt_lama"]=> string(7) "Jakarta" ["pn_lama"]=> string(13) "Jakarta Pusat" ["kelas_lama"]=> string(5) "I.A.K" ["jabatan_baru"]=> string(18) "Panitera Pengganti" ["pt_baru"]=> string(6) "Banten" ["pn_baru"]=> string(6) "Serang" ["tunjangan"]=> string(6) "360000" ["pangkat"]=> string(12) "Penata Tk. I" ["gol"]=> string(5) "III/d" ["kelas_baru"]=> string(3) "I.A" ["kppn_lama"]=> string(10) "Jakarta VI" ["kppn_baru"]=> string(6) "Serang" ["id_stage"]=> string(1) "5" ["id_status"]=> string(1) "7" ["keterangan"]=> string(1) "0" ["file_loc_petikan"]=> string(0) "" ["file_loc_salinan"]=> string(0) "" ["updated_user_id"]=> string(2) "16" ["updated_date"]=> string(19) "2021-04-29 18:50:42" } } 


        //  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
        // $file = APPPATH.'docx\SKKP_Panitera\5_1_123.pdf';
        //echo $file;
        //Membuat kondisi jika file tidak ada
        if (!file_exists($file)) {

            echo "The file $file does not exist";
            //die();
            // call function to create sk
            $this->PDF_model->generateSKMutasiPanitera($data,$datagroup, $jenis);
            
        }else{
            echo "file ketemu";
             // echo file_get_contents($file);
   
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