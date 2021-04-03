<?php  
/**
 * 
 */

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use NcJoes\OfficeConverter\OfficeConverter;
class Jabatan_model extends CI_Model
{
	
	
	function get_data(){
		$this->db->select('*');
		$this->db->from('tbl_ref_jabatan');
		$this->db->join('tbl_ref_group', 'tbl_ref_jabatan.id_group = tbl_ref_group.id_group');
		
    	$query = $this->db->get();
	
		return $query->result_array();
	}
}
 ?>