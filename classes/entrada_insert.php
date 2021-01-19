<?php
	include("functions.php");
	$comand=$_POST['botaoSalvar'];
	$nfe=$_POST['nfe'];
	$linksei=$_POST['linksei'];
	$data=$_POST['data'];
	$observacao=$_POST['observacao'];
	$obj = new Crud_Entrada();
	$obj->entrada_insert($nfe,$linksei,$data,$observacao);
?>