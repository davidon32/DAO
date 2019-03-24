<?php 

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM usuario");

echo json_encode($usuarios);*/

$usuario = new Usuario();

$usuario->carregarPeloId(4);

//ao dar o echo em um objeto e chamado o metodo to string
echo $usuario;

echo "---------------------<\br>";

//chama o metodo getlist direto pois e um metodo static
//chama o metodo para listar uma tabela inteira
$lista = Usuario::getList();

echo json_encode($lista);

echo "---------------------<\br>";
//chama o metodo para fazer uma busca
$search = Usuario::search("das");

echo json_encode($search);

echo "---------------------<\br>";
//carrega o usuario a partir do login e da senha
$login = new Usuario();

$login->login("davi","senha");

echo $usuario;

echo "---------------------<\br>";

?>