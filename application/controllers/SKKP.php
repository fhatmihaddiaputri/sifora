<?php
class SKKP extends CI_Controller{
  function __construct(){
    parent::__construct();
     if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
    $this->load->model('SKKP_model');
    $this->load->model('Surat_model');
    $this->load->model('Stage_model');
    $this->load->model('PDF_model');
    $this->load->helper('my_helper');
    $this->load->library('ciqrcode'); //meload library barcode

    $this->load->model('Excel_model'); //meload library barcode    
  }

  function index(){
     if($this->session->userdata('level_name')!=='Staf'){
        redirect('SKKP/viewDataSK/'.$stage);

     }
  	  $data['skkp'] = $this->SKKP_model->getData();
       $data['skkp'] = $this->SKKP_model->getData();
     
  	 // $data['jabatan']= $this->jabatan_model->get_data();
       // var_dump($data);
  	    $this->load->view('admin_template/head');
        $this->load->view('admin_template/sidebar');
        $this->load->view('SK/SKKP_view',$data);
        $this->load->view('admin_template/footer');
  }

  function sync($id_group){
    echo $id_group;
    $where  = array('skpangkatnoid' => $id_group );
    $data['skkp'] = $this->SKKP_model->getWhere($where);
    // var_dump($data);

     if($data['skkp'][0]['skpangkatnoid']!=null){
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
        $dataGroup = array('id' =>'' ,
                  'skpangkatnoid' => $data['skkp'][0]['skpangkatnoid'] ,
                  'skpangkatnama' => $data['skkp'][0]['skpangkatnama'] ,
                  'skpangkatdate' => $data['skkp'][0]['skpangkatdate'] ,
                  'skpangkatdirjen' => $data['skkp'][0]['skpangkatdirjen'] ,
                  'skpangkatdirektur' => $data['skkp'][0]['skpangkatdirektur'] ,
                  'skpangkatkepalasub' => $data['skkp'][0]['skpangkatkepalasub'] ,
                  'createdate' => $data['skkp'][0]['createdate'] ,
                  'updated_date'=> $update_date,
                  'updated_user_id'=> $userid
                   );
         // var_dump($dataGroup);
          $this->SKKP_model->addData($dataGroup, 'tbl_skkp_panitera'); 

         $data['skkp'] = $this->SKKP_model->getDataDBSync('tbl_skkp_panitera');
         $cond = array('kategori_surat' => 'SKKP','id_group'=>'2' );
         $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
         $sksync=$this->SKKP_model->addDataSK('tbl_skkp_panitera_data', $where, $stage) ;
       //  $this->PDF_model->generateSKKPPanitera($sksync);         

    //  echo "data ".$data['skkpgroup'][0]['skpangkatnoid'];
        //setelah input ke db sk group maka tampilkan di view 

         $this->load->view('admin_template/head');
         $this->load->view('admin_template/sidebar');
         $this->load->view('SK/SKKP_Sincronized_view',$data);
         $this->load->view('admin_template/footer');
     }else{

      echo "data tidak ada";
     }

  }
function viewDataSK($stage){
      

         // array(2) { [0]=> array(5) { ["id_stage"]=> string(1) "5" ["stage_name"]=> string(4) "STAF" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(5) { ["id_stage"]=> string(2) "11" ["stage_name"]=> string(11) "FINAL/ARSIP" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(2) "11" } }
          $where = array('id_stage' => $stage );
            //   $data['skkp']=$this->SKKP_model->getWhereDBSync($where, 'tbl_skkp_panitera_data');
          $data['skkp']=$this->SKKP_model->getDataSKSync($where);
               //var_dump($data);
          $data['stage']=$this->getStage();



          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/SKKP_Data_view',$data);
          $this->load->view('admin_template/footer');

}
function tesAddDataSK(){
    $where  = array('skpangkatnoid' => '5' );
    $data = array();
     $cond = array('kategori_surat' => 'SKKP','id_group'=>'2' );
        $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
         $this->SKKP_model->addDataSK('tbl_skkp_panitera_data', $where, $stage) ;
    
}


//function ini hanya untuk test fungsi dari print pdf saja... nnti tidak menggunakan fungsi ini
function cetakSK($data){
  // ini $out nnti dimatikan saja
$out = array( 
      
    // Ankit will act as key 
    'skpangkatnoid'=> array( 
          
        // Subject and marks are 
        // the key value pair 
       'skpangkatnoid' => '5', 
                'skpangkatindx'=>'1',
                'nipnmrc'=>'123',
                'nama'=>'tes',
                'tptlhr'=>'bengkulu',
                'tgllhr'=>'1997-07-22',
                'sknmrkeputusn'=>'AI-13001000763',
                'sktglkeputusn'=>'2019-10-01',
                'sknmrskkenaikn'=>'123/dju' ,
                'sktgltdkenaikn'=>'2019-10-01',
                'skpangkatbaru'=>'III/a',
                'sktglskkenaikn'=>'2019-10-01',
                'skpangkatlthn'=>'10',
                'skpangkatlbln'=>'6',
                'skpangkatltmt'=>'2018-10-01',
                'skpangkatlama'=>'II/d',
                'ptnama'=>'Manado',
                'pnnama'=>'Tondano',
                'jabatan'=>'JS',
                'skpangkatpdk2'=>'MH',
                'skpangkatpdk1'=>'SH',
                'skpangkatgaji'=>'260000',
                'skpangkattunj'=>'260000',
                'skpangkatcatat'=>'123'
    )
); 
if(empty($out)){

          echo "data sk pada group kosong";
      }else{
        
      //var_dump($out);
    $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
      $no=1; foreach ($out as $hasil): 
        
      $pdk='';
      $pdk= $hasil['skpangkatpdk2'];
      if(!empty($pdk)){


      }else{
        $pdk= $hasil['skpangkatpdk1'];
      }
          $data = array('id' => '',
                'skpangkatnoid'=>$hasil['skpangkatnoid'],
                'skpangkatindx'=>$hasil['skpangkatindx'],
                'nip'=>$hasil['nipnmrc'],
                'nama'=>$hasil['nama'],
                'tempat_lahir'=>$hasil['tptlhr'],
                'tgl_lahir'=>$hasil['tgllhr'],
                'sknmrpertek'=>$hasil['sknmrkeputusn'],
                'sktglpertek'=>$hasil['sktglkeputusn'],
                'sknomor'=>$hasil['sknmrskkenaikn'] ,
                'sktgl'=>$hasil['sktgltdkenaikn'],
                'gol_baru'=>$hasil['skpangkatbaru'],
                'tmt_gol_baru'=>$hasil['sktglskkenaikn'],
                'mk_tahun'=>$hasil['skpangkatlthn'],
                'mk_bulan'=>$hasil['skpangkatlbln'],
                'tmt_gol_lama'=>$hasil['skpangkatltmt'],
                'gol_lama'=>$hasil['skpangkatlama'],
                'pt'=>$hasil['ptnama'],
                'pn'=>$hasil['pnnama'],
                'jabatan'=>$hasil['jabatan'],
                'pendidikan'=>$pdk,
                'gaji'=>$hasil['skpangkatgaji'],
                'tunjangan'=>$hasil['skpangkattunj'],
                'qrcode'=>$hasil['skpangkatcatat'],
                'id_stage'=>'',
                'id_status'=>'7',
                'updated_date'=>$update_date,
                'updated_user_id'=>$this->session->userdata('userid'),
                'keterangan'=>'syncronized',
                'file_loc'=>''
              );
         // $this->db->insert($table,$data);
          $this->PDF_model->generateSKKPPanitera($data);
        
          endforeach;

    }
  
}

//function untuk menampilkan file PDF dari SK KP
function fileSK($idgroupsk, $idx){
      $where = array('skpangkatnoid' =>$idgroupsk , 'skpangkatindx'=>$idx );
      $data =$this->SKKP_model->getWhereDBSync($where, 'tbl_skkp_panitera_data');
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
function tesqr(){

  echo "masuk sini";
}
function generateqrcode($data)
  {
    echo $data;
    /*$this->load->helper('url'); //meload helper url untuk aktifkan base urlnya
    $barcode_create=$data; // membuat code barcode yang nilainya 123456789

        //settingang pada barcode 
    $params['data'] = $barcode_create;
    $params['level'] = 'H';
    $params['size'] =5;

    //settingan untuk membuat file barcode dalam format .png dan di simpan dalam folder assets
    $params['savename'] = APPPATH . "docx/qrcode/".$barcode_create.".png";
    //mulai menggenerate barcode
    $this->ciqrcode->generate($params);

    //mencoba mengeluarkan nilai barcode yang baru saja di generate
    echo '<img src="'.APPPATH.'docx/qrcode/'.$barcode_create.'.png" />';*/
  }
}

function monitoringSK(){
  $data['skkp']=$this->SKKP_model->getDataAllSync();//getDataDBSync('tbl_skkp_panitera_data');
  $this->load->view('admin_template/head');
  $this->load->view('admin_template/sidebar');
  $this->load->view('SK/SKKP_Monitoring_view',$data);
  $this->load->view('admin_template/footer');

}

//function untuk menampilkan start_stage dan end_stage dari SK
function getStage(){

    $cond = array('kategori_surat' => 'SKKP','id_group'=>'2' );
    $stage= $this->Surat_model->get_where('tbl_ref_surat', $cond);
    return $stage;
    var_dump($stage);
    //array(1) { [0]=> array(5) { ["id_kategori_surat"]=> string(1) "2" ["kategori_surat"]=> string(4) "SKKP" ["id_group"]=> string(1) "2" ["start_stage"]=> string(1) "5" ["end_stage"]=> string(2) "10" } }
    echo $stage[0]['start_stage'];
    echo $stage[0]['end_stage'];


}
  function listDataGroup($id_group){
      //echo $id_group;
    $where  = array('skpangkatnoid' => $id_group );
    $data['skkp'] = $this->SKKP_model->getListDataSK($where);
    var_dump($data['skkp']);

         

    // make a view data list group sk 

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
     $this->SKKP_model->update_data('tbl_skkp_panitera_data', $data, $where);

     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_skkp'=>$idx, 'id_stage'=>$stage,'id_status'=>'5', 'tgl'=>$update_date, 'keterangan'=>'di setujui oleh '.$this->session->userdata('username'));
     $this->SKKP_model->insertHistory($dataHistory);

     //message jika sukses 
     echo $this->session->set_flashdata('msg','SK berhasil di proses/verifikasi');
        
    // if($this->session->userdata('end_stage')!==''){
        redirect('SKKP/viewDataSK/'.$stage);
     //}else{
      //  redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}

     //insert history status



    //redirect('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));
 }

