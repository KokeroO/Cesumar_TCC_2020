<main>
    <div class="container-fluid">
        <h1 class="mt-4"><i class="fas fa-network-wired"></i>&ensp;Departamentos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
            <li class="breadcrumb-item active">Departamentos</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <div class="ml-auto"><span data-toggle="tooltip" data-placement="bottom" title="Editar"><button class="btn btn-success" data-toggle="modal" data-target="#modalDepartamentos" onclick="javascript:editarStatus(0)"><i class="fas fa-plus"></i>&ensp;Adicionar</button></span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Data criação</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="modalDepartamentos" tabindex="-1" aria-labelledby="modalDepartamentosLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="<?= base_url('admin/departamentos_pro') ?>" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar / Editar Departamento</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="modal-body-departamentos">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "processing": true,
            "pagingType" : "full_numbers",
            "pageLength" : 20,
            "serverSide": true,
            "orderMulti": false,
            "responsive": false,
            lengthMenu: [
            [ 10, 20, 50, 100, -1 ],
            [ '10', '20', '50', '100', 'Mostrar tudo' ]
            ],
            "columnDefs": [
            { 
                "targets": [2,3],
                "orderable": false
            }
            ],
            "columns": [
            { "width": "5%" },
            null,
            { "width": "20%" },
            { "class": "text-center", "width": "10%" }
            ],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Mostrar _MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar: ",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                buttons: {
                    copy: 'Copiar',
                    print: 'Imprimir',
                    copyTitle: 'Copiado para área de transferência',
                    copyKeys: 'Pressione <i>ctrl</i> ou <i>\u2318</i> + <i>C</i>  para copiar os dados da tabela para a área de transferência. <br><br>Para cancelar, clique sobre esta mensagem ou pressione Esc.',
                    copySuccess: {
                        _: '%d linhas copiadas',
                        1: '1 linha copiada'
                    }
                },
                select: {
                    rows: {
                        _: "%d linhas selecionadas",
                        0: "",
                        1: "Uma linha selecionada"
                    }
                }
            },
            "ajax": {
                url : "<?php echo site_url("admin/departamentos_page") ?>",
                type : 'POST',
                data : function ( d ) {
                }
            },
            "drawCallback": function(settings, json) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });

    function editarStatus(id) {
        $("#modal-body-departamentos").load('<?= base_url('admin/departamentos_add_edit/') ?>' + id);
    }

</script>