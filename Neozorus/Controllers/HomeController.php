<?php

class HomeController extends CoreController{

	/**
	 * Affiche la page d'accueil
	 */
	public function display(){
		$this->isSessionNeozorus();
		$userID = $this->session;
		$model = new HomeModel();
		if(!empty($userData = $model->verifyUser($userID))){
			$user = $userData -> getU_pseudo();
			include(VIEWS_PATH . DS . 'Home' . DS . 'HomeView.php');
		}
	}

	/**
	 * Affiche la page des régles du jeu
	 */
	public function rules(){
		include(VIEWS_PATH . DS . 'Home' . DS . 'RulesView.php');
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