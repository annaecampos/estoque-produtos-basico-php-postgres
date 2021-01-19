<!doctype html>
<html lang="en">
<head>
  <?php 
  include ("classes/mensagem.php");
  include("classes/functions.php");

  $obj = new Crud_Tipoproduto();
  //Select dos estoque/estoqueminimo da tabela
  $estoque =$obj->tipoproduto_select_menu();

  $tipoproduto =$obj->tipoproduto_select_menu_lista();

  ?>
  <!-- MetaTag-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon-->
  <link rel="icon" href="imagens/favicon.ico">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="navbar-top-fixed.css" rel="stylesheet"> 
  <link href="css/form-validation.css" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  
  <title>Sistema Estoque JMU</title>
</head>

<body>
  <!-- Aqui Menu Navbar -->
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Estoque JMU</a>
    <form class="form-inline" style="margin-bottom: 0em!important">

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sair</a>
        </li>
      </ul>
    </form>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="/defaul.php">
                <ion-icon name="home"></ion-icon>
                Página Principal <span class="sr-only"> <i data-feather="eye"></i></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="listar_servidores.php"><i data-feather="users"></i> Servidores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="listar_empresas.php"><i data-feather="truck"></i> Empresas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="listar_produtos.php"><i data-feather="shopping-cart"></i> Produtos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="listar_entradas.php"><i data-feather="log-in"></i> Registros de Entradas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="listar_saidas.php"><i data-feather="minus-circle"></i> Registros de Saídas</a>
            </li>
            <hr class="mb-3">
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i data-feather="settings"></i> Configuração</a>
              <div id="submenu-3" class="collapse menu">
                <ul class="nav nav-small flex-column ">
                  <li class="nav-item">
                    <a class="nav-link" href="listar_setor.php"><i data-feather="users"></i> Setor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="listar_tipoproduto.php"><i data-feather="shopping-cart"></i> Tipo de Produto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="listar_unidadesmedida.php"><i data-feather="crop"></i> Unidade de Medida</a>
                  </li>
                </ul>
              </div>
            </li>
            <hr class="mb-3">
            <li class="nav-item">
              <div class="dropdown">
                <div style="display: block; position: relative;" class="dropdown-menu dropdown-menu-warning">
                  <a href="cadastrar_entrada.php" class="dropdown-item"><i data-feather="log-in"></i> Entrada</a>
                  <div class="dropdown-divider"></div>
                  <a href="cadastrar_saida.php" class="dropdown-item"><i data-feather="minus-circle"></i> Saída</a>
                </div>
              </div>
            </li>
            <hr class="mb-3">
            
            <?php
            $i =0;
            while ($i < count($tipoproduto)) {
              $nometipoproduto = $tipoproduto[$i]['nome'];
              ?>

              <li class="nav-item">
               <div class='alert alert-dark' role='alert' id="danger">
                 <?php
                 $f =0;
                 while ($f < count($estoque)) {
                   $quantidade = $estoque[$i]['quantidade'];
                   $estoqueminimo = $estoque[$i]['estoqueminimo'];
                   $idtipo = $tipoproduto[$i]['id'];

                   $f++;
                 }
                 if ($quantidade <= $estoqueminimo) {

                  echo "<i data-feather='alert-triangle' id='icon'></i> ";
                  echo "<label style='text-transform: uppercase;'>".$nometipoproduto."</label>";
                  ?>

                  <br><a href="listar_estoque_baixo.php?id=<?php echo $idtipo ?>" class='alert-link'>

                    Estoque baixo  <i data-feather='chevron-right'></i>
                    <?php
                    echo "<script>TrocarCores();</script>";
                    ?>
                  </a>
                  <?php
                } 

                else {
                 echo "<i data-feather='check-circle' id='icon'></i> ";
                 echo "<label style='text-transform: uppercase;'>".$nometipoproduto."</label>";
                 echo "<br><a class='alert-link'>Estoque Ok</a>";
               }

               ?>
             </div>
           </li>
           <?php
           $i++;
         }

         ?>
       </li>
     </li>
   </li>
 </ul>
</div>
</nav>
</div>
</div>

<!-- Bootstrap core JavaScript -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/vendor/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js"></script>
<script src="js/vendor/holder.min.js"></script>


 

<!-- Aqui validação dos campos com Bootstrap-->
<script>
  (function() {
    'use strict';

    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('needs-validation');

      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

<!--Aqui a máscara dos campos-->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>

<script type="text/javascript">
  $(function() {
    $.mask.definitions['~'] = "[+-]";
    $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy",completed:function(){alert("completed!");}});
    $(".phone").mask("(99) 99999-9999");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $("#pct").mask("99%");
    $("#phoneAutoclearFalse").mask("(999) 999-9999", { autoclear: false, completed:function(){alert("completed autoclear!");} });
    $("#phoneExtAutoclearFalse").mask("(999) 999-9999? x99999", { autoclear: false });

    $("input").blur(function() {
      $("#info").html("Unmasked value: " + $(this).mask());
    }).dblclick(function() {
      $(this).unmask();
    });
  });

</script>

<script src="https://unpkg.com/feather-icons"></script>

<script type="text/javascript">
  feather.replace()
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tabela').DataTable();
  } );
</script>


 <script type="text/javascript">

    function TrocarCores(){
      $(" #danger").removeClass("alert-dark");
      $(" #danger").addClass("alert-danger");
    }

  </script>

    <script type="text/javascript">

     $('.modal').on('shown.bs.modal', function(event) {
       $(this).find('[autofocus]').focus();
     });

 </script>

</body>
</html>
