<?php  
/**
 * 
 */
class SKKP_model extends CI_Model
{

	
	function getData(){
		log_message("debug", "Masuk model");
		$db2 = $this->load->database('panitera', TRUE);
		$table =$db2->list_tables();
		$db2->select('*');
		$db2->from('sknaikpangkatmst');
		$query = $db2->get();
	    log_message("debug", "TEST");
		 return $query->result_array();
	  
  }


  //function getDataMonitoring
function getDataAllSync(){
  		//$table =$db2->list_tables();
  		$this->db->select('*');
  		$this->db->from('tbl_skkp_panitera_data');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skkp_panitera_data.updated_user_id');
  		$this->db->join('tbl_ref_status', 'tbl_ref_status.id_status=tbl_skkp_panitera_data.id_status');
  		$this->db->join('tbl_ref_stage', 'tbl_ref_stage.id_stage=tbl_skkp_panitera_data.id_stage');
  	
  		$query= $this->db->get();
	    return $query->result_array();

}


function sinkronUlangSK($where, $table){

  //get data from data master 
  $hasil= $this->getListDataSK($where);
  var_dump($hasil);
  
  $now = new DateTime();
      $update_date= $now->format('Y-m-d H:i:s'); 
      $no=1; foreach ($hasil as $hasil): 
        $no++;
      $pdk='';
      $pdk= $hasil['skpangkatpdk2'];
      if(!empty($pdk)){


      }else{
        $pdk= $hasil['skpangkatpdk1'];
      }
          $data_update = array('id' => '',
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
                'jabatan'=>$hasil['skpangkatoptx'],
                'pendidikan'=>$pdk,
                'gaji'=>$hasil['skpangkatgaji'],
                'tunjangan'=>$hasil['skpangkattunj'],
                'qrcode'=>$hasil['skpangkatcatat'],
                'id_stage'=>$stage[0]['start_stage'],
                'id_status'=>'7',
                'updated_date'=>$update_date,
                'updated_user_id'=>$this->session->userdata('userid'),
                'keterangan'=>'syncronized',
                'file_loc'=>''
              );
          // insert kedalam data table tbl_skkp_panitera_data
          
         $this->db->where($where);
         $this->db->update($table, $data_update);
         $this->load->model('PDF_model');
         $this->PDF_model->generateSKKPPanitera($data_update, 'kp');         
          
          endforeach;
    return $data_update;
    }
  // pake yang ini untuk ambil list SK yang mau ditampilkan
    function getDataSKSync($where){
  		//$table =$db2->list_tables();
  		$this->db->select('*');
  		$this->db->from('tbl_skkp_panitera_data');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skkp_panitera_data.updated_user_id');
  		$this->db->join('tbl_ref_status', 'tbl_ref_status.id_status=tbl_skkp_panitera_data.id_status');
  		$this->db->where($where);
		$query= $this->db->get();
		 	//var_dump($query->result()) ;
		//var_dump($query->result_array());
		return $query->result_array();

		/*array(1) { [0]=> array(37) { ["id"]=> string(1) "5" ["skpangkatnoid"]=> string(1) "5" ["skpangkatindx"]=> string(1) "1" ["nip"]=> string(3) "123" ["nama"]=> string(3) "tes" ["tempat_lahir"]=> string(8) "bengkulu" ["tgl_lahir"]=> string(10) "1997-07-22" ["sknmrpertek"]=> string(14) "AI-13001000763" ["sktglpertek"]=> string(10) "2019-10-01" ["sknomor"]=> string(7) "123/dju" ["sktgl"]=> string(10) "2019-10-01" ["gol_baru"]=> string(5) "III/a" ["tmt_gol_baru"]=> string(10) "2019-10-01" ["mk_tahun"]=> string(2) "10" ["mk_bulan"]=> string(1) "6" ["tmt_gol_lama"]=> string(10) "2018-10-01" ["gol_lama"]=> string(4) "II/d" ["pt"]=> string(6) "Manado" ["pn"]=> string(7) "Tondano" ["jabatan"]=> string(2) "JS" ["pendidikan"]=> string(2) "MH" ["gaji"]=> string(6) "260000" ["tunjangan"]=> string(6) "260000" ["qrcode"]=> string(3) "123" ["id_stage"]=> string(1) "8" ["id_status"]=> string(1) "7" ["updated_date"]=> string(19) "2021-03-20 19:39:46" ["updated_user_id"]=> string(1) "2" ["keterangan"]=> string(11) "syncronized" ["file_loc"]=> string(65) "C:\xampp\htdocs\sifora\application\docx\SKKP_Panitera\5_1_123.pdf" ["user_id"]=> string(1) "2" ["NIP"]=> string(0) "" ["user_name"]=> string(13) "administrator" ["user_password"]=> string(32) "e10adc3949ba59abbe56e057f20f883e" ["user_email"]=> string(15) "admin@gmail.com" ["user_id_jab"]=> string(1) "0" ["status"]=> string(6) "PROSES" } }*/

  }
  function getDataDBSync($table){
		log_message("debug", "Masuk model");
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
	    log_message("debug", "TEST");
		//var_dump($query->result()) ;
		return $query->result_array();


		/*
ject(stdClass)#23 (10) { ["id"]=> string(1) "0" ["skpangkatnoid"]=> string(1) "4" ["skpangkatnama"]=> string(13) "HANYA TESTING" ["skpangkatdate"]=> string(10) "2019-08-26" ["skpangkatdirjen"]=> string(14) "HERRI SWANTORO" ["skpangkatdirektur"]=> string(8) "HASWANDI" ["skpangkatkepalasub"]=> string(13) "J. KAMALUDDIN" ["createdate"]=> string(20) "2019-08-26 09:20:11." ["updated_date"]=> string(19) "2021-03-20 06:06:18" ["updated_user_id"]=> string(1) "2" } [1]=> object(stdClass)#24 (10) { ["id"]=> string(1) "2" ["skpangkatnoid"]=> string(1) "5" ["skpangkatnama"]=> string(12) "TESTING SAJA" ["skpangkatdate"]=> string(10) "2019-09-01" ["skpangkatdirjen"]=> string(14) "HERRI SWANTORO" ["skpangkatdirektur"]=> string(8) "HASWANDI" ["skpangkatkepalasub"]=> string(13) "J. KAMALUDDIN" ["createdate"]=> string(20) "2019-09-04 11:02:51." ["updated_date"]=> string(19) "2021-03-20 05:28:41" ["updated_user_id"]=> string(1) "2" } [2]=> object(stdClass)#25 (10) { ["id"]=> string(1) "3" ["skpangkatnoid"]=> string(1) "1" ["skpangkatnama"]=> string(10) "APRIL 2019" ["skpangkatdate"]=> string(10) "2019-04-01" ["skpangkatdirjen"]=> string(14) "HERRI SWANTORO" ["skpangkatdirektur"]=> string(8) "HASWANDI" ["skpangkatkepalasub"]=> string(13) "J. KAMALUDDIN" ["createdate"]=> string(20) "2019-03-06 00:19:56." ["updated_date"]=> string(19) "2021-03-20 05:57:20" ["updated_user_id"]=> string(1) "2" } }


		*/
	  
  }
  function getWhere($where){

		$db2 = $this->load->database('panitera', TRUE);
		//$table =$db2->list_tables();
		$query= $db2->get_where('sknaikpangkatmst', $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
		//return  $query->num_rows();

		// tambahkan inout ke database sistem untuk copy data group

		

		/*
		hasil array by id_group :
		6array(1) { ["skkpgroup"]=> array(1) { [0]=> array(27) { ["skpangkatnoid"]=> string(1) "6" ["skpangkatdate"]=> string(10) "2019-10-01" ["skpangkatnama"]=> string(12) "KPO OKT 2019" ["skpangkatdescr"]=> NULL ["skpangkatfiles"]=> string(5) "Grup6" ["skpangkatdirjen"]=> string(12) "PRIM HARYADI" ["skpangkatdirektur"]=> string(8) "HASWANDI" ["skpangkatkepalasub"]=> string(13) "J. KAMALUDDIN" ["skpangkatdirjennip"]=> string(1) "-" ["skpangkatdirekturnip"]=> string(1) "-" ["skpangkatkepalasubnip"]=> string(1) "-" ["skpangkatwilayah"]=> string(9) "Wilayah I" ["skpangkatjabatan"]=> string(8) "Panitera" ["jumlahkata"]=> string(1) "6" ["tanggalotk"]=> NULL ["tanggalttd"]=> NULL ["jumlahdlmsk"]=> string(1) "0" ["jumlahotentik"]=> string(1) "0" ["jumlahsalin"]=> string(1) "0" ["jumlahpetik"]=> string(1) "0" ["jumlahcheck"]=> string(1) "0" ["statusupdate"]=> string(1) "Y" ["statuslocked"]=> string(1) "Y" ["createnoid"]=> string(1) "6" ["createdate"]=> string(23) "2019-10-04 09:35:36.239" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(23) "2019-10-04 09:35:36.269" } } }
		*/
  }
  function getWhereDBSync($where, $table){

		//$table =$db2->list_tables();
		$query= $this->db->get_where($table, $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
	}

  function addData($data, $table){
  	//var_dump($data);
  	$where = array('skpangkatnoid' => $data['skpangkatnoid'] );
  			
  		$result = $this->getWhereDBSync($where, $table);
  		
  		
  		if(empty($result)){
  			
  			$this->db->insert($table,$data);
  		}else{
		
			$this->db->where($where);
  			$this->db->update($table,$data);
  			//var_dump($result); 
  			
  		}
  		
 
  	// masukkan data kedalam data group sk kp di database sifora beserta 

  /*	array(7) { ["skpangkatnoid"]=> string(1) "6" ["skpangkatnama"]=> string(12) "KPO OKT 2019" ["skpangkatdate"]=> string(10) "2019-10-01" ["skpangkatdirjen"]=> string(12) "PRIM HARYADI" ["skpangkatdirektur"]=> string(8) "HASWANDI" ["skpangkatkepalasub"]=> string(13) "J. KAMALUDDIN" ["createdate"]=> string(23) "2019-10-04 09:35:36.239" }*/
 		//redirect('SKKP/index');
  	
  }
  function addDataSK( $table, $where, $stage){
  	$this->load->model('PDF_model');
  		// matikan dulu 
  	$out = $this->getListDataSK($where);


  	/*$out = array( 
      
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
); */
  		//array(1) { [0]=> array(154) { ["skpangkatnoid"]=> string(1) "5" ["skpangkatindx"]=> string(1) "1" ["skpangkaturut"]=> string(1) "1" ["sknmrkeputusn"]=> string(3) "123" ["sktglkeputusn"]=> string(10) "2019-07-22" ["sknmrskkenaikn"]=> string(3) "123" ["sktglskkenaikn"]=> string(10) "2019-10-01" ["sktgltdkenaikn"]=> string(10) "2019-09-04" ["skpangkatpegw"]=> string(4) "7448" ["skpangkatlbln"]=> string(1) "6" ["skpangkatlthn"]=> string(2) "13" ["skpangkatltmt"]=> string(10) "2018-10-01" ["skpangkatlama"]=> string(4) "II/d" ["skpangkatbaru"]=> string(5) "III/a" ["skpangkatopyn"]=> string(1) "N" ["skpangkatoptx"]=> string(8) "Jurusita" ["skpangkattjgn"]=> string(2) "JS" ["skpangkatrwyt"]=> string(13) "JS PN TONDANO" ["skpangkatptpn"]=> string(1) "N" ["skpangkatptid"]=> string(2) "24" ["skpangkatpnid"]=> string(3) "304" ["skmutasiyesn"]=> string(1) "N" ["skmutasiptpn"]=> string(1) "N" ["skmutasiptid"]=> string(1) "0" ["skmutasipnid"]=> string(1) "0" ["skmutasiopyn"]=> string(1) "N" ["skmutasioptx"]=> string(0) "" ["skmutasibrtjg"]=> string(0) "" ["skmutasibrrwy"]=> string(0) "" ["skmutasisktg"]=> NULL ["skmutasiskno"]=> string(0) "" ["skpangkatgaji"]=> string(7) "3106900" ["skpangkattunj"]=> string(6) "260000" ["skpangkatpdk1"]=> string(2) "SH" ["skpangkatpdk2"]=> string(0) "" ["skpangkatcatat"]=> NULL ["skpangkatchek"]=> string(1) "N" ["sdhdicheckfl"]=> string(1) "Y" ["sdhdicheckid"]=> string(1) "6" ["sdhdicheckdt"]=> string(23) "2019-09-03 21:04:43.904" ["sdhdiprtotkfl"]=> string(1) "N" ["sdhdiprtotkid"]=> string(1) "0" ["sdhdiprtotkdt"]=> NULL ["sdhdiprtslnfl"]=> string(1) "N" ["sdhdiprtslnid"]=> string(1) "0" ["sdhdiprtslndt"]=> NULL ["sdhdiprtptkfl"]=> string(1) "N" ["sdhdiprtptkid"]=> string(1) "0" ["sdhdiprtptkdt"]=> NULL ["createnoid"]=> string(1) "1" ["createdate"]=> string(23) "2019-02-26 10:44:52.877" ["updatenoid"]=> string(1) "1" ["updatedate"]=> string(23) "2020-02-12 10:10:21.555" ["ptnoid"]=> string(2) "24" ["ptrmwi"]=> string(4) "XXIV" ["ptnama"]=> string(6) "Manado" ["ptkelas"]=> string(1) "B" ["ptkppn"]=> string(6) "Manado" ["ptalmt"]=> string(43) "Jl. Dr. SamRatulangi No. 20 Manado, 95111" ["ptsort"]=> string(1) "2" ["ptkode"]=> string(1) "W" ["headptpn"]=> string(1) "2" ["emailpt"]=> string(22) "ptmanadomari@gmail.com" ["pnnoid"]=> string(3) "304" ["pnurut"]=> string(1) "3" ["pnnama"]=> string(7) "Tondano" ["pnkelas"]=> string(3) "I.B" ["pnkppn"]=> string(6) "Manado" ["pnalmt"]=> string(51) "Jl. Manguni No. 75 Tondano, Sulawesi Utara 95615" ["pnpusat"]=> string(1) "N" ["pnphi"]=> string(1) "N" ["pntipikor"]=> string(1) "N" ["pnsort"]=> string(1) "5" ["pnkode"]=> string(6) "W - 03" ["pnhakim"]=> string(3) "304" ["emailpn"]=> string(21) "info@pn-tondano.go.id" ["nomor"]=> string(4) "7448" ["nogrp"]=> string(1) "0" ["noidx"]=> string(1) "1" ["nodrp"]=> string(1) "5" ["nama"]=> string(15) "METY HUSAIN, SH" ["nip"]=> string(21) "19720402 200604 2 001" ["niplama"]=> string(0) "" ["nipnmrc"]=> string(18) "197204022006042001" ["nogol"]=> string(5) "III/a" ["tglgol"]=> string(10) "2019-10-01" ["tptlhr"]=> string(6) "Manado" ["tgllhr"]=> string(10) "1972-04-02" ["kelamin"]=> string(6) "WANITA" ["pasangan"]=> string(0) "" ["anak"]=> string(1) "4" ["agama"]=> string(5) "ISLAM" ["pddkan1"]=> string(2) "SH" ["pddkan2"]=> string(0) "" ["pddkan3"]=> string(0) "" ["jabattgl"]=> string(10) "2017-06-22" ["jabatan"]=> string(2) "JS" ["postptpn"]=> string(2) "PN" ["nomorpt"]=> string(2) "24" ["nomorpn"]=> string(3) "304" ["txjabatan"]=> string(23) "PN TONDANO ( I.B ) JS" ["txpekerjaan"]=> string(106) "01-04-06 CPNS PN TONDANO 01-05-07 PNS PN TONDANO 14-02-14 JSP PN TONDANO 22-06-17 JS PN TONDANO" ["txdiklat"]=> string(0) "" ["txdata1st"]=> string(93) "NAMA N I P GOL. RUANG TP/TGL LAHIR JENIS KEL. ISTRI/SUAMI ANAK AGAMA PENDIDIKAN " ["txdata2nd"]=> string(26) ": : : : : : : : : " ["txdata3rd"]=> string(120) "METY HUSAIN, SH 19720402 200604 2 001 III/a , 1 OKTOBER 2019 Manado , 2 APRIL 1972 WANITA - 4 ISLAM SH " ["pa_th"]=> NULL ["pa_k"]=> NULL ["pa_skor"]=> string(1) "0" ["fit1_th"]=> NULL ["fit1_tj"]=> NULL ["fit1_status"]=> NULL ["fit1_rank"]=> string(1) "0" ["fit2_th"]=> NULL ["fit2_tj"]=> NULL ["fit2_status"]=> NULL ["fit2_rank"]=> string(1) "0" ["fit3_th"]=> NULL ["fit3_tj"]=> NULL ["fit3_status"]=> NULL ["fit3_rank"]=> string(1) "0" ["fit4_th"]=> NULL ["fit4_tj"]=> NULL ["fit4_status"]=> NULL ["fit4_rank"]=> string(1) "0" ["fit5_th"]=> NULL ["fit5_tj"]=> NULL ["fit5_status"]=> NULL ["fit5_rank"]=> string(1) "0" ["diklat_nm"]=> NULL ["diklat_th"]=> NULL ["diklat_kt"]=> NULL ["keterangan"]=> string(0) "" ["stsflag"]=> string(1) "A" ["stsdate"]=> NULL ["stspilih"]=> string(0) "" ["txhkmndinas"]=> NULL ["tglpensiun"]=> NULL ["ketpensiun"]=> NULL ["txusulan"]=> NULL ["grupurutan"]=> string(1) "6" ["adadrp"]=> NULL ["namadrp"]=> NULL ["nomordrp"]=> string(1) "0" ["adafoto"]=> string(1) "0" ["rlistdrp"]=> string(2) "16" ["txcomment"]=> NULL ["peddkanakhir"]=> NULL ["sakityatdk"]=> string(1) "N" ["sakitketer"]=> NULL ["tmtpppertama"]=> NULL ["alamatemail"]=> NULL ["nohandphone"]=> NULL } };
		
  		if(empty($out)){

  				echo "data sk pada group kosong";
  		}else{
	  		
			//var_dump($out);
		  $now = new DateTime();
	    $update_date= $now->format('Y-m-d H:i:s'); 
	    $no=1; foreach ($out as $hasil): 
  			$no++;
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
  							'jabatan'=>$hasil['skpangkatoptx'],
  							'pendidikan'=>$pdk,
  							'gaji'=>$hasil['skpangkatgaji'],
  							'tunjangan'=>$hasil['skpangkattunj'],
  							'qrcode'=>$hasil['skpangkatcatat'],
  							'id_stage'=>$stage[0]['start_stage'],
  							'id_status'=>'7',
  							'updated_date'=>$update_date,
  							'updated_user_id'=>$this->session->userdata('userid'),
  							'keterangan'=>'syncronized',
  							'file_loc'=>''
  						);
  				// insert kedalam data table tbl_skkp_panitera_data
  				$this->db->insert($table,$data);
  				// insert kedalam data history sk tbl_skkp_panitera_history

  				$this->PDF_model->generateSKKPPanitera($data, 'kp');         
  				$datahistory = array('id_history' =>'' ,'id_group'=>$hasil['skpangkatnoid'],'id_skkp'=>$hasil['skpangkatindx'],'id_stage'=>$stage[0]['start_stage'],'id_status'=>'7','tgl'=>$update_date, 'keterangan'=>'syncronized' );
  				$this->insertHistory($datahistory);
  				endforeach;
  				//var_dump($out); 
  				return $data;
  		}

  }

	function insertHistory($data){
		$this->db->insert('tbl_skkp_panitera_history',$data);
	}

	function getHistory($where){

		$this->db->select('*');
		$this->db->from('tbl_skkp_panitera_history');
		$this->db->join('tbl_ref_status','tbl_skkp_panitera_history.id_status=tbl_ref_status.id_status');

		$this->db->join('tbl_ref_stage','tbl_skkp_panitera_history.id_stage=tbl_ref_stage.id_stage');
		$this->db->where($where);
		$query= $this->db->get();
		return $query->result_array();
			
	}
	function getListDataSK($where){

		$db2 = $this->load->database('panitera', TRUE);
		//$table =$db2->list_tables();
		
		//$query= $db2->get_where('sknaikpangkatpeg', $where);
		//	var_dump($query->result()) ;
		//return $query->result_array();
	
		//return  $query->num_rows();

		var_dump($where);
		    $db2->select('*');
			$db2->from('sknaikpangkatpeg');
			$db2->join('tbdatapt', 'sknaikpangkatpeg.skpangkatptid = tbdatapt.ptnoid');
			$db2->join('tbdatapn', 'sknaikpangkatpeg.skpangkatpnid = tbdatapn.pnnoid');
			//$db2->join('jabatan', 'sknaikpangkatpeg.jabatkd = jabatan.jabatkd');
			$db2->join('datapegawai', 'sknaikpangkatpeg.skpangkatpegw = datapegawai.nomor');
			$db2->where($where);
		    $query2 = $db2->get();
			return $query2->result_array();

		//cek row_num jika tidak null > masukkan data list sk kedalam database list skkp group dan set status dan stage sk ada di staf

		// ini data list sk by id group 


			/*
			[78]=> array(76) { ["skpangkatnoid"]=> string(1) "6" ["skpangkatindx"]=> string(2) "80" ["skpangkaturut"]=> string(2) "80" ["sknmrkeputusn"]=> string(14) "AI-13001000763" ["sktglkeputusn"]=> string(10) "2019-09-02" ["sknmrskkenaikn"]=> string(27) "3228/DJU/SK/KP.04.1/11/2019" ["sktglskkenaikn"]=> string(10) "2019-10-01" ["sktgltdkenaikn"]=> string(10) "2019-11-04" ["skpangkatpegw"]=> string(4) "1336" ["skpangkatlbln"]=> string(1) "7" ["skpangkatlthn"]=> string(2) "28" ["skpangkatltmt"]=> string(10) "2016-10-01" ["skpangkatlama"]=> string(4) "IV/a" ["skpangkatbaru"]=> string(4) "IV/b" ["skpangkatopyn"]=> string(1) "N" ["skpangkatoptx"]=> string(8) "Panitera" ["skpangkattjgn"]=> string(8) "PANITERA" ["skpangkatrwyt"]=> string(20) "PANITERA PN SEMARANG" ["skpangkatptpn"]=> string(1) "N" ["skpangkatptid"]=> string(2) "13" ["skpangkatpnid"]=> string(3) "137" ["skmutasiyesn"]=> string(1) "N" ["skmutasiptpn"]=> string(1) "N" ["skmutasiptid"]=> string(1) "0" ["skmutasipnid"]=> string(1) "0" ["skmutasiopyn"]=> string(1) "N" ["skmutasioptx"]=> string(0) "" ["skmutasibrtjg"]=> string(0) "" ["skmutasibrrwy"]=> string(0) "" ["skmutasisktg"]=> NULL ["skmutasiskno"]=> string(0) "" ["skpangkatgaji"]=> string(7) "4898100" ["skpangkattunj"]=> string(7) "2025000" ["skpangkatpdk1"]=> string(9) "SH TH. 92" ["skpangkatpdk2"]=> string(36) "MH UNIVERSITAS SUNAN GIRI TAHUN 2009" ["skpangkatcatat"]=> string(32) "8ae483a86ddc67c8016e349dac5f4f45" ["skpangkatchek"]=> string(1) "N" ["sdhdicheckfl"]=> string(1) "Y" ["sdhdicheckid"]=> string(1) "6" ["sdhdicheckdt"]=> string(26) "2020-01-21 18:50:27.618486" ["sdhdiprtotkfl"]=> string(1) "N" ["sdhdiprtotkid"]=> string(1) "0" ["sdhdiprtotkdt"]=> NULL ["sdhdiprtslnfl"]=> string(1) "N" ["sdhdiprtslnid"]=> string(1) "0" ["sdhdiprtslndt"]=> NULL ["sdhdiprtptkfl"]=> string(1) "N" ["sdhdiprtptkid"]=> string(1) "0" ["sdhdiprtptkdt"]=> NULL ["createnoid"]=> string(1) "1" ["createdate"]=> string(23) "2014-01-24 02:58:56.596" ["updatenoid"]=> string(1) "3" ["updatedate"]=> string(23) "2015-05-22 09:51:58.997" ["ptnoid"]=> string(2) "13" ["ptrmwi"]=> string(4) "XIII" ["ptnama"]=> string(8) "Semarang" ["ptkelas"]=> string(1) "A" ["ptkppn"]=> string(11) "Semarang II" ["ptalmt"]=> string(49) "Jl. Pahlawan No. 19 Semarang, Jawa Tengah 50243" ["ptsort"]=> string(1) "1" ["ptkode"]=> string(1) "D" ["headptpn"]=> string(1) "2" ["emailpt"]=> string(19) "pt.jateng@gmail.com" ["pnnoid"]=> string(3) "137" ["pnurut"]=> string(1) "1" ["pnnama"]=> string(8) "Semarang" ["pnkelas"]=> string(5) "I.A.K" ["pnkppn"]=> string(11) "Semarang II" ["pnalmt"]=> string(47) "Jl. Siliwangi No. 512, Krapyak Semarang, 50418" ["pnpusat"]=> string(1) "Y" ["pnphi"]=> string(1) "N" ["pntipikor"]=> string(1) "Y" ["pnsort"]=> string(1) "3" ["pnkode"]=> string(6) "D - 01" ["pnhakim"]=> string(3) "137" ["emailpn"]=> string(26) " pn.semarangkota@gmail.com" } }




			*/
		/*
			 [0]=> object(stdClass)#22 (53) { ["skpangkatnoid"]=> string(1) "6" ["skpangkatindx"]=> string(1) "6" ["skpangkaturut"]=> string(1) "6" ["sknmrkeputusn"]=> string(14) "AI-13001000719" ["sktglkeputusn"]=> string(10) "2019-09-02" ["sknmrskkenaikn"]=> string(27) "3117/DJU/SK/KP.04.1/10/2019" ["sktglskkenaikn"]=> string(10) "2019-10-01" ["sktgltdkenaikn"]=> string(10) "2019-10-08" ["skpangkatpegw"]=> string(4) "4423" ["skpangkatlbln"]=> string(1) "7" ["skpangkatlthn"]=> string(2) "18" ["skpangkatltmt"]=> string(10) "2015-10-01" ["skpangkatlama"]=> string(5) "III/b" ["skpangkatbaru"]=> string(5) "III/c" ["skpangkatopyn"]=> string(1) "N" ["skpangkatoptx"]=> string(21) "Panitera Muda Perdata" ["skpangkattjgn"]=> string(14) "PANMUD PERDATA" ["skpangkatrwyt"]=> string(26) "PANMUD PERDATA PN BANTAENG" ["skpangkatptpn"]=> string(1) "N" ["skpangkatptid"]=> string(2) "21" ["skpangkatpnid"]=> string(3) "273" ["skmutasiyesn"]=> string(1) "N" ["skmutasiptpn"]=> string(1) "N" ["skmutasiptid"]=> string(1) "0" ["skmutasipnid"]=> string(1) "0" ["skmutasiopyn"]=> string(1) "N" ["skmutasioptx"]=> string(0) "" ["skmutasibrtjg"]=> string(0) "" ["skmutasibrrwy"]=> string(0) "" ["skmutasisktg"]=> NULL ["skmutasiskno"]=> string(0) "" ["skpangkatgaji"]=> string(7) "3704300" ["skpangkattunj"]=> string(6) "360000" ["skpangkatpdk1"]=> string(54) "SHI STAI DARUL DA'WAH WAL- IRSYAD JENEPONTO TAHUN 2008" ["skpangkatpdk2"]=> string(0) "" ["skpangkatcatat"]=> string(32) "8ae483a56d89d32c016dae9e9f2101a1" ["skpangkatchek"]=> string(1) "N" ["sdhdicheckfl"]=> string(1) "Y" ["sdhdicheckid"]=> string(1) "6" ["sdhdicheckdt"]=> string(26) "2020-01-21 18:50:27.618486" ["sdhdiprtotkfl"]=> string(1) "N" ["sdhdiprtotkid"]=> string(1) "0" ["sdhdiprtotkdt"]=> NULL ["sdhdiprtslnfl"]=> string(1) "N" ["sdhdiprtslnid"]=> string(1) "0" ["sdhdiprtslndt"]=> NULL ["sdhdiprtptkfl"]=> string(1) "N" ["sdhdiprtptkid"]=> string(1) "0" ["sdhdiprtptkdt"]=> NULL ["createnoid"]=> string(1) "6" ["createdate"]=> string(23) "2019-10-04 10:34:44.871" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(23) "2019-10-09 10:54:49.446" }


		*/



}

function update_data($table, $data, $where){
	$this->db->where($where);
	$this->db->update($table, $data);
}


function signSK(){


}
function terbilang(){
	$this->load->helper('my_helper');
	return terbilang(25000);

}

}
 ?>