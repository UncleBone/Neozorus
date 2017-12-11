<?php

class User{
	/**
	 * identifiant de l'utilisateur
	 * @var [null|int]
	 */
	private $u_id = NULL;

	/**
	 * mail de l'utilisateur
	 * @var [string]
	 */
	private $u_mail;

	/**
	 * pseudo de l'utilisateur
	 * @var [string]
	 */
	private $u_pseudo;

	/**
	 * mot de passe de l'utilisateur
	 * @var [string]
	 */
	private $u_mdp;

	/**
	 * Nom de l'utilisateur
	 * @var [string]
	 */
	private $u_nom;

	/**
	 * Prenom de l'utilisateur
	 * @var [string]
	 */
	private $u_prenom;

	/**
	 * date de naissance de l'utilisateur
	 * @var 
	 */
	private $u_dateNaissance;

	/**
	 * l'utilisateur a t il coché ou non la case offre
	 * @var [bool]
	 */
	private $u_offre;

	/**
	 * question secrete de l'utilisateur
	 * @var [string]
	 */
	private $u_question;

	/**
	 * reponse secrete de l'utilisateur
	 * @var [type]
	 */
	private $u_reponse;

	private $u_langue;

	/**
	 * Instancie un utilisateur
	 * @param array $data tableau comportant toutes les informations nécessaires à l'instanciation d'un utilisateur
	 */
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
		$this->u_langue = $data['u_langue_fk'];
	}

	/**
	 * getter id
	 * @return [int|null] 
	 */
	public function getU_id(){
		return $this->u_id;
	}

	/**
	 * getter mail
	 * @return [string]
	 */
	public function getU_mail(){
		return $this->u_mail;
	}

	/**
	 * getter pseudo
	 * @return [string]
	 */
	public function getU_pseudo(){
		return $this->u_pseudo;
	}

	/**
	 * getter mot de passe
	 * @return [string]
	 */
	public function getU_mdp(){
		return $this->u_mdp;
	}

	/**
	 * getter Nom
	 * @return [string]
	 */
	public function getU_nom(){
		return $this->u_nom;
	}

	/**
	 * getter Prenom
	 * @return [string]
	 */
	public function getU_prenom(){
		return $this->u_prenom;
	}

	/**
	 * getter date de naissance
	 * @return [type] 
	 */
	public function getU_dateNaissance(){
		return $this->u_dateNaissance;
	}

	/**
	 * getter Offre
	 * @return [bool] 
	 */
	public function getU_offre(){
		return $this->u_offre;
	}

	/**
	 * setter offre
	 * @param [bool] $u_offre 
	 */
	public function setU_offre($u_offre){
		$this->u_offre = $u_offre;
	}

	/**
	 * getter question secrete
	 * @return [string] 
	 */
	public function getU_question(){
		return $this->u_question;
	}

	/**
	 * getter reponse secrete
	 * @return [string]
	 */
	public function getU_reponse(){
		return $this->u_reponse;
	}

	public function getU_langue(){
		return $this->u_langue;
	}
}
