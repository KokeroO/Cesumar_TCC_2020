  <?= (isset($status->id)) ? '<input type="hidden" name="id" value="'.$status->id.'"/>' : ''; ?>
  <div class="form-group">
    <label for="nome" class="col-form-label">Nome:</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?= (isset($status->nome)) ? $status->nome : '' ?>">
  </div>
  <div class="form-group">
    <label for="defaultCheck" class="col-form-label">Escopo:</label>
    <div class="form-check">
      <?php if(isset($status->escopo)){
        $escopo = $status->escopo;
      }else{
        $escopo = 1;
      } ?>
      <input class="form-check-input" type="radio" name="escopo" value="1" id="defaultCheck1" <?= ($escopo == 1) ? 'checked' : '' ?>>
      <label class="form-check-label" for="defaultCheck1">
        Aberto
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="escopo" value="2" id="defaultCheck2" <?= ($escopo == 2) ? 'checked' : '' ?>>
      <label class="form-check-label" for="defaultCheck2">
        Em atendimento
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="escopo" value="3" id="defaultCheck3" <?= ($escopo == 3) ? 'checked' : '' ?>>
      <label class="form-check-label" for="defaultCheck3">
        Fechado
      </label>
    </div>
  </div>