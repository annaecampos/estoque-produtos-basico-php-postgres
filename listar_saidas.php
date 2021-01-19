<html>
<head>

  <?php
  include ("header.php");
  $obj = new Crud_Saida();
  //Select dos pordutos da tabela
  $linha =$obj->saida_select_table();
  //Select último produto
  $ultimo = $obj->saida_select_ultimo();
  $obj = new Crud_Produto();
  //seleciona produto para o select
  $comboproduto =$obj->select_produto_combo();
  //seleciona servidor para o select
  $obj = new Crud_Pessoa();
  $comboservidor =$obj->select_servidor_combo();



  
  ?>
</head>
<body class="bg-light">
  <div class="container-fluid">
    <div class="row">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h4 class="h4">Registros de Saídas </h4>
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
          <h5>Pesquisa</h5>
          <hr class="mb-4">
          <div class="modal fade" id="modalcadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cadastrar Saída</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <?php
                require('cadastrar_servidor.php');
                ?>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modalalterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalalterar">Alterar Saída</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                require('alterar_saida.php');
                ?>
              </div>
            </div>
          </div>
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
                <th scope="col">Data do Cadastro</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade do Produto</th>
                <th scope="col">Servidor</th>
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
              <td><?php echo  $linha[$i]['data'] ?></td>
              <td><?php echo $linha[$i]['nomeproduto'] ?></td>
              <td><?php echo $linha[$i]['quantidade'] ?></td>
              <td><?php echo $linha[$i]['nomeservidor'] ?></td>
              <td>
                <a data-toggle="tooltip" data-placement="top" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-lg" title="Excluir" href="classes/saida_delete.php?id=<?php echo $linha[$i]['id']?>"> 
                  <i data-feather="trash-2"></i>
                </a>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalalterar" 
                data-id="<?php echo $linha[$i]['id']; ?>" 
                data-idproduto="<?php echo $linha[$i]['idproduto']; ?>" 
                data-quantidade="<?php echo $linha[$i]['quantidade']; ?>" 
                data-data="<?php echo $linha[$i]['data']; ?>" 
                data-idservidor="<?php echo $linha[$i]['idservidor']; ?>" 
                >
                <i data-feather="edit"></i></button>
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
      var recipientidproduto = button.data('idproduto')
      var recipientquantidade = button.data('quantidade')
      var recipientdata = button.data('data')
      var recipientidservidor = button.data('idservidor')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#idproduto').val(recipientidproduto)
      modal.find('#quantidade').val(recipientquantidade)
      modal.find('#data').val(recipientdata)
      modal.find('#idservidor').val(recipientidservidor)

    })
  </script>
  <?php
  include ("footer.php");
  ?>
</body>
</html>