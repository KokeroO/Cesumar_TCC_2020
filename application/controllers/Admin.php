<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logado') == true) {
			if (!$this->session->userdata('atendente')) {
				redirect(base_url('client'));
			}
		}else{
			redirect(base_url('login'));
		}
		$this->load->model("admin_model");
		$this->load->model("tickets_model");
		$this->template->set_layout("layout/default.php");
	}

	public function index()
	{
		$this->template->loadData("activeLink", 
			array("dashboard" => 1));
		$stats = new stdClass();
		$stats->abertos = $this->tickets_model->tickets_abertos();
		$stats->atendimento = $this->tickets_model->tickets_atendimento();
		$stats->fechados = $this->tickets_model->tickets_fechados();
		$stats->agua_resposta = $this->tickets_model->agua_resposta()->row()->count;
		$this->template->loadContent("admin/index.php", 
			array(
				"stats" => $stats
			)
		);
	}

	public function status()
	{
		$this->template->loadData("activeLink", 
			array("admin" => array("status" => 1)));
		$this->template->loadContent("admin/status_index.php");
	}

	public function status_add_edit($id)
	{	
		$status = 0;
		if ($id > 0) {
			$status = $this->admin_model->get_status_id($id)->row();
		}
		$this->load->view('admin/status_add_edit.php', array('status' => $status));
	}

	public function status_delete($id)
	{
		$this->admin_model->delete('status', 'id', $id);
		redirect(base_url('admin/status'));
	}

	public function status_page()
	{
		$this->load->library("datatables");
		$this->datatables->set_total_rows($this->admin_model->get_status_total());
		$status = $this->admin_model->get_status($this->datatables);
		foreach($status->result() as $r) {
			switch ($r->escopo) {
				case 1:
				$escopo = 'Aberto';
				break;
				case 2:
				$escopo = 'Em atendimento';
				break;
				case 3:
				$escopo = 'Fechado';
				break;
				default:
				$escopo = 'Indefinido';
				break;
			}
			$this->datatables->data[] = array(
				$r->id,
				$r->nome,
				$escopo,
				date('d/m/Y H:i:s',$r->data_criacao_timestamp),
				'<span data-toggle="tooltip" data-placement="bottom" title="Editar"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalStatus" onclick="javascript:editarStatus(\'' .$r->id.'\')"><i class="fas fa-pencil-alt"></i></button></span> <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="event.preventDefault(); swal({title: \'Excluir\',text: \'Deseja realmente excluir o status?\',icon: \'warning\',buttons: [\'Cancelar\', \'Excluir\'],dangerMode: true,}).then((willDelete) => {if (willDelete) {window.location.href = \''.site_url("admin/status_delete/" . $r->id . "/" . $this->security->get_csrf_hash()).'\';} else {return false;}});" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>'
			);
		}
		header('Access-Control-Allow-Origin: ' . base_url());
		header('Content-type: application/json');
		echo json_encode($this->datatables->process(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
	}

	public function status_pro()
	{
		$id = $this->input->post('id', true);
		$nome = $this->input->post('nome', true);
		$escopo = $this->input->post('escopo', true);

		if ($id > 0) {
			$this->admin_model->update('status', 'id', $id, 
				array(
					'nome' => $nome,
					'escopo' => $escopo
				)
			);
			$this->session->set_flashdata('success', 'Departamento alterado com sucesso.');
		}else{
			$this->admin_model->insert('status',
				array(
					'nome' => $nome,
					'escopo' => $escopo
				)
			);
			$this->session->set_flashdata('success', 'Departamento criado com sucesso.');
		}
		redirect(base_url('admin/status'));
	}

	public function departamentos()
	{
		$this->template->loadData("activeLink", 
			array("admin" => array("dapart" => 1)));
		$this->template->loadContent("admin/departamentos_index.php");
	}

	public function departamentos_add_edit($id)
	{	
		$departamentos = 0;
		if ($id > 0) {
			$departamentos = $this->admin_model->get_departamentos_id($id)->row();
		}
		$this->load->view('admin/departamentos_add_edit.php', array('departamentos' => $departamentos));
	}

	public function departamentos_delete($id)
	{
		$this->admin_model->delete('departamentos', 'id', $id);
		redirect(base_url('admin/departamentos'));
	}

	public function departamentos_page()
	{
		$this->load->library("datatables");
		$this->datatables->set_total_rows($this->admin_model->get_departamentos_total());
		$departamentos = $this->admin_model->get_departamentos($this->datatables);
		foreach($departamentos->result() as $r) {
			$this->datatables->data[] = array(
				$r->id,
				$r->nome,
				date('d/m/Y H:i:s',$r->data_criacao_timestamp),
				'<span data-toggle="tooltip" data-placement="bottom" title="Editar"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalStatus" onclick="javascript:editarStatus(\'' .$r->id.'\')"><i class="fas fa-pencil-alt"></i></button></span> <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="event.preventDefault(); swal({title: \'Excluir\',text: \'Deseja realmente excluir o departamento?\',icon: \'warning\',buttons: [\'Cancelar\', \'Excluir\'],dangerMode: true,}).then((willDelete) => {if (willDelete) {window.location.href = \''.site_url("admin/departamentos_delete/" . $r->id . "/" . $this->security->get_csrf_hash()).'\';} else {return false;}});" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="far fa-trash-alt"></i></a>'
			);
		}
		header('Access-Control-Allow-Origin: ' . base_url());
		header('Content-type: application/json');
		echo json_encode($this->datatables->process(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
	}

	public function departamentos_pro()
	{
		$id = $this->input->post('id', true);
		$nome = $this->input->post('nome', true);

		if ($id > 0) {
			$this->admin_model->update('departamentos', 'id', $id, 
				array(
					'nome' => $nome
				)
			);
			$this->session->set_flashdata('success', 'Departamento alterado com sucesso.');
		}else{
			$this->admin_model->insert('departamentos',
				array(
					'nome' => $nome
				)
			);
			$this->session->set_flashdata('success', 'Departamento criado com sucesso.');
		}
		redirect(base_url('admin/departamentos'));
	}

	public function membros()
	{
		$this->template->loadData("activeLink", 
			array("admin" => array("membros" => 1)));
		$this->template->loadContent("admin/membros_index.php");
	}

	public function membros_page()
	{
		$this->load->library("datatables");
		$this->datatables->set_total_rows($this->admin_model->get_membros_total());
		$membros = $this->admin_model->get_membros($this->datatables);
		foreach($membros->result() as $r) {
			switch ($r->atendente) {
				case 0:
				$atendente = 'Não';
				break;
				case 1:
				$atendente = 'Sim';
				break;
				default:
				$atendente = 'Indefinido';
				break;
			}
			switch ($r->ativo) {
				case 0:
				$situacao = 'Desativado';
				break;
				case 1:
				$situacao = 'Ativo';
				break;
				default:
				$situacao = 'Indefinido';
				break;
			}
			$this->datatables->data[] = array(
				$r->id,
				$r->nome,
				$r->email,
				$situacao,
				$atendente,
				date('d/m/Y H:i:s',$r->data_criacao_timestamp),
				'<span data-toggle="tooltip" data-placement="bottom" title="Editar"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalMembros" onclick="javascript:editarMembros(\'' .$r->id.'\')"><i class="fas fa-pencil-alt"></i></button></span> <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="event.preventDefault(); swal({title: \'Desativar\',text: \'Deseja realmente desativar este membro?\',icon: \'warning\',buttons: [\'Cancelar\', \'Desativar\'],dangerMode: true,}).then((willDelete) => {if (willDelete) {window.location.href = \''.site_url("admin/membros_desativa/" . $r->id . "/" . $this->security->get_csrf_hash()).'\';} else {return false;}});" data-toggle="tooltip" data-placement="bottom" title="Desativar"><i class="fas fa-user-slash"></i></a>'
			);
		}
		header('Access-Control-Allow-Origin: ' . base_url());
		header('Content-type: application/json');
		echo json_encode($this->datatables->process(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
	}

	public function membros_edit($id)
	{	
		$membros = 0;
		if ($id > 0) {
			$membros = $this->admin_model->get_membros_id($id)->row();
			$membros_endereco = $this->admin_model->get_membros_endereco_id($id)->row();
		}
		$this->load->view('admin/membros_edit.php', 
			array(
				'membros' => $membros, 
				'membros_endereco' => $membros_endereco
			)
		);
	}

	public function membros_pro()
	{
		$id = $this->input->post('id', true);
		$ativo = $this->input->post('ativo', true);
		$atendente = $this->input->post('atendente', true);
		$nome = $this->input->post('nome', true);
		$telefone = preg_replace("/[^0-9]/", "", $this->input->post('telefone', true));
		$logradouro = $this->input->post('logradouro', true);
		$numero = $this->input->post('numero', true);
		$bairro = $this->input->post('bairro', true);
		$complemento = $this->input->post('complemento', true);
		$cidade = $this->input->post('cidade', true);
		$UF = $this->input->post('UF', true);
		$CEP = preg_replace("/[^0-9]/", "", $this->input->post('CEP', true));

		$this->admin_model->update('usuarios', 'id', $id,
			array(
				'ativo' => $ativo,
				'atendente' => $atendente,
				'nome' => $nome,
				'fone' => $telefone
			)
		);
		$this->admin_model->update('usuarios_endereco', 'usuariosid', $id,
			array(
				'logradouro' => $logradouro,
				'numero' => $numero,
				'bairro' => $bairro,
				'complemento' => $complemento,
				'cidade' => $cidade,
				'uf' => $UF,
				'cep' => $CEP
			)
		);
		$this->session->set_flashdata('success', 'Dados alterados com sucesso.');
		redirect(base_url('admin/membros'));
	}


	public function membros_desativa($id)
	{
			$this->admin_model->update('usuarios', 'id', $id, 
				array(
					'ativo' => 0,
				)
			);
			$this->session->set_flashdata('success', 'Membro desativado com sucesso.');
		redirect(base_url('admin/membros'));
	}

	public function configuracoes()
	{
		$this->template->loadData("activeLink", 
			array("admin" => array("configs" => 1)));
		$configuracoes = $this->admin_model->get_configuracoes()->row();
		$this->template->loadContent("admin/configuracoes_index.php", array("configuracoes" => $configuracoes));
	}

	public function configuracoes_pro()
	{
		$nome_site = $this->input->post('nome_site', true);
		$nome_logo = $this->input->post('nome_logo', true);
		$email = $this->input->post('email', true);
		$descricao_site = $this->input->post('descricao', true);

			$this->admin_model->update('configuracoes', 'id', 1, 
				array(
					'nome_site' => $nome_site,
					'nome_logo' => $nome_logo,
					'email' => $email,
					'descricao_site' => $descricao_site
				)
			);
			$this->session->set_flashdata('success', 'Configurações alteradas com sucesso.');

		redirect(base_url('admin/configuracoes'));
	}

	public function search_usuario() 
	{
		$query = $this->common->nohtml($this->input->post("query"));

		if(!empty($query)) {
			$usuarios = $this->admin_model->get_usuarios($query);
			if($usuarios->num_rows() == 0) {
				echo json_encode(array());
			} else {
				$array = array();
				foreach($usuarios->result() as $r) {
					$array[] = array('key' => $r->id, 'value' => $r->nome);
				}
				echo json_encode($array);
				exit();
			}
		} else {
			echo json_encode(array());
			exit();
		}
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */