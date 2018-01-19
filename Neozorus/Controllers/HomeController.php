<?php

class HomeController extends CoreController{

	/**
	 * Génère une page d'acceuil personnalisé si l'authentification d'un utilisateur a réussi
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
	public function affichagePageRegles(){
			include('./Views/Home/ReglesHomeView.php');
		
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