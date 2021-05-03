<?php  
/**
 * 
 */
class Surat_model extends CI_Model
{
	
	
	function get_data($table){
			$query = $this->db->get($table);
			return $query->result_array();
	}
	function get_where($table, $where){
			$query = $this->db->get_where($table, $where);
			return $query->result_array();
	}


	function getAllSurat($kode_surat, $stage){
		
		$table = 'tbl_'.$this->session->userdata('group_name').'_'.$kode_surat;
			// search data from table where stage =$stage
		echo $table;
		$this->db->select($table.'.*, u.user_name as update_name, c.user_name as create_name, tbl_ref_status.*');
		$this->db->from($table);
		$this->db->join('tbl_user as u', 'u.user_id='.$table.'.updated_user_id');
		$this->db->join('tbl_user as c', 'c.user_id='.$table.'.created_user_id');
		$this->db->join('tbl_ref_status', 'tbl_ref_status.id_status='.$table.'.id_status');
		$query = $this->db->get();

		return $query->result_array();
		

	}
	function getSuratWhere($kode_surat, $where){
		$table = 'tbl_'.$this->session->userdata('group_name').'_'.$kode_surat;
			// search data from table where stage =$stage
		echo $table;
		$this->db->select($table.'.*, u.user_name as update_name, c.user_name as create_name, tbl_ref_status.*');
		$this->db->from($table);
		$this->db->join('tbl_user as u', 'u.user_id='.$table.'.updated_user_id');
		$this->db->join('tbl_user as c', 'c.user_id='.$table.'.created_user_id');
		$this->db->join('tbl_ref_status', 'tbl_ref_status.id_status='.$table.'.id_status');
		$this->db->where($where);
		$query = $this->db->get();

		return $query->result_array();
		

	}
	function insertData($kode_surat,$data){
		$table = 'tbl_'.$this->session->userdata('group_name').'_'.$kode_surat;
		$this->db->insert($table, $data);
		return true;

	}
	function updateData($kode_surat, $data, $where){
		$table = 'tbl_'.$this->session->userdata('group_name').'_'.$kode_surat;
		$this->db->where($where);
		$this->db->update($table, $data);
		return true;
	}
	function get(){

  		$db2 = $this->load->database('panitera', TRUE);
		//$table =$db2->list_tables();
		$query= $db2->get_where('sknaikpangkatmst', $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
		//return  $query->num_rows();
  }
}
 ?>