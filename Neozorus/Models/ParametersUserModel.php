<?php
class ParametersUserModel extends CoreModel{
	/**
	 * recupere dans la BDD un utilisateur à partir de son ID, puis retourne une instance User
	 * @param  int $id Identifiant de l'utilisateur en BDD
	 * @return Object     User
	 */
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

	/**
	 * Modifie une donnée d'un utilisateur(ex: pseudo, adresse mail...) dans la BDD
	 * @param  int $userID  Identifiant de l'utilisateur
	 * @param  string $champs  Attribut de la classe a modifier
	 * @param  string $contenu Contenu a mettre
	 * @return true|exception
	 */
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

	/**
	 * Verifie si un mail existe en BDD
	 * @param  string $mail mail a tester
	 * @return booleen
	 */
	public function issetMailDB($mail){
		$sql = 'SELECT * FROM user WHERE u_mail = :mail';
		$params = array('mail' => $mail);
		$request = $this->makeSelect($sql, $params);
		if(count($request)==0){
			return false;
		}
		return true;
	}

	/**
	 * Modifie l'attribut u_password d'un utilisateur de la BDD
	 * @param  string $password nouveau mot de passe
	 * @param  int $idUser   Identifiant de l'utilisateur
	 * @return bool
	 */
	public function updatePasswordDB($password, $idUser){
		$sql = 'UPDATE user SET u_mdp=:password WHERE u_id=:id';
		$params = array('password' => $password, 'id' => $idUser);
		if($this->makeStatement($sql,$params)){
			return true;
		}
		return false;
	}

	/**
	 * Modifie les attributes u_question et u_reponse d'un utilisateur dans la BDD
	 * @param  string $question nouvelle question
	 * @param  string $answer   nouvelle reponse
	 * @param  int $idUser   Identifiant de l'utilisateur
	 * @return boolen
	 */
	public function updateQuestionAnswerDB($question,$answer,$idUser){
		$sql = 'UPDATE user SET u_question = :question, u_reponse = :answer WHERE u_id=:id';
		$params = array('question' => $question, 'answer' => $answer, 'id' => $idUser);
		if($this->makeStatement($sql,$params)){
			return true;
		}
		return false;
	}
}