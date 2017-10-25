<?php

class User{

	private $u_id = NULL;
	private $u_mail;
	private $u_pseudo;
	private $u_mdp;
	private $u_nom;
	private $u_prenom;
	private $u_dateNaissance;
	private $u_offre;
	private $u_question;
	private $u_reponse;

	public function __construct(array $data){
		$this->u_id = $data['u_id'];
		$this->u_mail = $data['u_mail'];
		$this->u_pseudo = $data['u_pseudo'];
		$this->u_mdp = $data['u_mdp'];
		$this->u_nom = $data['u_nom'];
		$this->u_prenom = $data['u_prenom'];
		$this->u_dateNaissance = $data['u_dateNaissance'];
		$this->u_offre = $data['u_offre'];
		$this->u_question = $data['u_question'];
		$this->u_reponse = $data['u_reponse'];
	}

	public function getU_id(){
	return $this->u_id;
	}

	public function getU_mail(){
		return $this->u_mail;
	}

	public function getU_pseudo(){
		return $this->u_pseudo;
	}

	public function getU_mdp(){
		return $this->u_mdp;
	}

	public function getU_nom(){
		return $this->u_nom;
	}

	public function getU_prenom(){
		return $this->u_prenom;
	}


	public function getU_dateNaissance(){
		return $this->u_dateNaissance;
	}

	public function getU_offre(){
		return $this->u_offre;
	}

	public function setU_offre($u_offre){
		$this->u_offre = $u_offre;
	}

	public function getU_question(){
		return $this->u_question;
	}



	public function getU_reponse(){
		return $this->u_reponse;
	}

}
