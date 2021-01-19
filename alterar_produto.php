<div class="modal-body">
	<form class="needs-validation" method="POST" novalidate action="classes/produto_update.php">
		<input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $id; ?>" required>

		<label for="nome">* Nome </label>
		<input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $campoalterar[0]['nome'] ?>" required>
		<div class="invalid-feedback">
			Insira um nome válido.
		</div>
		<label for="descricao">Descrição</label>
		<input type="text" class="form-control" name="descricao" id="descricao" placeholder="" 	value="<?php echo $campoalterar[0]['descricao'] ?>">

		<div class="row">
			<div class="col-md-12 mb-3">
				<label for="unidademedida">* Unidade de Medida</label>
				<select class="custom-select d-block w-100" id="idunidademedida" name="idunidademedida" required value="<?php echo $campoalterar[0]['idunidademedida'] ?>">
					<?php
					$optUnidadeMedida = "";
					$i = 0;
					while ($i < count($combounidademedida))
					{
						$id = $combounidademedida[$i]['id'];
						$nome = $combounidademedida[$i]['nome'];

						if($id == $campoalterar[0]['idunidademedida'])
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
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mb-3">
				<label for="tipoproduto">* Tipo Produto</label>
				<select class="custom-select d-block w-100" id="idtipoproduto" name="idtipoproduto" required value="<?php echo $campoalterar[0]['idtipoproduto'] ?>">
					<?php
					$optTipoproduto = "";
					$i = 0;
					while ($i < count($combotipoproduto))
					{
						$id = $combotipoproduto[$i]['id'];
						$nome = $combotipoproduto[$i]['nome'];

						if($id == $campoalterar[0]['idtipoproduto'])
						{
							$optTipoproduto = $optTipoproduto. "<option value='$id' selected>$nome</option>";
						}
						else
						{
							$optTipoproduto = $optTipoproduto. "<option value='$id'>$nome</option>";
						}
						$i++;
					}
					?>
					<option value="">selecione..</option>
					<?php echo $optTipoproduto; ?>
				</select>
				<div class="invalid-feedback">
					Insira um tipo produto válido.
				</div>
			</div>
		</div>
		<hr class="mb-4">
		<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
	</form>
</div>