<html>
<head>

  <?php
  include ("header.php");
  $id = $_GET['id'];
  $obj = new Crud_Setor();
  //Select dos setores da tabela
  $linha =$obj->setor_select_table();
  //Select último setor
  $ultimo = $obj->setor_select_ultimo();
  //popula campos no alterar
  $campoalterar = $obj->setor_select($id);
  ?>




</head>
<body class="bg-light">
 <div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Setores da Auditoria</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2" id="c">
            <button name="m" id="m" type="button"class="btn btn-round btn-success" data-toggle="modal" data-target="#modalcadastrar">
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
                  <h5 class="modal-title" id="exampleModalLabel">Cadastrar Setor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <?php
                require('cadastrar_setor.php');
                ?>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modalalterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalalterar">Alterar Setor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                require('alterar_setor.php');
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
         <table class="table" id="tabela"> 
          <thead class="thead-dark" id="tabela-thead">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Nome</th>
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

            <td>
              <a data-toggle="tooltip" data-placement="top" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-lg" title="Excluir" href="classes/setor_delete.php?id=<?php echo $linha[$i]['id']?>"> 
               <i data-feather="trash-2"></i>
             </a>
             <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalalterar" 
             data-id="<?php echo $linha[$i]['id']; ?>" 
             data-nome="<?php echo $linha[$i]['nome']; ?>" >
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


 <div class="row">
  <div class="col-sm-12 col-md-5">
    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 11 to 20 of 57 entries
    </div>
  </div>
  <div class="col-sm-12 col-md-7">
    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
      <ul class="pagination">
        <li class="paginate_button page-item previous" id="example_previous">
          <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
        </li>
        <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0" class="page-link">1</a>
        </li>
        <li class="paginate_button page-item active">
          <a href="#" aria-controls="example" data-dt-idx="2" tabindex="0" class="page-link">2</a>
        </li>
        <li class="paginate_button page-item ">
          <a href="#" aria-controls="example" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>

</nav>
</div>

</div>
</div>
</main>
</div>
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
      var recipientnome = button.data('nome')

      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('#id').val(recipient)
      modal.find('#nome').val(recipientnome)
    })
  </script>

  <script type="text/javascript">

   $('.modal').on('shown.bs.modal', function(event) {
     $(this).find('[autofocus]').focus();
   });

 </script>

 <script type="text/javascript">
   $(document).ready(function() {
    $('#tebela tr').DataTable();
  } );
</script>
<?php
include ("footer.php");
?>
</body>
</html>