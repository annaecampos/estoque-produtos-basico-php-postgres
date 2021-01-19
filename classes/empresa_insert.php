<?php
	include("functions.php");
	$comand=$_POST['botaoSalvar'];
	$razaosocial=$_POST['razaosocial'];
	$nomefantasia=$_POST['nomefantasia'];
	$telefone=$_POST['telefone'];
	$cnpj=$_POST['cnpj'];
	$email=$_POST['email'];
	$obj = new Crud_Pessoa();
	$obj->empresa_insert($razaosocial,$nomefantasia,$telefone,$cnpj,$email);

?>