<?php
class ParametersController extends CoreController{

	private $user;
	private $languages;

	public function __construct(){
		$this->isSessionNeozorus();	//On verifie qu'une session est en cours
		$this->getUserData();
		if($_SESSION['neozorus']['u_id'] == 2){
			header('Location:.?controller=home&action=display');
		}
	}

/***************** Retourne les informations de l'utilisateur ***********************/

	private function getUserData(){
		try{
			$model = new UserModel();
			$user = $model -> getData($_SESSION['neozorus']['u_id']);
			$this->user = $user[0];
		}
		catch(Exception $e){
			$controller = new ErrorController();
			$controller->error($e->getMessage());
		}
	}

	// private function getlanguages(){
	// 	try{
	// 		$model = new ParametersModel();
	// 		$this->languages = $model -> getLanguages();
	// 	}
	// 	catch(Exception $e){
	// 		$controller = new ErrorController();
	// 		$controller->error($e->getMessage());
	// 	}
	// }

/**************** Affiche les paramètres **********************/

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
		if(!empty($this->data['langue'])){
			$this->changeLangue($this->data['langue']);
		}

		ob_start();
		require(VIEWS_PATH . DS . 'Parameters' . DS . 'ParametersView.php');
		$view = ob_get_contents();
		ob_clean();
		require(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
	}

/**************** Change la langue par de l'utilisateur **********************/

	private function changeLangue($lang){
		if(($lang == '1' || $lang == '2') && $lang != $this->session['u_language']){
			$model = new UserModel();
			$model->updateLangue($this->session['u_id'], $lang);
			$_SESSION['neozorus']['u_language'] = $lang;
			header('Location:.?controller=parameters&action=display');
		}
	}

/**************** Page de changement d'email **********************/

	public function changeEmail(){
		$title = 'Paramètres';
		$lang = 1 ;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		/* Vérification des entrées du fomulaire */
		if(!empty($this->data)){		
			$check  = $this->checkEmailValidity();
			if ($check !== true) {
				$error = $check;
			}elseif(empty($this->data['confirmNewEmail']) || $this->data['confirmNewEmail'] != $this->data['newEmail']){
				$error = 'Erreur de confirmation';
			}else{
				$check  = $this->checkPassword();
				if ($check !== true) {
					$error = $check;
				}else{
					$model = new UserModel();
					if($model->updateEmail($_SESSION['neozorus']['u_id'], $this->data['newEmail'])){
						$success = 'Changement effectué avec succès';
					}else{
						$error = 'Erreur d\'écriture dans la base de données';
					}
				}
			}
		}

		ob_start();
		require(VIEWS_PATH . DS . 'Parameters' . DS . 'ChangeEmail.php');
		$view = ob_get_contents();
		ob_clean();
		require(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
	}

/**************** Page de changement de pseudo **********************/

	public function changePseudo(){
		$title = 'Paramètres';
		$lang = 1 ;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		/* Vérification des entrées du fomulaire */
		if(!empty($this->data)){		
			if (empty($this->data['newPseudo'])) {
				$error = 'Veuillez renseigner le nouveau pseudo';
			}else{
				$check  = $this->checkPassword();
				if ($check !== true) {
					$error = $check;
				}else{
					$model = new UserModel();
					if($model->updatePseudo($_SESSION['neozorus']['u_id'], $this->data['newPseudo'])){
						$success = 'Changement effectué avec succès';
					}else{
						$error = 'Erreur d\'écriture dans la base de données';
					}
				}
			}
		}

		ob_start();
		require(VIEWS_PATH . DS . 'Parameters' . DS . 'ChangePseudo.php');
		$view = ob_get_contents();
		ob_clean();
		require(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
	}

/**************** Page de changement de mot de passe **********************/

	public function changePassword(){
		$title = 'Paramètres';
		$lang = 1 ;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		/* Vérification des entrées du fomulaire */
		if(!empty($this->data)){		
			if (empty($this->data['password'])) {
				$error = 'Veuillez renseigner le mot de passe actuel';
			}else{
				$check  = $this->checkPassword();
				if ($check !== true) {
					$error = $check;
				}elseif(empty($this->data['newPassword'])){
					$error = 'Veuillez renseigner le nouveau mot de passe';
				}elseif (empty($this->data['confirmNewPassword']) || $this->data['confirmNewPassword'] != $this->data['newPassword']) {
					$error = 'Erreur de confirmation';
				}else{
					$model = new UserModel();
					if($model->updatePassword($_SESSION['neozorus']['u_id'], password_hash($this->data['newPassword'], PASSWORD_DEFAULT))){
						$success = 'Changement effectué avec succès';
					}else{
						$error = 'Erreur d\'écriture dans la base de données';
					}
				}
			}
		}

		ob_start();
		require(VIEWS_PATH . DS . 'Parameters' . DS . 'ChangePassword.php');
		$view = ob_get_contents();
		ob_clean();
		require(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
	}

/**************** Page de changement de question secrète **********************/

	public function changeQuestion(){
		$title = 'Paramètres';
		$lang = 1 ;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		/* Vérification des entrées du fomulaire */
		if(!empty($this->data)){		
			if (empty($this->data['newQuestion'])) {
				$error = 'Veuillez renseigner la nouvelle question secrète';
			}elseif (empty($this->data['newAnswer'])) {
				$error = 'Veuillez renseigner la réponse';
			}else{
				$check = $this->checkPassword();
				if ($check !== true) {
					$error = $check;
				}else{
					$model = new UserModel();
					if($model->updateQuestion($_SESSION['neozorus']['u_id'], $this->data['newQuestion'], $this->data['newAnswer'])){
						$success = 'Changement effectué avec succès';
					}else{
						$error = 'Erreur d\'écriture dans la base de données';
					}
				}
			}
		}

		ob_start();
		require(VIEWS_PATH . DS . 'Parameters' . DS . 'ChangeQuestion.php');
		$view = ob_get_contents();
		ob_clean();
		require(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
	}

/***************** Vérifie la validité d'une adresse email ***********************/

	public function checkEmailValidity(){
		if(!empty($this->data['newEmail'])){
			$email = $this->data['newEmail'];
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$model = new UserModel();
				$list = array_column($model->getLoginList(), 'u_mail');
				if(!in_array($email, $list)){
					$retour = true;
				}else{
					$retour = 'Cet email est déjà pris';
				}
			}else{
				$retour = 'Adresse email invalide';
			}
		}else{
			$retour = 'Veuillez renseigner la nouvelle adresse email';
		}
		// header('Content-Type: application/json; charset=utf-8');
	 //    echo json_encode($retour);
		return $retour;
	}

/***************** Vérifie la validité d'un mot de passe ***********************/

	public function checkPassword(){
		if(!empty($this->data['password'])){
			$model = new UserModel();
			$hash = $model->getPassword($_SESSION['neozorus']['u_id'])[0]['u_mdp'];
			if(password_verify($this->data['password'], $hash)){
				$retour = true;				
			}else{
				$retour = 'Mot de passe incorrect';
			}
		}else{
			$retour = 'Veuillez rentrer votre mot de passe';
		}
		return $retour;
	}
}