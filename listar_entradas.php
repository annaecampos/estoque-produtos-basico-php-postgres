<html>
<head>

  <?php
  include ("header.php");
  $id = $_GET['id'];
  $obj = new Crud_Entrada();
  $campo = $obj->entrada_select($id);
  //Select dos pordutos da tabela
  $linha =$obj->entrada_select_table();
  //Select último produto
  $ultimo = $obj->entrada_select_ultimo();
  //Select dos produtos adicionados na entrada

  $idid = $linha[0]['id'];
  $linha_entrada_produto =$obj->entrada_produto_select_table($idid);
  
  ?>
</head>
<body class="bg-light">
  <div class="container-fluid">
    <div class="row">
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Registros de Entradas </h4>
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
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar Entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <?php
              require('cadastrar_entrada_modal.php');
              ?>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalalterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalalterar">Alterar Entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php
              require('alterar_entrada_produtos.php');
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
              <th scope="col">Nº nota fiscal</th>
              <th scope="col">Link do Sei</th>
              <th scope="col">Data de Entrada</th>
              <th scope="col">Observação</th>
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
            <td><?php echo  $linha[$i]['nfe'] ?></td>

            <td><a href="<?php echo $linha[$i]['linksei'] ?>" class="btn btn-secondary btn-lg" target="_blank"><i data-feather="eye"></i> Visualizar no SEI</a></td>
            <td><?php echo date('d/m/Y', strtotime($linha[$i]['data'])) ?></td>
            <td><?php echo $linha[$i]['observacao'] ?></td>
            <td>
              <a data-toggle="tooltip" data-placement="top" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-lg" title="Excluir" href="classes/entrada_delete.php?id=<?php echo $linha[$i]['id']?>"> 
                <i data-feather="trash-2"></i>
              </a>
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalalterar" 
              data-id="<?php echo $linha[$i]['id']; ?>" 
              data-nfe="<?php echo $linha[$i]['nfe']; ?>" 
              data-linksei="<?php echo $linha[$i]['linksei']; ?>" 
              data-data="<?php echo $linha[$i]['data']; ?>" 
              data-observacao="<?php echo $linha[$i]['observacao']; ?>">
              <i data-feather="edit"></i>
            </button>
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