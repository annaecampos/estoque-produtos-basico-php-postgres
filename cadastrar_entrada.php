<html>
<head>

	<?php
	include ("header.php");
	$obj = new Crud_Entrada();
	?>

	

</head>
<body class="bg-light">
	<div class="container-fluid">
		<div class="row">
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h4 class="h4">Entrada </h4>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group mr-2">
							<button type="button"class="btn btn-round btn-success" data-toggle="modal" data-target="#modalcadastrar">
								<i data-feather="plus"></i>
							</button>
						</div>
					</div>

				</div>
				<?php 
				if (isset($_GET["excluir"])){
					echo $mensagem_sucesso_excluir;
				}
				if (isset($_GET["cad"])){
					echo $mensagem_sucesso_cadastrar;
				}
				if (isset($_GET["alt"])){
					echo $mensagem_sucesso_alterar;
				}
				?>
				<div class="card">
					<div class="card-body">
						<h5>Entrada de Produtos</h5>
						<hr class="mb-4">

						<div class="modal-body">
							<form class="needs-validation" method="POST" novalidate action="classes/entrada_insert.php" >
								<script>
									document.form.nfe.focus();
								</script>
								<label for="nfe">* Número Nota Fiscal </label>
								<input type="text" class="form-control" name="nfe" id="nfe" placeholder="" required autofocus>
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
					</div>
				</div>

			</main>
		</div>
	</div>

	<?php
	include ("footer.php");
	?>
</body>
</html>
