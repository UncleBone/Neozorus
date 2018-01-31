<?php
class Deck{
	/**
	 * Identifiant du deck
	 * @var [int]
	 */
	private $id;

	/**
	 * Libelle du deck
	 * @var [string]
	 */
	private $libelle;

	/**
	 * Identifiant du hero associé au deck
	 * @var [int]
	 */
	private $personnage;

	/**
	 * Nombre de carte maximum que peut contenir un deck
	 */
	const MAX_CARTE = NB_MAX_CARTE;//NB_MAX_CARTE defini dans ini.php

	/**
	 * Instancie un deck
	 * @param [array] $data tableau comportant toutes les informations nécessaires à l'instanciation d'un deck
	 */
	public function __construct(array $data){
		$this->setId($data['d_id']);
		$this->setLibelle($data['d_libelle']);
		$this->setPersonnage($data['d_personnage_fk']);
	}

	/**
	 * setter ID
	 * @param [int] $ID 
	 */
	private function setId($ID){
		$this->id = $ID;
	}

	/**
	 * setter Libelle
	 * @param [string] $Libelle
	 */
	private function setLibelle($Libelle){
		$this->libelle = $Libelle;
	}

	/**
	 * setter hero associé au deck
	 * @param [int] $idPersonnage 
	 */
	private function setPersonnage($idPersonnage){
		$this->personnage = $idPersonnage;
	}

	/**
	 * getter id
	 * @return [int]
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * getter Libelle
	 * @return [string]
	 */
	public function getLibelle(){
		return $this->libelle;
	}

	/**
	 * getter Id du hero associé au deck
	 * @return [int]
	 */
	public function getPersonnage(){
		return $this->personnage;
	}

	/**
	 * [AjouterCarte description]
	 * @param Carte $carte [description]
	 */
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