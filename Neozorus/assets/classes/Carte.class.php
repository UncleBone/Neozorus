<?php
// Class Carte implements JsonSerializable{
Class Carte 
{
	private $id;	// Identifiant de la carte [int]
	private $libelle;	// Nom de la carte [string]
	private $type;	// Type de la carte (ex:creature,sort,speciale...) [string]
	private $puissance;	// Puissance de la carte [int]
	private $pvMax;	// Point de Vie maximum de la carte [int]
	private $mana;	// Coût en mana de la carte [int]
	private $gabarit;	// Chemin vers l'illustration de la carte [string]
	private $indice = NULL;	// Indice de la carte (pour differencier des cartes en double dans un deck) [null|int]

	const EXEMPLAIRE_CREATURE = Nb_EXEMPLAIRE_CREATURE;	//Nombre de creature doublon autorise
	const  EXEMPLAIRE_SPECIALE = Nb_EXEMPLAIRE_SPECIALE;	//Nombre de carte speciale doublon autorise
	const EXEMPLAIRE_SORT = Nb_EXEMPLAIRE_SORT;	//Nombre de carte sort doublon autorise

	/**
	 * Instancie une carte à partir d'un tableau $data, et d'un parametre facultatif $indice
	 *
	 * @param [array]  $data   tableau comportant toutes les informations nécessaires à l'instanciation d'une carte
	 * @param [int] $indice spécifie l'indice d'une carte, par défaut c'est égal à 1
	 */
	// public function __construct(array $data,$indice = 1){
	// 	$this->setC_id($data['c_id']);
	// 	$this->setC_libelle($data['c_libelle']);
	// 	$this->setC_type($data['c_type']);
	// 	$this->setC_puissance($data['c_puissance']);
	// 	$this->setC_pvMax($data['c_pvMax']);
	// 	$this->setC_mana($data['c_mana']);
	// 	$this->setC_gabarit($data['c_type'],$data['c_id']);
	// 	$this->setC_indice($indice);
	// }
	public function __construct($id,$libelle,$type,$puissance,$pv,$mana,$indice = 1){
		$this->setId($id);
		$this->setLibelle($libelle);
		$this->setType($type);
		$this->setPuissance($puissance);
		$this->setPvMax($pv);
		$this->setMana($mana);
		$this->setGabarit($type,$id);
		$this->setIndice($indice);
	}

	/**
	 * retourne un tableau avec les attributs de la carte lors d'un JSON_encode
	 * @return [array] 
	 */
	// public function jsonSerialize(){
	// 	$array = array();
	// 	$array['c_id']=$this->c_id;
	// 	$array['c_libelle']=$this->c_libelle;
	// 	$array['c_type']=$this->c_type;
	// 	$array['c_puissance']=$this->c_puissance;
	// 	$array['c_pvMax']=$this->c_pvMax;
	// 	$array['c_mana']=$this->c_mana;
	// 	$array['c_gabarit']=$this->c_gabarit;
	// 	$array['c_indice']=$this->c_indice;
	// 	$array['c_localisation']=$this->c_localisation;

	// 	return $array;
	// }

/**************** SETTERS ********************/

	private function setId($ID){
		$this->id = $ID;
	}

	private function setLibelle($Libelle){
		$this->libelle = $Libelle;
	}

	private function setType($Type){
		$this->type = $Type;
	}

	private function setPuissance($Puissance){
		$this->puissance = $Puissance;
	}

	private function setPvMax($pvMax){
		$this->pvMax = $pvMax;
	}

	private function setMana($Mana){
		$this->mana = $Mana;
	}

	private function setGabarit($type,$id){
		$this->gabarit = GABARIT_PATH . DS . $type . DS . $id . '.png';
		// switch ($type) {
		// 	case 'creature':
		// 		$this->c_gabarit = CREATURE_PATH . DS . $id . '.png';
		// 		break;
		// 	case 'sort':
		// 		$this->c_gabarit = SORT_PATH . DS . $id . '.png';
		// 		break;
		// 	case 'speciale':
		// 		$this->c_gabarit = SPECIAL_PATH . DS . $id . '.png';
		// 		break;		
		// }
	}

	/**
	 * setter Indice
	 * @param [int] $indice 
	 */
	private function setIndice($indice){
		switch ($this->type) {
			case 'creature':
				if ($indice >0 && $indice <= self::EXEMPLAIRE_CREATURE) {
					$this->indice = $indice;				
				}
				else{
					return false;
				}
				break;
			case 'sort':
			case 'speciale':
				if ($indice >0 && $indice <= self::EXEMPLAIRE_SORT) {
					$this->indice = $indice;				
				}
				else{
					return false;
				}
				break;
		}
	}

/**************** GETTERS ********************/

	public function getId(){
		return $this->id;
	}

	public function getLibelle(){
		return $this->libelle;
	}

	public function getType(){
		return $this->type;
	}

	public function getPuissance(){
		return $this->puissance;
	}

	public function getPvMax(){
		return $this->pvMax;
	}

	public function getMana(){
		return $this->mana;
	}

	public function getGabarit(){
		return $this->gabarit;
	}

	public function getIndice(){
		return $this->indice;
	}

}