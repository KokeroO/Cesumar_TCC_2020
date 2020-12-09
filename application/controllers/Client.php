<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logado') == true) {
			redirect(base_url('login'));
		}
		$this->load->model("client_model");
		$this->load->model("tickets_model");
		$this->template->set_layout("layout/default.php");
	}
	public function index()
	{
		$this->template->loadData("activeLink", 
			array("dashboard" => 1));
		$this->template->loadContent("client/index.php");
	}

	public function tickets_page()
	{
		$this->load->library("datatables");
		$this->datatables->set_total_rows($this->client_model->get_tickets_total());
		$tickets = $this->client_model->get_tickets($this->datatables);
		foreach($tickets->result() as $r) {
			if ($r->usuarios_ult_resp == null || $r->usuarios_ult_resp == $this->session->userdata('id') || $r->escopo == 3) {
				$situacao = "Respondido por você";
				$color = "rgb(0 169 29)";
			}else{
				$situacao = "Aguardando sua resposta";
				$color = "rgb(249 5 5)";
				
			}
			$this->datatables->data[] = array(
				'<span data-toggle="tooltip" title="'.$situacao.'">'.$r->id.'</span>',
				$r->assunto,
				$r->departamento_nome,
				$r->status_nome,
				date('d/m/Y H:i:s',$r->data_criacao_timestamp),
				'<a href="'.base_url("client/view/".$r->id).'" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Visualizar"><i class="fas fa-eye"></i></a>',
				$color,
			);
		}
		header('Access-Control-Allow-Origin: ' . base_url());
		header('Content-type: application/json');
		echo json_encode($this->datatables->process(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
	}

	public function view($id)
	{
		$ticket = $this->tickets_model->get_ticket($id);
		if ($ticket->num_rows() <> 1) {
			$this->session->set_flashdata('error', 'Este ticket é inexitente.');
			redirect(base_url('client'));
		}
		$ticket = $this->tickets_model->get_ticket($id)->row();
		if ($ticket->usuariosid != $this->session->userdata('id')) {
			$this->session->set_flashdata('error', 'Este ticket não foi criado por você.');
			redirect(base_url('client'));
		}
		$ticket_responses = $this->tickets_model->get_ticket_responses($id)->result();
		$ticket_files = $this->tickets_model->get_ticket_files($id)->result();
		$this->load->model('admin_model');
		$departamentos = $this->admin_model->get_departamentos_select()->result();
		$status = $this->admin_model->get_status_select()->result();
		$this->template->loadContent("client/view.php",
			array(
				"ticket" => $ticket,
				"ticket_responses" => $ticket_responses,
				"ticket_files" => $ticket_files,
				"departamentos" => $departamentos,
				"status" => $status
			)
		);
	}

	public function create()
	{	
		$this->load->model('admin_model');
		$departamentos = $this->admin_model->get_departamentos_select()->result();
		$this->load->view('client/create.php',
			array(
				"departamentos" => $departamentos
			)
		);
	}

	public function create_pro()
	{
		$usuarioid = $this->session->userdata('id');
		$departamento = $this->input->post('departamento', true);
		$assunto = $this->input->post('assunto', true);
		$descricao = $this->input->post('descricao', true);
		if (!$usuarioid || !$departamento || !$assunto || !$descricao) {
			$this->session->set_flashdata('error', 'Campos obrigatórios não foram preenchidos.');
			redirect(base_url('client'));
		}

		$id = $this->client_model->insert('tickets', 
			array(
				"usuariosid" => $usuarioid,
				"statusid" => 1,
				"departamentosid" => $departamento,
				"assunto" => $assunto,
				"descricao" => $descricao,
				"data_criacao_timestamp" => time()
			)
		);

		if (!is_dir("uploads/tickets/".$id)) {
			mkdir("uploads/tickets/".$id, 0777, TRUE);
		}
		$this->load->library("upload");

		$count = count($_FILES['files']['name']);

		for($i=0;$i<$count;$i++){

			if(!empty($_FILES['files']['name'][$i])){
				print_r($_FILES['files']);
				$this->upload->initialize(array(
					"upload_path" => "uploads/tickets/".$id,
					"overwrite" => FALSE,
					"max_filename" => 300,
					"encrypt_name" => TRUE,
					"remove_spaces" => TRUE,
					"allowed_types" => 'jpg|jpeg|png|gif|pdf|png'
				)
			);
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
				$this->upload->do_upload('file');
				$data = $this->upload->data();
				$reduce = false;
				$files_flag = 1;
				$file_data[] = array(
					"nome_hash" => $data['file_name'],
					"tipo_arquivo" => $data['file_type'],
					"tamanho" => round((filesize("./uploads/tickets/{$id}/{$data['file_name']}")/1024), 2),
					"nome_origem" => $data['orig_name'],
					"data_criacao_timestamp" => time()
				);
			}
		}
		if ($count > 0) {
			foreach($file_data as $file) {
				$this->client_model->insert('tickets_arquivos', 
					array(
						"ticketsid" => $id,
						"tickets_respostasid" => NULL,
						"nome_hash" => $file['nome_hash'],
						"tipo_arquivo" => $file['tipo_arquivo'],
						"tamanho" => $file['tamanho'],
						"nome_origem" => $file['nome_origem'],
						"data_criacao_timestamp" => $file['data_criacao_timestamp']
					)
				);
			}
		}

		$this->session->set_flashdata('success', 'Ticket criado com sucesso.');
		redirect(base_url('client'));
	}

	public function ticket_reply_pro()
	{
		if (!$this->input->post('id')) {
			$this->session->set_flashdata('error', 'Ticket inexistente.');
			redirect(base_url('client'));
		}
		$id = $this->input->post('id');
		if (!$this->input->post('descricao')) {
			$this->session->set_flashdata('error', 'A resposta não pode ser vazia.');
			redirect(base_url('client/view/'.$id));
		}
		$tickets_respostasid = $this->tickets_model->insert('tickets_respostas',
			array(
				"ticketsid" => $id,
				"usuariosid" => $this->session->userdata('id'),
				"descricao" => $this->input->post('descricao'),
				"data_criacao_timestamp" => time()
			)
		);
		if (!is_dir("uploads/tickets/".$id)) {
			mkdir("uploads/tickets/".$id, 0777, TRUE);
		}
		$this->load->library("upload");

		$count = count($_FILES['files']['name']);

		for($i=0;$i<$count;$i++){

			if(!empty($_FILES['files']['name'][$i])){
				print_r($_FILES['files']);
				$this->upload->initialize(array(
					"upload_path" => "uploads/tickets/".$id,
					"overwrite" => FALSE,
					"max_filename" => 300,
					"encrypt_name" => TRUE,
					"remove_spaces" => TRUE,
					"allowed_types" => 'jpg|jpeg|png|gif|pdf|png'
				)
			);
				$_FILES['file']['name'] = $_FILES['files']['name'][$i];
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
				$this->upload->do_upload('file');
				$data = $this->upload->data();
				$reduce = false;
				$files_flag = 1;
				$file_data[] = array(
					"nome_hash" => $data['file_name'],
					"tipo_arquivo" => $data['file_type'],
					"tamanho" => round((filesize("./uploads/tickets/{$id}/{$data['file_name']}")/1024), 2),
					"nome_origem" => $data['orig_name'],
					"data_criacao_timestamp" => time()
				);
			}
		}
		if ($count > 0) {
			foreach($file_data as $file) {
				$this->tickets_model->insert('tickets_arquivos', 
					array(
						"ticketsid" => $id,
						"tickets_respostasid" => $tickets_respostasid,
						"nome_hash" => $file['nome_hash'],
						"tipo_arquivo" => $file['tipo_arquivo'],
						"tamanho" => $file['tamanho'],
						"nome_origem" => $file['nome_origem'],
						"data_criacao_timestamp" => $file['data_criacao_timestamp']
					)
				);
			}
		}
		$this->session->set_flashdata('success', 'Resposta postada as '.date('d/m/Y H:i:s', time()));
		redirect(base_url('client/view/'.$id));
	}

}

/* End of file Client.php */
/* Location: ./application/controllers/Client.php */