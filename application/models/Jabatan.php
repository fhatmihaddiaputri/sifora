<?php  
/**
 * 
 */
class Jabatan_model extends CI_Model
{
	
	
	function get_data(){
			$query = $this->db->get('tbl_ref_jabatan');
			return $query->result_array();
	}
}
 ?>