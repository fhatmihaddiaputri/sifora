<?php  
/**
 * 
 */
class SKMutasi_Hakim_PN_model extends CI_Model
{

	function getData(){
		$db2 = $this->load->database('hakim', TRUE);
		$table =$db2->list_tables();
		$db2->select('*');
		$db2->from('mutasijns01mst');
		$query = $db2->get();
		return $query->result_array();

	}

	function getKhusus($id_pn){
		$db2 = $this->load->database('hakim', TRUE);
		$where = array('pnnoid' => $id_pn );
		$db2->select('*');
		$db2->from('tbpnkhusus');
		$db2->where($where);
		$query = $db2->get();
		$khusus=  $query->result_array();
		/*
		 [0]=>
		  array(5) {
		    ["pnkhusus"]=>
		    string(7) "Tipikor"
		    ["pnnoid"]=>
		    string(3) "349"
		    ["pnurut"]=>
		    string(1) "3"
		    ["createdate"]=>
		    string(23) "2020-02-03 14:57:20.217"
		    ["createnoid"]=>
		    string(1) "1"
		  }
		  [1]=>
		  array(5) {
		    ["pnkhusus"]=>
		    string(3) "PHI"
		    ["pnnoid"]=>
		    string(3) "349"
		    ["pnurut"]=>
		    string(2) "30"
		    ["createdate"]=>
		    string(23) "2020-11-09 11:18:45.029"
		    ["createnoid"]=>
		    string(1) "1"
		  }
		  */
		  $num = count($khusus);
		  $text = '';
		  for($i=0;$i<$num;$i++){
		  	if($khusus[$i]['pnkhusus']==='Tipikor'){
		  		$text= $text.'Tindak Pidana Korupsi';
		  	}elseif($khusus[$i]['pnkhusus']==='PHI'){
		  		$text= $text.'Hubungan Industrial';
		  	}elseif($khusus[$i]['pnkhusus']==='Perikanan'){
		  		$text= $text.'Perikanan';
		  	}elseif($khusus[$i]['pnkhusus']==='Niaga'){
		  		$text= $text.'Niaga';
		  	}else{

		  	}
		  	//echo $khs[0]['pnkusus'];
		  	//$text = $text.$khusus[$i]['pnkhusus'];
		  	$j= $i+1;
		  	if($j<$num){
		  			$text= $text.'/';
		  	
		  		
		  	}
		  }
		  echo $text;
		  return $text;
	}
	function getListDataSK($where){

		$db2 = $this->load->database('hakim', TRUE);

		    $db2->select("mutasijns01dtl.mutasinoid,
				  mutasijns01dtl.mutasiindx,
				  mutasijns01dtl.mutasiurut,
				  mutasijns01dtl.mutasipegw,
				  mutasijns01dtl.mutasigolr,
				  mutasijns01dtl.mutasidari,
				  mutasijns01dtl.mutasituju,
				  mutasijns01dtl.lamachecked,
				  mutasijns01dtl.baruchecked,
				  
				  mutasijns01dtl.mutasitunj,
				  mutasijns01dtl.mutasicatat,
				  datapegawai.nama,
				  datapegawai.nip,
				  mutasijns01dtl.mutasigolr as namagol,
				  
				  golongan.nmgolrelasi as golrelasi,
				  golongan.kepangkatan as pangkat,
				  
				  pndr.pnnama as pnlama,
				  pnke.pnnama as pnbaru,
				 
				 
				 
				  upper(pndr.pnkelas) as drtingkat,
				  upper(pnke.pnkelas) as ketingkat,

				  mutasijns01dtl.lamaoptions,
				  mutasijns01dtl.baruoptions,

				  mutasijns01dtl.createdate,
				  buat.nama pembuat,
				  mutasijns01dtl.updatedate,
				  ubah.nama pengubah,
				  mutasijns01dtl.createnoid,
				  mutasijns01dtl.updatenoid,
				  mutasijns01dtl.mutasigrup,
				  
				  pndr.pnkppn as kppnpnlama,
				  pndr.pnnoid as idpnlama,
				  ptdr.ptnama as ptlama,
				  pnke.pnkppn as kppnpnbaru,
				  pnke.pnnoid as idpnbaru,
				  ptke.ptnama as ptbaru
				  ");
			$db2->from('mutasijns01dtl');
			
			$db2->join('tbdatapn as pndr', 'mutasijns01dtl.mutasidari = pndr.pnnoid', 'left outer');
			$db2->join('tbdatapn as pnke', 'mutasijns01dtl.mutasituju = pnke.pnnoid', 'left outer');
			
			$db2->join('tbdatapt as ptke', 'ptke.ptnoid = pnke.ptnoid', 'left outer');
			$db2->join('golongan', 'lower(mutasijns01dtl.mutasigolr) = lower(golongan.namagol)', 'left outer');
			$db2->join('pengguna as buat', 'mutasijns01dtl.createnoid = buat.noid', 'left outer');
			$db2->join('tbdatapt as ptdr', 'ptdr.ptnoid = pndr.ptnoid', 'left outer');
			
			$db2->join('pengguna as ubah', 'mutasijns01dtl.updatenoid = ubah.noid', 'left outer');
			$db2->join('datapegawai', 'mutasijns01dtl.mutasipegw = datapegawai.nomor', 'left outer');

			//$db2->join('pengguna as pkyes', 'mutasijns02dtl.pkyn_noid = pkyes.noid', 'left outer');
			$db2->where($where);
			$db2->order_by("mutasijns01dtl.mutasiurut", "asc");
		    $query2 = $db2->get();
		    $db2->last_query();

			$data = $query2->result_array();
			//var_dump($data);
			return $data;

		}



	function getWhere($where){

		$db2 = $this->load->database('hakim', TRUE);
		//$table =$db2->list_tables();
		$query= $db2->get_where('mutasijns01mst', $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
		//return  $query->num_rows();
	}

	function getCountListDataSK($where){

		$db2 = $this->load->database('hakim', TRUE);
		

		//var_dump($where);
		    $db2->select('COUNT(mutasinoid)');
			$db2->from('mutasijns02dtl');
			//$db2->join('datapegawai', 'sk_kpo_2020.no_peg = datapegawai.nomor');
			$db2->where($where);
			// $this->db->group_by('no_idx');
		    $query2 = $db2->get();
			return $query2->result_array();

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

function getWhereDBSync($where, $table){

		//$table =$db2->list_tables();
		$query= $this->db->get_where($table, $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
	}
	 function addData($data, $table){
  	//var_dump($data);
  	$where = array('skmutasinoid' => $data['skmutasinoid'] );
  			
  		$result = $this->getWhereDBSync($where, $table);
  		
  		
  		if(empty($result)){
  			
  			$this->db->insert($table,$data);
  		}else{
		
			$this->db->where($where);
  			$this->db->update($table,$data);
  			//var_dump($result); 
  			
  		}
  	}

  	

  	function addDataSK( $table, $where, $stage){
  	$this->load->model('PDF_model');
  		// matikan dulu 
  	$out = $this->getListDataSK($where);
  	var_dump($out);

  	/*
		
[0]=>
  array(33) {
    ["mutasinoid"]=>
    string(2) "11"
    ["mutasiindx"]=>
    string(1) "1"
    ["mutasiurut"]=>
    string(1) "1"
    ["mutasipegw"]=>
    string(4) "4548"
    ["mutasigolr"]=>
    string(5) "III/a"
    ["mutasidari"]=>
    string(3) "325"
    ["mutasituju"]=>
    string(3) "322"
    ["lamachecked"]=>
    string(1) "N"
    ["baruchecked"]=>
    string(1) "N"
    ["mutasitunj"]=>
    string(7) "8500000"
    ["mutasicatat"]=>
    NULL
    ["nama"]=>
    string(32) "TEGUH UJANG FIRDAUS BURENI, S.H."
    ["nip"]=>
    string(21) "19930517 201712 1 002"
    ["namagol"]=>
    string(5) "III/a"
    ["golrelasi"]=>
    string(13) "Hakim Pratama"
    ["pangkat"]=>
    string(11) "Penata Muda"
    ["pnlama"]=>
    string(9) "Larantuka"
    ["pnbaru"]=>
    string(6) "Bajawa"
    ["drtingkat"]=>
    string(2) "II"
    ["ketingkat"]=>
    string(2) "II"
    ["lamaoptions"]=>
    string(5) "Hakim"
    ["baruoptions"]=>
    string(5) "Hakim"
    ["createdate"]=>
    string(23) "2021-06-22 19:05:11.576"
    ["pembuat"]=>
    string(5) "Putri"
    ["updatedate"]=>
    string(23) "2021-06-22 19:07:50.891"
    ["pengubah"]=>
    string(5) "Putri"
    ["createnoid"]=>
    string(2) "12"
    ["updatenoid"]=>
    string(2) "12"
    ["mutasigrup"]=>
    string(1) "1"
    ["kppnpnlama"]=>
    string(9) "Larantuka"
    ["ptlama"]=>
    string(6) "Kupang"
    ["kppnpnbaru"]=>
    string(6) "Ruteng"
    ["ptbaru"]=>
    string(6) "Kupang"
  }
  	*/

		
  		if(empty($out)){

  				echo "data sk pada group kosong";
  		}else{
	  		
			//var_dump($out);


		$now = new DateTime();
	    $update_date= $now->format('Y-m-d H:i:s'); 
	    $no=1; foreach ($out as $hasil): 
  			$no++;
  				$pnkhususlama=$this->getKhusus($hasil['idpnlama']).' ';
  				$pnkhususbaru=$this->getKhusus($hasil['idpnbaru']).' ';
  				//var_dump($pnkhususlama);
  				//var_dump($pnkhususbaru);

  			/*$pnlama='-';
  			$kppnlama = $hasil['kppnpnlama'];
  			$jablama='';
  			$ptlama = $hasil['ptlama'];
  			$jablama=$hasil['lamaoptions'];
  			if($hasil['lamachecked']==='N'){
				$pnlama=$hasil['pnlama'];
				

			}else{

				$pnlama= $hasil['pnlama'];
				if($hasil['mutasidari']==='0'){
					$kppnpnlama='Jakarta';
					
				}else{
					$kppnlama= $hasil['kppnpnlama'];
					
				}

				
			}
			$pnbaru='';
			$jabbaru='';
			$kppnbaru='';
			$ptbaru=$hasil['ptbaru'];
			if($hasil['baruchecked']==='N'){
				$pnbaru=$hasil['pnbaru'];
				$jabbaru=$hasil['baruoptions'];
				$kppnbaru= $hasil['kppnpnbaru'];

			}else{
				$pnbaru=$hasil['pnbaru'];
				$jabbaru=$hasil['baruoptions'];
				if($hasil['mutasituju']==='0'){
					$kppnpnbaru='Jakarta';
				}else{
					$kppnbaru= $hasil['kppnpnbaru'];

				}
				
			}

			*/
			

			$data = array('id' => '',
					'id_group_sk'=>$hasil['mutasinoid'],
					'id_sk'=>$hasil['mutasiindx'],
					'no_urut'=>$hasil['mutasiurut'],
					'kelas_lama'=>$hasil['drtingkat'],
					'nip'=>$hasil['nip'],
					'nama'=>$hasil['nama'],
					'jabatan_lama'=>$hasil['lamaoptions'],
					'pt_lama'=>$hasil['ptlama'],
					'pn_lama'=>$hasil['pnlama'] ,
					'jabatan_baru'=>$hasil['baruoptions'],
					'pt_baru'=>$hasil['ptbaru'],
					'pnkhususlama'=>$pnkhususlama,
					'pnkhususbaru'=>$pnkhususbaru,
					'pn_baru'=>$hasil['pnbaru'],
					'tunjangan'=>$hasil['mutasitunj'],
					'pangkat'=>$hasil['pangkat'],
					'gol_relasi'=>$hasil['golrelasi'],
					'gol'=>$hasil['mutasigolr'],
					'kelas_baru'=>$hasil['ketingkat'],
					'kppn_lama'=>$hasil['kppnpnlama'],
					'kppn_baru'=>$hasil['kppnpnbaru'],
					'id_stage'=>$this->session->userdata('start_stage'),
					'id_status'=>'7',
					'keterangan'=>'syncronized',
					'file_loc_petikan'=>'',
					'file_loc_salinan'=>'',
					'updated_user_id'=>$this->session->userdata('userid'),
					'updated_date'=>$update_date
				);
  				// insert kedalam data table tbl_skkp_panitera_data
  				$this->db->insert($table,$data);
  				// insert kedalam data history sk tbl_skkp_panitera_history

  				//$this->PDF_model->generateSKMutasiPanitera($data, 'mutasi');         
  				$datahistory = array('id_history' =>'' ,'id_group'=>$hasil['mutasinoid'],'id_sk'=>$hasil['mutasiindx'],'id_stage'=>$stage[0]['start_stage'],'id_status'=>'7','tgl'=>$update_date, 'keterangan'=>'syncronized' );
  				$this->insertHistory($datahistory);
  				
  				endforeach;
  				return $data;
  		}

  }
	function insertHistory($data){
			$this->db->insert('tbl_skmutasi_hakim_pn_history',$data);
	}

	function getHistory($where){

		$this->db->select('*');
		$this->db->from('tbl_skmutasi_hakim_pn_history');
		$this->db->join('tbl_ref_status','tbl_skmutasi_hakim_pn_history.id_status=tbl_ref_status.id_status');

		$this->db->join('tbl_ref_stage','tbl_skmutasi_hakim_pn_history.id_stage=tbl_ref_stage.id_stage');
		$this->db->where($where);
		$query= $this->db->get();
		return $query->result_array();
			
	}

	 function getDataSKSync($where){
  		$this->db->select('*');
  		$this->db->from('tbl_skmutasi_hakim_pn_data');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skmutasi_hakim_pn_data.updated_user_id');
  		$this->db->join('tbl_ref_status', 'tbl_ref_status.id_status=tbl_skmutasi_hakim_pn_data.id_status');
  		$this->db->where($where);
		$query= $this->db->get();
		return $query->result_array();
  }
   function getDataGroupSKSync(){
  		$this->db->select('*');
  		$this->db->from('tbl_skmutasi_hakim_pn');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skmutasi_hakim_pn.updated_user_id');
  		$query= $this->db->get();
		return $query->result_array();
  }

  function uploadLampiran($where,$table, $data){

  	
  	$this->db->where($where);
  	$this->db->update($table,$data);
  }
  function uploadSK($where,$table, $data){

  	
  	$this->db->where($where);
  	$this->db->update($table,$data);
  }


  function update_data($table, $data, $where){
	$this->db->where($where);
	$this->db->update($table, $data);
}

}