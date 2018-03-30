<?php
class Event_play extends Event{
	private $ep_id;		// identifiant de l'événement dans la table event_play
	private $carte;		// carte jouée (objet de type GameCard)

	public function getEp_id(){
		return $this->ep_id;
	}
	public function getCarte(){
		return $this->carte;
	}

	public function setEp_id($id){
		$this->ep_id = $id;
	}
	public function setCarte($carte){
		$this->carte = $carte;
	}
}