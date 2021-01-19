 
  
  <div class="modal-body">
  	<form class="needs-validation" method="POST" novalidate action="classes/servidor_insert.php">
  		<label for="nome">* Nome</label>
  		<input type="text" class="form-control" name="nome" id="nome" placeholder="" required>
  		<div class="invalid-feedback">
  			Insira um nome válido.
  		</div>

  		<label for="telefone">* Telefone</label>
  		<input type="tel" class="form-control phone" name="telefone" id="telefone" maxlength="15" placeholder="" required>
  		<div class="invalid-feedback">
  			Insira um telefone válido.
  		</div>
  		<label for="cpf">CPF</label>
  		<input type="cpf" class="form-control cpf" name="cpf" id="cpf" maxlength="15" placeholder="" >
  		<div class="invalid-feedback">
  			Insira um CPF válido.
  		</div>
  		<div class="mb-3">
  			<label for="email">Email </label>
  			<input type="email" class="form-control" name="email" id="email" placeholder="modelo: email@email.com">
  			<div class="invalid-feedback">
  				Insira um email válido.
  			</div>
  		</div>
  		<label for="setor">* Setor</label>
  		<select class="form-control" name="idsetor" required>
  			<?php

  			$optSetor = "";
  			$i = 0;
  			while ($i < count($combo))
  			{
  				$id = $combo[$i]['id'];
  				$nome = $combo[$i]['nome'];

  				if($id == $item['idsetor'])
  				{
  					$optSetor = $optSetor. "<option value='$id' selected>$nome</option>";
  				}
  				else
  				{
  					$optSetor = $optSetor. "<option value='$id'>$nome</option>";
  				}
  				$i++;
  			}
  			?>
  			<option value="">selecione..</option>
  			<?php echo $optSetor; ?>
  		</select>
  		<div class="invalid-feedback">
  			Selecione um setor.
  		</div>

  		<hr class="mb-4">
  		<div class="custom-control custom-checkbox">
  			<input type="checkbox" class="custom-control-input" id="same-address" name="check">
  			<label class="custom-control-label" for="same-address">Essa pessoa será usuário do sistema.</label>
  		</div>

  		<div name="divMostrar" style="display:none">
  			<hr class="mb-4">
  			<div class="mb-3">
  				<label for="login">* Login </label>
  				<input type="text" class="form-control" name="login" id="login" <?php echo $required ?>> 
  				<div class="invalid-feedback">
  					Insira um login.
  				</div>
  			</div>
  			<div class="mb-3">
  				<label for="login">* Senha </label>
  				<input type="password" class="form-control" name="senha" id="senha" <?php echo $required ?>>
  				<div class="invalid-feedback">
  					Insira uma senha válida.
  				</div>
  			</div>
  		</div>
  		<div class="modal-footer">
  			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
  			<button type="submit" class="btn btn-success" value="salvar" name="botaoSalvar">Salvar</button>
  		</div>
  	</form>
  </div>