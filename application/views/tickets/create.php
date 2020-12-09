    <div class="form-group">
      <label for="usuario" class="col-form-label">Usuário*:</label>
      <input type="text" class="form-control" id="usuario" required="required">
      <input type="hidden" class="form-control" id="usuarioid" name="usuarioid" required="required">
    </div>
    <div class="form-group">
      <label for="assunto" class="col-form-label">Departamento*:</label>
      <select class="form-control" required="required" name="departamento">
        <?php foreach ($departamentos as $d) : ?>
          <option value="<?= $d->id ?>"><?= $d->nome ?></option>
        <?php endforeach; ?>
      </select></p>
    </div>
    <div class="form-group">
      <label for="assunto" class="col-form-label">Assunto*:</label>
      <input type="text" class="form-control" id="assunto" name="assunto" required="required">
    </div>
    <div class="form-group">
      <label for="descricao" class="col-form-label">Descrição*:</label>
      <textarea class="form-control" id="ticket-descricao" name="descricao" required></textarea>
    </div>
    <div class="form-group">
      <label for="descricao" class="col-form-label">Anexos:</label><input type="file" class="form-control-file" multiple="multiple" name="files[]" accept="image/*, application/pdf">
    </div>
    <script type="text/javascript">
      $(document).ready(function() { 
        $('#usuario').autocomplete({
          delay : 300,
          minLength: 2,
          source: function (request, response) {
           $.ajax({
             type: "POST",
             url: "<?= base_url('admin/search_usuario') ?>",
             data: {
              query : request.term
            },
            dataType: 'JSON',
            success: function (msg) {
              response($.map(msg, function (value, key) {
                return {
                  label: value.value,
                  value: value.value,
                  key: value.key
                }
              }));
            }
          });
         },
         select: function( event, ui ) {
          $('#usuarioid').val(ui.item.key);
        }
      });  
      });
      CKEDITOR.replace('ticket-descricao');
    </script>
    <style type="text/css">
      .ui-autocomplete{
       z-index: 1050 !important;
     }
   </style>