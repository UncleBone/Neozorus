<?php 
class UserController extends CoreController
{
	/*Fonction d'affichage de la view dans le layout
	**/
	public function display($viewName,$param = array()){
		if(!empty($_SESSION['neozorus']['u_id'])){
			header('Location:.?controller=home&action=display');
			exit();
		}
		extract($param);
		ob_start();
		require( VIEWS_PATH . DS . 'Connexion' . DS . $viewName );
		$view = ob_get_contents();
		ob_clean();
		require(VIEWS_PATH . DS . 'Connexion' . DS . 'Layout.php');
	}

	/*Affichage de la page de choix
	**/
	public function connexionInscription(){
		$param['title'] = 'Connexion/Inscription';
		$this->display('ConnexionInscription.php',$param);
	}	

	/*Affichage du formulaire de connexion
	**/
	public function connexion(){
		$param['title'] = 'Connexion';
		$param['email'] = (!empty($this->session['connexion']['email']) ? $this->session['connexion']['email'] : '');
		$param['mdp'] = (!empty($this->session['connexion']['mdp']) ? $this->session['connexion']['mdp'] : '');
		$param['error'] = (!empty($this->parameters['error']) ? $this->parameters['error'] : '');
		$param['errorMessage'] = $this->errorMessage($param['error']);
		$this->display('Connexion.php',$param);
	} 

	/*Vérification des identifiants de connexion
	**/
	public function traitementConnexion(){
		foreach ($this->data as $key => $value) {
			$_SESSION['neozorus']['connexion'][$key]=$value;
		}
		$email = (!empty($this->data['email']) ? $this->data['email'] : '');
		$mdp = (!empty($this->data['mdp']) ? $this->data['mdp'] : '');
		$check = $this->checkLogin($email,$mdp);
		$language = $this->checkLanguage($check);
		if(!is_numeric($check)){
			header("Location:.?controller=user&action=connexion&error=".$check);
			exit();
		}else{
			$_SESSION['neozorus']['u_id'] = $check;
			$_SESSION['neozorus']['u_language'] = $language;
			unset($_SESSION['neozorus']['connexion']);
			header("Location:.?controller=home&action=display");
			exit();
		}
	}

/*** connexion en tant qu'invité ***/

	public function connectAsGuest(){
		$_SESSION['neozorus']['u_id'] = 2;
		unset($_SESSION['neozorus']['connexion']);
		header("Location:.?controller=home&action=display");
		exit();
	}

	public function checkLogin($email,$mdp){
		$Log=false;
		$MdP=false;	

		$user = new UserModel();
		$data = $user->getLoginList();
		
		foreach ($data as $key => $value) {
			if(!empty($email) && $email==$value['u_mail']){
				$Log=True;
				if(!empty($mdp) && password_verify($mdp,$value['u_mdp'])){
					$MdP=True;
					$id = $value['u_id'];
					break;
				}
			}
		}
		if($Log==false){
			return "Error_login";
		}elseif($MdP==false){
			return "Error_psswd";
		}else{
			return $id;
		}
	}

	private function checkLanguage($idUser){
		try{
			$user = new UserModel();
			 return $data = $user->getLanguageFor($idUser);
		}
		catch(Exception $e){
			return 1;
		}
		
	}

	/*Affichage du formulaire d'inscription
	**/
	public function inscription(){
		$para['title'] = 'Inscription';
		$para['param'] = (!empty($this->session['inscription']) ? $this->session['inscription'] : array());
		$para['error'] = (!empty($this->parameters['error']) ? $this->parameters['error'] : '');
		$para['errorMessage'] = $this->errorMessage($para['error']);
		$this->display('Inscription.php',$para);
	}

	/*Traitement du formulaire d'inscription
	**/
	public function traitementInscription(){
		foreach ($this->data as $key => $value) {
			$_SESSION['neozorus']['inscription'][$key]=$value;
		}
		$param = (!empty($this->data) ? $this->data : array());
		//$user = new UserModel;
		$check = $this->checkInscription($param);
		if($check!="error_i_"){
			header("Location:.?controller=user&action=inscription&error=".$check);
			exit();
		}else{
			header("Location:.?controller=user&action=inscriptionPseudo");
			exit();
		}
	}

	/*Vérifie la validité des entrées du formulaire d'inscription
	**/
	public function checkInscription($entries = array()){
		$error="error_i_";
		if (empty($entries['prenom']) || empty($entries['nom'])) {
			$error.="no_name";
		}elseif (empty($entries['date_naissance'])) {
			$error.="no_date";
		}elseif (empty($entries['mail'])) {
			$error.="no_email";
		}elseif (empty($entries['confirm_mail']) || $entries['mail']!=$entries['confirm_mail']) {
			$error.="wrong_confirm_email";
		}elseif(!$this->uniciteEmail($entries['mail'])){
			$error.="email_already_used";
		}elseif (filter_var($entries['mail'], FILTER_VALIDATE_EMAIL)===false) {
			$error .= "wrong_mail";
		}elseif (empty($entries['mdp'])) {
			$error.="no_psswd";
		}elseif (empty($entries['confirm_mdp']) || $entries['mdp']!=$entries['confirm_mdp']) {
			$error.="wrong_confirm_psswd";
		}elseif (empty($entries['question'])) {
			$error.="no_question";
		}elseif (empty($entries['reponse'])) {
			$error.="no_answer";
		}elseif (empty($entries['accepter'])) {
			$error.="no_agreement";
		}elseif (!ctype_alpha(str_replace(' ','', $entries['prenom'])) || !ctype_alpha(str_replace(' ','', $entries['nom']))) {
			$error.="wrong_name";
		}else{
			if(strpos($entries['date_naissance'],'/'))
			{
				$error .= $this->checkBirthday('/');
			}else{
				$error .= $this->checkBirthday('-');
			}
		}
		return $error;
	}

