<?php
require_once("confing.php");
/*$sql = new Sql();
$usuario = $sql->select("SELECT * FROM tb_usuario");

echo json_encode($usuario);
/////////////////////////// clas Usuario
$marcos = new Usuario();

$marcos->loadById(10);

echo $marcos;
////////metodo lista
$lista = Usuario::getList();

echo json_encode($lista);

//// carrega uma lista de Usuario buscando pelo longi
$search = Usuario::search("Mar");
echo json_encode($search);

////Carregar um usuario usando o login e senha
$usuario = new Usuario();
$usuario->login("Marcos Davi","06042018");
echo $usuario;*/
//outra forma de inserssão no banco chaado o construtor da class
$aluno = new Usuario("Vania","123456");
//chama os metodos na class
//$aluno->setDeslogin("Davi");
//$aluno->setDessenha("123456");

$aluno->insert();

echo $aluno;


 ?>
