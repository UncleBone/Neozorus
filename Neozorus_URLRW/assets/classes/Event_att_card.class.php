<?php
class Event_att_card extends Event{
	private $eac_id;		// identifiant de l'événement dans la table event_att_card
	private $att;		// carte attaquante (objet de type GameCard)
	private $cible;		// carte cible (objet de type GameCard)
	private $mortAtt;	// carte attaquante vivante après attaque (bool)
	private $mortCible;	// carte cible vivante après attaque (bool)

	public function getEac_id(){
		return $this->eac_id;
	}
	public function getAtt(){
		return $this->att;
	}
	public function getCible(){
		return $this->cible;
	}
	public function getMortAtt(){
		return $this->mortAtt;
	}
	public function getMortCible(){
		return $this->mortCible;
	}

	public function setEac_id($id){
		$this->eac_id = $id;
	}
	public function setAtt($att){
		$this->att = $att;
	}
	public function setCible($cible){
		$this->cible = $cible;
	}
	public function setMortAtt($mortAtt){
		$this->mortAtt = $mortAtt;
	}
	public function setMortCible($mortCible){
		$this->mortCible = $mortCible;
	}
}