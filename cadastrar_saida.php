<html>
<head>

  <?php
  include ("header.php");
  $obj = new Crud_Produto();
  //Select dos pordutos da tabela
  $linha =$obj->produto_select_table();
  //Select último produto
  $ultimo = $obj->produto_select_ultimo();
  //seleciona servidor para o select
  $obj = new Crud_Pessoa();
  $linhaservidor =$obj->select_servidor_combo();
  ?>
</head>
<body class="bg-light">
  <div class="container-fluid">
    <div class="row">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h4 class="h4">Servidor/Usuário </h4>
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
                  <h5 class="modal-title" id="exampleModalLabel">Cadastrar Servidor</h5>
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
                  <h5 class="modal-title" id="modalalterar">Alterar Servidor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                require('alterar_servidor.php');
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
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Unidade Medida</th>
                <th scope="col">Tipo</th>
                <th scope="col">Ações</th>
                <th scope="col"></th>
                <th scope="col"></th>
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
              <td><?php echo $linha[$i]['nometipoproduto'] ?></td>

              <form class="needs-validation" method="POST" novalidate action="classes/saida_insert.php">
                <input type="hidden" class="form-control" name="idproduto" id="idproduto" placeholder="" value="<?php echo $linha[$i]['id'] ?>"/>
                <td>
                  <input type="text" name="quantidade" class="form-control" id="quantidade" placeholder="Quantidade"/>
                </td>
                <td>
                  <select class="form-control" name="idservidor" required>
                    <?php

                    $optServidor = "";
                    $i = 0;
                    while ($i < count($linhaservidor))
                    {
                      $id = $linhaservidor[$i]['id'];
                      $nome = $linhaservidor[$i]['nome'];

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
                </td>
                <td>
                  <button class="btn btn-success btn-lg btn-block" data-toggle="tooltip" data-placement="top" title="Salvar" type="submit" value="salvar" name="botaoAdd">
                   <i data-feather="check-circle"></i>
                 </button>
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
</div>
</main>
</div>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Início</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Próxima</a>
    </li>
  </ul>
</nav>
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

<?php
include ("footer.php");
?>

</body>
</html>