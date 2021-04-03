<?php
class Pengguna_model extends CI_Model{

 function getData(){
    //$query = $this->db->get_where('tbl_ref_jabatan', array('id_jabatan' => $id));
    $this->db->select('*');
	$this->db->from('tbl_user','tbl_ref_group');
	$this->db->join('tbl_ref_jabatan', 'tbl_ref_jabatan.id_jabatan = tbl_user.user_id_jab');
	$this->db->join('tbl_ref_group', 'tbl_ref_group.id_group = tbl_ref_jabatan.id_group');
	//$this->db->where('user_id_jab!=','0');
    $query = $this->db->get();
	//var_dump($query);
    return $query->result_array();
  }

  function hapus_data($where, $table){

  	$this->db->where($where);
  	$this->db->delete($table);

  }

  function input_data($data, $table){

  	$this->db->insert($table,$data);
  }

  function edit_data($where, $table){

  	return $this->db->get_where($table,$where);
  }

  function update_data($data, $where, $table){

  	$this->db->where($where);
  	$this->db->update($table,$data);
  }
}

?>
