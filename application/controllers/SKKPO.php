<?php
class SKKPO extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
    $this->load->model('SKKPO_model');
    $this->load->model('Surat_model');
    $this->load->model('Stage_model');
    $this->load->model('PDF_model');
    $this->load->model('Excel_model');
    $this->load->helper('my_helper');
    $this->load->library('ciqrcode'); //meload library barcode
    
  }
  function index(){

    $data['skkp']=$this->SKKPO_model->getData();

    if($this->session->userdata('level_name')!=='Staf'){
        redirect('SKKPO/viewDataSK/'.$stage);

     }
      $data['skkp'] = $this->SKKPO_model->getData();
      $no=1;
      foreach ($data['skkp'] as $sk) {
        $no++;
        $where = array('no_idx' =>$sk['sknoid'] );

        //array(1) { ["no_idx"]=> string(1) "7" } array(1) { [0]=> array(1) { ["count"]=> string(3) "257" } }
        $data['count'][$no] = $this->getCountListDataSK($sk['sknoid']);
        
      }
       
        $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('SK/SKKPO_view',$data);
        $this->load->view('admin_template/footer');
      //var_dump($data['skkp']);
  }


  function sync($id_group){
    echo $id_group;
    $where  = array('sknoid' => $id_group );
    $data['skkp'] = $this->SKKPO_model->getWhere($where);
    // var_dump($data);

     if($data['skkp'][0]['sknoid']!=null){
      
        $userid = $this->session->userdata('userid');
       // echo $userid;
        $now = new DateTime();

        $update_date= $now->format('Y-m-d H:i:s'); 



        //array(18) { [0]=> array(10) { ["sknoid"]=> string(1) "3" ["skdate"]=> string(10) "2018-10-01" ["skdescr"]=> string(14) "SK KP OKT 2018" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "6" ["lockdate"]=> string(10) "2019-04-07" ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2019-03-09 01:09:19.764" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(22) "2019-04-08 09:28:00.01" } 
        $dataGroup = array('id' =>'' ,
                  'skpangkatnoid' => $data['skkp'][0]['sknoid'] ,
                  'skpangkatnama' => $data['skkp'][0]['skdescr'] ,
                  'skpangkatdate' => $data['skkp'][0]['skdate'] ,
                  'skpangkatdirjen' => '' ,
                  'skpangkatdirektur' => '',
                  'skpangkatkepalasub' => '' ,
                  'createdate' => $data['skkp'][0]['createdate'] ,
                  'updated_date'=> $update_date,
                  'updated_user_id'=> $userid
                   );
          //var_dump($dataGroup);

           // ************************  data group ************************************
    //2array(10) { ["id"]=> string(0) "" ["skpangkatnoid"]=> string(1) "2" ["skpangkatnama"]=> string(9) "SK JS JSP" ["skpangkatdate"]=> string(10) "2019-04-01" ["skpangkatdirjen"]=> string(0) "" ["skpangkatdirektur"]=> string(0) "" ["skpangkatkepalasub"]=> string(0) "" ["createdate"]=> string(23) "2019-02-26 11:45:41.692" ["updated_date"]=> string(19) "2021-03-26 10:22:04" ["updated_user_id"]=> string(1) "7" }

      // *****************************************************************************
         
          $cekerror =$this->SKKPO_model->addData($dataGroup, 'tbl_skkpo_panitera');
          if($cekerror===''){

            $data['skkp'] = $this->SKKPO_model->getDataDBSync('tbl_skkpo_panitera');
            $cond = array('kategori_surat' => 'SKKP','id_group'=>'2' );
            $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
            $where2 = array('no_idx' => $id_group);
            $sksync=$this->SKKPO_model->addDataSK('tbl_skkpo_panitera_data', $where2, $stage) ;
            var_dump($sksync);
             
         }else{
            
             echo $this->session->set_flashdata('error',$cekerror);
             redirect('SKKPO');

         }
          
          /*

         
       //  $this->PDF_model->generateSKKPPanitera($sksync);         

    //  echo "data ".$data['skkpgroup'][0]['skpangkatnoid'];
        //setelah input ke db sk group maka tampilkan di view 

         $this->load->view('admin_template/head');
         $this->load->view('admin_template/sidebar');
         $this->load->view('SK/SKKPO_Sincronized_view',$data);
         $this->load->view('admin_template/footer');*/
     }else{

      echo "data tidak ada";
     }

  }

  // function untuk menampilkan jumlah data pada sk group
  function getCountListDataSK($idgroupsk){

    $where = array('no_idx' =>$idgroupsk );

   $data = $this->SKKPO_model->getCountListDataSK($where);
   $hasil = array('no_idx' => $idgroupsk, 'count'=>$data[0]['count'] );
    return $hasil;
  }
