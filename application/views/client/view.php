<main>
	<div class="container-fluid">
		<h1 class="mt-4"><i class="fas fa-ticket-alt"></i>&ensp;Ticket #<?= $ticket->ticketid ?></h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="<?= base_url('client') ?>">Área do Cliente</a></li>
			<li class="breadcrumb-item active"><a href="<?= base_url('tickets') ?>">Tickets</a></li>
			<li class="breadcrumb-item active">Visualizar</li>
		</ol>
		<div class="row">
			<div class="col-8">
				<div class="card mb-3">
					<div class="card-body">
						<h5 class="card-title"><b>Assunto:</b> <?= $ticket->assunto ?></h5>
						<p><b>Descrição: </b></p><?= $ticket->descricao ?>
						<p><br/><b>Anexos: </b></p>
						<?php 
						if(count($ticket_files) > 0) : ?>
							<small><table class="table table-sm table-striped table-hover">
								<thead>
									<tr>
										<th scope="col">Arquivo</th>
										<th scope="col">Tamanho</th>
										<th scope="col">Tipo</th>
										<th scope="col">Anexado em</th>
										<th scope="col">Ação</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($ticket_files as $f) : ?>
										<tr>
											<td scope="row"><?= $f->nome_origem ?></th>
												<td><?= $f->tamanho ?> Kb</td>
												<td><?= $f->tipo_arquivo ?></td>
												<td><?= date('d/m/Y H:i:s',$f->data_criacao_timestamp) ?></td>
												<td><a <?= ( substr($f->tipo_arquivo, 0, 5) == "image") ? 'data-lightbox="total" data-title="'. $f->nome_origem .'"' : 'target="_blank"'; ?> href="<?= base_url("uploads/tickets/{$ticket->ticketid}/$f->nome_hash") ?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Visualizar"><i class="fas fa-eye"></i></a></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table></small>
								<?php else : ?>
									<p>Sem anexos</p>
								<?php endif; ?>
							</div>
						</div>
						<?php 
						$contResp = 0;
						foreach ($ticket_responses as $r) : ?>
							<div class="card mb-3">
								<div class="card-header <?= ($r->usuario_id == $ticket->usuario_id) ? "bg-info text-white" : "bg-secondary text-white" ?>">
									<?= ($r->usuario_id == $ticket->usuario_id) ? 'Você - ' : 'Atendente - ' ?><?= $r->nome ?>
								</div>
								<div class="card-body">
									<?= $r->descricao ?>
									<?php 
									$ticket_files_responses = $this->tickets_model->get_ticket_files_responses($ticket->ticketid, $r->id)->result();
									if(count($ticket_files_responses) > 0) : ?>
										<p><br/><b>Anexos: </b></p>
										<small>
											<table class="table table-sm table-striped table-hover">
												<thead>
													<tr>
														<th scope="col">Arquivo</th>
														<th scope="col">Tamanho</th>
														<th scope="col">Tipo</th>
														<th scope="col">Anexado em</th>
														<th scope="col">Ação</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($ticket_files_responses as $f) : ?>
														<tr>
															<td scope="row"><?= $f->nome_origem ?></th>
																<td><?= $f->tamanho ?> Kb</td>
																<td><?= $f->tipo_arquivo ?></td>
																<td><?= date('d/m/Y H:i:s', $f->data_criacao_timestamp) ?></td>
																<td><a <?= ( substr($f->tipo_arquivo, 0, 5) == "image") ? 'data-lightbox="group-'.$contResp.' data-title="'. $f->nome_origem .'"' : 'target="_blank"'; ?> href="<?= base_url("uploads/tickets/{$ticket->ticketid}/$f->nome_hash") ?>" class="btn btn-default btn-sm" data-toggle="tooltip" title="Visualizar"><i class="fas fa-eye"></i></a></td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</small>
										<?php endif; ?>
										<small>Postado em: <?= date('d/m/Y H:i:s', $r->data_criacao_timestamp) ?></small>
									</div>
								</div>
								<?php 
								$contResp++;
							endforeach; ?>
							<?php if($ticket->escopo != 3) : ?>
								<div class="card">
									<div class="card-body">
										<form action="<?= base_url("client/ticket_reply_pro") ?>" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="id" value="<?= $ticket->ticketid ?>">
											<h5 class="card-title">Responder Ticket</h5>
											<p class="card-text"><textarea id="ticket-body" name="descricao"></textarea></p>
											<p class="card-text"><input type="file" class="form-control-file" multiple="multiple" name="files[]" accept="image/*, application/pdf"></p>
											<button type="submit" class="btn btn-success btn-block">Responder</button>
										</form>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-4">
							<div class="card">
								<div class="card-body">
									<h5><p><b>Detalhes do ticket</b></p></h5>
									<hr/>
									<p><b>Data de criação: </b><?= date('d/m/Y H:i:s',$ticket->data_criacao_timestamp) ?></p>
									<p><b>Departamento: </b><?= $ticket->departamento_nome ?></p>
										<p><b>Status: </b><?= $ticket->status_nome ?></p></p>
												<br/>
												<h5><p><b>Dados do cliente</b></p></h5>
												<hr/>
												<p><b>Cliente: </b><?= $ticket->nome ?></p>
												<p><b>CPF: </b><?= $this->common->mask($ticket->cpf, "###.###.###-##") ?></p>
												<p><b>E-mail: </b><?= $ticket->email ?></p>
												<p><b>Fone: </b><?= (strlen($ticket->fone) == 11) ? $this->common->mask($ticket->fone, "## # ####-####") : $this->common->mask($ticket->fone, "## ####-####") ?></p>
												<p><b>Logradouro: </b><?= $ticket->logradouro ?>, <?= $ticket->numero ?></p>
												<p><b>Bairro: </b><?= $ticket->bairro ?></p>
												<p><b>Complemento: </b><?= $ticket->complemento ?></p>
												<p><b>Cidade / UF: </b><?= $ticket->cidade ?> / <?= $ticket->uf ?></p>
												<p><b>CEP: </b><?= $this->common->mask($ticket->cep, "##.###-###") ?></p>
											</div>
										</div>
									</div>
								</div>

							</div>
						</main>
						<script src="//cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
						<script type="text/javascript" src="https://cdn.ckeditor.com/4.9.1/standard/lang/pt-br.js?t=I2QI"></script>
						<script type="text/javascript" src="https://cdn.ckeditor.com/4.9.1/standard/styles.js?t=I2QI"></script>
						<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
						<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
						<script type="text/javascript">
							CKEDITOR.replace('ticket-body');
						</script>