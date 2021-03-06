<?php

class HomeController extends CoreController{

	/**
	 * Affiche la page d'accueil
	 */
	public function display(){
		$this->isSessionNeozorus();
		$lang = 1;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		$title = 'Home';
		$titleTrad = $lang == 1 ? 'Accueil' : $title;
		$helloTrad = $lang == 1 ? 'Bienvenue ' : 'Welcome ';
		$userID = $this->session;
		$team = !empty($this->parameters['team']) ? $this->parameters['team'] : '';
		$model = new HomeModel();
		if(!empty($userData = $model->verifyUser($userID))){
			$user = $userData -> getU_pseudo();
			ob_start();
			include(VIEWS_PATH . DS . 'Home' . DS . 'HomeView.php');
			$view = ob_get_contents();
			ob_clean();
			include(VIEWS_PATH . DS . 'Common' . DS . 'splitBackgroundLayout.php');
		}else{
			header('Location:.');
		}
	}

	/**
	 * Affiche la page des régles du jeu
	 */
	public function rules(){
		$title = 'Règles du jeu';

		$lang = 1;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}

		ob_start();
		include(VIEWS_PATH . DS . 'Home' . DS . 'RulesView.php');
		$view = ob_get_contents();
		ob_clean();
		include(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
	}
	
	/**
	 * Deconnecte un utilisateur et le redirige sur la page de connexion
	 */
	public function deconnexion(){
		unset($_SESSION['neozorus']);
		header('Location:.');
		exit;
	}

}