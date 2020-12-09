<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends CI_Model {

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
		->limit($datatable->length, $datatable->start)
		->get("tickets");
	}

	public function get_ticket($id)
	{
		return $this->db->select("tickets.id as ticketid, tickets.assunto, tickets.descricao, tickets.data_criacao_timestamp, usuarios.nome, usuarios.email, usuarios.cpf, usuarios.fone, usuarios_endereco.*, usuarios.id as usuario_id, departamentos.id as departamento_id, status.id as status_id, departamentos.nome as departamento_nome, status.nome as status_nome, status.escopo, case status.escopo
when 1 then '<span class=\'alert-success\'>Aberto</span>'
when 2 then '<span class=\'alert-info\'>Em atendimento</span>'
when 3 then '<span class=\'alert-danger\'>Fechado</span>' end as escopo_nome")
		->where("tickets.id", $id)
		->join("status", "tickets.statusid = status.id")
		->join("departamentos", "tickets.departamentosid = departamentos.id")
		->join("usuarios", "tickets.usuariosid = usuarios.id")
		->join("usuarios_endereco", "tickets.usuariosid = usuarios_endereco.usuariosid")
		->limit(1)
		->get("tickets");
	}

	public function get_ticket_responses($id)
	{
		return $this->db->select("tickets_respostas.*, usuarios.nome, usuarios.atendente, usuarios.id as usuario_id")
		->where("tickets_respostas.ticketsid", $id)
		->join("usuarios", "tickets_respostas.usuariosid = usuarios.id")
		->get("tickets_respostas");
	}

	public function get_ticket_files($id)
	{
		return $this->db->select("tickets_arquivos.*")
		->where("tickets_arquivos.ticketsid", $id)
		->get("tickets_arquivos");
	}

	public function get_ticket_files_responses($id, $responsesid)
	{
		return $this->db->select("tickets_arquivos.*")
		->where("tickets_arquivos.ticketsid", $id)
		->where("tickets_arquivos.tickets_respostasid", $responsesid)
		->get("tickets_arquivos");
	}

	public function tickets_abertos()
	{
		return $this->db->where('status.escopo', 1)
		->join("status", "tickets.statusid = status.id")
		->get("tickets")
		->num_rows();
	}

	public function tickets_atendimento()
	{
		return $this->db->where('status.escopo', 2)
		->join("status", "tickets.statusid = status.id")
		->get("tickets")
		->num_rows();
	}
	public function tickets_fechados()
	{
		return $this->db->where('status.escopo', 3)
		->join("status", "tickets.statusid = status.id")
		->get("tickets")
		->num_rows();
	}

	public function agua_resposta()
	{
		return $this->db->select(" COUNT(*) as count")
		->where("not EXISTS(SELECT 1 FROM tickets_respostas WHERE tickets_respostas.ticketsid = tickets.id)", null, false)
		->get('tickets');
	}

}

/* End of file Tickets_model.php */
/* Location: ./application/models/Tickets_model.php */