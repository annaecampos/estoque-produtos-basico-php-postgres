<?php
require_once 'conexao_bd.php';

abstract class crud extends conexao_bd{

	protect $table;

	abstract public function insert();
	abstract public function update($id);
	public function find($id){
		$sql = "SELECT * FROM $this->$table where id = :id ";
	}
}

 ?>