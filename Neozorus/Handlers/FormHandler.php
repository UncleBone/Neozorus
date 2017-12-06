<?php
class FormHandler implements JsonSerializable{
	private $newPassword = null;
	private $confirmedNewPassword = null;
	private $newQuestion = null;
	private $newAnswer = null;
	private $error;

	public function __construct(array $data){
		$this->setNewPassword($data);
		$this->setConfirmedNewPassword($data);
		$this->setNewQuestion($data);
		$this->setNewAnswer($data);
		$this->error = array();
	}

	public function jsonSerialize(){
		$array = array();
		$array['newPassword']=$this->newPassword;
		$array['confirmedNewPassword']=$this->confirmedNewPassword;
		$array['newQuestion']=$this->newQuestion;
		$array['newAnswer']=$this->newAnswer;
		return $array;
	}


	public function setNewPassword(array $data){
		if(isset($data['newPassword'])){
			$this->newPassword = $data['newPassword'];
		}
	}

	public function setConfirmedNewPassword(array $data){
		if(isset($data['confirmedNewPassword'])){
			$this->confirmedNewPassword = $data['confirmedNewPassword'];
		}
	}


	public function setNewQuestion(array $data){
		if(isset($data['newQuestion'])){
			$this->newQuestion = $data['newQuestion'];
		}
	}


	public function setNewAnswer(array $data){
		if(isset($data['newAnswer'])){
			$this->newAnswer = $data['newAnswer'];
		}
	}

	public function checkInfoForChangingPassword(){
		$this->checkPasswordIntegrity();
		$this->checkPasswordConfirmed();
		return $this->error;
	}

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

	private function checkPasswordConfirmed(){
		if($this->newPassword == $this->confirmedNewPassword){

		}
		else{
			$this->error['confirmedNewPassword']= 'la confirmation du mot de passe n\'est pas identique';
		}
	}

	public function checkInfoForChangingQuestionAnswer(){
		$this->checkNewQuestion();
		$this->checkNewAnswer();
		return $this->error;
	}

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