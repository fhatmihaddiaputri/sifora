<?php  
/**
 * 
 */
class SKKPO_model extends CI_Model
{

	function getData(){
		log_message("debug", "Masuk model");
		$db2 = $this->load->database('panitera', TRUE);
		$table =$db2->list_tables();
		$db2->select('*');
		$db2->from('sk_kp_o_1st');
		$query = $db2->get();
	    log_message("debug", "TEST");
		 return $query->result_array();
	  // *********************hasil**********************
		 /*
			array(18) { [0]=> array(10) { ["sknoid"]=> string(1) "3" ["skdate"]=> string(10) "2018-10-01" ["skdescr"]=> string(14) "SK KP OKT 2018" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "6" ["lockdate"]=> string(10) "2019-04-07" ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2019-03-09 01:09:19.764" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(22) "2019-04-08 09:28:00.01" } [1]=> array(10) { ["sknoid"]=> string(1) "1" ["skdate"]=> string(10) "2019-04-01" ["skdescr"]=> string(16) "TMT 1 April 2019" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "6" ["lockdate"]=> string(10) "2019-04-07" ["createnoid"]=> string(1) "1" ["createdate"]=> string(23) "2019-02-18 08:51:46.556" ["updatenoid"]=> string(1) "1" ["updatedate"]=> string(23) "2019-02-18 08:52:20.049" } [2]=> array(10) { ["sknoid"]=> string(1) "2" ["skdate"]=> string(10) "2019-04-01" ["skdescr"]=> string(9) "SK JS JSP" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "6" ["lockdate"]=> string(10) "2019-04-07" ["createnoid"]=> string(1) "6" ["createdate"]=> string(23) "2019-02-26 11:45:41.692" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(23) "2019-02-26 11:48:25.352" } [3]=> array(10) { ["sknoid"]=> string(1) "4" ["skdate"]=> string(10) "2019-04-01" ["skdescr"]=> string(21) "perbaikan ISKANDAR MY" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "6" ["lockdate"]=> string(10) "2019-07-03" ["createnoid"]=> string(2) "10" ["createdate"]=> string(23) "2019-04-09 18:30:46.588" ["updatenoid"]=> string(2) "10" ["updatedate"]=> string(23) "2019-04-09 18:31:24.141" } [4]=> array(10) { ["sknoid"]=> string(1) "5" ["skdate"]=> string(10) "2019-04-01" ["skdescr"]=> string(7) "sk kpo " ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "6" ["lockdate"]=> string(10) "2019-07-03" ["createnoid"]=> string(1) "6" ["createdate"]=> string(23) "2019-04-11 09:03:33.639" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(23) "2019-04-11 09:03:47.275" } [5]=> array(10) { ["sknoid"]=> string(1) "6" ["skdate"]=> string(10) "2019-04-01" ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "6" ["createdate"]=> string(23) "2019-07-25 09:26:58.862" ["updatenoid"]=> string(1) "6" ["updatedate"]=> string(23) "2019-07-25 09:27:07.296" } [6]=> array(10) { ["sknoid"]=> string(1) "8" ["skdate"]=> string(10) "2020-04-01" ["skdescr"]=> string(4) "test" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "4" ["lockdate"]=> string(10) "2020-06-05" ["createnoid"]=> string(1) "8" ["createdate"]=> string(23) "2020-03-18 00:23:34.924" ["updatenoid"]=> string(1) "4" ["updatedate"]=> string(22) "2020-06-06 05:11:22.41" } [7]=> array(10) { ["sknoid"]=> string(1) "7" ["skdate"]=> string(10) "2020-04-01" ["skdescr"]=> string(10) "April 2020" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "5" ["lockdate"]=> string(10) "2020-07-21" ["createnoid"]=> string(1) "6" ["createdate"]=> string(23) "2019-11-28 10:43:27.304" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2020-07-21 15:59:46.748" } [8]=> array(10) { ["sknoid"]=> string(1) "9" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2020-08-24 09:26:20.608" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2020-08-24 09:26:20.626" } [9]=> array(10) { ["sknoid"]=> string(2) "10" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2020-08-31 09:12:23.137" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2020-08-31 09:12:23.152" } [10]=> array(10) { ["sknoid"]=> string(2) "11" ["skdate"]=> string(10) "2020-10-01" ["skdescr"]=> string(16) "KPO OKTOBER 2020" ["lockdata"]=> string(1) "Y" ["locknoid"]=> string(1) "5" ["lockdate"]=> string(10) "2020-10-14" ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2020-08-31 09:50:42.695" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2020-10-14 15:07:54.642" } [11]=> array(10) { ["sknoid"]=> string(2) "12" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2020-12-17 08:39:04.893" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2020-12-17 08:39:04.908" } [12]=> array(10) { ["sknoid"]=> string(2) "13" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2021-02-16 09:13:46.264" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2021-02-16 09:13:46.275" } [13]=> array(10) { ["sknoid"]=> string(2) "14" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2021-02-17 14:55:19.312" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2021-02-17 14:55:19.323" } [14]=> array(10) { ["sknoid"]=> string(2) "15" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2021-02-17 15:54:14.762" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2021-02-17 15:54:14.772" } [15]=> array(10) { ["sknoid"]=> string(2) "16" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2021-02-17 15:58:12.005" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2021-02-17 15:58:12.016" } [16]=> array(10) { ["sknoid"]=> string(2) "17" ["skdate"]=> NULL ["skdescr"]=> NULL ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2021-02-17 16:17:54.706" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2021-02-17 16:17:54.717" } [17]=> array(10) { ["sknoid"]=> string(2) "18" ["skdate"]=> string(10) "2021-04-01" ["skdescr"]=> string(14) "KPO APRIL 2021" ["lockdata"]=> string(1) "N" ["locknoid"]=> NULL ["lockdate"]=> NULL ["createnoid"]=> string(1) "5" ["createdate"]=> string(23) "2021-02-17 16:21:40.927" ["updatenoid"]=> string(1) "5" ["updatedate"]=> string(23) "2021-02-17 16:22:32.421" } }


		 */

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
         $this->PDF_model->generateSKKPPanitera($data_update, 'kpo');         
         
        endforeach;
        return $data_update;
    }
  
