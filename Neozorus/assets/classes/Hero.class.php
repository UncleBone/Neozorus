<?php
class Hero {
	/**
	 * Identifiant du héro
	 * @var [int]
	 */
	private $h_id;

	/**
	 * Nom du héro
	 * @var [string]
	 */
	private $h_libelle;

	/**
	 * Point de Vie Max du héro
	 * @var [int]
	 */
	private $h_pvMax;

	/**
	 * url vers l'illustration du héro
	 * @var [null|string]
	 */
	private $h_gabarit = NULL;

	/**
	 * Instancie un héro
	 * @param [array] $data tableau comportant toutes les informations nécessaires à l'instanciation d'un hero
	 */
	public function __construct (array $data){
		$this->setH_id($data['p_id']);
		$this->setH_libelle($data['p_libelle']);
		$this->setH_pvMax($data['p_pvMax']);
		$this->setH_gabarit(HERO_PATH.DS.$data['p_id'].'.png');
	}

	/**
	 * getter Id
	 * @return [int]
	 */
	public function getH_id(){
		return $this->p_id;
	}

	/**
	 * getter Nom du héro
	 * @return [string] 
	 */
	public function getH_libelle(){
		return $this->p_libelle;
	}

	/**
	 * getter PVMax
	 * @return [int]
	 */
	public function getH_pvMax(){
		return $this->p_pvMax;
	}

	/**
	 * getter url illustration
	 * @return [string] 
	 */
	public function getH_gabarit(){
		return $this->p_gabarit;
	}

	/**
	 * setter Id
	 * @param [int] $ID 
	 */
	private function setH_id($ID){
		$this->p_id = $ID;
	}

	/**
	 * setter nom du hero
	 * @param [string] $libelle
	 */
	private function setH_libelle($libelle){
		$this->p_libelle = $libelle;
	}

	/**
	 * setter PVMax
	 * @param [int] $pvMax
	 */
	private function setH_pvMax($pvMax){
		$this->p_pvMax =$pvMax;
	}

	/**
	 * setter url illustration
	 * @param [string] $gabarit 
	 */
	private function setH_gabarit($gabarit){
		$this->p_gabarit = $gabarit;
	}
}