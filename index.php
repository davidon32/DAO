<?php 

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM usuario");

echo json_encode($usuarios);*/

$usuario = new Usuario();

$usuario->carregarPeloId(4);
//ao dar o echo em um objeto e chamado o metodo to string
echo $usuario;

?>