<?php
class Deck
{
	private $id;		// Identifiant du deck [int]
	private $libelle;	// Nom du deck [string]
	private $personnage;	// Identifiant du héros associé au deck [int]
	private $cartes; 	// Tableau des cartes composant le deck [array(Carte)]

	const MAX_CARTE = NB_MAX_CARTE;		// Nombre de carte maximum que peut contenir un deck

	// public function __construct(array $data){
	// 	$this->setId($data['d_id']);
	// 	$this->setLibelle($data['d_libelle']);
	// 	$this->setPersonnage($data['d_personnage_fk']);
	// }
	public function __construct($id, $libelle, $team){
		$this->setId($id);
		$this->setLibelle($libelle);
		$this->setPersonnage($team);
	}

/**************** SETTERS ********************/

	private function setId($ID){
		$this->id = $ID;
	}

	private function setLibelle($Libelle){
		$this->libelle = $Libelle;
	}

	private function setPersonnage($idPersonnage){
		$this->personnage = $idPersonnage;
	}

	public function setCartes(){
		$model = new CarteModel();
		$data = $model->getCardsByDeck($this->id);
		foreach ($data as $value){
			$this->cartes[]=new Carte($value['c_id'], $value['c_libelle'], $value['c_type'], $value['c_puissance'], $value['c_pvMax'], $value['c_mana'], $value['nbExemplaire']);
		}
	}

/**************** GETTERS ********************/

	public function getId(){
		return $this->id;
	}

	public function getLibelle(){
		return $this->libelle;
	}

	public function getPersonnage(){
		return $this->personnage;
	}

	public function getCartes(){
		return $this->cartes;
	}

	// public function AjouterCarte(Carte $carte){
	// 	$indice=0;
	// 	if(count($this->d_cartes) < self::MAX_CARTE){
	// 		foreach ($this->d_cartes as $key => $value) {
	// 			if($value->getC_id()==$carte->getC_id()){
	// 				$indice++;
	// 			}
	// 		}
	// 		switch ($carte->getC_type()) {
	// 			case 'creature':
	// 				if($indice<2){
	// 					$this->d_cartes[]=$carte;
	// 				}
	// 				break;
	// 			case 'speciale':
	// 				if($indice<1){
	// 					$this->d_cartes[]=$carte;
	// 				}
	// 				break;
	// 			case 'sort':
	// 				if($indice<1){
	// 					$this->d_cartes[]=$carte;
	// 				}
	// 				break;							
	// 		}
	// 	}
	// }
}