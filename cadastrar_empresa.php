<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/empresa_insert.php">

		<label for="razaosocial">* Razão Social</label>
		<input type="text" class="form-control" name="razaosocial" id="razaosocial" placeholder="" required>
		<div class="invalid-feedback">
			Insira um razão social válido.
		</div>
		<label for="nomefantasia">* Nome Fantasia</label>
		<input type="text" class="form-control" name="nomefantasia" id="nomefantasia" placeholder="" required>
		<div class="invalid-feedback">
			Insira um nome fantasia válido.
		</div>
		<label for="telefone">* Telefone</label>
		<input type="tel" class="form-control phone" name="telefone" id="telefone" maxlength="15" placeholder="" required>
		<div class="invalid-feedback">
			Insira um telefone válido.
		</div>
		<label for="cnpj">CNPJ</label>
		<input type="cnpj" class="form-control cnpj" name="cnpj" id="cnpj" maxlength="15" placeholder="" >
		<div class="invalid-feedback">
			Insira um CNPJ válido.
		</div>
		<div class="mb-3">
			<label for="email">Email </label>
			<input type="email" class="form-control" name="email" id="email" placeholder="modelo: email@email.com">
			<div class="invalid-feedback">
				Insira um email válido.
			</div>
		</div>
		<hr class="mb-4">
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success" value="salvar" name="botaoSalvar">Salvar</button>
		</div>
	</form>
</div>
