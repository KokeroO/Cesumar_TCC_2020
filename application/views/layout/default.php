<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $this->configs->info->nome_site ?></title>
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url() ?>"><?= $this->configs->info->nome_logo ?></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 <?= (!$this->session->userdata('atendente')) ? 'd-none' : '' ?>" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= (isset($activeLink['user'])) ? "active" : "" ?>" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= base_url('profile') ?>">Meus dados</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('login/sair') ?>">Sair</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <?php if($this->session->userdata('atendente')) : ?>
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link <?= (isset($activeLink['dashboard'])) ? "active" : "" ?>" href="<?= base_url() ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                                Painel
                            </a>
                            <a class="nav-link <?= (isset($activeLink['tickets'])) ? "active" : "" ?>" href="<?= base_url('tickets') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-ticket-alt"></i></div>
                                Tickets
                            </a>
                            <?php if ($this->session->userdata('atendente')) { ?>
                                <a class="nav-link <?= (isset($activeLink['admin']['membros'])) ? "active" : "" ?>" href="<?= base_url('admin/membros') ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Gerenciar membros
                                </a>
                                <a class="nav-link <?= (isset($activeLink['admin'])) ? "active" : "collapsed" ?>" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                    Configurações
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?= (isset($activeLink['admin'])) ? "show" : "" ?>" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link <?= (isset($activeLink['admin']['configs'])) ? "active" : "" ?>" href="<?= base_url('admin/configuracoes') ?>">Configurações gerais</a>
                                        <a class="nav-link <?= (isset($activeLink['admin']['depart'])) ? "active" : "" ?>" href="<?= base_url('admin/departamentos') ?>">Departamentos</a>
                                        <a class="nav-link <?= (isset($activeLink['admin']['status'])) ? "active" : "" ?>" href="<?= base_url('admin/status') ?>">Status</a>
                                    </nav>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </nav>
            </div>
        <?php endif; ?>
        <div id="layoutSidenav_content">
            <?php if($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Erro!</strong> <?= $this->session->flashdata('error') ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php }
        if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Sucesso! </strong> <?= $this->session->flashdata('success') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <?= $content ?>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">HelpDesk - TCC Cesumar 2020</div>
            </div>
        </div>
    </footer>
</div>
</div>
<script src="<?= base_url('assets/js/scripts.js'); ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){ $('.alert-dismissible').alert('close') }, 5000);
    });
    $('[data-toggle="tooltip"]').tooltip();
</script>
</body>
</html>
