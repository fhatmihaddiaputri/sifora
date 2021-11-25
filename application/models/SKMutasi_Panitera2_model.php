<?php  
/**
 * 
 */
class SKMutasi_Panitera2_model extends CI_Model
{

	/*function getData(){
		$db2 = $this->load->database('panitera', TRUE);
		$table =$db2->list_tables();
		$db2->select('*');
		$db2->from('mutasijns02mst');
		$query = $db2->get();
		return $query->result_array();

	}*/

	function getDataAll($table){
	//	log_message("debug", "Masuk model");
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
	    log_message("debug", "TEST");
		//var_dump($query->result()) ;
		return $query->result_array();
	}

	function getDataWhere($where, $table){

		//$table =$db2->list_tables();
		$query= $this->db->get_where($table, $where);
		 	//var_dump($query->result()) ;
		return $query->result_array();
	}





}