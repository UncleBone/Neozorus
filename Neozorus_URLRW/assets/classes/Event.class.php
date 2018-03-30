<?php
	abstract class Event{
	private $id;		// identifiant de l'évènement dans la table historique de la bdd
	private $tour;		// tour auquel l'évènement est survenu
	private $partie;	// id de la partie associée
	private $joueur;	// id du joueur à l'origine de l'évènement
	private $type;		// type d'évènement

	const PLAY = 1;
	const ATT_CARD = 2;
	const ATT_PLAYER = 3;

	public function __construct($tour,$joueur,$type){
		// $this->setId($id);
		$this->setTour($tour);
		$this->setJoueur($joueur);
		$this->setType($type);
	}

	public function getId(){
		return $this->id;
	}
	public function getTour(){
		return $this->tour;
	}
	public function getPartie(){
		return $this->partie;
	}
	public function getJoueur(){
		return $this->joueur;
	}
	public function getType(){
		return $this->type;
	}

	public function setId($id){
		$this->id = $id;
	}
	public function setTour($tour){
		$this->tour = $tour;
	}
	public function setPartie($gameId){
		$this->partie = $gameId;
	}
	public function setJoueur($playerId){
		$this->joueur = $playerId;
	}
	public function setType($type){
		$this->type = $type;
	}
}