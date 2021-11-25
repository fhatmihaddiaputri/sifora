<?php  
/**
 * 
 */
class SKMutasi_Panitera_model extends CI_Model
{

	function getData(){
		$db2 = $this->load->database('panitera', TRUE);
		$table =$db2->list_tables();
		$db2->select('*');
		$db2->from('mutasijns02mst');
		$query = $db2->get();
		return $query->result_array();

	}
	function getListDataSK($where){

		$db2 = $this->load->database('panitera', TRUE);

		    $db2->select("mutasijns02dtl.mutasinoid,
				  mutasijns02dtl.mutasiindx,
				  mutasijns02dtl.mutasiurut,
				  mutasijns02dtl.mutasipegw,
				  mutasijns02dtl.mutasigolr,
				  mutasijns02dtl.mutasidrtp,
				  mutasijns02dtl.mutasidrpt,
				  mutasijns02dtl.mutasidrpn,
				  mutasijns02dtl.mutasitjtp,
				  mutasijns02dtl.mutasitjpt,
				  mutasijns02dtl.mutasitjpn,
				  mutasijns02dtl.mutasitunj,
				  mutasijns02dtl.kosongljr07,
				  mutasijns02dtl.mutasicatat,
				  datapegawai.nama,
				  datapegawai.nip,
				  mutasijns02dtl.mutasigolr as namagol,
				  golongan.kepangkatan,
				  cast(case upper(coalesce(mutasijns02dtl.mutasidrtp, 'N')) when 'T' then 'PT '||upper(ptdr.ptnama)
				  else 'PN '||upper(pndr.pnnama)
				  end as varchar(120)) as drnama,
				  cast(case upper(coalesce(mutasijns02dtl.mutasidrtp,'N'))
				  when 'T' then upper(ptdr.ptkelas)
				  else upper(pndr.pnkelas)
				  end as varchar(20)) as drtingkat,

				  mutasijns02dtl.mutasidrjb,
				  mutasijns02dtl.mutasitjjb,

				  cast(case upper(coalesce(mutasijns02dtl.mutasitjtp,'N'))
				  when 'T' then 'PT '||upper(ptke.ptnama)
				  else 'PN '||upper(pnke.pnnama)
				  end as varchar(120)) as kenama,

				  cast(case upper(coalesce(mutasijns02dtl.mutasitjtp,'N'))
				  when 'T' then upper(ptke.ptkelas)
				  else upper(pnke.pnkelas)
				  end as varchar(20)) as ketingkat,

				  mutasijns02dtl.sdhdicheckfl,
				  mutasijns02dtl.biayanegara,

				  mutasijns02dtl.pkyn_flag,
				  mutasijns02dtl.pkyn_date,
				  pkyes.nama yangnamapk,

				  mutasijns02dtl.createdate,
				  buat.nama pembuat,
				  mutasijns02dtl.updatedate,
				  ubah.nama pengubah,
				  mutasijns02dtl.createnoid,
				  mutasijns02dtl.updatenoid,
				  mutasijns02dtl.mutasigrup,
				  jabbaru.jabatnm as jabbaru,
				  jablama.jabatnm as jablama,
				  ptdr.ptnama as ptlama,
				  ptke.ptnama as ptbaru,
				  pndr.pnnama as pnlama,
				  pnke.pnnama as pnbaru,
				  ptdr.ptkppn as kppnptlama,
				  ptke.ptkppn as kppnptbaru,
				  pndr.pnkppn as kppnpnlama,
				  pnke.pnkppn as kppnpnbaru
				  ");
			$db2->from('mutasijns02dtl');
			/*$db2->join('tbdatapt as a', 'mutasijns02dtl.mutasitjpt = a.ptnoid');
			$db2->join('tbdatapn as b', 'mutasijns02dtl.mutasitjpn = b.pnnoid');
			$db2->join('tbdatapt as c', 'mutasijns02dtl.mutasidrpt = c.ptnoid');
			$db2->join('tbdatapn as d', 'mutasijns02dtl.mutasidrpn = d.pnnoid');
			$db2->join('jabatan as h', 'mutasijns02dtl.mutasidrjb = h.jabatkd');
			$db2->join('golongan as j', 'lower(mutasijns02dtl.mutasigolr) = lower(j.namagol)');

			$db2->join('jabatan as i', 'mutasijns02dtl.mutasitjjb = i.jabatkd');
			$db2->join('datapegawai as g', 'mutasijns02dtl.mutasipegw = g.nomor');
			*/
			$db2->join('tbdatapt as ptdr', 'mutasijns02dtl.mutasidrpt = ptdr.ptnoid', 'left outer');
			$db2->join('tbdatapn as pndr', 'mutasijns02dtl.mutasidrpn = pndr.pnnoid', 'left outer');
			$db2->join('tbdatapt as ptke', 'mutasijns02dtl.mutasitjpt = ptke.ptnoid', 'left outer');
			$db2->join('tbdatapn as pnke', 'mutasijns02dtl.mutasitjpn = pnke.pnnoid', 'left outer');
			$db2->join('golongan', 'lower(mutasijns02dtl.mutasigolr) = lower(golongan.namagol)', 'left outer');
			$db2->join('pengguna as buat', 'mutasijns02dtl.createnoid = buat.noid', 'left outer');
			$db2->join('jabatan as jablama', 'mutasijns02dtl.mutasidrjb = jablama.jabatkd', 'left outer');
			
			$db2->join('jabatan as jabbaru', 'mutasijns02dtl.mutasitjjb = jabbaru.jabatkd', 'left outer');
			
			$db2->join('pengguna as ubah', 'mutasijns02dtl.updatenoid = ubah.noid', 'left outer');
			$db2->join('datapegawai', 'mutasijns02dtl.mutasipegw = datapegawai.nomor', 'left outer');

			$db2->join('pengguna as pkyes', 'mutasijns02dtl.pkyn_noid = pkyes.noid', 'left outer');
			$db2->where($where);
			$db2->order_by("mutasijns02dtl.mutasiurut", "asc");
		    $query2 = $db2->get();
		    $db2->last_query();

			$data = $query2->result_array();
			//var_dump($data);
			return $data;

		}



	function getWhere($where){

		$db2 = $this->load->database('panitera', TRUE);
		//$table =$db2->list_tables();
		$query= $db2->get_where('mutasijns02mst', $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
		//return  $query->num_rows();
	}

	function getCountListDataSK($where){

		$db2 = $this->load->database('panitera', TRUE);
		

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
  	//var_dump($out);

		
  		if(empty($out)){

  				echo "data sk pada group kosong";
  		}else{
	  		
			//var_dump($out);
		$now = new DateTime();
	    $update_date= $now->format('Y-m-d H:i:s'); 
	    $no=1; foreach ($out as $hasil): 
  			$no++;
  			$pnlama='-';
  			$kppnlama = $hasil['kppnptlama'];
  			$pnbaru='-';
			$kppnbaru= $hasil['kppnptbaru'];
			if($hasil['mutasidrtp']==='N'){
				$pnlama=$hasil['pnlama'];
				$kppnlama= $hasil ['kppnpnlama'];

			}
			if($hasil['mutasitjtp']==='N'){
				$pnbaru=$hasil['pnbaru'];
				$kppnbaru= $hasil['kppnpnbaru'];
			}

			/* { [0]=> array(42) { ["mutasinoid"]=> string(2) "10" ["mutasiindx"]=> string(1) "3" ["mutasiurut"]=> string(1) "3" ["mutasipegw"]=> string(3) "707" ["mutasigolr"]=> string(5) "III/d" ["mutasidrtp"]=> string(1) "N" ["mutasidrpt"]=> string(2) "11" ["mutasidrpn"]=> string(3) "111" ["mutasitjtp"]=> string(1) "N" ["mutasitjpt"]=> string(2) "10" ["mutasitjpn"]=> string(3) "107" ["mutasitunj"]=> string(6) "360000" ["kosongljr07"]=> string(1) "N" ["mutasicatat"]=> NULL ["nama"]=> string(21) "ABDUL SHOMAD, SH., MH" ["nip"]=> string(21) "19750918 199903 1 005" ["namagol"]=> string(5) "III/d" ["kepangkatan"]=> string(12) "Penata Tk. I" ["drnama"]=> string(16) "PN JAKARTA PUSAT" ["drtingkat"]=> string(5) "I.A.K" ["mutasidrjb"]=> string(2) "PP" ["mutasitjjb"]=> string(2) "PP" ["kenama"]=> string(9) "PN SERANG" ["ketingkat"]=> string(3) "I.A" ["sdhdicheckfl"]=> string(1) "Y" ["biayanegara"]=> string(1) "Y" ["pkyn_flag"]=> string(1) "N" ["pkyn_date"]=> NULL ["yangnamapk"]=> NULL ["createdate"]=> string(23) "2019-07-04 15:16:37.472" ["pembuat"]=> string(3) "Tri" ["updatedate"]=> string(23) "2019-07-12 15:52:09.482" ["pengubah"]=> string(5) "Puput" ["createnoid"]=> string(2) "18" ["updatenoid"]=> string(1) "6" ["mutasigrup"]=> string(1) "1" ["jabbaru"]=> string(18) "Panitera Pengganti" ["jablama"]=> string(18) "Panitera Pengganti" ["ptlama"]=> string(7) "Jakarta" ["ptbaru"]=> string(6) "Banten" ["pnlama"]=> string(13) "Jakarta Pusat" ["pnbaru"]=> string(6) "Serang" } */
			$data = array('id' => '',
					'id_group_sk'=>$hasil['mutasinoid'],
					'id_sk'=>$hasil['mutasiindx'],
					'no_urut'=>$hasil['mutasiurut'],
					'kelas_lama'=>$hasil['drtingkat'],
					'nip'=>$hasil['nip'],
					'nama'=>$hasil['nama'],
					'jabatan_lama'=>$hasil['jablama'],
					//'jabatan_lama'=>'STAF',
					'pt_lama'=>$hasil['ptlama'],
					'pn_lama'=>$pnlama ,
					'jabatan_baru'=>$hasil['jabbaru'],
					'pt_baru'=>$hasil['ptbaru'],
					'pn_baru'=>$pnbaru,
					'tunjangan'=>$hasil['mutasitunj'],
					'pangkat'=>$hasil['kepangkatan'],
					'gol'=>$hasil['mutasigolr'],
					'kelas_baru'=>$hasil['ketingkat'],
					'kppn_lama'=>$kppnlama,
					'kppn_baru'=>$kppnbaru,
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
  				//var_dump($out); 
  				return $data;
  		}

  }
	function insertHistory($data){
			$this->db->insert('tbl_skmutasi_panitera_history',$data);
	}

	function getHistory($where){

		$this->db->select('*');
		$this->db->from('tbl_skmutasi_panitera_history');
		$this->db->join('tbl_ref_status','tbl_skmutasi_panitera_history.id_status=tbl_ref_status.id_status');

		$this->db->join('tbl_ref_stage','tbl_skmutasi_panitera_history.id_stage=tbl_ref_stage.id_stage');
		$this->db->where($where);
		$query= $this->db->get();
		return $query->result_array();
			
	}

	 function getDataSKSync($where){
  		$this->db->select('*');
  		$this->db->from('tbl_skmutasi_panitera_data');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skmutasi_panitera_data.updated_user_id');
  		$this->db->join('tbl_ref_status', 'tbl_ref_status.id_status=tbl_skmutasi_panitera_data.id_status');
  		$this->db->where($where);
		$query= $this->db->get();
		return $query->result_array();
  }
   function getDataGroupSKSync(){
  		$this->db->select('*');
  		$this->db->from('tbl_skmutasi_panitera');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skmutasi_panitera.updated_user_id');
  		$this->db->join('tbl_ref_jenis_sk_mutasi_panitera', 'tbl_ref_jenis_sk_mutasi_panitera.id_jenis=tbl_skmutasi_panitera.id_jenis', 'left outer');
  		$query= $this->db->get();
		return $query->result_array();
  }

  function uploadLampiran($where,$table, $data){

  	
  	$this->db->where($where);
  	$this->db->update($table,$data);
  }

  function update_data($table, $data, $where){
	$this->db->where($where);
	$this->db->update($table, $data);
  }

	function getJenis(){
		$this->db->select('id_jenis, jenis');
	  		$this->db->from('tbl_ref_jenis_sk_mutasi_panitera');
	  		$query= $this->db->get();
			return $query->result_array();
	}

	function getTemplate($id_jenis){
		$where = array('id_jenis' =>$id_jenis );
		$this->db->select('*');
	  		$this->db->from('tbl_ref_jenis_sk_mutasi_panitera');
	  		$this->db->where($where);
			$query= $this->db->get();
	  		return $query->result_array();
	}

}