<?php
class ParametersController extends CoreController{

	private $user;
	private $languages;

	public function __construct(){
		$this->isSessionNeozorus();	//On verifie qu'une session est en cours
		$this->getDataUser();
		$this->getLanguages();
	}

	public function display(){
		$title = 'Paramètres';
		$lang = 1 ;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		$mail = $this->user['u_mail'];
		$nom = $this->user['u_nom'];
		$prenom = $this->user['u_prenom'];
		$pseudo = $this->user['u_pseudo'];

		ob_start();
		require(VIEWS_PATH . DS . 'Home' . DS . 'ParametersView.php');
		$view = ob_get_contents();
		ob_clean();
		require(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
	}

	/**
	 * Recupere une instance User correspondant à l'utilisateur actuel
	 */
	private function getDataUser(){
		try{
			$model = new ParametersModel();
			$user = $model -> getDataUserDB($_SESSION['neozorus']['u_id']);
			$this->user = $user[0];
		}
		catch(Exception $e){
			$controller = new ErrorController();
			$controller->error($e->getMessage());
		}
	}

	private function getlanguages(){
		try{
			$model = new ParametersModel();
			$this->languages = $model -> getLanguages();
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
		$model = new ParametersModel();
		$user= $this->data['u_id'];
		//Si newPseudo existe, c'est que l'utilisateur veut modifier son pseudo
		if(!empty($this->data['newPseudo'])){
			//On verifie que le pseudo soit alphanumerique compris entre borne MIN et MAX
			if(StringHandler::isAlphaNumeric($this->data['newPseudo'],PSEUDO_MIN,PSEUDO_MAX)){
				//On met à jour la BDD
				try{
					if($model->makeChange($user,'u_pseudo', $this->data['newPseudo'])){
						echo json_encode(array('newPseudo'=>$this->data['newPseudo']));
					}
				}
				catch(Exception $e){
					echo json_encode(array('error'=>'Problème lors de la connexion à la base de donnée'));
				}
				

			}
			else{
				echo json_encode(array('error'=>'Le pseudo doit être alphanumérique, compris entre '.PSEUDO_MIN.' et '.PSEUDO_MAX.' caractères.'));
			}
			
		}
		//Si newNom existe, c'est que l'utilisateur veut modifier son nom
		else if(!empty($this->data['newNom'])){
			//On verifie que le nom soit alpha compris entre borne MIN et MAX
			if(StringHandler::isAlpha($this->data['newNom'],NOM_MIN,NOM_MAX)){
				try{
					//On met à jour la BDD
					if($model->makeChange($user,'u_nom', $this->data['newNom'])){
						echo json_encode(array('newNom'=>$this->data['newNom']));
					}
				}
				catch(Exception $e){
					echo json_encode(array('error'=>'Problème lors de la connexion à la base de donnée'));
				}
			}
			else{
				echo json_encode(array('error'=>'Le nom doit être composé de lettres et tirets, compris entre '.NOM_MIN.' et '.NOM_MAX.' caractères.'));
			}
			
		}
		//Si newPrenom existe, c'est que l'utilisateur veut modifier son prenom
		else if(!empty($this->data['newPrenom'])){
			//On verifie que le prenom soit alpha compris entre borne MIN et MAX
			if(StringHandler::isAlpha($this->data['newPrenom'],PRENOM_MIN,PRENOM_MAX)){
				try{
					//On met à jour la BDD
					if($model->makeChange($user,'u_prenom', $this->data['newPrenom'])){
						echo json_encode(array('newPrenom'=>$this->data['newPrenom']));
					}
				}
				catch(Exception $e){
					echo json_encode(array('error'=>'Problème lors de la connexion à la base de donnée'));
				}
			}
			else{
				echo json_encode(array('error'=>'Le nom doit être composé de lettres et tirets, compris entre '.PRENOM_MIN.' et '.PRENOM_MAX.' caractères.'));
			}
		}
		else if(!empty($this->data['newMail'])){
			//On verifie que le mail soit valide
			if(StringHandler::isValidEmail($this->data['newMail'],MAIL_MIN,MAIL_MAX)){
				//On verifie si le mail est deja en BDD
				if(!$model->issetMailDB($this->data['newMail'])){
					try{
						//On met à jour la BDD
						if($model->makeChange($user,'u_mail', $this->data['newMail'])){
							echo json_encode(array('newMail'=>$this->data['newMail']));
						}
					}
					catch(Exception $e){
						echo json_encode(array('error'=>'Problème lors de la connexion à la base de donnée'));
					}	
				}
				else{
					echo json_encode(array('error'=>'Ce mail est associé à un autre utilisateur'));
				}
			}
			else{
				echo json_encode(array('error'=>'Le mail est invalide.'));
			}
		}
		else{
			echo json_encode(array('error'=>'Champs vide'));
		}
		
	}

	/**
	 * requete ajax, a partir de données reçu par l'utilisateur, on verifie avec un Handler si tout est ok et on modifie le mot de passe en BDD
	 * @return json encode tableau
	 */
	public function changePassword(){
		$model = new ParametersModel();
		//on recupere le mot de passe haché
		$hash = $this->user->getU_mdp();
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

	/**
	 * methode ajax, reçoi des données utilisateurs pour changer la question et reponse secrete. On verifie l'integrité des données et si tout est ok on met à jour la BDD et on renvoi un message qui définit le statut de la requete
	 * @return JSON
	 */
	public function changeQuestionAnswer(){
		$model = new ParametersModel();
		//on recupere le mot de passe haché
		$hash = $this->user->getU_mdp();
		//On verifie que le mot de passe saisi par l'utilisateur corresponde au mot de passe de la BDD
		if(password_verify($this->data['password'], $hash)){
			//On vérifie que la reponse saisie à la question secrete soit la même que dans la BDD
			if($this->data['answer'] == $this->user->getU_reponse()){
				//On instancie un FormHandler qui va verifier l'intergrité des nouvelles questions et reponses secretes
				$handler = new FormHandler($this->data);
				$tabError = $handler->checkInfoForChangingQuestionAnswer();
				//Si tout est ok $tabError est un tableau vide
				if(count($tabError)==0){
					try{
						//On enregistre en BDD les nouvelles questions/reponses secretes
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

	/**
	 * Change la langue du site et met en BDD la langue par defaut d'un utilisateur
	 * @return void
	 */
	public function switchLanguage(){
		//On recupere l'identifiant de l'utilisateur connecte
		$idUser = $this->user->getU_id();
		//On recupere l'identifiant de la langue selectionné par l'utilisateur
		if(isset($this->parameters['language'])){
			$idLanguage = $this->parameters['language'];
			try{
				$model = new ParametersModel();
				//On met à jour la BDD en modifiant la langue associé à l'utilisateur
				if($model->switchLanguage($idLanguage,$idUser)){
					//On modifie la langue associé en session
					$_SESSION['neozorus']['u_language'] = $idLanguage;
					//On modifie la langue associé à notre instance utilisateur
					$this->user->setU_langue($idLanguage);
					//On affiche notre page
					$this->affichageParametresUtilisateur();
				}
				else{
					$errorController = new ErrorController();
					$errorController->error('Problème lors du changement de langue, veuillez réessayer plus tard');
				}
				
			}
			catch(Exception $e){
				$errorController = new ErrorController();
				$errorController->error('Problème lors du changement de langue, veuillez réessayer plus tard');
			}
		}
		else{
			$errorController = new ErrorController();
			$errorController->error('Problème lors du changement de langue, veuillez réessayer plus tard');
		}	
	}
}