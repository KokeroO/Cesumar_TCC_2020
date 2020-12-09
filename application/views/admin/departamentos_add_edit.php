  <?= (isset($departamentos->id)) ? '<input type="hidden" name="id" value="'.$departamentos->id.'"/>' : ''; ?>
  <div class="form-group">
    <label for="nome" class="col-form-label">Nome:</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?= (isset($departamentos->nome)) ? $departamentos->nome : '' ?>">
  </div>