	/*Fonction de vérification de l'unicité de l'adresse email
	**/
	public function uniciteEmail($email){

		$user = new UserModel;
		$data = $user->getLoginList();
		$uni = true;

		foreach ($data as $key => $value) {
			if($email == $value['u_mail']){
				$uni = false;
				break;
			}
		}
		return $uni;
	}

	/*Fonction de vérification de la date de naissance (formats français et américain)
	**/
	public function checkBirthday($param){
		$error='';
		$birthday = explode($param, $_POST['date_naissance']);
		if (count($birthday)!=3){
			$error ="wrong_date";
		}else{
			for($i=0;$i<3;$i++) {
				if(!ctype_digit((string)$birthday[$i])){
					$error="wrong_date";
				}else{
					if($param=='/'){
						if($i==0 && ((int)$birthday[$i]<1 || (int)$birthday[$i]>31)){
							$error="wrong_date";
						}
						if($i==1 && ((int)$birthday[$i]<1 || (int)$birthday[$i]>12)){
							$error="wrong_date";
						}
						if($i==2 && ((int)$birthday[$i]>date('Y'))){
							$error="wrong_date";
						}
					}else{
						if($i==2 && ((int)$birthday[$i]<1 || (int)$birthday[$i]>31)){
							$error="wrong_date";
						}
						if($i==1 && ((int)$birthday[$i]<1 || (int)$birthday[$i]>12)){
							$error="wrong_date";
						}
						if($i==0 && ((int)$birthday[$i]>date('Y'))){
							$error="wrong_date";
						}
					}
				}
			}
		}
		return $error;
	}

	/*Affichage du formulaire de choix de pseudo
	**/
	public function inscriptionPseudo(){
		$param['title'] = 'Inscription';
		$param['error'] = (!empty($this->parameters['error']) ? $this->parameters['error'] : '');
		$param['errorMessage'] = $this->errorMessage($param['error']);
		$this->display('InscriptionPseudo.php',$param);
	}


	/*Traitement du formulaire de choix de pseudo
	**/
	public function traitementInscriptionPseudo(){
		if(empty($this->data['pseudo'])){
			header("Location:.?controller=user&action=inscriptionPseudo&error=error_i_no_pseudo");
			exit();
		}else{
			$_SESSION['neozorus']['inscription']['pseudo'] = htmlentities($this->data['pseudo']);
			header("Location:.?controller=user&action=enregistrementInscription");
			exit();
		}
	}

	/*Enregistrement de l'inscription
	**/
	public function enregistrementInscription(){
		$param['title'] = 'Inscription';
		$param['entries'] = $this->session['inscription'];
		$param['entries']['date_naissance'] = $this->convertDate($param['entries']['date_naissance']);
		$user = new UserModel;
		$param['result'] = $user->enregistrement($param['entries']);
		unset($_SESSION['neozorus']['inscription']);
		$this->display('InscriptionConfirmation.php',$param);
	}

	/*Conversion de la date de naissance au format SQL
	**/
	function convertDate($date)	{
		if(strpos($date,'/')){
			$tab = explode('/', $date);
			$convert = $tab[2].'-'.$tab[1].'-'.$tab[0];
			return $convert;
		}else{
			return $date;
		}
	}

	/*Affichage des messages d'erreur
	**/
	public function errorMessage($error){
		
		switch ($error) {

			case 'Error_login':
				return 'Erreur de login!';
				break;

			case 'Error_psswd':
				return 'Erreur de mot de passe!';
				break;

			case 'error_i_no_name':
				return 'Merci d\'entrer vos nom et prénom!';
				break;

			case 'error_i_no_date':
				return 'Merci d\'entrer votre date de naissance!';
				break;

			case 'error_i_no_email':
				return 'Merci d\'entrer votre adresse email!';
				break;
			
			case 'error_i_wrong_confirm_email':
				return 'Erreur de confirmation de l\'adresse email!';
				break;

			case 'error_i_email_already_used':
				return 'Cette adresse email est déjà utilisée!';
				break;

			case 'error_i_no_psswd':
				return 'Merci d\'entrer un mot de passe!';
				break;

			case 'error_i_wrong_confirm_psswd':
				return 'Erreur de confirmation du mot de passe!';
				break;

			case 'error_i_no_question':
				return 'Merci de renseigner votre question secrète!';
				break;

			case 'error_i_no_answer':
				return 'Merci de préciser la réponse à votre question secrète!';
				break;

			case 'error_i_no_agreement':
				return 'Vous n\'avez pas accepté les conditions d\'utilisation!';
				break;

			case 'error_i_wrong_date':
				return 'La date de naissance est erronée!';
				break;

			case 'error_i_wrong_mail':
				return 'L\'adresse email est erronée!';
				break;

			case 'error_i_no_pseudo':
				return 'Merci de choisir un pseudo!';
				break;

			default:
				return "Erreur indéterminée";
				break;
		}
	}

	public function deconnexion(){
		unset($_SESSION['neozorus']);
		header('Location:.');
		exit;
	}
	
}