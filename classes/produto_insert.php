<?php
include("functions.php");
$comand=$_POST['botaoSalvar'];
$nome=$_POST['nome'];
$descricao=$_POST['descricao'];
$estoqueminimo=$_POST['estoqueminimo'];
$idunidademedida=$_POST['idunidademedida'];
$idtipoproduto=$_POST['idtipoproduto'];

$obj = new Crud_Produto();
$obj->produto_insert($nome,$descricao,$estoqueminimo,$idunidademedida,$idtipoproduto);

?>