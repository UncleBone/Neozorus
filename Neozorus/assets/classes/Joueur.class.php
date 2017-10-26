<?php

class Joueur{
	private $id;
	private $deck = array();
	private $main = array();
	private $pioche = array();
	private $plateau = array();
	private $defausse = array();
	private $pv;
	private $mana;

	public function __construct($id,$deckId){
		$this->setId($id);
		$this->deck = new GameDeck($deckId);
		$this->pioche = $this->getDeck()->getCartes();
		$this->setPv(20);
        $this->setMana(0);
	}

	public function setId($id){
		$this->id = $id;
	}
    public function getId(){
        return $this->id;
    }

	public function setPv($val = int){
	    $this->pv = $val;
    }

    public function getPv(){
        return $this->pv;
    }

    public function setMana($val = int){
        $this->mana = $val;
    }

    public function getMana(){
        return $this->mana;
    }

    public function addMana($val = int){
        $a = $val + $this->getMana();
        $this->setMana($a);
    }

	public function getDeck(){
	    return $this->deck;
    }

    public function getMain(){
	    return $this->main;
    }

    public function getPioche(){
        return $this->pioche;
    }

    public function getPlateau(){
        return $this->plateau;
    }

    public function pioche(){
        $carte = array_shift($this->pioche);
	    $carte->setLocalisation(GameCard::LOC_MAIN);
	    $this->main[] = $carte;
        return 1;
    }


}