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

	const MANA_MAX = 10;

	public function __construct($id,$deckId){
		$this->setId($id);
		$this->deck = new GameDeck($deckId);
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
        if($a <= self::MANA_MAX) {
            $this->setMana($a);
        }else{
            $this->setMana(self::MANA_MAX);
        }
    }

    public function subMana($val = int){
        $a = $this->getMana() - $val;
        if($a >= 0) {
            $this->setMana($a);
        }else{
            $this->setMana(0);
        }
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

    public function initPioche(){
        $this->pioche = $this->getDeck()->getCartes();
    }

    public function pioche(){
        $carte = array_shift($this->pioche);
	    $carte->setLocalisation(GameCard::LOC_MAIN);
	    $this->main[$carte->getId().$carte->getIndice()] = $carte;
        return 1;
    }

    public function jouerCarte($identifiant){
        $this->plateau[$identifiant] = $this->main[$identifiant];
        $this->subMana($this->main[$identifiant]->getMana());
        unset($this->main[$identifiant]);
    }
}