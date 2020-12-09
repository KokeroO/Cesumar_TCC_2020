<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

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

	public function get_tickets_total() 
	{
		$s = $this->db->select("COUNT(*) as num")->get("tickets");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_tickets($datatable) 
	{

		$datatable->db_search(
			array(
				"tickets.nome"
			)
		);
		if ($this->input->post("order", true)) {
			$order_column = array(
				"tickets.id",
				"tickets.assunto",
				"departamentos.nome",
				"status.nome",
				"tickets.data_criacao_timestamp"
			);
			$this->db->order_by($order_column[$this->input->post("order", true)['0']['column']], $this->input->post("order", true)['0']['dir']);
		} else {
			$this->db->order_by("tickets.data_criacao_timestamp", "DESC");
		}
		return $this->db
		->select(" tickets.id, tickets.assunto, tickets.descricao, tickets.data_criacao_timestamp, departamentos.nome as departamento_nome, status.nome as status_nome, status.escopo, tickets.usuariosid, 
			( SELECT  tickets_respostas.usuariosid
			FROM    tickets_respostas
			WHERE   tickets_respostas.ticketsid = tickets.id
			ORDER BY tickets_respostas.data_criacao_timestamp DESC
			LIMIT 1
			) AS usuarios_ult_resp
			")
		->join("status", "tickets.statusid = status.id")
		->join("departamentos", "tickets.departamentosid = departamentos.id")
		->where("tickets.usuariosid", $this->session->userdata('id'))
		->limit($datatable->length, $datatable->start)
		->get("tickets");
	}

}

/* End of file Client_model.php */
/* Location: ./application/models/Client_model.php */