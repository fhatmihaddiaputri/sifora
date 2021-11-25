<?php  
/**
 * 
 */
class SKMutasi_Hakim_model extends CI_Model
{

	function getData(){
		$db2 = $this->load->database('hakim', TRUE);
		$table =$db2->list_tables();
		$db2->select('*');
		$db2->from('mutasijns02mst');
		$query = $db2->get();
		return $query->result_array();

	}
	function getListDataSK($where){

		$db2 = $this->load->database('hakim', TRUE);

		    $db2->select("mutasijns02dtl.mutasinoid,
				  mutasijns02dtl.mutasiindx,
				  mutasijns02dtl.mutasiurut,
				  mutasijns02dtl.mutasipegw,
				  mutasijns02dtl.mutasigolr,
				  mutasijns02dtl.mutasipnpt,
				  mutasijns02dtl.mutasiptno,
				  mutasijns02dtl.mutasipndr,
				  mutasijns02dtl.mutasiptke,
				  
				  mutasijns02dtl.mutasitunj,
				 mutasijns02dtl.mutasicatat,
				  datapegawai.nama,
				  datapegawai.nip,
				  mutasijns02dtl.mutasigolr as namagol,
				  
				  golongan.nmgolrelasi as golrelasi,
				  golongan.kepangkatan as pangkat,
				  cast(case upper(coalesce(mutasijns02dtl.mutasipnpt, 'N')) when 'T' then 'PT '||upper(ptdr.ptnama)
				  else 'Pengadilan Negeri '||upper(pndr.pnnama)
				  end as varchar(120)) as drnama,
				  cast(case upper(coalesce(mutasijns02dtl.mutasipnpt,'N'))
				  when 'T' then upper(ptdr.ptkelas)
				  else upper(pndr.pnkelas)
				  end as varchar(20)) as drtingkat,

				  mutasijns02dtl.lamaoptions,
				  mutasijns02dtl.baruoptions,

				  upper(ptke.ptkelas) as ketingkat,


				  mutasijns02dtl.createdate,
				  buat.nama pembuat,
				  mutasijns02dtl.updatedate,
				  ubah.nama pengubah,
				  mutasijns02dtl.createnoid,
				  mutasijns02dtl.updatenoid,
				  mutasijns02dtl.mutasigrup,
				  ptdr.ptnama as ptlama,
				  ptke.ptnama as ptbaru,
				  pndr.pnnama as pnlama,
				  ptdr.ptkppn as kppnptlama,
				  ptke.ptkppn as kppnptbaru,
				  pndr.pnkppn as kppnpnlama
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
			$db2->join('tbdatapt as ptdr', 'mutasijns02dtl.mutasiptno = ptdr.ptnoid', 'left outer');
			$db2->join('tbdatapn as pndr', 'mutasijns02dtl.mutasipndr = pndr.pnnoid', 'left outer');
			$db2->join('tbdatapt as ptke', 'mutasijns02dtl.mutasiptke = ptke.ptnoid', 'left outer');
			//$db2->join('tbdatapn as pnke', 'mutasijns02dtl.mutasitjpn = pnke.pnnoid', 'left outer');
			$db2->join('golongan', 'lower(mutasijns02dtl.mutasigolr) = lower(golongan.namagol)', 'left outer');
			$db2->join('pengguna as buat', 'mutasijns02dtl.createnoid = buat.noid', 'left outer');
			//$db2->join('jabatan as jablama', 'mutasijns02dtl.lamaoptions = jablama.jabatkd', 'left outer');
			
			//$db2->join('jabatan as jabbaru', 'mutasijns02dtl.mutasitjjb = jabbaru.jabatkd', 'left outer');
			
			$db2->join('pengguna as ubah', 'mutasijns02dtl.updatenoid = ubah.noid', 'left outer');
			$db2->join('datapegawai', 'mutasijns02dtl.mutasipegw = datapegawai.nomor', 'left outer');

			//$db2->join('pengguna as pkyes', 'mutasijns02dtl.pkyn_noid = pkyes.noid', 'left outer');
			$db2->where($where);
			$db2->order_by("mutasijns02dtl.mutasiurut", "asc");
		    $query2 = $db2->get();
		    $db2->last_query();

			$data = $query2->result_array();
			//var_dump($data);
			return $data;

		}



	function getWhere($where){

		$db2 = $this->load->database('hakim', TRUE);
		//$table =$db2->list_tables();
		$query= $db2->get_where('mutasijns02mst', $where);
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

  	//syn7array(11) { [0]=> array(33) { ["mutasinoid"]=> string(1) "7" ["mutasiindx"]=> string(2) "16" ["mutasiurut"]=> string(1) "1" ["mutasipegw"]=> string(4) "3570" ["mutasigolr"]=> string(4) "IV/e" ["mutasipnpt"]=> string(1) "T" ["mutasiptno"]=> string(2) "26" ["mutasipndr"]=> string(1) "0" ["mutasiptke"]=> string(2) "27" ["mutasitunj"]=> string(8) "40200000" ["mutasicatat"]=> NULL ["nama"]=> string(27) "Dr. H. ALI MAKKI, S.H., M.H" ["nip"]=> string(21) "19590410 198512 1 001" ["namagol"]=> string(4) "IV/e" ["kepangkatan"]=> string(13) "Pembina Utama" ["drnama"]=> string(10) "PT MATARAM" ["drtingkat"]=> string(1) "B" ["lamaoptions"]=> string(11) "Wakil Ketua" ["baruoptions"]=> string(5) "Ketua" ["ketingkat"]=> string(1) "B" ["createdate"]=> string(23) "2020-11-23 16:42:38.901" ["pembuat"]=> string(4) "Irma" ["updatedate"]=> string(23) "2020-11-23 16:43:03.154" ["pengubah"]=> string(4) "Irma" ["createnoid"]=> string(1) "5" ["updatenoid"]=> string(1) "5" ["mutasigrup"]=> string(1) "1" ["ptlama"]=> string(7) "Mataram" ["ptbaru"]=> string(6) "Kupang" ["pnlama"]=> NULL ["kppnptlama"]=> string(7) "Mataram" ["kppnptbaru"]=> string(6) "Kupang" ["kppnpnlama"]=> NULL }

		
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
			if($hasil['mutasipnpt']==='N'){
				$pnlama=$hasil['pnlama'];
				$kppnlama= $hasil ['kppnpnlama'];

			}
			
			$data = array('id' => '',
					'id_group_sk'=>$hasil['mutasinoid'],
					'id_sk'=>$hasil['mutasiindx'],
					'no_urut'=>$hasil['mutasiurut'],
					'kelas_lama'=>$hasil['drtingkat'],
					'nip'=>$hasil['nip'],
					'nama'=>$hasil['nama'],
					'jabatan_lama'=>$hasil['lamaoptions'],
					'pt_lama'=>$hasil['ptlama'],
					'pn_lama'=>$pnlama ,
					'jabatan_baru'=>$hasil['baruoptions'],
					'pt_baru'=>$hasil['ptbaru'],
					'pn_baru'=>$pnbaru,
					'tunjangan'=>$hasil['mutasitunj'],
					'pangkat'=>$hasil['pangkat'],
					'gol_relasi'=>$hasil['golrelasi'],
					'gol'=>$hasil['mutasigolr'],
					'kelas_baru'=>$hasil['ketingkat'],
					'kppn_lama'=>$kppnlama,
					'kppn_baru'=>$hasil['kppnptbaru'],
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
  		//return $out;

  }
	function insertHistory($data){
			$this->db->insert('tbl_skmutasi_hakim_history',$data);
	}

	function getHistory($where){

		$this->db->select('*');
		$this->db->from('tbl_skmutasi_hakim_history');
		$this->db->join('tbl_ref_status','tbl_skmutasi_hakim_history.id_status=tbl_ref_status.id_status');

		$this->db->join('tbl_ref_stage','tbl_skmutasi_hakim_history.id_stage=tbl_ref_stage.id_stage');
		$this->db->where($where);
		$query= $this->db->get();
		return $query->result_array();
			
	}

	 function getDataSKSync($where){
  		$this->db->select('*');
  		$this->db->from('tbl_skmutasi_hakim_data');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skmutasi_hakim_data.updated_user_id');
  		$this->db->join('tbl_ref_status', 'tbl_ref_status.id_status=tbl_skmutasi_hakim_data.id_status');
  		$this->db->where($where);
		$query= $this->db->get();
		return $query->result_array();
  }
   function getDataGroupSKSync(){
  		$this->db->select('*');
  		$this->db->from('tbl_skmutasi_hakim');
  		$this->db->join('tbl_user', 'tbl_user.user_id=tbl_skmutasi_hakim.updated_user_id');
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

}