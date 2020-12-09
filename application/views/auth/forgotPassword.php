<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Recuperar senha</h3></div>
                            <div class="card-body">
                                <div class="small mb-3 text-muted">Forneça seu email e será enviado uma nova senha para o email.</div>
                                <form action="<?= base_url('login/forgotPassword_pro') ?>" method="post">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="email" name="email" aria-describedby="emailHelp" placeholder="example@example.com.br" />
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="<?= base_url('login') ?>">Logar</a>
                                        <button type="submit" class="btn btn-primary">Resetar senha</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="<?= base_url('login/register') ?>"> Usuário novo? Cadastre-se.</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>