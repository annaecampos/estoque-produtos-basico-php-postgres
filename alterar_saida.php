<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/saida_update.php">
		<input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $id; ?>" required>

		<label for="produto">* Produto </label>
		<select class="form-control" name="idproduto" id="idproduto" required>
			<?php

			$optProduto = "";
			$i = 0;
			while ($i < count($comboproduto))
			{
				$id = $comboproduto[$i]['id'];
				$nome = $comboproduto[$i]['nome'];

				if($id == $item['idservidor'])
				{
					$optProduto = $optProduto. "<option value='$id' selected>$nome</option>";
				}
				else
				{
					$optProduto = $optProduto. "<option value='$id'>$nome</option>";
				}
				$i++;
			}
			?>
			<option value="">selecione..</option>
			<?php echo $optProduto; ?>
		</select>
		<div class="invalid-feedback">
			Selecione um Produto.
		</div>
		<label for="data">* quantidade</label>
		<input type="text" name="quantidade" class="form-control" id="quantidade" placeholder="Quantidade"/>

		<label for="servidor">* Servidor</label>
		<select class="form-control" name="idservidor" id="idservidor" required>
			<?php

			$optServidor = "";
			$i = 0;
			while ($i < count($comboservidor))
			{
				$id = $comboservidor[$i]['id'];
				$nome = $comboservidor[$i]['nome'];

				if($id == $item['idservidor'])
				{
					$optServidor = $optServidor. "<option value='$id' selected>$nome</option>";
				}
				else
				{
					$optServidor = $optServidor. "<option value='$id'>$nome</option>";
				}
				$i++;
			}
			?>
			<option value="">selecione..</option>
			<?php echo $optServidor; ?>
		</select>
		<div class="invalid-feedback">
			Selecione um servidor.
		</div>

		<label for="data">* Data saída</label>
		<input type="date" class="form-control date" name="data" id="data" placeholder="" value="<?php echo $campo[0]['data'] ?>" required>

		<div class="invalid-feedback">
			Insira uma data de saída válida.
		</div>

		<hr class="mb-4">
		<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
	</form>
</div>
