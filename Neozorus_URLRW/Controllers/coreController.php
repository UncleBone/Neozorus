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
		foreach ($parameters as $key => $value) {
			$this->parameters[$key] = htmlentities($value);
		}
	}

	/**
	 * Rempli le tableau $data
	 * @param array $data Contient les données reçues en POST
	 */
	public function setData(array $data){
		foreach ($data as $key => $value) {
			$this->data[$key] = htmlentities($value);
		}
	}

	/**
	 * Templi le tableau Session
	 * @param array $session Contient les données reçues en SESSION
	 */
	public function setSession(array $session){
		$this->session = $session;
	}


	/**
	 * test si il existe une session, sinon, on invoque le controller Error sur sa methode noSession 
	 * @return boolean [description]
	 */
    protected function isSessionNeozorus(){
		if(!isset($_SESSION['neozorus'])){
			$controller= new ErrorController();
			$controller->noSession();
		}  		
	}
}