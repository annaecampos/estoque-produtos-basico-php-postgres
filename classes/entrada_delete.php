<?php

    $id = $_GET['id'];
    include("functions.php");
    $obj = new Crud_Entrada();
    $obj->entrada_delete($id);

?>