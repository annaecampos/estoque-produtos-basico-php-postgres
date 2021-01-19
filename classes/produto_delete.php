<?php

    $id = $_GET['id'];
    include("functions.php");
    $obj = new Crud_Produto();
    $obj->produto_delete($id);

?>