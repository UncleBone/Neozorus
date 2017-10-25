<?php
class CoreController{
	protected $parameters;// array parametres obtenu en GET par défaut
	protected $data;// array Données obtenu en POST par défaut
	protected $session;

	public function __contruct(){
		$this->parameters = array();
		$this->data = array();
		$this->session = array();
	}

	public function setParameters(array $parameters){
		$this->parameters = $parameters;
	}

	public function setData(array $data){
		$this->data = $data;
	}

	public function setSession(array $session){
		$this->session = $session;
	}
}