<?php

    $id = $_GET['id'];
    include("functions.php");
    $obj = new Crud_Pessoa();
    $obj->empresa_delete($id);

?>