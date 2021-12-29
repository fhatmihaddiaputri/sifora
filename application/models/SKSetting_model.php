<?php 
class SKSetting_model extends CI_Model{
	

	function getTemplate($id_jenis){
		$where = array('id_jenis' =>$id_jenis );
		$this->db->select('*');
	  		$this->db->from('tbl_ref_jenis_sk_mutasi_panitera');
	  		$this->db->where($where);
			$query= $this->db->get();
	  		return $query->result_array();
	}
	function getTemplateMutasibyGroup($group){
		//$where = array('id_jenis' =>$id_jenis );
			$this->db->select('*');
	  		$this->db->from('tbl_ref_jenis_sk_mutasi_'.$group);
	  		//$this->db->where($where);
			$query= $this->db->get();
	  		return $query->result_array();
	}
	function getTemplateMutasiWhere($group,$id){
			$where = array('id_jenis' =>$id);
			$this->db->select('*');
	  		$this->db->from('tbl_ref_jenis_sk_mutasi_'.$group);
	  		$this->db->where($where);
			$query= $this->db->get();
	  		return $query->result_array();
	}

}
?>