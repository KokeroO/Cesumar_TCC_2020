<main>
    <div class="container-fluid">
        <h1 class="mt-4"><i class="fas fa-users"></i>&ensp;Configurações</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
            <li class="breadcrumb-item active">Configurações</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form action="<?= base_url('admin/configuracoes_pro') ?>" method="POST">
                    <div class="form-group">
                        <label for="nome_site">Nome do Site:</label>
                        <input type="text" class="form-control" id="nome_site" name="nome_site" aria-describedby="nomeSite" value="<?= $configuracoes->nome_site ?>">
                        <small id="nomeSite" class="form-text text-muted">Define o nome do site.</small>
                    </div>
                    <div class="form-group">
                        <label for="nome_logo">Logo do sistema:</label>
                        <input type="text" class="form-control" id="nome_logo" name="nome_logo" aria-describedby="nomLogo" maxlength="12" value="<?= $configuracoes->nome_logo ?>">
                        <small id="nomLogo" class="form-text text-muted">Define o logo que será usado no sistema.</small>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail de envio</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="<?= $configuracoes->email ?>">
                        <small id="email" class="form-text text-muted">Define o e-mail que será utilizado para enviar notificações ao usuarios.</small>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição do sistema:</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" aria-describedby="descricao" value="<?= $configuracoes->descricao_site ?>">
                        <small id="descricao" class="form-text text-muted">Breve descrição do sistema.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</main>