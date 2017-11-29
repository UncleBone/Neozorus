<?php
class CoreController{
	protected $parameters;// array parametres obtenu en GET par défaut
	protected $data;// array Données obtenu en POST par défaut
	protected $session;// array Données obtenu en SESSION par défaut

	/**
	 * initalise les tableaux parameters,data et session
	 */
	public function __construct(){
		$this->parameters = array();
		$this->data = array();
		$this->session = array();
	}

	/**
	 * Rempli le tableau $parameters
	 * @param array $parameters Contient les données reçues en GET
	 */
	public function setParameters(array $parameters){
		$this->parameters = $parameters;
	}

	/**
	 * Rempli le tableau $data
	 * @param array $data Contient les données reçues en POST
	 */
	public function setData(array $data){
		$this->data = $data;
	}

	/**
	 * Templi le tableau Session
	 * @param array $session Contient les données reçues en SESSION
	 */
	public function setSession(array $session){
		$this->session = $session;
	}

	/**
	 * génère une erreur 404 et redirige sur une page d'érreur
	 */
	public function redirect404(){
        http_response_code(404);
        include(VIEWS_PATH . DS . '404.php');
        exit;
    }

    protected function isSessionNeozorus(){	
		if(!isset($_SESSION['neozorus'])){
			header('Location:.');
			exit;
		}  		
	}
}