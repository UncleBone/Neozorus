<?php
class FormHandler implements JsonSerializable{
	private $password = null;
	private $confirmedPassword = null;
	private $newPassword = null;
	private $confirmedNewPassword = null;
	private $question = null;
	private $newQuestion = null;
	private $answer = null;
	private $newAnswer = null;
	private $error;

	public function __construct(array $data){
		$this->setPassword($data);
		$this->setConfirmedPassword($data);
		$this->setNewPassword($data);
		$this->setConfirmedNewPassword($data);
		$this->setQuestion($data);
		$this->setNewQuestion($data);
		$this->setAnswer($data);
		$this->setNewAnswer($data);
		$this->error = array();
	}

	public function jsonSerialize(){
		$array = array();
		$array['password']=$this->password;
		$array['confirmedPassword']=$this->confirmedPassword;
		$array['newPassword']=$this->newPassword;
		$array['confirmedPassword']=$this->confirmedPassword;
		$array['confirmedNewPassword']=$this->confirmedNewPassword;
		$array['question']=$this->question;
		$array['newQuestion']=$this->newQuestion;
		$array['answer']=$this->answer;
		$array['newAnswer']=$this->newAnswer;
		return $array;
	}

	public function setPassword(array $data){
		if(isset($data['password'])){
			$this->password = $data['password'];
		}
	}

	public function setConfirmedPassword(array $data){
		if(isset($data['confirmedPassword'])){
			$this->confirmedPassword = $data['confirmedPassword'];
		}
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

	public function setQuestion(array $data){
		if(isset($data['question'])){
			$this->question = $data['question'];
		}
	}

	public function setNewQuestion(array $data){
		if(isset($data['newQuestion'])){
			$this->newQuestion = $data['newQuestion'];
		}
	}

	public function setAnswer(array $data){
		if(isset($data['answer'])){
			$this->answer = $data['answer'];
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

}