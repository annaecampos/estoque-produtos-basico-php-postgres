<?php

    include("functions.php");
    $comand= $_POST['botaoAlterar'];
    $id = $_POST['id'];
    $nfe = $_POST['nfe'];
    $linksei = $_POST['linksei'];
    $data = $_POST['data'];
    $observacao = $_POST['observacao'];
    $obj = new Crud_Entrada();
    $obj->entrada_update($id,$nfe,$linksei,$data,$observacao);

?>