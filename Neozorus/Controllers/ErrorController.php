<?php
class ErrorController extends CoreController{
	/**
	 * Affiche une view avec un message d'erreur standard, sans précision
	 * @return 
	 */
	public function error($message = null){
		if(isset($message)){
			$this->loadErrorView($message);
		}
		else{
			$this->loadErrorView();
		}
	}
		
	
	
	/**
	 * Affiche une page d'erreur 404
	 */
	public function error404(){
		$this->loadErrorView('Cette page n\'existe pas', 'Error 404', 404);    
	}

	/**
	 * Affiche un message d'erreur quand un utilisateur sans session tente d'acceder à une page
	 */
	public function noSession(){
		$this->loadErrorView('Vous tentez d\'acceder à une page qui necessite une connexion, veuillez vous connecter','Aucune Session');
	}

	/**
	 * Crée un view qui affiche une erreur
	 * @param  string $errorMessage message descriptif de l'érreur
	 * @param  string $titre        titre de la page
	 * @param  [int|null] $codeError	Definit le code d'erreur http
	 */
	private function loadErrorView($errorMessage = 'Une erreur interne c\'est produite, veuillez réessayer ultérieurement.',$titre = 'Error',$codeError = null){
		if(isset($codeError)){
			http_response_code(404);
		}	
		include(VIEW_ERROR);
	    exit;
	}
}