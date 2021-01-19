<script>
  function setaDadosModal(valor) {
    document.getElementById('id').value = valor;
    var idpessoa = document.getElementById('id').value;
    alert(idpessoa);
    <?php 
    $g = '<script> document.getElementById(idpessoa)</script>';
    $obj = "select * from pessoa where id = " + $g;

    echo $g;
    $pnome = $p[0]['nome'];
    echo "$idpessoa";



    ?>
    document.getElementById('nome').value = <?php echo $pnome ?>;
  }
</script>

