  <div class="modal-body">	  
  	<div class="content-list">
  		<div class="row content-list-head">
  			<form class="col-md-auto">
  				<div class="input-group input-group-round">
  					<div class="input-group-prepend">
  						<span class="input-group-text">
  							<i data-feather="filter"></i>
  						</span>
  					</div>
  					<input type="text" id="search" class="form-control filter-list-input" placeholder="Buscar um servidor" aria-label="Filter Projects" aria-describedby="filter-projects" id="inputBusca">
  				</div>
  			</form>
  		</div>
  	</div>
  	<div class="table-responsive">
  		<table class="table" id=tabela> 
  			<thead class="thead-dark" id="tabela-thead">
  				<tr>
  					<th scope="col">Id</th>
  					<th scope="col">Nome</th>
  					<th scope="col">Descrição</th>
  					<th scope="col">Unidade Medida</th>
  					<th scope="col">Quantidade</th>
  					<th scope="col">Ações</th>
  				</tr>
  			</thead>
  			<tbody>
  				<?php

  				$id_linha = $linha[0]['id'];
  				$id_ultimo = $ultimo[0]['id'];
  				if(($id_linha = $id_ultimo) && (isset($_GET["cad"]))){

  					echo "<tr class='table-success'>";

  				}
  				else{"<tr>";}

  				$i =0;
  				while ($i < count($linha)) {
  					?>

  					<th scope="row"><?php echo $linha[$i]['id'] ?></th>
  					<td><?php echo  $linha[$i]['nome'] ?></td>
  					<td><?php echo $linha[$i]['descricao'] ?></td>
  					<td><?php echo $linha[$i]['nomeunidademedida'] ?></td>
  					<form class="needs-validation" method="POST" novalidate action="classes/entrada_produto_insert.php">
  						<input type="hidden" class="form-control" name="identrada" id="identrada" placeholder="" value="<?php echo $id; ?>"/>
  						<input type="hidden" class="form-control" name="idproduto" id="idproduto" placeholder="" value="<?php echo $linha[$i]['id'] ?>"/>
  						<td>
  							<input type="text" name="quantidade" class="form-control" id="quantidade" placeholder="Quantidade"/>
  						</td>
  						<td>
  							<button class="btn btn-success btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAdd"><i class="ion ion-md-add-circle"></i></button>
  						</td>	
  					</form>
  				</tr>
  				<?php
  				$i++;
  			}
  			?>
  		</tbody>
  	</table>
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