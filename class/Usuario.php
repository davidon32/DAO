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

			$this->setData($resultado[0]); 

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

			$this->setData($resultado[0]); 

		
		}else{

			throw new Exception("Login e/ou senha invalidos", 1);
			
		}

	}

	public function setData($date){

		$this->setId($date['id']);
		$this->setLogin($date['login']);
		$this->setSenha($date['senha']);


	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			  ":LOGIN"=>$this->getLogin(),
			  ":SENHA"=>$this->getSenha()

		));

		if (count($results) > 0){
			$this->setData($results[0]); 
		}

	}

	public function update($login, $senha){

		$this->setLogin($login);
		$this->setSenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE usuario SET login=:LOGIN, senha=:SENHA WHERE id=:ID", array(
			  ":LOGIN"=>$this->getLogin(),
			  ":SENHA"=>$this->getSenha(),
			  ":ID"=>$this->getId()

		));

	}

	public function delete(){
		$sql = new Sql();

		$results = $sql->query("DELETE FROM usuario WHERE id=:ID", array(
			  ":ID"=>$this->getId()
		));

		$this->setId(0);
		$this->setLogin("");
		$this->setSenha("");
	}

	public function __construct($login = "", $senha = ""){

		$this->setLogin($login);
		$this->setSenha($senha);
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