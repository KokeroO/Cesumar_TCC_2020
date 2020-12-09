<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
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

	function delete($table, $columnWhere, $where)
	{
		$this->db->where($columnWhere, $where)
		->delete($table);
	}

	public function get_status_total() 
	{
		$s = $this->db->select("COUNT(*) as num")->get("status");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_status($datatable) 
	{

		$datatable->db_search(
			array(
				"status.nome"
			)
		);
		if ($this->input->post("order", true)) {
			$order_column = array(
				"status.id",
				"status.nome",
				null,
				"status.data_criacao_timestamp"
			);
			$this->db->order_by($order_column[$this->input->post("order", true)['0']['column']], $this->input->post("order", true)['0']['dir']);
		} else {
			$this->db->order_by("status.nome", "ASC");
		}
		return $this->db
		->select("*")
		->limit($datatable->length, $datatable->start)
		->get("status");
	}

	public function get_departamentos_id($id)
	{
		return $this->db->where('id', $id)
		->get('departamentos');
	}

	public function get_departamentos_total() 
	{
		$s = $this->db->select("COUNT(*) as num")->get("departamentos");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_departamentos($datatable) 
	{

		$datatable->db_search(
			array(
				"departamentos.nome"
			)
		);
		if ($this->input->post("order", true)) {
			$order_column = array(
				"departamentos.id",
				"departamentos.nome",
				"departamentos.data_criacao_timestamp"
			);
			$this->db->order_by($order_column[$this->input->post("order", true)['0']['column']], $this->input->post("order", true)['0']['dir']);
		} else {
			$this->db->order_by("departamentos.nome", "ASC");
		}
		return $this->db
		->select("*")
		->limit($datatable->length, $datatable->start)
		->get("departamentos");
	}

	public function get_status_id($id)
	{
		return $this->db->where('id', $id)
		->get('departamentos');
	}

	public function get_membros_total() 
	{
		$s = $this->db->select("COUNT(*) as num")->get("usuarios");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_membros($datatable) 
	{

		$datatable->db_search(
			array(
				"usuarios.nome"
			)
		);
		if ($this->input->post("order", true)) {
			$order_column = array(
				"usuarios.id",
				"usuarios.nome",
				"usuarios.email",
				"usuarios.ativo",
				"usuarios.atendente",
				"usuarios.data_criacao_timestamp"
			);
			$this->db->order_by($order_column[$this->input->post("order", true)['0']['column']], $this->input->post("order", true)['0']['dir']);
		} else {
			$this->db->order_by("usuarios.nome", "ASC");
		}
		return $this->db
		->select("*")
		->limit($datatable->length, $datatable->start)
		->get("usuarios");
	}

	public function get_membros_id($id)
	{
		return $this->db->where('id', $id)
		->get('usuarios');
	}

	function get_membros_endereco_id($id)
	{
		return $this->db->where('usuariosid', $id)
		->get('usuarios_endereco');
	}

	public function get_status_select()
	{
		return $this->db->get('status');
	}

	public function get_departamentos_select()
	{
		return $this->db->get('departamentos');
	}

	public function get_configuracoes()
	{
		return $this->db->limit(1)->get('configuracoes');
	}

	public function get_usuarios($value) 
	{
		return $this->db->like("nome", $value)->limit(10)->get("usuarios");
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */