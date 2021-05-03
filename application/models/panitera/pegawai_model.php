<?php  
/**
 * 
 */
class Pegawai_model extends CI_Model
{
	
	
	function get_data(){
			$query = $this->db->get('dummy_pegawai');
			return $query->result_array();
	}
}
 ?>