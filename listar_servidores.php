<html>
<head>

  <?php

  include ("header.php");

  $id = $_GET['id'];
  $obj = new Crud_Pessoa();
  $campoalterar = $obj->servidor_select($id);

  $tipopessoa = $campoalterar[0]['tipopessoa'];
  if($tipopessoa == 1)
  {
    $checked = "checked='checked'";
    $style = "";
    $login = $campoalterar[0]['login'];
    $senha = $campoalterar[0]['senha'];
    $tipopessoa = 1;
    $required = "required";
  }
  else
  {
    $checked = "";
    $style = "display:none";
    $login="";
    $senha="";
    $tipopessoa=2;
    $required = "";
  }
  //Select dos servidores da tabela
  $linha =$obj->servidor_select_table();
  //Select último servidor
  $ultimo_servidor = $obj->servidor_select_ultimo();

  $obj = new Crud_Setor();
  //seleciona setor para o select
  $combo =$obj->select_setor_combo();

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
          <table class="table table-bordered table-striped" id=tabela> 
            <thead class="thead-dark" id="tabela">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
                <th scope="col">Setor</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $id_linha = $linha[0]['id'];
              $id_ultimo = $ultimo_servidor[0]['id'];
              if(($id_linha = $id_ultimo) && (isset($_GET["cad"]))){

               echo "<tr class='table-success'>";

             }
             else{"<tr>";}

             $i =0;
             while ($i < count($linha)) {
              ?>

              <td><?php echo  $linha[$i]['nome'] ?></td>
              <td><?php echo $linha[$i]['telefone'] ?></td>
              <td><?php echo $linha[$i]['cpf'] ?></td>
              <td><?php echo  $linha[$i]['email'] ?></td>
              <td><?php echo $linha[$i]['nomesetor'] ?></td>
              <td>
                <a data-toggle="tooltip" data-placement="top" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-lg" title="Excluir" href="classes/servidor_delete.php?id=<?php echo $linha[$i]['id']?>"> 
                  <i data-feather="trash-2"></i>
                </a>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalalterar" 
                data-id="<?php echo $linha[$i]['id']; ?>" 
                data-nome="<?php echo $linha[$i]['nome']; ?>" 
                data-telefone="<?php echo $linha[$i]['telefone']; ?>" 
                data-cpf="<?php echo $linha[$i]['cpf']; ?>" 
                data-email="<?php echo $linha[$i]['email']; ?>" 
                data-idsetor="<?php echo $linha[$i]['idsetor']; ?>" 
                data-tipopessoa="<?php echo $linha[$i]['tipopessoa']; ?>" 
                data-login="<?php echo $linha[$i]['login']; ?>" 
                data-senha="<?php echo $linha[$i]['senha']; ?>" >
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
<script type="text/javascript">
 $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
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
<script type="text/javascript">
  $('#modalalterar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('id') // Extract info from data-* attributes
      var recipientnome = button.data('nome')
      var recipienttelefone = button.data('telefone')
      var recipientcpf = button.data('cpf')
      var recipientemail = button.data('email')
      var recipientidsetor = button.data('idsetor')
      var recipienttipopessoa = button.data('tipopessoa')
      var recipientlogin = button.data('login')
      var recipientsenha = button.data('senha')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#nome').val(recipientnome)
      modal.find('#telefone').val(recipienttelefone)
      modal.find('#cpf').val(recipientcpf)
      modal.find('#email').val(recipientemail)
      modal.find('#idsetor').val(recipientidsetor)
      if(recipienttipopessoa == 1){
        //var teste = "checked='checked'"
        //modal.find('#tipopessoa').val(teste)
        //document.getElementById("tipopessoa").checked = true;
        document.getElementById("divMostrar").style = "";
        modal.find('#login').val(recipientlogin);
        modal.find('#senha').val(recipientsenha);
        modal.find('#tipopessoa').val(1);

        document.getElementById("tipopessoa").checked = true;


      }
      else{
        document.getElementById("tipopessoa").checked = false;
        document.getElementById("divMostrar").style = "display:none";
        modal.find('#login').val("");
        modal.find('#senha').val("");
        modal.find('#tipopessoa').val(2);
      }

    })
  </script>
   <!--if($tipopessoa == 1)
  {
    $checked = "checked='checked'";
    $style = "";
    $login = $campoalterar[0]['login'];
    $senha = $campoalterar[0]['senha'];
    $tipopessoa = 1;
    $required = "required";
  }
  else
  {
    $checked = "";
    $style = "display:none";
    $login=NULL;
    $senha=NULL;
    $tipopessoa=2;
    $required = "";
  }-->
  <?php
  include ("footer.php");
  ?>

</body>
</html>
