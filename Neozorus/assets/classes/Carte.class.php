<?php
Class Carte{
	private $c_id;
	private $c_libelle;
	private $c_type;
	private $c_puissance;
	private $c_pvMax;
	private $c_mana;
	private $c_gabarit;
	private $c_indice = NULL;
	private $c_localisation = 'pioche';
	const EXEMPLAIRE_CREATURE = Nb_EXEMPLAIRE_CREATURE;
	const  EXEMPLAIRE_SPECIALE = Nb_EXEMPLAIRE_SPECIALE;
	const EXEMPLAIRE_SORT = Nb_EXEMPLAIRE_SORT;


	public function __construct($data,$indice = 1){
		$this->setC_id($data['c_id']);
		$this->setC_libelle($data['c_libelle']);
		$this->setC_type($data['c_type']);
		$this->setC_puissance($data['c_puissance']);
		$this->setC_pvMax($data['c_pvMax']);
		$this->setC_mana($data['c_mana']);
		$this->setC_gabarit($data['c_type'],$data['c_id']);
		$this->setC_indice($indice);
	}

	private function setC_id($ID){
		$this->c_id = $ID;
	}

	private function setC_libelle($Libelle){
		$this->c_libelle = $Libelle;
	}

	private function setC_type($Type){
		$this->c_type = $Type;
	}

	private function setC_puissance($Puissance){
		$this->c_puissance = $Puissance;
	}

	private function setC_pvMax($pvMax){
		$this->c_pvMax = $pvMax;
	}

	private function setC_mana($Mana){
		$this->c_mana = $Mana;
	}

	private function setC_gabarit($type,$id){
		switch ($type) {
			case 'creature':
				$this->c_gabarit = CREATURE_PATH . DS . $id . '.png';
				break;
			case 'sort':
				$this->c_gabarit = SORT_PATH . DS . $id . '.png';
				break;
			case 'speciale':
				$this->c_gabarit = SPECIAL_PATH . DS . $id . '.png';
				break;		
		}
	}

	private function setC_indice($indice){
		switch ($this->c_type) {
			case 'creature':
				if ($indice >0 && $indice <= self::EXEMPLAIRE_CREATURE) {
					$this->c_indice = $indice;				
				}
				else{
					return false;
				}
				break;
		}
	}

	public function getC_id(){
		return $this->c_id;
	}

	public function getC_libelle(){
		return $this->c_libelle;
	}

	public function getC_type(){
		return $this->c_type;
	}

	public function getC_puissance(){
		return $this->c_puissance;
	}

	public function getC_pvMax(){
		return $this->c_pvMax;
	}

	public function getC_mana(){
		return $this->c_mana;
	}

	public function getC_gabarit(){
		return $this->c_gabarit;
	}

	public function getC_indice(){
		return $this->c_indice;
	}

}