 // function untuk menandatangi SK -- mengubah stage, status, history status dan memanggil API e-sign MA
 function signSK($idgroupsk, $idx){
    // verifikasi
  echo "masuk sign SK";
    //$this->verifySK($idgroupsk, $idx);

 }

 function sinkronUlangSK($idgroupsk, $idx, $stage){
    //mengupdate data sk berdasarkan id group dan idx/id sk

      $where = array('skpangkatnoid' => $idgroupsk, 'skpangkatindx'=>$idx );
      $table = 'tbl_skkp_panitera_data';
      $this->SKKP_model->sinkronUlangSK($where, $table);
       redirect('SKKP/viewDataSK/'.$stage);
     

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
     $this->SKKP_model->update_data('tbl_skkp_panitera_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_skkp'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>'perintah revisi oleh '.$this->session->userdata('username'));
     $this->SKKP_model->insertHistory($dataHistory);

     if($this->session->userdata('end_stage')!==''){
        redirect('SKKP/viewDataSK/'.$this->session->userdata('end_stage'));
     }else{
        redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     }
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
     $this->SKKP_model->update_data('tbl_skkp_panitera_data', $data, $where);



     // tambahkan data history sk
     $dataHistory = array('id_history' =>'' ,'id_group'=>$idgroupsk, 'id_skkp'=>$idx, 'id_stage'=>$stage,'id_status'=>'6', 'tgl'=>$update_date, 'keterangan'=>$ket);
     $this->SKKP_model->insertHistory($dataHistory);

     //if($this->session->userdata('end_stage')!==''){
        redirect('SKKP/viewDataSK/'.$stage);
     //}else{
       // redirect('SKKP/viewDataSK/'.$this->session->userdata('start_stage'));

     //}
 }


