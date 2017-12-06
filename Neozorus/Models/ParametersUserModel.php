<?php
class ParametersUserModel extends CoreModel{

	function getDataUserDB($id){
		$sql = 'SELECT * FROM user WHERE u_id = :id';
		$params = array ('id'=>$id);
		$data = $this->makeSelect($sql,$params);

		if(count($data)==0){
			throw new Exception("Aucun Utilisateur avec cet identifiant dans la base de donnée");		
		}

		$User = array();

		foreach ($data as $key => $value) {
			$User[]=new User ($value);
		}

		return $User[0];
	}

	public function makeChange($userID, $champs, $contenu){
		$sql = 'UPDATE user SET ' . $champs . '=:contenu WHERE u_id=:id';
		$params = array(
            'contenu' => $contenu,
            'id' => $userID
        );
        if($this->makeStatement($sql,$params)){
        	return true;
        }
        throw new Exception("Problème lors du changement des données dans la base de donné");  
	}

	public function issetMailDB($mail){
		$sql = 'SELECT * FROM user WHERE u_mail = :mail';
		$params = array('mail' => $mail);
		$request = $this->makeSelect($sql, $params);
		if(count($request)==0){
			return false;
		}
		return true;
	}

	public function updatePasswordDB($password, $idUser){
		$sql = 'UPDATE user SET u_mdp=:password WHERE u_id=:id';
		$params = array('password' => $password, 'id' => $idUser);
		if($this->makeStatement($sql,$params)){
			return true;
		}
		return false;
	}
}