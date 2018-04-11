<?php
require_once("confing.php");
$sql = new Sql();
$usuario = $sql->select("SELECT * FROM tb_usuario");

echo json_encode($usuario);

 ?>
