<?php
class Deck{
	private $d_id;
	private $d_libelle;
	const MAX_CARTE = NB_MAX_CARTE;

	public function __construct($data){
		$this->setD_id($data['d_id']);
		$this->setD_libelle($data['d_libelle']);
	}

	private function setD_id($ID){
		$this->d_id = $ID;
	}

	private function setD_libelle($Libelle){
		$this->d_libelle = $Libelle;
	}

	public function getD_id(){
		return $this->d_id;
	}

	public function getD_libelle(){
		return $this->d_libelle;
	}

	public function AjouterCarte(Carte $carte){
		$indice=0;
		if(count($this->d_cartes) < self::MAX_CARTE){
			foreach ($this->d_cartes as $key => $value) {
				if($value->getC_id()==$carte->getC_id()){
					$indice++;
				}
			}
			switch ($carte->getC_type()) {
				case 'creature':
					if($indice<2){
						$this->d_cartes[]=$carte;
					}
					break;
				case 'speciale':
					if($indice<1){
						$this->d_cartes[]=$carte;
					}
					break;
				case 'sort':
					if($indice<1){
						$this->d_cartes[]=$carte;
					}
					break;							
			}
		}
	}
}