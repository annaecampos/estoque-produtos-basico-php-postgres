<?php

    include("functions.php");
    $comand= $_POST['botaoAlterar'];
    $id = $_POST['id'];
    $razaosocial=$_POST['razaosocial'];
    $nomefantasia=$_POST['nomefantasia'];
    $telefone=$_POST['telefone'];
    $cnpj=$_POST['cnpj'];
    $email=$_POST['email'];
    $obj = new Crud_Pessoa();
    $obj->empresa_update($id,$razaosocial,$nomefantasia,$telefone,$cnpj,$email);

?>