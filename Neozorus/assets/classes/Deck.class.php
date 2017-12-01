<?php
class Deck{
	/**
	 * Identifiant du deck
	 * @var [int]
	 */
	private $d_id;

	/**
	 * Libelle du deck
	 * @var [string]
	 */
	private $d_libelle;

	/**
	 * Identifiant du hero associé au deck
	 * @var [int]
	 */
	private $d_personnage;

	/**
	 * Nombre de carte maximum que peut contenir un deck
	 */
	const MAX_CARTE = NB_MAX_CARTE;//NB_MAX_CARTE defini dans ini.php

	/**
	 * Instancie un deck
	 * @param [array] $data tableau comportant toutes les informations nécessaires à l'instanciation d'un deck
	 */
	public function __construct(array $data){
		$this->setD_id($data['d_id']);
		$this->setD_libelle($data['d_libelle']);
		$this->setD_personnage_fk($data['d_personnage_fk']);
	}

	/**
	 * setter ID
	 * @param [int] $ID 
	 */
	private function setD_id($ID){
		$this->d_id = $ID;
	}

	/**
	 * setter Libelle
	 * @param [string] $Libelle
	 */
	private function setD_libelle($Libelle){
		$this->d_libelle = $Libelle;
	}

	/**
	 * setter hero associé au deck
	 * @param [int] $idPersonnage 
	 */
	private function setD_personnage_fk($idPersonnage){
		$this->d_personnage = $idPersonnage;
	}

	/**
	 * getter id
	 * @return [int]
	 */
	public function getD_id(){
		return $this->d_id;
	}

	/**
	 * getter Libelle
	 * @return [string]
	 */
	public function getD_libelle(){
		return $this->d_libelle;
	}

	/**
	 * getter Id du hero associé au deck
	 * @return [int]
	 */
	public function getD_personnage(){
		return $this->d_personnage;
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