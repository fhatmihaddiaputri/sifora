<?php  
/**
 * 
 */
class Pangkat_model extends CI_Model
{
	
	
	function get_pangkat($gol){
		$where  = array('gol' => $gol );
		$query = $this->db->get_where('tbl_ref_pangkat',$where );
		
		return $query->result_array();
	}
}
 ?>