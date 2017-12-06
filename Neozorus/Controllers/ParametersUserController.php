<?php
class ParametersUserController extends CoreController{
	private $user;

	public function __construct(){
		$this->isSessionNeozorus();
		$this->getDataUser();
	}

	public function affichageParametresUtilisateur(){
		include(VIEWS_PATH . DS . 'ParametersUser' . DS . 'ParametersUserView.php');
	}

	private function getDataUser(){
		try{
			$model = new ParametersUserModel();
			$user = $model -> getDataUserDB($_SESSION['neozorus']['u_id']);
			$this->user = $user;
		}
		catch(Exception $e){
			$controller = new ErrorController();
			$controller->error($e->getMessage());
		}
	}

	public function changeDataUser(){	
		$model = new ParametersUserModel();
		$changeOn = null;
		$myChange = null;
		$user= $this->data['u_id'];
		if(!empty($this->data['newPseudo'])){
			if(StringHandler::isAlphaNumeric($this->data['newPseudo'],PSEUDO_MIN,PSEUDO_MAX)){
				if($model->makeChange($user,'u_pseudo', $this->data['newPseudo'])){
					echo json_encode(array('newPseudo'=>$this->data['newPseudo']));
				}
			}
			else{
				echo json_encode(array('newPseudo'=>$this->data['newPseudo'],'error'=>1));
			}
			
		}

		else if(!empty($this->data['newNom'])){
			if(StringHandler::isAlpha($this->data['newNom'],NOM_MIN,NOM_MAX)){
				if($model->makeChange($user,'u_nom', $this->data['newNom'])){
					echo json_encode(array('newNom'=>$this->data['newNom']));
				}
			}
			else{
				echo json_encode(array('newNom'=>$this->data['newNom'],'error'=>1));
			}
			
		}
		else if(!empty($this->data['newPrenom'])){
			if(StringHandler::isAlpha($this->data['newPrenom'],PRENOM_MIN,PRENOM_MAX)){
				if($model->makeChange($user,'u_prenom', $this->data['newPrenom'])){
					echo json_encode(array('newPrenom'=>$this->data['newPrenom']));
				}
			}
			else{
				echo json_encode(array('newPrenom'=>$this->data['newPrenom'],'error'=>1));
			}
		}
		else if(!empty($this->data['newMail'])){
			if(StringHandler::isValidEmail($this->data['newMail'],MAIL_MIN,MAIL_MAX)){
				if(!$model->issetMailDB($this->data['newMail'])){
					if($model->makeChange($user,'u_mail', $this->data['newMail'])){
						echo json_encode(array('newMail'=>$this->data['newMail']));
					}
				}
				else{
					echo json_encode(array('newMail'=>$this->data['newMail'],'error'=>2));
				}
			}
			else{
				echo json_encode(array('newMail'=>$this->data['newMail'],'error'=>1));
			}
		}
	}
	public function changePassword(){
		$model = new ParametersUserModel();
		$user = $model -> getDataUserDB($this->data['u_id']);
		$hash = $user->getU_mdp();
		if(!StringHandler::isEmpty($this->data['password'])){	
			if(password_verify($this->data['password'], $hash)){
				$handler = new FormHandler($this->data);
				$tabError = $handler->checkInfoForChangingPassword();
				if(count($tabError) == 0 ){
					try{
						$hashedPassword = password_hash($this->data['newPassword'],PASSWORD_DEFAULT);
						if($model -> updatePasswordDB($hashedPassword, $this->data['u_id'])){
							echo json_encode(array('statement'=>'ok'));
						}
					}
					catch(Exception $e){
						echo json_encode(array('statement'=>'Probleme lors de l\'enregistrement du nouveau mot de passe'));
					}
				}
				else{
					echo json_encode($tabError);
				}
			}
			else{
				echo json_encode(array('invalidPassword' => 'Mot de passe incorrect'));
			}
		}
		else{
			echo json_encode(array('invalidPassword' => 'Champs vide'));
		}	
	}

}