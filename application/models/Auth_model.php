<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function Verifica($value)
	{
		$r = $this->db
		->where('cpf', $value)
		->or_where('email', $value)
		->limit(1)
		->get('usuarios');
		if ($r->num_rows() > 0) {
			return $r->row();
		}else{
			return false;
		}
	}

	function insert($table, $data=array())
	{
		$this->db->insert($table, $data);
		$id = $this->db->insert_id();
		if ($id > 0) {
			return $id;
		}else{
			return false;
		}
	}

	function update($table, $columnWhere, $where, $data=array())
	{
		$this->db->where($columnWhere, $where)
		->set($data)
		->update($table);
	}

	function check_cpf($value)
	{
		$r = $this->db->where('cpf', $value)
		->get('usuarios');
		if ($r->num_rows() >= 1) {
			return true;
		}else{
			return false;
		}

	}

	function check_email($value)
	{
		$r = $this->db->where('email', $value)
		->get('usuarios');
		if ($r->num_rows() >= 1) {
			return true;
		}else{
			return false;
		}

	}

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */