<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	function get_user($id)
	{
		return $this->db->where('id', $id)
		->get('usuarios');
	}

	function get_user_endereco($id)
	{
		return $this->db->where('usuariosid', $id)
		->get('usuarios_endereco');
	}

	function update($table, $columnWhere, $where, $data=array())
	{
		$this->db->where($columnWhere, $where)
		->set($data)
		->update($table);
	}

}

/* End of file Profile_model.php */
/* Location: ./application/models/Profile_model.php */