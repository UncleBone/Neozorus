<?php
Class Carte implements JsonSerializable{
	/**
	 * Identifiant de la carte
	 * @var [int]
	 */
	private $c_id;

	/**
	 * Libelle de la carte
	 * @var [string]
	 */
	private $c_libelle;

	/**
	 * Type de la carte (ex:creature,sort,speciale...)
	 * @var [string]
	 */
	private $c_type;

	/**
	 * Puissance de la carte
	 * @var [int]
	 */
	private $c_puissance;

	/**
	 * Point de Vie maximum de la carte
	 * @var [int]
	 */
	private $c_pvMax;

	/**
	 * Coût en mana de la carte
	 * @var [int]
	 */
	private $c_mana;

	/**
	 * Chemin vers l'illustration de la carte
	 * @var [string]
	 */
	private $c_gabarit;

	/**
	 * Indice de la carte (pour differencier des cartes en double dans un deck)
	 * @var [null|int]
	 */
	private $c_indice = NULL;

	/**
	 * nombre de creature doublon autorise
	 */
	const EXEMPLAIRE_CREATURE = Nb_EXEMPLAIRE_CREATURE;//Nb_EXEMPLAIRE_CREATURE defini dans ini.php

	/**
	 * nombre de carte speciale doublon autorise
	 */
	const  EXEMPLAIRE_SPECIALE = Nb_EXEMPLAIRE_SPECIALE;//Nb_EXEMPLAIRE_SPECIALE defini dans ini.php

	/**
	 * nombre de carte sort doublon autorise
	 */
	const EXEMPLAIRE_SORT = Nb_EXEMPLAIRE_SORT;//Nb_EXEMPLAIRE_SORT defini dans ini.php

	/**
	 * Instancie une carte à partir d'un tableau $data, et d'un parametre facultatif $indice
	 * @param [array]  $data   tableau comportant toutes les informations nécessaires à l'instanciation d'une carte
	 * @param [int] $indice spécifie l'indice d'une carte, par défaut c'est égal à 1
	 */
	public function __construct(array $data,$indice = 1){
		$this->setC_id($data['c_id']);
		$this->setC_libelle($data['c_libelle']);
		$this->setC_type($data['c_type']);
		$this->setC_puissance($data['c_puissance']);
		$this->setC_pvMax($data['c_pvMax']);
		$this->setC_mana($data['c_mana']);
		$this->setC_gabarit($data['c_type'],$data['c_id']);
		$this->setC_indice($indice);
	}

	/**
	 * retourne un tableau avec les attributs de la carte lors d'un JSON_encode
	 * @return [array] 
	 */
	public function jsonSerialize(){
		$array = array();
		$array['c_id']=$this->c_id;
		$array['c_libelle']=$this->c_libelle;
		$array['c_type']=$this->c_type;
		$array['c_puissance']=$this->c_puissance;
		$array['c_pvMax']=$this->c_pvMax;
		$array['c_mana']=$this->c_mana;
		$array['c_gabarit']=$this->c_gabarit;
		$array['c_indice']=$this->c_indice;
		$array['c_localisation']=$this->c_localisation;

		return $array;
	}

	/**
	 * Setter Identifiant
	 * @param [int] $ID Identifiant de la carte
	 */
	private function setC_id($ID){
		$this->c_id = $ID;
	}

	/**
	 * Setter Libelle
	 * @param [string] $Libelle 
	 */
	private function setC_libelle($Libelle){
		$this->c_libelle = $Libelle;
	}

	/**
	 * Setter Type
	 * @param [string] $Type 
	 */
	private function setC_type($Type){
		$this->c_type = $Type;
	}

	/**
	 * Setter Puissance
	 * @param [int] $Puissance 
	 */
	private function setC_puissance($Puissance){
		$this->c_puissance = $Puissance;
	}

	/**
	 * Setter pvMax
	 * @param [type] $pvMax 
	 */
	private function setC_pvMax($pvMax){
		$this->c_pvMax = $pvMax;
	}

	/**
	 * Setter Cout en mana
	 * @param [int] $Mana 
	 */
	private function setC_mana($Mana){
		$this->c_mana = $Mana;
	}

	/**
	 * Setter url Gabarit
	 * @param [string] $type 
	 * @param [int] $id   
	 */
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

	/**
	 * setter Indice
	 * @param [int] $indice 
	 */
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

			case 'sort':
				if ($indice >0 && $indice <= self::EXEMPLAIRE_SORT) {
					$this->c_indice = $indice;				
				}
				else{
					return false;
				}

				break;
			case 'speciale':
				if ($indice >0 && $indice <= self::EXEMPLAIRE_SORT) {
					$this->c_indice = $indice;				
				}
				else{
					return false;
				}
				break;
		}
	}

	/**
	 * getter Identifiant
	 * @return [int] 
	 */
	public function getC_id(){
		return $this->c_id;
	}

	/**
	 * getter Libelle
	 * @return [string]
	 */
	public function getC_libelle(){
		return $this->c_libelle;
	}

	/**
	 * getter Type
	 * @return [string]
	 */
	public function getC_type(){
		return $this->c_type;
	}

	/**
	 * getter Puissance
	 * @return [int]
	 */
	public function getC_puissance(){
		return $this->c_puissance;
	}

	/**
	 * getter pvMax
	 * @return [int]
	 */
	public function getC_pvMax(){
		return $this->c_pvMax;
	}

	/**
	 * getter cout mana
	 * @return [int] 
	 */
	public function getC_mana(){
		return $this->c_mana;
	}

	/**
	 * getter url Illustration
	 */
	public function getC_gabarit(){
		return $this->c_gabarit;
	}

	/**
	 * getter Indice
	 * @return [int]
	 */
	public function getC_indice(){
		return $this->c_indice;
	}

}