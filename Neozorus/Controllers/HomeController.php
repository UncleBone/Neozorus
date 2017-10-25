<?php

class HomeController extends CoreController{



	public function affichagePageAccueil(){
		$userID = $this->session;
		$model = new HomeModel();
		if(!empty($userData = $model->verifyUser($userID))){
			$user = $userData[0] -> getU_pseudo();
			include('./Views/Home/HomeView.php');			
		}
	}

	public function affichagePageRegles(){
		$user = $this->session;
		$model = new HomeModel();
		if(!empty($model->verifyUser($user))){
			include('./Views/Home/ReglesHomeView.php');
		}
	}
	
	public function deconnexion(){
	unset($_SESSION['neozorus']);
	header('Location:.');
	exit;
	}
}