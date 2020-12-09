<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if ($this->router->fetch_method() != 'sair' && $this->session->userdata('logado') == true) {
            if ($this->session->userdata('atendente')) {
                redirect(base_url('admin'));
            }else{
                redirect(base_url('client'));
            }
            redirect('login');
        }
        $this->load->model('auth_model');
        $this->template->set_layout("layout/login.php");
    }

    public function index()
    {
      $this->template->loadContent('auth/login.php');
  }

  public function register()
  {
    $this->template->loadContent('auth/register.php');
}

public function register_pro()
{
    $nome = $this->input->post('nome', true);
    $CPF = preg_replace("/[^0-9]/", "", $this->input->post('CPF', true));
    $email = $this->input->post('email', true);
    $password = $this->input->post('password', true);
    $telefone = preg_replace("/[^0-9]/", "", $this->input->post('telefone', true));
    $logradouro = $this->input->post('logradouro', true);
    $numero = $this->input->post('numero', true);
    $bairro = $this->input->post('bairro', true);
    $complemento = $this->input->post('complemento', true);
    $cidade = $this->input->post('cidade', true);
    $UF = $this->input->post('UF', true);
    $CEP = preg_replace("/[^0-9]/", "", $this->input->post('CEP', true));
    if (!$nome || !$CPF || !$password || !$email || !$logradouro || !$numero || !$bairro || !$cidade || !$UF || !$CEP) {
        $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Deve preencher todos os campos obrigatórios.</div>');
        redirect(base_url('login/register'));
    }
    $id = $this->auth_model->insert('usuarios', 
        array(
            'nome' => $nome,
            'cpf' => $CPF,
            'email' => $email,
            'senha' => password_hash($password, PASSWORD_DEFAULT),
            'fone' => $telefone,
            'ativo' => 1,
            'atendente' => 0,
            'data_criacao_timestamp' => time()
        )
    );
    if ($id) {
        $this->auth_model->insert('usuarios_endereco', 
            array(
                'usuariosid' => $id,
                'logradouro' => $logradouro,
                'numero' => $numero,
                'bairro' => $bairro,
                'complemento' => $complemento,
                'cidade' => $cidade,
                'uf' => $UF,
                'cep' => $CEP
            )
        );
        $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso.</div>');
        redirect(base_url('login'));
    }else{
        $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Erro interno, entre em contato com o administrador.</div>');
        redirect(base_url('login/register'));
    }

}

public function forgotPassword()
{
    $this->template->loadContent('auth/forgotPassword.php');
}

public function forgotPassword_pro()
{
    if ($this->auth_model->check_email($this->input->post('email', true))) {
        $newPassword = bin2hex(random_bytes(3));
        $this->auth_model->update('usuarios', 'email', $this->input->post('email', true),
            array(
                'senha' => password_hash($newPassword, PASSWORD_DEFAULT)
            )
        );
        $emailFrom = $this->configs->info->email;
        $nomeSite = $this->configs->info->nome_site;
        $destino = $this->input->post('email', true);
        $assunto = "Recueperação de senha";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: $nome <$emailFrom>';
        $mensagem = "Olá usuário,<br/><br/>Foi solicitado uma nova senha ao usuário relacionado a este e-mail. <br/>A nova senha de acesso: {$newPassword}<br/><br/>Atte.";

        mail($destino, $assunto, $mensagem, $headers);

        $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">E-mail enviado para '.$this->input->post('email', true).', em instantes chegará o e-mail informando sua nova senha.</div>');
        redirect(base_url('login'));
    }else{
        $this->session->set_flashdata('error', '<div class="alert alert-danger" role="alert">Email não encontrado na base de dados.</div>');
        redirect(base_url('login'));
    }

}

public function check_cpf()
{
    if (!$this->input->is_ajax_request()) redirect(base_url('login'));

    header('Access-Control-Allow-Origin: ' . base_url());
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Content-Type: application/json');

    if ($this->auth_model->check_cpf($this->input->post('cpf'))) {
        echo json_encode(array('return' => true));
    }else{
        echo json_encode(array('return' => false));
    }
    exit();
}

public function check_email()
{
    if (!$this->input->is_ajax_request()) redirect(base_url('login'));

    header('Access-Control-Allow-Origin: ' . base_url());
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Content-Type: application/json');

    if ($this->auth_model->check_email($this->input->post('email'))) {
        echo json_encode(array('return' => true));
    }else{
        echo json_encode(array('return' => false));
    }
    exit();
}

public function sair()
{
    $this->session->sess_destroy();
    redirect('login');
}

public function verificarLogin()
{
    header('Access-Control-Allow-Origin: ' . base_url());
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Content-Type: application/json');

    $this->load->library('form_validation');
    $this->form_validation->set_rules('usuario', 'Usuário', 'required|trim');
    $this->form_validation->set_rules('password', 'Senha', 'required|trim');
    if ($this->form_validation->run() == false) {
        $json = ['result' => false, 'message' => validation_errors()];
        echo json_encode($json);
    } else {
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('password');
        $user = $this->auth_model->Verifica($usuario);

        if ($user) {
            if (!$user->ativo) {
                $json = ['result' => false, 'message' => 'O usuário não está ativo no sistema.'];
                echo json_encode($json);
                die();
            }

            if (password_verify($password, $user->senha)) {
                $session_data = ['nome' => $user->nome, 'email' => $user->email, 'id' => $user->id, 'atendente' => $user->atendente, 'logado' => true];
                $this->session->set_userdata($session_data);
                $json = ['result' => true, 'atendente' => $user->atendente];
                echo json_encode($json);
            } else {
                $json = ['result' => false, 'message' => 'Os dados de acesso estão incorretos.'];
                echo json_encode($json);
            }
        } else {
            $json = ['result' => false, 'message' => 'Email ou CPF não encontrados.'];
            echo json_encode($json);
        }
    }
    die();
}

}