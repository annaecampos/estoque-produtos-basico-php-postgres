<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/produto_insert.php">
		<label for="nome">* Nome </label>
		<input type="text" class="form-control" name="nome" id="nome" placeholder="" required autofocus>
		<div class="invalid-feedback">
			Insira um nome válido.
		</div>
		<label for="descricao">Descrição</label>
		<input type="text" class="form-control" name="descricao" id="descricao" placeholder="" >

		<label for="estoqueminimo">Estoque Mínimo</label>
		<input type="text" class="form-control" name="estoqueminimo" id="estoqueminimo" placeholder="" >

		<label for="unidademedida">* Unidade de Medida</label>
		<select class="form-control" name="idunidademedida" required>
			<?php

			$optUnidadeMedida = "";
			$i = 0;
			while ($i < count($combounidademedida))
			{
				$id = $combounidademedida[$i]['id'];
				$nome = $combounidademedida[$i]['nome'];

				if($id == $item['idunidademedida'])
				{
					$optUnidadeMedida = $optUnidadeMedida. "<option value='$id' selected>$nome</option>";
				}
				else
				{
					$optUnidadeMedida = $optUnidadeMedida. "<option value='$id'>$nome</option>";
				}
				$i++;
			}
			?>
			<option value="">selecione..</option>
			<?php echo $optUnidadeMedida; ?>
		</select>
		<div class="invalid-feedback">
			Insira uma unidade de medida válida.
		</div>

		<label for="tipoproduto">* Tipo Produto</label>
		<select class="form-control" name="idtipoproduto" required>
			<?php

			$optTipoProduto = "";
			$i = 0;
			while ($i < count($combotipoproduto))
			{
				$id = $combotipoproduto[$i]['id'];
				$nome = $combotipoproduto[$i]['nome'];

				if($id == $item['idtipoproduto'])
				{
					$optTipoProduto = $optTipoProduto. "<option value='$id' selected>$nome</option>";
				}
				else
				{
					$optTipoProduto = $optTipoProduto. "<option value='$id'>$nome</option>";
				}
				$i++;
			}
			?>
			<option value="">selecione..</option>
			<?php echo $optTipoProduto; ?>
		</select>
		<div class="invalid-feedback">
			Insira um tipo de produto válido.
		</div>
		<hr class="mb-4">
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success" value="salvar" name="botaoSalvar">Salvar</button>
		</div>
	</form>
</div>
