<main>
    <div class="container-fluid">
        <h1 class="mt-4"><i class="fas fa-user-tag"></i>&ensp;Meus dados</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Meus dados</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <div class="ml-auto">
                    <span data-toggle="tooltip" data-placement="bottom" title="Editar">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modalUsuario" onclick="javascript:editarUsuario(<?=$this->session->userdata('id')?>)"><i class="fas fa-edit"></i>&ensp;Alterar</button>
                    </span>
                    <span data-toggle="tooltip" data-placement="bottom" title="Alterar senha">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modalSenha"><i class="fas fa-key"></i>&ensp;Alterar Senha</button>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <p><h3>Dados pessoais</h3></p>
                <p><b>Nome:</b>&ensp;<?=$user->nome?></p>
                <p><b>CPF:</b>&ensp;<?=$this->common->mask($user->cpf, '###.###.###-##')?></p>
                <p><b>E-mail:</b>&ensp;<?=$user->email?></p>
                <p><b>Telefone:</b>&ensp;<?=(strlen($user->fone) == 11) ? $this->common->mask($user->fone, '## # ####-####') : $this->common->mask($user->fone, '## ####-####') ?></p>
                <p><b>Situação:</b>&ensp;<?= ($user->ativo) ? 'Ativo' : 'Desativado'?></p>
                <p><b>Data criação:</b>&ensp;<?=date('d/m/Y H:i:s',$user->data_criacao_timestamp)?></p>
                <hr/>
                <p><h3>Endereço</h3></p>
                <p><b>Logradouro:</b>&ensp;<?=$user_endereco->logradouro?></p>
                <p><b>Número:</b>&ensp;<?=$user_endereco->numero?></p>
                <p><b>Bairro:</b>&ensp;<?=$user_endereco->bairro?></p>
                <p><b>Complemento:</b>&ensp;<?=$user_endereco->complemento?></p>
                <p><b>Cidade / UF:</b>&ensp;<?=$user_endereco->cidade . ' / ' . $user_endereco->uf?></p>
                <p><b>CEP:</b>&ensp;<?=$this->common->mask($user_endereco->cep, '##.###-###')?></p>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalDepartamentosLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="<?= base_url('profile/user_edit_pro') ?>" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar meus dados</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal-body-usuario">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
</div>
</div>
<div class="modal fade" id="modalSenha" tabindex="-1" aria-labelledby="modalDepartamentosLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="formRegister" action="<?= base_url('profile/edit_password_pro') ?>" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alterar senha</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal-body">
            <div class="form-group">
                <label for="nome" class="col-form-label">Senha atual:</label>
                <input type="password" class="form-control" id="senhaAntiga" name="senhaAntiga">
            </div>
            <div class="form-group">
                <label for="nome" class="col-form-label">Nova senha:</label>
                <input type="password" class="form-control" id="novaSenha" name="novaSenha">
            </div>
            <div class="form-group">
                <label for="nome" class="col-form-label">Confirmar nova senha:</label>
                <input type="password" class="form-control" id="novaSenha2" name="novaSenha2">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
</div>
</div>
<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js') ?>"></script>
<script type="text/javascript">
    function editarUsuario(id) {
        $("#modal-body-usuario").load('<?= base_url('profile/user_edit/') ?>' + id);
    }
        $(document).ready(function() {
        $('#usuario').focus();
        $("#formRegister").validate({
            rules: {
                senhaAntiga: {
                    required: true
                },
                novaSenha: {
                    required: true,
                    equalTo : '[name="novaSenha2"]',
                    minlength: 6,
                    maxlength: 16
                },
                novaSenha2: {
                    required: true,
                    equalTo : '[name="novaSenha"]',
                    minlength: 6,
                    maxlength: 16
                }
            },
            messages: {
                senhaAntiga: {
                    required: 'Obrigatório'
                },
                novaSenha: {
                    required: 'Obrigatório',
                    equalTo : 'As senhas não coicidem',
                    minlength: 'A senha deve ter entre 6 e 16 caracteres',
                    maxlength: 'A senha deve ter entre 6 e 16 caracteres'
                },
                novaSenha2: {
                    required: 'Obrigatório',
                    equalTo : 'As senhas não coicidem',
                    minlength: 'A senha deve ter entre 6 e 16 caracteres',
                    maxlength: 'A senha deve ter entre 6 e 16 caracteres'
                }
            },
            submitHandler: function(form) {
                form.submit();
            },
            errorClass: "text-danger",
            errorElement: "span"
        });

    });
</script>