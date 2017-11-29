<?php
class ErrorController extends CoreController{

	public function error(){
		$this->loadErrorView();
	}
	
	public function error404(){
		$this->loadErrorView('Cette page n\'existe pas', 'Error 404', 404);    
	}

	public function noSession(){
		$this->loadErrorView('Vous tenter d\'acceder à une page qui nécessite une connexion, veuillez vous connecter','Aucune Session');
	}

	private function loadErrorView($errorMessage = 'Une erreur interne c\'est produit, veuillez réessayer ultérieurement.',$titre = 'Error',$codeError = null){
		if(isset($codeError)){
			http_response_code(404);
		}	
		include(VIEW_ERROR);
	    exit;
	}
}