function getStage(){

    $cond = array('kategori_surat' => 'SKKP','id_group'=>'2' );
    $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
    return $stage;
    var_dump($stage);
    //array(1) { [0]=> array(5) { ["id_kategori_surat"]=> string(1) "2" ["kategori_surat"]=> string(4) "SKKP" ["id_group"]=> string(1) "2" ["start_stage"]=> string(1) "5" ["end_stage"]=> string(2) "10" } }
    echo $stage[0]['start_stage'];
    echo $stage[0]['end_stage'];


}
//function untuk menampilkan file PDF dari SK KP
function fileSK($idgroupsk, $idx){
      $where = array('skpangkatnoid' =>$idgroupsk , 'skpangkatindx'=>$idx );
      $data =$this->SKKPO_model->getWhereDBSync($where, 'tbl_skkpo_panitera_data');
     // var_dump($data);
      $file = $data[0]['file_loc'];
      echo $file;
    //  $file='C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf';
     // $file = APPPATH.'docx\SKKP_Panitera\5_1_123.pdf';
      //echo $file;
  //Membuat kondisi jika file tidak ada
      if (!file_exists($file)) {
          echo "The file $file does not exist";
          die();
      }else{
          echo "file ketemu";
           // echo file_get_contents($file);
 
      //nama file untuk tampilan
     $filename="skkp.pdf";
      //echo $file;
     header('Content-type:application/pdf');
     header('Content-disposition: inline; filename="'.$filename.'"');
     header('content-Transfer-Encoding:binary');
     header('Accept-Ranges:bytes');
     //membaca dan menampilkan file
     readfile($file);

    }
  }

     //function untuk memverifikasi SK, mengubah stage, status, serta history status
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
      $where = array('skpangkatnoid' => $idgroupsk,'skpangkatindx'=>$idx );

      //update stage dan set status menjadi menunggu persetujuan
     $this->SKKPO_model->update_data('tbl_skkpo_panitera_data', $data, $where);

     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_skkp'=>$idx, 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
     $this->SKKPO_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di proses/verifikasi');
        
    // if($this->session->userdata('end_stage')!==''){
        redirect('SKKPO/viewDataSK/'.$stage);
     //}else{
      //  redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}

     //insert history status



    //redirect('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));
 }

 // function untuk menandatangi SK -- mengubah stage, status, history status dan memanggil API e-sign MA
 function signSK($idgroupsk, $idx){
    // verifikasi
    //$this->verifySK($idgroupsk, $idx);

 }

 //function untuk revisi SK , menurunkan stage, history status, serta update status
 function reviseSK($idgroupsk, $idx, $stage){
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
      $data = array('id_stage' => $prevStage[0]['id_stage'] , 'id_status'=> '6' ,'updated_date'=>$update_date);

      //var_dump($data);

      //update stage dan status sk
      $where = array('skpangkatnoid' => $idgroupsk,'skpangkatindx'=>$idx );
     $this->SKKPO_model->update_data('tbl_skkp_panitera_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_skkp'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>'perintah revisi oleh '.$this->session->userdata('username'));
     $this->SKKPO_model->insertHistory($dataHistory);

     if($this->session->userdata('end_stage')!==''){
        redirect('SKKPO/viewDataSK/'.$this->session->userdata('end_stage'));
     }else{
        redirect('SKKPO/viewDataSK/'.$this->session->userdata('start_stage'));

     }
 }

