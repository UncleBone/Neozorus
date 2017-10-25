<?php
class Hero {
	private $h_id;
	private $h_libelle;
	private $h_pvMax;
	private $h_gabarit = NULL;

	public function __construct ($data){
		$this->setH_id($data['p_id']);
		$this->setH_libelle($data['p_libelle']);
		$this->setH_pvMax($data['p_pvMax']);
		$this->setH_gabarit(HERO_PATH.DS.$data['p_id'].'.png');
	}

	public function getH_id(){
		return $this->p_id;
	}

	public function getH_libelle(){
		return $this->p_libelle;
	}

	public function getH_pvMax(){
		return $this->p_pvMax;
	}

	public function getH_gabarit(){
		return $this->p_gabarit;
	}

	private function setH_id($ID){
		$this->p_id = $ID;
	}

	private function setH_libelle($libelle){
		$this->p_libelle = $libelle;
	}

	private function setH_pvMax($pvMax){
		$this->p_pvMax =$pvMax;
	}

	private function setH_gabarit($gabarit){
		$this->p_gabarit = $gabarit;
	}
}