  function getWhere($where){

		$db2 = $this->load->database('panitera', TRUE);
		//$table =$db2->list_tables();
		$query= $db2->get_where('sk_kp_o_1st', $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();

	}


	function addData($data, $table){
  	var_dump($data);
  	$where = array('skpangkatnoid' => $data['skpangkatnoid'] );
  			
  		$result = $this->getWhereDBSync($where, $table);
  		$error='';
  		
  		if(empty($result)){
  			echo "data belum ada";
  			$this->db->insert($table,$data);
  			//PRINT @@ROWCOUNT;
  		}else{
  			echo "data sudah ada";
			$error= "Group SK sudah pernah di sinkron";
			//$this->db->where($where);
  			//$this->db->update($table,$data);
  			//var_dump($result); 
  			
  		}
  		return $error;
  	}

  	 function getWhereDBSync($where, $table){

		//$table =$db2->list_tables();
		$query= $this->db->get_where($table, $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
	}

  	function getDataDBSync($table){
		log_message("debug", "Masuk model");
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
	    log_message("debug", "TEST");
		//var_dump($query->result()) ;
		return $query->result_array();
	}


	function addDataSK( $table, $where, $stage){
  	$this->load->model('PDF_model');
  		// matikan dulu 
  	$out = $this->getListDataSK($where);
  	var_dump($out);


  	/*
 8array(10) { ["id"]=> string(0) "" ["skpangkatnoid"]=> string(1) "8" ["skpangkatnama"]=> string(4) "test" ["skpangkatdate"]=> string(10) "2020-04-01" ["skpangkatdirjen"]=> string(0) "" ["skpangkatdirektur"]=> string(0) "" ["skpangkatkepalasub"]=> string(0) "" ["createdate"]=> string(23) "2020-03-18 00:23:34.924" ["updated_date"]=> string(19) "2021-03-31 05:44:02" ["updated_user_id"]=> string(2) "16" } data belum adaarray(1) { [0]=> array(133) { ["no_idx"]=> string(1) "8" ["no_urt"]=> string(1) "1" ["no_ref"]=> string(1) "1" ["no_peg"]=> string(4) "3017" ["kode_barcode"]=> string(0) "" ["no_pertek"]=> string(3) "234" ["tgl_pertek"]=> string(12) "05 Juni 2020" ["namadpn"]=> string(0) "" ["namablk"]=> string(0) "" ["namatgh"]=> string(14) "IDRIS, SH., MH" ["namatable"]=> string(14) "IDRIS, SH., MH" ["tempat_lahir"]=> string(15) "SEI LAMA ASAHAN" ["tgl_lahir"]=> string(14) "18 - 08 - 1966" ["nip"]=> string(21) "19660818 198703 1 002" ["pendidikan"]=> string(48) "MH UNIVERSITAS PEMBANGUNAN PANCA BUDI TAHUN 2015" ["th_lulus"]=> string(0) "" ["gol_lama"]=> string(4) "IV/a" ["tmt_gol_lama"]=> string(14) "06 - 06 - 2020" ["mk_th_lama"]=> NULL ["mk_bl_lama"]=> NULL ["gaji_lama"]=> string(7) "3044300" ["gol_baru"]=> string(4) "IV/b" ["tmt_gol_baru"]=> NULL ["mk_th_baru"]=> NULL ["mk_bl_baru"]=> NULL ["gaji_baru"]=> string(7) "3173100" ["jabatan"]=> string(8) "PANITERA" ["unitkerja"]=> string(25) "Pengadilan Negeri Kisaran" ["no_sk"]=> NULL ["tgl_sk"]=> NULL ["nomor"]=> string(4) "3017" ["nogrp"]=> string(1) "0" ["noidx"]=> string(1) "1" ["nodrp"]=> string(1) "1" ["nama"]=> string(14) "IDRIS, SH., MH" ["niplama"]=> string(0) "" ["nipnmrc"]=> string(18) "196608181987031002" ["nogol"]=> string(4) "IV/b" ["tglgol"]=> string(10) "2020-04-01" ["tptlhr"]=> string(15) "SEI LAMA ASAHAN" ["tgllhr"]=> string(10) "1966-08-18" ["kelamin"]=> string(4) "PRIA" ["pasangan"]=> string(31) "RIKALIS DEWI SARTIKA/PEG SWASTA" ["anak"]=> string(1) "3" ["agama"]=> string(5) "ISLAM" ["pddkan1"]=> string(36) "SH UNIVERITAS AMIR HAMZAH TAHUN 2004" ["pddkan2"]=> string(48) "MH UNIVERSITAS PEMBANGUNAN PANCA BUDI TAHUN 2015" ["pddkan3"]=> string(0) "" ["jabattgl"]=> string(10) "2020-04-21" ["postptpn"]=> string(2) "PN" ["nomorpt"]=> string(1) "2" ["nomorpn"]=> string(2) "34" ["txjabatan"]=> string(29) "PN KISARAN ( I.B ) PANITERA" ["txpekerjaan"]=> string(212) "01-03-87 CPNS PN KISARAN 01-06-88 PNS PN KISARAN 22-09-99 PP PN KISARAN 16-06-00 PP PN MEDAN 02-01-14 PANMUD PERDATA PN LUBUK PAKAM 25-09-18 PANITERA PN SEI RAMPEH 21-04-20 PANITERA PN KISARAN" ["txdiklat"]=> string(35) "FIT IB NOVEMBER 2019 (11)/ 16 LULUS" ["txphoto"]=> string(28776) ["txdata1st"]=> string(93) "NAMA N I P GOL. RUANG TP/TGL LAHIR JENIS KEL. ISTRI/SUAMI ANAK AGAMA PENDIDIKAN " ["txdata2nd"]=> string(26) ": : : : : : : : : " ["txdata3rd"]=> string(237) "IDRIS, SH., MH 19660818 198703 1 002 IV/b , 1 APRIL 2020 SEI LAMA ASAHAN , 18 AGUSTUS 1966 PRIA RIKALIS DEWI SARTIKA/PEG SWASTA 3 ISLAM SH UNIVERITAS AMIR HAMZAH TAHUN 2004 MH UNIVERSITAS PEMBANGUNAN PANCA BUDI TAHUN 2015 " ["pa_th"]=> string(0) "" ["pa_k"]=> string(0) "" ["pa_skor"]=> string(1) "0" ["fit1_th"]=> string(0) "" ["fit1_tj"]=> string(0) "" ["fit1_status"]=> string(0) "" ["fit1_rank"]=> string(1) "0" ["fit2_th"]=> string(8) "2019 NOV" ["fit2_tj"]=> string(0) "" ["fit2_status"]=> string(5) "LULUS" ["fit2_rank"]=> string(2) "11" ["fit3_th"]=> string(0) "" ["fit3_tj"]=> string(0) "" ["fit3_status"]=> string(0) "" ["fit3_rank"]=> string(1) "0" ["fit4_th"]=> string(0) "" ["fit4_tj"]=> string(0) "" ["fit4_status"]=> string(0) "" ["fit4_rank"]=> string(1) "0" ["fit5_th"]=> string(0) "" ["fit5_tj"]=> string(0) "" ["fit5_status"]=> string(0) "" ["fit5_rank"]=> string(1) "0" ["diklat_nm"]=> string(0) "" ["diklat_th"]=> string(0) "" ["diklat_kt"]=> string(0) "" ["keterangan"]=> string(0) "" ["stsflag"]=> string(1) "A" ["stsdate"]=> NULL ["stspilih"]=> string(1) "N" ["txhkmndinas"]=> NULL ["tglpensiun"]=> NULL ["ketpensiun"]=> NULL ["createnoid"]=> string(1) "1" ["createdate"]=> string(23) "2014-11-11 15:15:57.168" ["updatenoid"]=> string(1) "1" ["updatedate"]=> string(23) "2019-01-31 08:02:45.657" ["txusulan"]=> NULL ["grupurutan"]=> string(1) "1" ["adadrp"]=> string(5) "Ada 1" ["namadrp"]=> string(9) "IDRIS, SH" ["nomordrp"]=> string(3) "268" ["adafoto"]=> string(1) "0" ["rlistdrp"]=> string(1) "1" ["txcomment"]=> NULL ["peddkanakhir"]=> NULL ["sakityatdk"]=> string(1) "N" ["sakitketer"]=> NULL ["tmtpppertama"]=> string(10) "1999-09-22" ["alamatemail"]=> NULL ["nohandphone"]=> NULL ["ptnoid"]=> string(1) "2" ["ptrmwi"]=> string(2) "II" ["ptnama"]=> string(5) "Medan" ["ptkelas"]=> string(1) "A" ["ptkppn"]=> string(5) "Medan" ["ptalmt"]=> string(65) "Jalan Ngumban Surbakti No.38 A Medan, Sumatera Utara, Indonesia" ["ptsort"]=> string(1) "1" ["ptkode"]=> string(1) "H" ["headptpn"]=> string(1) "2" ["emailpt"]=> string(18) "pt.medan@gmail.com" ["pnnoid"]=> string(2) "34" ["pnurut"]=> string(1) "5" ["pnnama"]=> string(7) "Kisaran" ["pnkelas"]=> string(3) "I.B" ["pnkppn"]=> string(13) "Tanjung Balai" ["pnalmt"]=> string(56) "Jl. Jend. A. Yani No. 33 Kisaran, Sumatera Utara 21214" ["pnpusat"]=> string(1) "N" ["pnphi"]=> string(1) "N" ["pntipikor"]=> string(1) "N" ["pnsort"]=> string(1) "5" ["pnkode"]=> string(6) "H - 05" ["pnhakim"]=> string(2) "34" ["emailpn"]=> string(21) "mail@pn-kisaran.go.id" } }


  	*/
  		if(empty($out)){

  				return $array = array('status' => '0','msg'=>'Data SK pada Group kosong');
  		}else{
	  		
  			   //var_dump($out);
  			   $now = new DateTime();
  		     $update_date= $now->format('Y-m-d H:i:s'); 
  		     $no=1; foreach ($out as $hasil): 
  	  	   $no++;
  			   $pdk='';
  			   $pdk= $hasil['pddkan2'];
  			/*if(!empty($pdk)){


  			}else{
  				$pdk= $hasil['pddkan1'];
  			}
  				$data = array('id' => '',
  							'skpangkatnoid'=>$hasil['no_idx'],
  							'skpangkatindx'=>$hasil['no_urt'],
  							'nip'=>$hasil['nipnmrc'],
  							'nama'=>$hasil['namadrp'],
  							'tempat_lahir'=>$hasil['tptlhr'],
  							'tgl_lahir'=>$hasil['tgllhr'],
  							'sknmrpertek'=>$hasil['no_pertek'],
  							'sktglpertek'=>$hasil['tgl_pertek'],
  							'sknomor'=>$hasil['no_sk'] ,
  							'sktgl'=>$hasil['tgl_sk'],
  							'sknomor'=>'123' ,
                'sktgl'=>'2020-10-01',
                'gol_baru'=>$hasil['gol_baru'],
  							'tmt_gol_baru'=>$hasil['tmt_gol_baru'],
  							'mk_tahun'=>$hasil['mk_th_baru'],
  							'mk_bulan'=>$hasil['mk_bl_baru'],
  							'tmt_gol_lama'=>$hasil['tmt_gol_lama'],
  							'gol_lama'=>$hasil['gol_lama'],
  							'pt'=>$hasil['ptnama'],
  							'pn'=>$hasil['pnnama'],
  							'jabatan'=>$hasil['jabatan'],
  							'pendidikan'=>$pdk,
  							'gaji'=>$hasil['gaji_baru'],
  							'tunjangan'=>'',
  							'qrcode'=>$hasil['kode_barcode'],
  							'id_stage'=>$stage[0]['start_stage'],
  							'id_status'=>'7',
  							'updated_date'=>$update_date,
  							'updated_user_id'=>$this->session->userdata('userid'),
  							'keterangan'=>'syncronized',
  							'file_loc'=>''
  						);
  				// insert kedalam data table tbl_skkp_panitera_data
  				$this->db->insert($table,$data);
*/
               try {
                    if(!empty($pdk)){


        }else{
          $pdk= $hasil['pddkan1'];
        }
          $data = array('id' => '',
                'skpangkatnoid'=>$hasil['no_idx'],
                'skpangkatindx'=>$hasil['no_urt'],
                'nip'=>$hasil['nipnmrc'],
                'nama'=>$hasil['namadrp'],
                'tempat_lahir'=>$hasil['tptlhr'],
                'tgl_lahir'=>$hasil['tgllhr'],
                'sknmrpertek'=>$hasil['no_pertek'],
                'sktglpertek'=>$hasil['tgl_pertek'],
               /* 'sknomor'=>$hasil['no_sk'] ,
                'sktgl'=>$hasil['tgl_sk'],
                'gol_baru'=>$hasil['gol_baru'],
                'tmt_gol_baru'=>$hasil['tmt_gol_baru'],
                'mk_tahun'=>$hasil['mk_th_baru'],
                'mk_bulan'=>$hasil['mk_bl_baru'],
                'tmt_gol_lama'=>$hasil['tmt_gol_lama'],
                'gol_lama'=>$hasil['gol_lama'],
                */'sknomor'=>'123',
                'sktgl'=>'2020-10-01',
                'gol_baru'=>'III/c',
                'tmt_gol_baru'=>'2020-10-01',
                'mk_tahun'=>'10',
                'mk_bulan'=>'1',
                'tmt_gol_lama'=>'2016-10-01',
                'gol_lama'=>'III/b',
                'pt'=>$hasil['ptnama'],
                'pn'=>$hasil['pnnama'],
                'jabatan'=>$hasil['jabatan'],
                'pendidikan'=>$pdk,
                'gaji'=>$hasil['gaji_baru'],
                'tunjangan'=>'',
                'qrcode'=>$hasil['kode_barcode'],
                'id_stage'=>$stage[0]['start_stage'],
                'id_status'=>'7',
                'updated_date'=>$update_date,
                'updated_user_id'=>$this->session->userdata('userid'),
                'keterangan'=>'syncronized',
                'file_loc'=>''
              );
          try{

               // insert kedalam data table tbl_skkp_panitera_data
                        $this->db->insert($table,$data);

                        $this->PDF_model->generateSKKPPanitera($data, 'kpo');         
                       $datahistory = array('id_history' =>'' ,'id_group'=>$hasil['no_idx'],'id_skkp'=>$hasil['no_urt'],'id_stage'=>$stage[0]['start_stage'],'id_status'=>'7','tgl'=>$update_date, 'keterangan'=>'syncronized' );
                        $this->insertHistory($datahistory);
          }catch(Exception $e){

              echo 'Received exception : ',  $e->getMessage(), "\n";
                         $where = array('skpangkatnoid' => $data['no_idx']);
                          $where_hst = array('id_group' => $data['no_idx']);
                          $where_group = array('skpangkatnoid' => $data['no_idx']);
              
                          $this->deleteData($where,'tbl_skkpo_panitera_data');
                          $this->deleteData($where_hst,'tbl_skkpo_panitera_history');
                          $this->deleteData($where_group,'tbl_skkpo_panitera');
              
                          return $array = array('status' => '0','msg'=>'Data SK pada Group tidak lengkap, cek kembali kelengkapan data');

          }
                        

                 // to the controller
                } catch  (Exception $e) {
                    
                        echo 'Received exception : ',  $e->getMessage(), "\n";
               
                } 
  				// insert kedalam data history sk tbl_skkp_panitera_history
  			/*	if($this->db->affected_rows() > 0) {
				  // Code here after successful insert
				  	$this->PDF_model->generateSKKPPanitera($data);         
  					$datahistory = array('id_history' =>'' ,'id_group'=>$hasil['no_idx'],'id_skkp'=>$hasil['no_urt'],'id_stage'=>$stage[0]['start_stage'],'id_status'=>'7','tgl'=>$update_date, 'keterangan'=>'syncronized' );
  					$this->insertHistory($datahistory);
  					 // to the controller
              //}
				}else{

					$where = array('skpangkatnoid' => $data['no_idx']);
					$where_hst = array('id_group' => $data['no_idx']);
					$where_group = array('skpangkatnoid' => $data['no_idx']);
					
					$this->deleteData($where,'tbl_skkpo_panitera_data');
					$this->deleteData($where_hst,'tbl_skkpo_panitera_history');
					$this->deleteData($where_group,'tbl_skkpo_panitera');
					
					return $array = array('status' => '0','msg'=>'Data SK pada Group tidak lengkap, cek kembali kelengkapan data');
				}*/
  				
  				endforeach;

  				//var_dump($out); 
  				return $data;
        }
  		}

  
 
function deleteData($where, $table){

	$this->db->delete($table, $where); 
}

//function getDataMonitoring
function getDataAllSync(){
      //$table =$db2->list_tables();
      $this->db->select('*');
      $this->db->from('tbl_skkpo_panitera_data');
      $this->db->join('tbl_user', 'tbl_user.user_id=tbl_skkpo_panitera_data.updated_user_id');
      $this->db->join('tbl_ref_status', 'tbl_ref_status.id_status=tbl_skkpo_panitera_data.id_status');
      $this->db->join('tbl_ref_stage', 'tbl_ref_stage.id_stage=tbl_skkpo_panitera_data.id_stage');
    
      $query= $this->db->get();
      return $query->result_array();

}
  function getListDataSK($where){

		$db2 = $this->load->database('panitera', TRUE);
		

		//var_dump($where);
		    $db2->select('*');
			$db2->from('sk_kpo_2020');
			$db2->join('datapegawai', 'sk_kpo_2020.no_peg = datapegawai.nomor');
			$db2->join('tbdatapt', 'datapegawai.nomorpt = tbdatapt.ptnoid');
			$db2->join('tbdatapn', 'datapegawai.nomorpn = tbdatapn.pnnoid');
			$db2->where($where);
		    $query2 = $db2->get();
			return $query2->result_array();

		
}
function getCountListDataSK($where){

		$db2 = $this->load->database('panitera', TRUE);
		

		//var_dump($where);
		    $db2->select('COUNT(no_idx)');
			$db2->from('sk_kpo_2020');
			//$db2->join('datapegawai', 'sk_kpo_2020.no_peg = datapegawai.nomor');
			$db2->where($where);
			// $this->db->group_by('no_idx');
		    $query2 = $db2->get();
			return $query2->result_array();

		}

    function insertHistory($data){
    $this->db->insert('tbl_skkp_panitera_history',$data);
  }
function getHistory($where){

    $this->db->select('*');
    $this->db->from('tbl_skkpo_panitera_history');
    $this->db->join('tbl_ref_status','tbl_skkpo_panitera_history.id_status=tbl_ref_status.id_status');

    $this->db->join('tbl_ref_stage','tbl_skkpo_panitera_history.id_stage=tbl_ref_stage.id_stage');
    $this->db->where($where);
    $query= $this->db->get();
    return $query->result_array();
      
  }
 function getDataSKSync($where){
      //$table =$db2->list_tables();
      $this->db->select('*');
      $this->db->from('tbl_skkpo_panitera_data');
      $this->db->join('tbl_user', 'tbl_user.user_id=tbl_skkpo_panitera_data.updated_user_id');
      $this->db->join('tbl_ref_status', 'tbl_ref_status.id_status=tbl_skkpo_panitera_data.id_status');
      $this->db->where($where);
    $query= $this->db->get();
      //var_dump($query->result()) ;
    //var_dump($query->result_array());
    return $query->result_array();
}
function update_data($table, $data, $where){
  $this->db->where($where);
  $this->db->update($table, $data);
}

}


?>