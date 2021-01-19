<html>
<head>

	<?php
	include ("header.php");
	include ("classes/functions.php");
	$obj = new Crud_Setor();
	//seleciona setor para o select
	$combo =$obj->select_setor_combo();

	$obj = new Crud_Pessoa();
  //Select dos servidores da tabela
	$linha =$obj->servidor_select_table();
  //Select último servidor
	$ultimo_servidor = $obj->servidor_select_ultimo();
	?>

</head>
<body class="bg-light">
	<div class="container-fluid">
		<div class="row">
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h4 class="h4">Servidor/Usuário</h4>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group mr-2">
							<button class="btn btn-sm btn-outline-secondary">Share</button>
							<button class="btn btn-sm btn-outline-secondary">Export</button>
						</div>
						<button class="btn btn-sm btn-outline-secondary dropdown-toggle">
							<span data-feather="calendar"></span>
							This week
						</button>
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
				</div>

				<div class="card">
					<div class="card-body">
						<h5>Cadastro</h5>
						<hr class="mb-4">
						<!--chama página cadastro-->
						<?php
						require('cadastrar_servidor.php');
						?>
					</div>

				</div>
				<div class="card text-white bg-light mb-3">
					<div class="card-header">Header</div>
					<div class="card-body">
						<h5>Pesquisa</h5>
						<hr class="mb-4">
						<form>
							<div class="form-group rpw">
								<label for="inputBusca" class="sr-only">Busca</label>
								<div class="col-sm-12">
									<input type="text" id="search" class="form-control" id="inputBusca" placeholder="Buscar por nome" >
								</div>
							</div>
						</form>
						<div class="table-responsive">
							<!--chama página listagem-->
							<?php
							require('listar_servidores.php');
							?>
						</div>
					</div>
				</div>


			</main>
		</div></div>
		<!-- Aqui mostrar e ocultar div com JS -->
		<script type="text/javascript">

			$('[name="check"]').change(function() {
				$('[name="divMostrar"]').toggle(0);
			});
		</script>
		<script>
			$(document).ready(function(){
				$("#search").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#tabela tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
		</script>
	</body>
	</html>