 function viewHistory($idgroupsk, $idx, $stage, $menu){

  $where = array('skpangkatnoid' =>$idgroupsk ,'skpangkatindx'=>$idx );

  $where2 = array('id_group' =>$idgroupsk ,'id_skkp'=>$idx );
  $data['skkp']= $this->SKKP_model->getWhereDBSync($where, 'tbl_skkp_panitera_data');
  $data['history']=  $this->SKKP_model->getHistory($where2);
  $data['stage']= $stage;
  $data['menu']=$menu;

  /*
  array(3) { [0]=> array(12) { ["id_history"]=> string(1) "7" ["id_group"]=> string(1) "5" ["id_skkp"]=> string(1) "1" ["id_stage"]=> string(1) "5" ["id_status"]=> string(1) "5" ["tgl"]=> string(19) "2021-03-24 15:18:00" ["keterangan"]=> string(22) "di setujui oleh danang" ["status"]=> string(3) "ACC" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } [1]=> array(12) { ["id_history"]=> string(1) "8" ["id_group"]=> string(1) "5" ["id_skkp"]=> string(1) "1" ["id_stage"]=> string(1) "6" ["id_status"]=> string(1) "6" ["tgl"]=> string(19) "2021-03-24 15:18:45" ["keterangan"]=> string(30) "perintah revisi oleh SIAPA AJA" ["status"]=> string(6) "REVISI" ["stage_name"]=> string(15) "KASI-VERIFIKASI" ["id_level"]=> string(1) "5" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "6" } [2]=> array(12) { ["id_history"]=> string(1) "9" ["id_group"]=> string(1) "5" ["id_skkp"]=> string(1) "1" ["id_stage"]=> string(1) "5" ["id_status"]=> string(1) "5" ["tgl"]=> string(19) "2021-03-24 15:19:58" ["keterangan"]=> string(22) "di setujui oleh danang" ["status"]=> string(3) "ACC" ["stage_name"]=> string(11) "STAF-PROSES" ["id_level"]=> string(1) "6" ["stage_status"]=> string(1) "1" ["stage_order"]=> string(1) "5" } }
  
  */

          $this->load->view('admin_template/head');
          $this->load->view('admin_template/sidebar');
          $this->load->view('SK/SKKP_History_view',$data);
          $this->load->view('admin_template/footer');
 }

/* function getCountListDataSK($idgroupsk){

    $where = array('skpangkatnoid' =>$idgroupsk );

    //array(1) { ["no_idx"]=> string(1) "7" } array(1) { [0]=> array(1) { ["count"]=> string(3) "257" } }
   $data = $this->SKKP_model->getCountListDataSK($where);
   $hasil = array('skpangkatnoid' => $idgroupsk, 'count'=>$data[0]['count'] );
    return $hasil;
  }*/


  function ExportToExcel(){
      $data['skkp']=$this->SKKP_model->getDataAllSync();//
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