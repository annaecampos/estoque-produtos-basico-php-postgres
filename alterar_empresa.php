<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/empresa_update.php">
		<input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $id; ?>" required>
		<label for="razaosocial">Razão Social</label>
		<input type="text" class="form-control" name="razaosocial" id="razaosocial" placeholder="" value="<?php echo $campoalterar[0]['razaosocial'] ?>" required>
		<div class="invalid-feedback">
			Insira uma razão social válida.
		</div>
		<label for="nomefantasia">Nome Fantasia</label>
		<input type="text" class="form-control" name="nomefantasia" id="nomefantasia" placeholder="" value="<?php echo $campoalterar[0]['nomefantasia'] ?>" required>
		<div class="invalid-feedback">
			Insira um nome fantasia válido.
		</div>
		<label for="telefone">Telefone</label>
		<input type="text" class="form-control phone" name="telefone" id="telefone" maxlength="13" placeholder="" value="<?php echo $campoalterar[0]['telefone'] ?>" required>
		<div class="invalid-feedback">
			Insira um telefone válido.
		</div>
		<label for="cnpj">CNPJ</label>
		<input type="tel" class="form-control cnpj" name="cnpj" id="cnpj" maxlength="15" placeholder="" value="<?php echo $campoalterar[0]['cnpj'] ?>">
		<div class="invalid-feedback">
			Insira um CNPJ válido.
		</div>
		<div class="mb-3">
			<label for="email">Email </label>
			<input type="email" class="form-control" name="email" id="email" placeholder="email@email.com" value="<?php echo $campoalterar[0]['email']?>">
			<div class="invalid-feedback">
				Insira um email válido.
			</div>
		</div>

		<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
	</form>
</div>
