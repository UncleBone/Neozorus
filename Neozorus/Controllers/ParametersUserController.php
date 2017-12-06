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

	/**
	 * A partir d'une donné recuperer en ajax, on traite cette donné et si tout est ok on met à jour la BDD
	 * @return json tableau
	 */
	public function changeDataUser(){	
		$model = new ParametersUserModel();
		$user= $this->data['u_id'];
		//Si newPseudo existe, c'est que l'utilisateur veut modifier son pseudo
		if(!empty($this->data['newPseudo'])){
			//On verifie que le pseudo soit alphanumerique compris entre borne MIN et MAX
			if(StringHandler::isAlphaNumeric($this->data['newPseudo'],PSEUDO_MIN,PSEUDO_MAX)){
				//On met à jour la BDD
				if($model->makeChange($user,'u_pseudo', $this->data['newPseudo'])){
					echo json_encode(array('newPseudo'=>$this->data['newPseudo']));
				}
			}
			else{
				echo json_encode(array('newPseudo'=>$this->data['newPseudo'],'error'=>1));
			}
			
		}
		//Si newNom existe, c'est que l'utilisateur veut modifier son nom
		else if(!empty($this->data['newNom'])){
			//On verifie que le nom soit alpha compris entre borne MIN et MAX
			if(StringHandler::isAlpha($this->data['newNom'],NOM_MIN,NOM_MAX)){
				//On met à jour la BDD
				if($model->makeChange($user,'u_nom', $this->data['newNom'])){
					echo json_encode(array('newNom'=>$this->data['newNom']));
				}
			}
			else{
				echo json_encode(array('newNom'=>$this->data['newNom'],'error'=>1));
			}
			
		}
		//Si newPrenom existe, c'est que l'utilisateur veut modifier son prenom
		else if(!empty($this->data['newPrenom'])){
			//On verifie que le prenom soit alpha compris entre borne MIN et MAX
			if(StringHandler::isAlpha($this->data['newPrenom'],PRENOM_MIN,PRENOM_MAX)){
				//On met à jour la BDD
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
					//On met à jour la BDD
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
	/**
	 * requete ajax, a partir de données reçu par l'utilisateur, on verifie avec un Handler si tout est ok et on modifie le mot de passe en BDD
	 * @return json encode tableau
	 */
	public function changePassword(){
		$model = new ParametersUserModel();
		//on recupere l'instance User a partir de l'id
		$user = $model -> getDataUserDB($this->data['u_id']);
		//on recupere le mot de passe haché de la BDD
		$hash = $user->getU_mdp();
		//On vérifie que le mot de passe fourni par l'utilisateur ne soit pas vide
		if(!StringHandler::isEmpty($this->data['password'])){
			//On vérifie que le mot de passe donné par l'utilisateur correspond à celui de la BDD
			if(password_verify($this->data['password'], $hash)){
				//On instancie un FormHandler qui va vérifier si les donénes utilisateurs sont conformes
				$handler = new FormHandler($this->data);
				$tabError = $handler->checkInfoForChangingPassword();
				//Si tout est Ok tabError est un tableau vide
				if(count($tabError) == 0 ){
					//On hache le nouveau mot de passe est on l'enregistre en BDD, on renvoie un statut OK
					try{
						$hashedPassword = password_hash($this->data['newPassword'],PASSWORD_DEFAULT);
						if($model -> updatePasswordDB($hashedPassword, $this->data['u_id'])){
							echo json_encode(array('statement'=>'ok'));
						}
					}
					catch(Exception $e){
						echo json_encode(array('errorDB'=>'Probleme lors de l\'enregistrement du nouveau mot de passe'));
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

	public function changeQuestionAnswer(){
		$model = new ParametersUserModel();
		$user = $model -> getDataUserDB($this->data['u_id']);
		$hash = $user->getU_mdp();
		if(password_verify($this->data['password'], $hash)){
			if($this->data['answer'] == $user->getU_reponse()){
				$handler = new FormHandler($this->data);
				$tabError = $handler->checkInfoForChangingQuestionAnswer();
				if(count($tabError)==0){
					try{
						if($model->updateQuestionAnswerDB($this->data['newQuestion'],htmlentities($this->data['newAnswer']),$this->data['u_id'])){
							echo json_encode(array('statement'=>'ok'));
						}
					}
					catch(Exception $e){
						echo json_encode(array('errorDB'=>'Probleme lors de l\'enregistrement de la nouvelle question/reponse'));
					}
				}
				else{
					echo json_encode($tabError);
				}
				
			}
			else{
				echo json_encode(array('wrongAnswer' => 'Reponse secrete incorrecte'));
			}
		}
		else{
			echo json_encode(array('invalidPassword' => 'Mot de passe incorrect'));
		}
	}

}