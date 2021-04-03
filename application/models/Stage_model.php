<?php  
/**
 * 
 */
class Stage_model extends CI_Model
{
	
	
	function get_data($table){
			$query = $this->db->get($table);
			return $query->result_array();
	}
	function get_where($table, $where){
			$query = $this->db->get_where($table, $where);
			return $query->result_array();
	}

	
}
 ?>