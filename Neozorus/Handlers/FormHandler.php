<?php
class FormHandler implements JsonSerializable{
	/**
	 * coorespond à un mot de passe
	 * @var null|string
	 */
	private $newPassword = null;

	/**
	 * coorespond à un mot de passe
	 * @var null|string
	 */
	private $confirmedNewPassword = null;

	/**
	 * coorespond à un une question secrete
	 * @var null|string
	 */
	private $newQuestion = null;

	/**
	 * coorespond à une reponse secrete
	 * @var null|string
	 */
	private $newAnswer = null;

	/**
	 * tableau qui récupère toutes les erreurs
	 * @var array
	 */
	private $error;

	/**
	 * Instancie un FormHandler
	 * @param array $data tableau associatif dont les clés doivent correspondre à un attribut
	 */
	public function __construct(array $data){
		$this->setNewPassword($data);
		$this->setConfirmedNewPassword($data);
		$this->setNewQuestion($data);
		$this->setNewAnswer($data);
		$this->error = array();
	}

	/**
	 * renvoi un tableau des attributs de l'instance si l'instance est encode en JSON
	 * @return array 
	 */
	public function jsonSerialize(){
		$array = array();
		$array['newPassword']=$this->newPassword;
		$array['confirmedNewPassword']=$this->confirmedNewPassword;
		$array['newQuestion']=$this->newQuestion;
		$array['newAnswer']=$this->newAnswer;
		return $array;
	}

	/**
	 * modifie l'attribut newPassword
	 * @param array $data Tableau qui doit contenir la clé "newPassword"
	 */
	public function setNewPassword(array $data){
		if(isset($data['newPassword'])){
			$this->newPassword = $data['newPassword'];
		}
	}

	/**
	 * modifie l'attribut confirmedNewPassword
	 * @param array $data Tableau qui doit contenir la clé "confirmedNewPassword"
	 */
	public function setConfirmedNewPassword(array $data){
		if(isset($data['confirmedNewPassword'])){
			$this->confirmedNewPassword = $data['confirmedNewPassword'];
		}
	}

	/**
	 * modifie l'attribut newQuestion
	 * @param array $data Tableau qui doit contenir la clé "newQuestion"
	 */
	public function setNewQuestion(array $data){
		if(isset($data['newQuestion'])){
			$this->newQuestion = $data['newQuestion'];
		}
	}

	/**
	 * modifie l'attribut newAnswer
	 * @param array $data Tableau qui doit contenir la clé "newAnswer"
	 */
	public function setNewAnswer(array $data){
		if(isset($data['newAnswer'])){
			$this->newAnswer = $data['newAnswer'];
		}
	}

	/**
	 * Verifie la conformité du nouveau mot de passe et du nouveau mot de passe saisi une deuxieme fois par l'utilisateur
	 * @return array tableau vide si tout est ok, sinon il contient les erreurs detectées
	 */
	public function checkInfoForChangingPassword(){
		$this->checkPasswordIntegrity();
		$this->checkPasswordConfirmed();
		return $this->error;
	}

	/**
	 * vérifie la conformité d'un mot de passe
	 */
	private function checkPasswordIntegrity(){
		if(!StringHandler::isEmpty($this->newPassword)){
			if(StringHandler::isStringIntervalValid($this->newPassword, PASSWORD_MIN, PASSWORD_MAX)){

			}
			else{
				$this->error['newPassword']= 'Le mot de passe doit être compris entre '.PASSWORD_MIN.' et '.PASSWORD_MAX. ' caractères';
			}
		}
		else{
			$this->error['newPassword']= 'Le mot de passe ne doit pas être vide';
		}
	}
	/**
	 * Verifie si le mot de passe confirmé correspond au mot de passe saisi
	 */
	private function checkPasswordConfirmed(){
		if($this->newPassword == $this->confirmedNewPassword){

		}
		else{
			$this->error['confirmedNewPassword']= 'la confirmation du mot de passe n\'est pas identique';
		}
	}

	/**
	 * Verifie le conformité d'une question et d'une reponse secrete
	 * @return array tableau vide si tout est ok, sinon il contient les erreurs detectées
	 */
	public function checkInfoForChangingQuestionAnswer(){
		$this->checkNewQuestion();
		$this->checkNewAnswer();
		return $this->error;
	}

	/**
	 * Verifie la conformité d'une question secrete
	 */
	private function checkNewQuestion(){
		if(!StringHandler::isEmpty($this->newQuestion)){
			if(StringHandler::isStringIntervalValid($this->newQuestion, QUESTION_MIN, QUESTION_MAX)){
				if(StringHandler::isQuestionValid($this->newQuestion)){

				}
				else{
					$this->error['newQuestion'] = 'La question n\'a pas une syntaxe valide, comprends uniquement des caractères alphanumériques, des espaces et un point d\'interrogation sans accentuation';
				}
			}
			else{
				$this->error['newQuestion']= 'La question doit être comprise entre '.QUESTION_MIN.' et '.QUESTION_MAX. ' caractères';
			}
		}
		else{
			$this->error['newQuestion']= 'La question ne doit pas être vide';
		}

	}

	/**
	 * Verifie la conformité d'une reponse secrete
	 */
	private function checkNewAnswer(){
		if(!StringHandler::isEmpty($this->newAnswer)){
			if(StringHandler::isStringIntervalValid($this->newAnswer, ANSWER_MIN, ANSWER_MAX)){
			}
			else{
				$this->error['newAnswer']= 'La reponse doit être comprise entre '.ANSWER_MIN.' et '.ANSWER_MAX. ' caractères';
			}
		}
		else{
			$this->error['newAnswer']= 'La reponse ne doit pas être vide';
		}
	}
}