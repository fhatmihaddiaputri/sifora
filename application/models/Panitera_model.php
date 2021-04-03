<?php  
/**
 * 
 */
class Panitera_model extends CI_Model
{
	
	
	function get_data($where){
	 log_message("debug", "Masuk model");
	 $db2 = $this->load->database('panitera', TRUE);
		log_message("debug", "TEST");
	$table =$db2->list_tables();
	$db2->select('skpangkatnoid');
	$db2->from('sknaikpangkatmst');
	$query = $db2->get();
    //$query = $db2->get('public.email_data');
    	log_message("debug", "TEST");
	//var_dump($table);
    	var_dump($query->result()) ;
	//print_r($query->result_array());
	 return $query->result_array();
   // return $table;
  }


  function get_data_sekre(){
	 log_message("debug", "Masuk model");
	 $db2 = $this->load->database('panitera_sekre', TRUE);
		log_message("debug", "TEST");
	$table =$db2->list_tables();
	//$db2->select('skpangkatnoid');
	//$db2->from('sknaikpangkatmst');
	//$query = $db2->get();
    //$query = $db2->get('public.email_data');
    	log_message("debug", "TEST");
	var_dump($table);
    //	var_dump($query->result()) ;
	//print_r($query->result_array());
	 //return $query->result_array();
    return $table;
  }
}
 ?>