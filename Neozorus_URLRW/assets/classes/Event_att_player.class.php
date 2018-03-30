<?php
class Event_att_player extends Event{
	private $eap_id;		// identifiant de l'événement dans la table event_att_player
	private $att;		// carte attaquante (objet de type GameCard)
	private $cible;		// joueur cible (objet de type Joueur)
	private $mortCible;	// joueur cible vivant après attaque (bool)

	public function getEap_id(){
		return $this->eap_id;
	}
	public function getAtt(){
		return $this->att;
	}
	public function getCible(){
		return $this->cible;
	}
	public function getMortCible(){
		return $this->mortCible;
	}

	public function setEap_id($id){
		$this->eap_id = $id;
	}
	public function setAtt($att){
		$this->att = $att;
	}
	public function setCible($cible){
		$this->cible = $cible;
	}
	public function setMortCible($mortCible){
		$this->mortCible = $mortCible;
	}
}