/*function revisiSK(){
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
      $where = array('skpangkatnoid' => $idgroupsk,'skpangkatindx'=>$idx );
     $this->SKKPO_model->update_data('tbl_skkp_panitera_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_skkp'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>$ket);
     $this->SKKPO_model->insertHistory($dataHistory);

     //if($this->session->userdata('end_stage')!==''){
        redirect('SKKP/viewDataSK/'.$stage);
     //}else{
       // redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}
    }
*/


    function viewHistory($idgroupsk, $idx, $stage, $menu){

  $where = array('skpangkatnoid' =>$idgroupsk ,'skpangkatindx'=>$idx );

  $where2 = array('id_group' =>$idgroupsk ,'id_skkp'=>$idx );
  $data['skkp']= $this->SKKPO_model->getWhereDBSync($where, 'tbl_skkpo_panitera_data');
  $data['history']=  $this->SKKPO_model->getHistory($where2);
  $data['stage']= $stage;
  $data['menu']=$menu;

  /*
  array(3) { [0]=> array(12) { ["id_history"]=> string(1) "7" ["id_group"]=> string(1) "5" ["id_skkp"]=> string(1) "1" ["id_stage"]=> string(1) "5" ["id_status"]=> string(1) "5" ["tgl"]=> string(19) "2021-03-24 15:18:00" ["keterangan"]=> string(22) "di setujui oleh danang" ["status"]=> string(3) "ACC" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(12) { ["id_history"]=> string(1) "8" ["id_group"]=> string(1) "5" ["id_skkp"]=> string(1) "1" ["id_stage"]=> string(1) "6" ["id_status"]=> string(1) "6" ["tgl"]=> string(19) "2021-03-24 15:18:45" ["keterangan"]=> string(30) "perintah revisi oleh SIAPA AJA" ["status"]=> string(6) "REVISI" ["stage_name"]=> string(15) "KASI-VERIFIKASI" ["id_level"]=> string(1) "5" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "6" } [2]=> array(12) { ["id_history"]=> string(1) "9" ["id_group"]=> string(1) "5" ["id_skkp"]=> string(1) "1" ["id_stage"]=> string(1) "5" ["id_status"]=> string(1) "5" ["tgl"]=> string(19) "2021-03-24 15:19:58" ["keterangan"]=> string(22) "di setujui oleh danang" ["status"]=> string(3) "ACC" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } }
  
  */

          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/SKKPO_History_view',$data);
          $this->load->view('admin_template/footer');
 }

function viewDataSK($stage){
      

         // array(2) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(4) "STAF" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(5) { ["id_stage"]=> string(2) "11" ["stage_name"]=> string(11) "FINAL/ARSIP" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(2) "11" } }
          $where = array('id_stage' => $stage );
            //   $data['skkp']=$this->SKKP_model->getWhereDBSync($where, 'tbl_skkp_panitera_data');
          $data['skkp']=$this->SKKPO_model->getDataSKSync($where);
               //var_dump($data);
          $data['stage']=$this->getStage();



          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/SKKPO_Data_view',$data);
          $this->load->view('admin_template/footer');

}
function monitoringSK(){
  $data['skkp']=$this->SKKPO_model->getDataAllSync();//getDataDBSync('tbl_skkp_panitera_data');
  $this->load->view('admin_template/head');
  $this->load->view('admin_template/sidebar');
  $this->load->view('SK/SKKPO_Monitoring_view',$data);
  $this->load->view('admin_template/footer');

}

 function sinkronUlangSK($idgroupsk, $idx, $stage){
    //mengupdate data sk berdasarkan id group dan idx/id sk

      $where = array('skpangkatnoid' => $idgroupsk, 'skpangkatindx'=>$idx );
      $table = 'tbl_skkpo_panitera_data';
      $this->SKKPO_model->sinkronUlangSK($where, $table);
       redirect('SKKPO/viewDataSK/'.$stage);
     

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
      $where = array('skpangkatnoid' => $idgroupsk,'skpangkatindx'=>$idx );
     $this->SKKPO_model->update_data('tbl_skkpo_panitera_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_skkp'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>$ket);
     $this->SKKPO_model->insertHistory($dataHistory);

     //if($this->session->userdata('end_stage')!==''){
        redirect('SKKPO/viewDataSK/'.$stage);
     //}else{
       // redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}
 }


  function ExportToExcel(){
      $data['skkp']=$this->SKKPO_model->getDataAllSync();//
      //getDataDBSync('tbl_skkp_panitera_data');
      $now = new DateTime();
      echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
      $filename= 'sk_kpo_'.$now->getTimestamp().'.xlsx'; 
      $this->Excel_model->exportToExcel($filename, $data);//$this->load->view('admin_template/head');
      //$this->load->view('admin_template/sidebar');
      //$this->load->view('SK/SKKP_Monitoring_view',$data);
      //$this->load->view('admin_template/footer');


  }
}

?>