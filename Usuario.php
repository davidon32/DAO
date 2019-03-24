<?php 

class Usuario{

	private $id;
	private $login;
	private $senha;

	public function getId{
		return $this->id;
	}

	public function setId($value){
		$this->id = $value;	
	}

	public function getLogin{
		return $this->login;
	}

	public function setLogin($value){
		$this->login = $login;	
	}


	public function getSenha{
		return $this->senha;
	}

	public function setSenha($value){
		$this->senha = $senha;	
	}


	public function carregarPeloId($id){

		$sql = new Sql();

		$resultado = $sql->select("SELECT * FROM usuario where id = :ID",array(
			":ID"=>$id
		));
		if(count($results) > 0) {

			$row = $results[0];

			$this->setId($row['id']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);

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