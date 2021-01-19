<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/entrada_update.php">
		<input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $id; ?>" required>

		<label for="nfe">* Número Nota Fiscal </label>
		<input type="text" class="form-control" name="nfe" id="nfe" placeholder="" value="<?php echo $campo[0]['nfe'] ?>" required>
		<div class="invalid-feedback">
			Insira um número válido.
		</div>
		<label for="linksei">* Link do Sei</label>
		<input type="text" class="form-control" name="linksei" id="linksei" placeholder="" value="<?php echo $campo[0]['linksei'] ?>" required>
		<div class="invalid-feedback">
			Insira um link válido.
		</div>

		<label for="data">* Data entrada</label>
		<input type="date" class="form-control date" name="data" id="data" placeholder="" value="<?php echo $campo[0]['data'] ?>" required>

		<div class="invalid-feedback">
			Insira uma data de entrada válida.
		</div>

		<label for="observacao">Observação</label>
		<input type="text" class="form-control" name="observacao" id="observacao" placeholder="" value="<?php echo $campo[0]['observacao'] ?>">
		<hr class="mb-4">
		<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
	</form>
</div>
