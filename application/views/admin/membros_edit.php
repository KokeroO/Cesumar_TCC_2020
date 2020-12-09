  <p><h3>Acessos</h3></p>
  <input type="hidden" name="id" value="<?= $membros->id ?>"/>
  <div class="form-row">
    <div class="col-md-5">
      <div class="form-group">
        <label class="mb-1" for="ativo">Ativo:</label>
        <input id="ativo" name="ativo" type="checkbox" <?= ($membros->ativo) ? 'checked' : '' ?> value="1" />
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label class="mb-1" for="atendente">Atendente:</label>
        <input id="atendente" name="atendente" type="checkbox" <?= ($membros->atendente) ? 'checked' : '' ?> value="1" />
      </div>
    </div>
  </div>
  <p><h3>Dados pessoais</h3></p>
  <hr/>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Nome:</label>
  	<input type="text" class="form-control" id="nome" name="nome" value="<?= $membros->nome ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">CPF:</label>
  	<input type="text" class="form-control" id="cpf" name="cpf" disabled value="<?= $this->common->mask($membros->cpf, '###.###.###-##') ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">E-mail:</label>
  	<input type="text" class="form-control" id="email" name="email" disabled value="<?= $membros->email ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Telefone:</label>
  	<input type="text" class="form-control" id="telefone" name="telefone" value="<?= $membros->fone ?>">
  </div>
  <hr/>
  <p><h3>Endereço</h3></p>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Logradouro:</label>
  	<input type="text" class="form-control" id="logradouro" name="logradouro" value="<?= $membros_endereco->logradouro ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Número:</label>
  	<input type="text" class="form-control" id="numero" name="numero" value="<?= $membros_endereco->numero ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Bairro:</label>
  	<input type="text" class="form-control" id="bairro" name="bairro" value="<?= $membros_endereco->bairro ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Complemento:</label>
  	<input type="text" class="form-control" id="complemento" name="complemento" value="<?= $membros_endereco->complemento ?>">
  </div>
  <div class="form-row">
  	<div class="col-md-5">
  		<div class="form-group">
  			<label class="small mb-1" for="cidade">Cidade*</label>
  			<input class="form-control" id="cidade" name="cidade" type="text" value="<?= $membros_endereco->cidade ?>" />
  		</div>
  	</div>
  	<div class="col-md-4">
  		<div class="form-group">
  			<label class="small mb-1" for="UF">UF*</label>
  			<select class="form-control" id="UF" name="UF">
  				<option value="AC" <?= ($membros_endereco->uf == 'AC') ? 'selected' : '' ?>>Acre</option>
  				<option value="AL" <?= ($membros_endereco->uf == 'AL') ? 'selected' : '' ?>>Alagoas</option>
  				<option value="AP" <?= ($membros_endereco->uf == 'AP') ? 'selected' : '' ?>>Amapá</option>
  				<option value="AM" <?= ($membros_endereco->uf == 'AM') ? 'selected' : '' ?>>Amazonas</option>
  				<option value="BA" <?= ($membros_endereco->uf == 'BA') ? 'selected' : '' ?>>Bahia</option>
  				<option value="CE" <?= ($membros_endereco->uf == 'CE') ? 'selected' : '' ?>>Ceará</option>
  				<option value="DF" <?= ($membros_endereco->uf == 'DF') ? 'selected' : '' ?>>Distrito Federal</option>
  				<option value="ES" <?= ($membros_endereco->uf == 'ES') ? 'selected' : '' ?>>Espírito Santo</option>
  				<option value="GO" <?= ($membros_endereco->uf == 'GO') ? 'selected' : '' ?>>Goiás</option>
  				<option value="MA" <?= ($membros_endereco->uf == 'MA') ? 'selected' : '' ?>>Maranhão</option>
  				<option value="MT" <?= ($membros_endereco->uf == 'MT') ? 'selected' : '' ?>>Mato Grosso</option>
  				<option value="MS" <?= ($membros_endereco->uf == 'MS') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
  				<option value="MG" <?= ($membros_endereco->uf == 'MG') ? 'selected' : '' ?>>Minas Gerais</option>
  				<option value="PA" <?= ($membros_endereco->uf == 'PA') ? 'selected' : '' ?>>Pará</option>
  				<option value="PB" <?= ($membros_endereco->uf == 'PB') ? 'selected' : '' ?>>Paraíba</option>
  				<option value="PR" <?= ($membros_endereco->uf == 'PR') ? 'selected' : '' ?>>Paraná</option>
  				<option value="PE" <?= ($membros_endereco->uf == 'PE') ? 'selected' : '' ?>>Pernambuco</option>
  				<option value="PI" <?= ($membros_endereco->uf == 'PI') ? 'selected' : '' ?>>Piauí</option>
  				<option value="RJ" <?= ($membros_endereco->uf == 'RJ') ? 'selected' : '' ?>>Rio de Janeiro</option>
  				<option value="RN" <?= ($membros_endereco->uf == 'RN') ? 'selected' : '' ?>>Rio Grande do Norte</option>
  				<option value="RS" <?= ($membros_endereco->uf == 'RS') ? 'selected' : '' ?>>Rio Grande do Sul</option>
  				<option value="RO" <?= ($membros_endereco->uf == 'RO') ? 'selected' : '' ?>>Rondônia</option>
  				<option value="RR" <?= ($membros_endereco->uf == 'RR') ? 'selected' : '' ?>>Roraima</option>
  				<option value="SC" <?= ($membros_endereco->uf == 'SC') ? 'selected' : '' ?>>Santa Catarina</option>
  				<option value="SP" <?= ($membros_endereco->uf == 'SP') ? 'selected' : '' ?>>São Paulo</option>
  				<option value="SE" <?= ($membros_endereco->uf == 'SE') ? 'selected' : '' ?>>Sergipe</option>
  				<option value="TO" <?= ($membros_endereco->uf == 'TO') ? 'selected' : '' ?>>Tocantins</option>
  			</select>
  		</div>
  	</div>
  	<div class="col-md-3">
  		<div class="form-group">
  			<label class="small mb-1" for="CEP">CEP*</label>
  			<input class="form-control" id="CEP" name="CEP" type="text" value="<?= $membros_endereco->cep ?>" />
  		</div>
  	</div>
  </div>
  <script type="text/javascript">
  	$('#telefone').mask("(99) 9 9999-999?9")
  	.focusout(function (event) {  
  		var target, phone, element;  
  		target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
  		phone = target.value.replace(/\D/g, '');
  		element = $(target);  
  		element.unmask();  
  		if(phone.length > 10) {  
  			element.mask("(99) 9 9999-999?9");  
  		} else {  
  			element.mask("(99) 9999-9999?9");  
  		}
  	});
  	$('#CPF').mask('999.999.999-99');
    $('#CEP').mask('99.999-999');
  </script>