  <p><h3>Dados pessoais</h3></p>
  <input type="hidden" name="id" value="<?= $user->id ?>"/>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Nome:</label>
  	<input type="text" class="form-control" id="nome" name="nome" value="<?= $user->nome ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">CPF:</label>
  	<input type="text" class="form-control" id="cpf" name="cpf" disabled value="<?= $this->common->mask($user->cpf, '###.###.###-##') ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">E-mail:</label>
  	<input type="text" class="form-control" id="email" name="email" disabled value="<?= $user->email ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Telefone:</label>
  	<input type="text" class="form-control" id="telefone" name="telefone" value="<?= $user->fone ?>">
  </div>
  <hr/>
  <p><h3>Endereço</h3></p>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Logradouro:</label>
  	<input type="text" class="form-control" id="logradouro" name="logradouro" value="<?= $user_endereco->logradouro ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Número:</label>
  	<input type="text" class="form-control" id="numero" name="numero" value="<?= $user_endereco->numero ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Bairro:</label>
  	<input type="text" class="form-control" id="bairro" name="bairro" value="<?= $user_endereco->bairro ?>">
  </div>
  <div class="form-group">
  	<label for="nome" class="col-form-label">Complemento:</label>
  	<input type="text" class="form-control" id="complemento" name="complemento" value="<?= $user_endereco->complemento ?>">
  </div>
  <div class="form-row">
  	<div class="col-md-5">
  		<div class="form-group">
  			<label class="small mb-1" for="cidade">Cidade*</label>
  			<input class="form-control" id="cidade" name="cidade" type="text" value="<?= $user_endereco->cidade ?>" />
  		</div>
  	</div>
  	<div class="col-md-4">
  		<div class="form-group">
  			<label class="small mb-1" for="UF">UF*</label>
  			<select class="form-control" id="UF" name="UF">
  				<option value="AC" <?= ($user_endereco->uf == 'AC') ? 'selected' : '' ?>>Acre</option>
  				<option value="AL" <?= ($user_endereco->uf == 'AL') ? 'selected' : '' ?>>Alagoas</option>
  				<option value="AP" <?= ($user_endereco->uf == 'AP') ? 'selected' : '' ?>>Amapá</option>
  				<option value="AM" <?= ($user_endereco->uf == 'AM') ? 'selected' : '' ?>>Amazonas</option>
  				<option value="BA" <?= ($user_endereco->uf == 'BA') ? 'selected' : '' ?>>Bahia</option>
  				<option value="CE" <?= ($user_endereco->uf == 'CE') ? 'selected' : '' ?>>Ceará</option>
  				<option value="DF" <?= ($user_endereco->uf == 'DF') ? 'selected' : '' ?>>Distrito Federal</option>
  				<option value="ES" <?= ($user_endereco->uf == 'ES') ? 'selected' : '' ?>>Espírito Santo</option>
  				<option value="GO" <?= ($user_endereco->uf == 'GO') ? 'selected' : '' ?>>Goiás</option>
  				<option value="MA" <?= ($user_endereco->uf == 'MA') ? 'selected' : '' ?>>Maranhão</option>
  				<option value="MT" <?= ($user_endereco->uf == 'MT') ? 'selected' : '' ?>>Mato Grosso</option>
  				<option value="MS" <?= ($user_endereco->uf == 'MS') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
  				<option value="MG" <?= ($user_endereco->uf == 'MG') ? 'selected' : '' ?>>Minas Gerais</option>
  				<option value="PA" <?= ($user_endereco->uf == 'PA') ? 'selected' : '' ?>>Pará</option>
  				<option value="PB" <?= ($user_endereco->uf == 'PB') ? 'selected' : '' ?>>Paraíba</option>
  				<option value="PR" <?= ($user_endereco->uf == 'PR') ? 'selected' : '' ?>>Paraná</option>
  				<option value="PE" <?= ($user_endereco->uf == 'PE') ? 'selected' : '' ?>>Pernambuco</option>
  				<option value="PI" <?= ($user_endereco->uf == 'PI') ? 'selected' : '' ?>>Piauí</option>
  				<option value="RJ" <?= ($user_endereco->uf == 'RJ') ? 'selected' : '' ?>>Rio de Janeiro</option>
  				<option value="RN" <?= ($user_endereco->uf == 'RN') ? 'selected' : '' ?>>Rio Grande do Norte</option>
  				<option value="RS" <?= ($user_endereco->uf == 'RS') ? 'selected' : '' ?>>Rio Grande do Sul</option>
  				<option value="RO" <?= ($user_endereco->uf == 'RO') ? 'selected' : '' ?>>Rondônia</option>
  				<option value="RR" <?= ($user_endereco->uf == 'RR') ? 'selected' : '' ?>>Roraima</option>
  				<option value="SC" <?= ($user_endereco->uf == 'SC') ? 'selected' : '' ?>>Santa Catarina</option>
  				<option value="SP" <?= ($user_endereco->uf == 'SP') ? 'selected' : '' ?>>São Paulo</option>
  				<option value="SE" <?= ($user_endereco->uf == 'SE') ? 'selected' : '' ?>>Sergipe</option>
  				<option value="TO" <?= ($user_endereco->uf == 'TO') ? 'selected' : '' ?>>Tocantins</option>
  			</select>
  		</div>
  	</div>
  	<div class="col-md-3">
  		<div class="form-group">
  			<label class="small mb-1" for="CEP">CEP*</label>
  			<input class="form-control" id="CEP" name="CEP" type="text" value="<?= $user_endereco->cep ?>" />
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