<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logado')) redirect(base_url('login'));
		$this->template->set_layout("layout/default.php");
		$this->load->model('profile_model');
		$this->template->loadData("activeLink", 
			array("user" => 1));
	}

	public function index()
	{
		$user = $this->profile_model->get_user($this->session->userdata('id'))->row();
		$user_endereco = $this->profile_model->get_user_endereco($this->session->userdata('id'))->row();
		$this->template->loadContent("profile/index.php", 
			array(
				'user' =>$user,
				'user_endereco' =>$user_endereco
			)
		);
	}

	public function user_edit($id)
	{	
		$user = $this->profile_model->get_user($this->session->userdata('id'))->row();
		$user_endereco = $this->profile_model->get_user_endereco($this->session->userdata('id'))->row();
		$this->load->view('profile/user_edit.php', 
			array(
				'user' => $user,
				'user_endereco' => $user_endereco
			)
		);
	}

	public function user_edit_pro()
	{
		$id = $this->session->userdata('id');
		$nome = $this->input->post('nome', true);
		$telefone = preg_replace("/[^0-9]/", "", $this->input->post('telefone', true));
		$logradouro = $this->input->post('logradouro', true);
		$numero = $this->input->post('numero', true);
		$bairro = $this->input->post('bairro', true);
		$complemento = $this->input->post('complemento', true);
		$cidade = $this->input->post('cidade', true);
		$UF = $this->input->post('UF', true);
		$CEP = preg_replace("/[^0-9]/", "", $this->input->post('CEP', true));

		$this->profile_model->update('usuarios', 'id', $id,
			array(
				'nome' => $nome,
				'fone' => $telefone
			)
		);
		$this->profile_model->update('usuarios_endereco', 'usuariosid', $id,
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
		redirect(base_url('profile'));
	}

	public function edit_password_pro()
	{
		$id = $this->session->userdata('id');
		$senhaAntiga = $this->input->post('senhaAntiga', true);
		$novaSenha = $this->input->post('novaSenha', true);
		$novaSenha2 = $this->input->post('novaSenha2', true);
		$user = $this->profile_model->get_user($id)->row();
		if ($novaSenha != $novaSenha2) {
			$this->session->set_flashdata('error', 'As senhas não coincidem.');
			redirect(base_url('profile'));
		}
		if (password_verify($senhaAntiga, $user->senha)) {
			$this->profile_model->update('usuarios', 'id', $id,
			array(
				'senha' => password_hash($novaSenha, PASSWORD_DEFAULT)
			)
		);
			$this->session->set_flashdata('success', 'Senha alterada com sucesso.');
			redirect(base_url('profile'));
		}else{
			$this->session->set_flashdata('error', 'A senha atual não está correta.');
			redirect(base_url('profile'));
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */