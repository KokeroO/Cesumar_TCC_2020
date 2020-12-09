        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><?= $this->configs->info->nome_logo ?></h3></div>
                                    <div class="card-body">
                                        <?= $this->session->flashdata('success'); ?>
                                        <?= $this->session->flashdata('error'); ?>
                                        <form id="formLogin" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="usuario">Usuário</label>
                                                <input class="form-control py-4" id="usuario" name="usuario" type="text" placeholder="CPF / E-mail" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Senha</label>
                                                <input class="form-control py-4" id="password" name="password" type="password" placeholder="" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="<?= base_url('login/forgotPassword')?>">Esqueceu a senha?</a>
                                                <button class="btn btn-primary" id="btn-acessar">Entrar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="d-none progress" id="progress-acessar">
                                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                      </div>
                                      <div class="small"><a href="<?= base_url('login/register')?>"> Usuário novo? Cadastre-se.</a></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </main>
          </div>
      </div>
      <div class="modal" id="myModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><?= $this->configs->info->nome_logo ?> - Erro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <p id="message"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
        </div>
    </div>
</div>
</div>
<script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#usuario').focus();
        $("#formLogin").validate({
            rules: {
                usuario: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                usuario: {
                    required: 'Campo Requerido.'
                },
                password: {
                    required: 'Campo Requerido.'
                }
            },
            submitHandler: function(form) {
                var dados = $(form).serialize();
                $('#btn-acessar').addClass('disabled');
                $('#progress-acessar').removeClass('d-none');

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('login/verificarLogin?ajax=true'); ?>",
                    data: dados,
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == true) {
                            if (data.atendente == '1') {
                                window.location.href = "<?= site_url('admin'); ?>";
                            }else{
                                window.location.href = "<?= site_url('client'); ?>";
                            }
                        } else {
                            $('#btn-acessar').removeClass('disabled');
                            $('#progress-acessar').addClass('d-none');

                            $('#message').text(data.message || 'Os dados de acesso estão incorretos, por favor tente novamente!');
                            $('#myModal').modal('show')
                        }
                    }
                });

                return false;
            },

            errorClass: "text-danger",
            errorElement: "span"
        });

    });
</script>