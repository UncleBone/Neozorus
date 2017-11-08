<?php

class Joueur{
	private $id;                    // ID du joueur
	private $deck;                  // deck du joueur pour la partie (objet de type GameDeck)
	private $main = array();        // Tableau d'objet de type GameCard représentant la main du joueur
	private $pioche = array();      // Tableau d'objet de type GameCard représentant la pioche du joueur
	private $plateau = array();     // Tableau d'objet de type GameCard représentant les cartes en jeu du joueur
	private $defausse = array();    // Tableau d'objet de type GameCard représentant la défausse du joueur
	private $pv;                    // pv du joueur
	private $mana;                  // mana du joueur
	private $visable;               // 0 : ne peut pas être visé, 1 : peut être visé

	const MANA_MAX = 10;

	public function __construct($id,$deckId){
		$this->setId($id);
		$this->deck = new GameDeck($deckId);
		$this->setPv(20);
        $this->setMana(0);
        $this->setVisable(1);
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

    public function subPv($val = int){
	    $a = $this->getPv() - $val;
	    if($a<0){
	        $a = 0;
        }
        $this->setPv($a);
	    return $a;
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
    public function getVisable(){
        return $this->visable;
    }
    public function setVisable($val = int){
        $this->visable = $val;
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

    public function getDefausse(){
        return $this->defausse;
    }

    public function initPioche(){
        $this->pioche = $this->getDeck()->getCartes();
    }

    /*
     * retire une carte du tableau pioche pour la mettre dans le tableau main
     */
    public function pioche(){
        $carte = array_shift($this->pioche);
        if(!is_null($carte)){
            $carte->setLocalisation(GameCard::LOC_MAIN);
            $this->main[$carte->getId().$carte->getIndice()] = $carte;
            return 1;
        }else{
            return 0;
        }

    }

    /*
     * retire une carte du tableau main pour la mettre dans le tableau plateau
     * si la carte est un sort, lance la méthode 'ciblage'
     */
    public function jouerCarte($identifiant,$jeton){
        if($this->main[$identifiant]->getType() == 'sort'){
            $this->ciblage($identifiant,$jeton,$this->main[$identifiant]->getAbilite());
        }else {
            $this->plateau[$identifiant] = $this->main[$identifiant];
            $this->subMana($this->main[$identifiant]->getMana());
            unset($this->main[$identifiant]);
            if($this->plateau[$identifiant]->getAbilite()>=2){
                for($i=1;$i<$this->plateau[$identifiant]->getAbilite();$i++){
                    $this->pioche();
                }
            }
        }
    }

    /*
     * renvoie l'identifiant et l'abilité éventuelle du sort au GameController
     */
    public function ciblage($att,$jeton,$abilite){
        header('Location:?controller=game&action=play&jeton='.$jeton.'&att='.$att.'&abilite='.$abilite);
    }

    /*
     * lance l'attaque sur la cible, diminue les pv de la cible de la puissance de l'attaquant
     * si la carte cible n'a plus de pv elle est placée dans la défausse du joueur adverse
     * si la carte attaquante est une carte sort elle est placée dans la défausse du joueur actif
     */
    public function attaquer($type,$att,$cible,$oPlayer,$jeton){
        if(!empty($this->main[$att]) && $this->main[$att]->getType() == 'sort') {
            $carteAtt = $this->main[$att];
        }else {
            $carteAtt = $this->plateau[$att];
        }
        if($type == 'j'){
           $cible->subPv($carteAtt->getPuissance());
        }elseif ($type == 'c'){
            if (!empty($oPlayer->getPlateau()[$cible])){
                $carteCible = $oPlayer->getPlateau()[$cible];
                $carteCiblePlayer = $oPlayer;
            }
            $alive = $carteCible->subPv($carteAtt->getPuissance());
            if($alive == 0){
                $carteCiblePlayer->defausse[$cible] = $carteCiblePlayer->getPlateau()[$cible];
                unset($carteCiblePlayer->plateau[$cible]);
            }
        }
        if($carteAtt->getType()=='sort') {
            $this->defausse[$att] = $this->main[$att];
            $this->subMana($this->main[$att]->getMana());
            unset($this->main[$att]);
        }elseif ($carteAtt->getType()=='creature'){
            $carteAtt->setActive(0);
        }
        header('Location:?controller=game&action=play&jeton='.$jeton);
    }
}