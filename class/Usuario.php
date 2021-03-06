<?php

/**
 *
 */
class Usuario
{
  private $idusuario;
  private $deslogin;
  private $dessenha;
  private $dtcadastro;

/*  function __construct()
  {
    # code...
  }*/

  public function getIdusuario()
  {
    return $this-> idusuario;
  }

  public function setIdusuario($idusuario)
  {
  $this->idusuario = $idusuario;
  }

  public function getDeslogin()
  {
    return $this-> deslogin;
  }

  public function setDeslogin($deslogin)
  {
  $this->deslogin = $deslogin;
  }

  public function getDessenha()
  {
    return $this-> dessenha;
  }

  public function setDessenha($dessenha)
  {
  $this->dessenha = $dessenha;
  }

  public function getDtcadastro()
  {
    return $this-> dtcadastro;
  }

  public function setDtcadastro($dtcadastro)
  {
  $this->dtcadastro = $dtcadastro;
  }

  public function loadById($id)
  {
    $sql = new Sql;
    $resultado = $sql->select("SELECT * FROM tb_usuario WHERE idusuario = :ID", array(
      ":ID"=>$id
    ));

    if (count($resultado) > 0) {
      //$row = $resultado[0];
      $this->setData($resultado[0]);
    /*  $this->setIdusuario($row['idusuario']);
      $this->setDeslogin($row['deslogin']);
      $this->setDessenha($row['dessenha']);
      $this->setDtcadastro(new DateTime($row['dtcadastro']));*/
    }
  }

  public static function getList()
  {
    $sql = new Sql();
    return  $sql->select("SELECT * FROM tb_usuario ORDER BY deslogin");
  }

  public static function search($login)
  {
    $sql = new Sql();
    return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :PESQUISA ORDER BY deslogin",array(
      ':PESQUISA'=>"%".$login."%"
    ));
  }

  public function login($login, $password)
  {
    $sql = new Sql();
    $resultado = $sql->select("SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
      ":LOGIN"=>$login,
      ":PASSWORD"=>$password
    ));

    if (count($resultado) > 0) {
      //$row = $resultado[0];
      $this->setData($resultado[0]);

    /*  $this->setIdusuario($data['idusuario']);
      $this->setDeslogin($data['deslogin']);
      $this->setDessenha($data['dessenha']);
      $this->setDtcadastro(new DateTime($data['dtcadastro']));*/

    }else {
      throw new Exception("Login e/ou senha inválidos.");
    }
  }

  public function insert()
  {
    $sql = new Sql();
    $resultado = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASSWORD)",array(
      ':LOGIN'=>$this->getDeslogin(),
      ':PASSWORD'=>$this->getDessenha()
    ));

    if (count($resultado) > 0) {
      $this->setData($resultado[0]);
    }
  }

  public function update($login,$password)
  {
    $this->setDeslogin($login);
    $this->setDessenha($password);
    $sql = new Sql();
    $sql->query("UPDATE tb_usuario SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID",array(
      ':LOGIN'=>$this->getDeslogin(),
      ':PASSWORD'=>$this->getDessenha(),
      ':ID'=>$this->getIdusuario()
    ));
  }
  public function __construct($login = "", $password = "")
  {
    $this->setDeslogin($login);
    $this->setDessenha($password);
  }

  public function setData($data)
  {
    $this->setIdusuario($data['idusuario']);
    $this->setDeslogin($data['deslogin']);
    $this->setDessenha($data['dessenha']);
    $this->setDtcadastro(new DateTime($data['dtcadastro']));
  }

  public function __toString()
  {
    return json_encode(array(
      "idusuario"=>$this->getIdusuario(),
      "deslogin"=>$this->getDeslogin(),
      "dessenha"=>$this->getDessenha(),
      "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
    ));
  }


}



 ?>
