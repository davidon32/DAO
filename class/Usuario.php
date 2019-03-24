	<?php 

class Usuario{

	private $id;
	private $login;
	private $senha;

	public function getId(){
		return $this->id;
	}

	public function setId($value){
		$this->id = $value;	
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($value){
		$this->login = $value;	
	}


	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($value){
		$this->senha = $value;	
	}


	public function carregarPeloId($id){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM usuario where id = :id",array(
			":id"=>$id
		));
		if(count($resultado) > 0) {

			$row = $resultado[0];

			$this->setId($row['id']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);

		}
	}
	//pode ser um metodo statico por nao ter nenhum $this 
	public static function getList(){

		$sql = new Sql();
		return $sql->select("SELECT * FROM usuario ORDER BY login");

	}

	public static function search($login){

		$sql = new Sql();
		return $sql->select("SELECT * FROM usuario WHERE login LIKE :search ORDER BY login",array(

			":search"=>"%".$login."%"

		));

	}

	public function login($login,$senha){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM usuario where login = :login AND senha = :senha ",array(
			":login"=>$login,
			":senha"=>$senha
		));
		if(count($resultado) > 0) {

			$row = $resultado[0];

			$this->setId($row['id']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);

		}else{
			throw new Exception("Login e/ou senha invalidos", 1);
			
		}

	}

	public function __toString(){

		return json_encode(array(
			"id"=>$this->getId(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
		));

	}
}




?>