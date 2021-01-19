<html>
<head>

	<?php
	include ("header.php");
	$id = $_GET['id'];
	$obj = new Crud_Entrada();
	$campo = $obj->entrada_select($id);
	//Select dos produtos adicionados na entrada

	$linha_entrada_produto =$obj->entrada_produto_select_table($id);

	$obj = new Crud_Produto();
  	//Select dos pordutos da tabela
	$linha =$obj->produto_select_table();
  	//Select último produto
	$ultimo = $obj->produto_select_ultimo();

	?>

</head>
<body class="bg-light">
	<div class="container-fluid">
		<div class="row">
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Dados da Entrada</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Produtos inseridos na nota</a>
					</li>

				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
							<h4 class="h4">Entrada de Produtos </h4>

							<div class="btn-toolbar mb-2 mb-md-0">
								<div class="btn-group mr-2">
									<button type="button"class="btn btn-round btn-success" data-toggle="modal" data-target="#modalinserirprodutos">
										<i data-feather="plus"></i>
									</button>
								</div>
							</div>
						</div>
						<!--aqui modal para inserir produtos na nota -->
						<div class="modal fade" id="modalinserirprodutos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Inserir Produtos</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

									<?php
									require('tabela-add-produtos-entrada.php');
									?>
								</div>
							</div>
						</div>
						<!--aqui modal para alterar entrada  -->
						<div class="modal fade" id="modalalterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalalterar">Alterar Dados</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<?php
									require('alterar_entrada.php');
									?>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="modal-body">
									<div class="alert alert-success" role="alert">

										<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">				
											<h4 class="alert-heading">Dados da entrada</h4>
											<div class="btn-toolbar mb-2 mb-md-0">
												<div class="btn-group mr-2">
													<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalalterar" 
													data-id="<?php echo $campo[0]['id']; ?>" 
													data-nfe="<?php echo $campo[0]['nfe']; ?>" 
													data-linksei="<?php echo $campo[0]['linksei']; ?>" 
													data-data="<?php echo $campo[0]['data']; ?>" 
													data-observacao="<?php echo $campo[0]['observacao']; ?>">
													<i data-feather="edit"></i>
												</button>
											</div>
										</div>
									</div>
									<input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $id; ?>" required>
									<hr>
									<strong>NFE:</strong>
									<p><?php echo $campo[0]['nfe'] ?></p>
									<strong>Link do Sei:</strong>
									<p><?php echo $campo[0]['linksei'] ?></p>
									<strong>Data:</strong>
									<p><?php echo $campo[0]['data'] ?></p>
									<strong>Observação:</strong>
									<p><?php echo $campo[0]['observacao'] ?></p>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h4 class="h4">Lista de Produtos Inseridos na Nota </h4>
					</div>
					<div class="card">
						<div class="card-body">

							<h4><i class="ion ion-md-exit"></i> Produtos da Nota</h4>
							<hr class="mb-4">
							<form>
								<div class="form-group rpw">
									<label for="inputBusca" class="sr-only">Busca</label>
									<div class="col-sm-12">
										<input type="text" id="search" class="form-control" id="inputBusca" placeholder="Buscar por nome" >
									</div>
								</div>
							</form>
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
							<table class="table" id=tabela> 
								<thead class="thead-dark" id="tabela-thead">
									<tr>
										<th scope="col">Produto</th>
										<th scope="col">Descrição</th>
										<th scope="col">Unidade de Medida</th>
										<th scope="col">Quantidade Adicionado</th>
										<th scope="col">Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$id_linha = $linha_entrada_produto[0]['id'];
									$id_ultimo = $ultimo[0]['id'];
									if(($id_linha = $id_ultimo) && (isset($_GET["cad"]))){

										echo "<tr class='table-success'>";

									}
									else{"<tr>";}

									$i =0;
									while ($i < count($linha_entrada_produto)) {
										?>
										<td scope="row"><?php echo $linha_entrada_produto[$i]['nomeproduto'] ?></td>
										<td><?php echo $linha_entrada_produto[$i]['descricaoproduto'] ?></td>
										<td><?php echo $linha_entrada_produto[$i]['nomeunidademedida'] ?></td>
										<td><?php echo $linha_entrada_produto[$i]['quantidade'] ?></td>
										<td>
											<a data-toggle="tooltip" data-placement="top" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-lg" title="Excluir" href="classes/entrada_produto_delete.php?id=<?php echo $linha_entrada_produto[$i]['id']?>"> 
												<i data-feather="trash-2"></i>
											</a>
										</td>

									</tr>
									<?php
									$i++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
</div>
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
<script type="text/javascript">
	$('#modalalterar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('id') // Extract info from data-* attributes
      var recipientnfe = button.data('nfe')
      var recipientlinksei = button.data('linksei')
      var recipientdata = button.data('data')
      var recipientobservacao = button.data('observacao')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#nfe').val(recipientnfe)
      modal.find('#linksei').val(recipientlinksei)
      modal.find('#data').val(recipientdata)
      modal.find('#observacao').val(recipientobservacao)
  })
</script>
<?php
include ("footer.php");
?>
</body>
</html>
