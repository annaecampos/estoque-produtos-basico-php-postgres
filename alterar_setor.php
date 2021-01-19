<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/setor_update.php">
		<input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $id; ?>" required>

		<label for="nome">* Nome </label>
		<input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $campoalterar[0]['nome'] ?>" required>
		<div class="invalid-feedback">
			Insira um nome válido.
		</div>
		<hr class="mb-4">
		<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
	</form>
</div>
