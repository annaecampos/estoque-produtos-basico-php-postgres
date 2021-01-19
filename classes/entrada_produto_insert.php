<?php
	include("functions.php");
	$comand=$_POST['botaoAdd'];
	$identrada=$_POST['identrada'];
	$idproduto=$_POST['idproduto'];
	$quantidade=$_POST['quantidade'];
	$obj = new Crud_Entrada();
	$obj->entrada_produto_insert($identrada,$idproduto,$quantidade);
?>