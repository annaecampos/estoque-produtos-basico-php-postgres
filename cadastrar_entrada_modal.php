<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/entrada_insert.php">
		<label for="nfe">* Número Nota Fiscal </label>
		<input type="text" class="form-control" name="nfe" id="nfe" placeholder="" required>
		<div class="invalid-feedback">
			Insira um número válido.
		</div>
		<label for="linksei">* Link do Sei</label>
		<input type="text" class="form-control" name="linksei" id="linksei" placeholder="" required>
		<div class="invalid-feedback">
			Insira um link válido.
		</div>

		<label for="data">* Data entrada</label>
		<input type="date" class="form-control date" name="data" id="data" placeholder="" required>

		<div class="invalid-feedback">
			Insira uma data de entrada válida.
		</div>

		<label for="observacao">Observação</label>
		<input type="text" class="form-control" name="observacao" id="observacao" placeholder="" >

		<hr class="mb-4">
		<button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoSalvar"><i class="ion ion-md-save"></i> Salvar</button>
	</form>
</div>
