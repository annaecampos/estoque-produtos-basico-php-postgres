		
<div class="modal-body">
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
			<form class="needs-validation" method="POST" novalidate action="classes/entrada_update.php">
				<input type="hidden" class="form-control" name="id" id="id" placeholder="" value="<?php echo $id; ?>" required>

				<label for="nfe">* Número Nota Fiscal </label>
				<input type="text" class="form-control" name="nfe" id="nfe" placeholder=""  required>
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
				<button class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAlterar">Salvar Alterações</button>
			</form>
		</div>


		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h4 class="h4">Produtos da Nota </h4>
			</div>

			<div class="card">
				<div class="card-body">
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
					<div class="table-responsive">
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
	</div>	
</div>