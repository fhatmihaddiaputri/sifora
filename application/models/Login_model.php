<?php
class Login_model extends CI_Model{

  function validate($email,$password){
    $this->db->where('user_email',$email);
    $this->db->where('user_password',$password);
    $result = $this->db->get('tbl_user',1);
	//var_dump($result);
    return $result;
  }
   function getLevel($id){
    //$query = $this->db->get_where('tbl_ref_jabatan', array('id_jabatan' => $id));
    $this->db->select('*');
	$this->db->from('tbl_ref_jabatan');
	$this->db->join('tbl_ref_level', 'tbl_ref_level.id_level = tbl_ref_jabatan.id_level');
	$this->db->join('tbl_ref_group', 'tbl_ref_group.id_group = tbl_ref_jabatan.id_group');
	$this->db->where('id_jabatan',$id);
    $query = $this->db->get();
	var_dump($query);
    return $query;
  }



 function getData($table, $where){
    $query = $this->db->get_where($table, $where);
	var_dump($query);
    return $query;
  }


  function update_data($data, $where, $table){
      $this->db->where($where);
      $this->db->update($table, $data);
      if($this->db->affected_rows()>0){

          return true;
      }else{
          return false;

      }

  }
}