<?php

class Joueur{
	private $id;                    // ID du joueur
    private $gameId;                // ID de la partie
    private $pseudo;
	private $deck;                  // deck du joueur pour la partie (objet de type GameDeck)
	private $main = array();        // Tableau d'objet de type GameCard représentant la main du joueur
	private $pioche = array();      // Tableau d'objet de type GameCard représentant la pioche du joueur
	private $plateau = array();     // Tableau d'objet de type GameCard représentant les cartes en jeu du joueur
	private $defausse = array();    // Tableau d'objet de type GameCard représentant la défausse du joueur
	private $pv;                    // pv du joueur
	private $mana;                  // mana du joueur
	private $visable;               // 0 : ne peut pas être visé, 1 : peut être visé
    private $heros;

	const MANA_MAX = 10;

	public function __construct($id,$deckId = null){
		$this->setId($id);
        if(!is_null($deckId)){
            $this->deck = new GameDeck($deckId);
        }
        $this->setPv(20);
        $this->setMana(0);
        $this->setVisable(1);
        $user = new UserModel();
        $this->pseudo = $user->getPseudo($id)['u_pseudo'];
	}

/************ Getters ***********/

    public function getId(){
        return $this->id;
    }
    public function getPseudo(){
        return $this->pseudo;
    }
    public function getGameId(){
        return $this->gameId;
    }
    public function getPv(){
        return $this->pv;
    }
    public function getMana(){
        return $this->mana;
    }
    public function getVisable(){
        return $this->visable;
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

/************ Setters ***********/    

	public function setId($id){
		$this->id = $id;
	}   
    public function setGameId($id){
        $this->gameId = $id;
    }
	public function setPv($val = int){
	    $this->pv = $val;
    }
    public function setMana($val = int){
        $this->mana = $val;
    } 
    public function setVisable($val = int){
        $this->visable = $val;
    }

/*** soustrait des pv actuels du héros du joueur la valeur $val ***/
    public function subPv($val = int){
	    $a = $this->getPv() - $val;
	    if($a<0){
	        $a = 0;
        }
        $this->setPv($a);
	    return $a;
    }

/*** ajoute au mana actuel du joueur la valeur $val ***/
    public function addMana($val = int){
        $a = $val + $this->getMana();
        if($a <= self::MANA_MAX) {
            $this->setMana($a);
        }else{
            $this->setMana(self::MANA_MAX);
        }
    }

/*** soustrait du mana actuel du joueur la valeur $val ***/
    public function subMana($val = int){
        $a = $this->getMana() - $val;
        if($a >= 0) {
            $this->setMana($a);
        }else{
            $this->setMana(0);
        }
    }
	
/*** ajout d'une carte aux tableaux Main, Pioche, Plateau ou Défausse ***/
    public function addMain($carte){
        $this->main[$carte->getGameId()] = $carte;
    }
    public function addPioche($carte){
        $this->pioche[] = $carte;
    }
    public function addPlateau($carte){
        $this->plateau[$carte->getGameId()] = $carte;
    }
    public function addDefausse($carte){
        $this->defausse[] = $carte;
    }

/*** retrait d'une carte aux tableaux Main, Plateau***/
    public function removeMain($carte){
        unset($this->main[$carte->getGameId()]);
    }
    public function removePlateau($carte){
        unset($this->plateau[$carte->getGameId()]);
    }
    
/*** Initialise la pioche avec les cartes du deck ***/
    public function initPioche(){
        $this->pioche = $this->getDeck()->getCartes();
    }

/*** retire une carte du tableau pioche pour la mettre dans le tableau main ***/
    public function pioche(){
        $carte = array_shift($this->pioche);
        if(!is_null($carte)){
            $carte->setLocalisation(GameCard::LOC_MAIN);
            $this->main[$carte->getGameId()] = $carte;
            return 1;
        }else{
            return 0;
        }
    }

/*** mise à jour des différents tableau à partir des cartes du deck ***/
    public function updateCardArrays(){
        $cartes = $this->deck->getCartes();
        foreach ($cartes as $carte) {
            switch ($carte->getLocalisation()) {
                case GameCard::LOC_PIOCHE :
                    $this->addPioche($carte);
                    break;
                case GameCard::LOC_MAIN :
                    $this->addMain($carte);
                    break;
                case GameCard::LOC_PLATEAU :
                    $this->addPlateau($carte);
                    break;
                case GameCard::LOC_DEFAUSSE :
                    $this->addDefausse($carte);
                    break;
            }
        }
    }

/* retire une carte du tableau main pour la mettre dans le tableau plateau
*  si la carte est un sort, lance la méthode 'ciblage'
*/
    public function jouerCarte($identifiant,$jeton){

        /** si la carte est un sort **/
        if($this->main[$identifiant]->getType() == 'sort'){
            $tabAbiliteSort = $this->main[$identifiant]->getAbilite();
            if(in_array(GameCard::ABILITE_PIOCHE_1, $tabAbiliteSort)){
                $abSort = GameCard::ABILITE_PIOCHE_1;
            }elseif (in_array(GameCard::ABILITE_PIOCHE_2, $tabAbiliteSort)){
                $abSort = GameCard::ABILITE_PIOCHE_2;
            }else{
                $abSort = GameCard::ABILITE_AUCUNE;
            }
            $this->ciblage($identifiant,$jeton,$abSort);

        /** si la carte n'est pas de type sort **/
        }else {
            $this->plateau[$identifiant] = $this->main[$identifiant];
            $this->subMana($this->main[$identifiant]->getMana());
            unset($this->main[$identifiant]);
            $this->plateau[$identifiant]->setLocalisation(GameCard::LOC_PLATEAU);
            $tabAbiliteCreature = $this->plateau[$identifiant]->getAbilite();
            /* si abilité de type pioche */
            if(in_array('2', $tabAbiliteCreature)) {
                $this->pioche();
            }elseif(in_array('3', $tabAbiliteCreature))
                for($i=1;$i<3;$i++){
                    $this->pioche();
            }
        }
    }

/*** renvoie l'identifiant et l'abilité éventuelle du sort au GameController ***/
    public function ciblage($att,$jeton,$abilite){
        header('Location:?controller=game&action=play&jeton='.$jeton.'&att='.$att.'&abilite='.$abilite.'&ajax=1');
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

        /** si la cible est le héros du joueur adverse **/
        if($type == 'j'){            
           $cible->subPv($carteAtt->getPuissance());

        /** si la cible est une carte **/   
        }elseif ($type == 'c'){
            if (!empty($oPlayer->getPlateau()[$cible])){
                $carteCible = $oPlayer->getPlateau()[$cible];
                $carteCiblePlayer = $oPlayer;
            }
            $aliveCible = $carteCible->subPv($carteAtt->getPuissance());
            
            /* si la carte n'est pas de type sort, riposte de la cible */
            if($carteAtt->getType() != 'sort'){
                $aliveAtt = $carteAtt->subPv($carteCible->getPuissance());
                if($aliveAtt == 0){
                    $this->defausse[$att] = $this->getPlateau()[$att];
                    unset($this->plateau[$att]);
                    $this->defausse[$att]->setLocalisation(GameCard::LOC_DEFAUSSE);
                }
            }
            if($aliveCible == 0){
                $carteCiblePlayer->defausse[$cible] = $carteCiblePlayer->getPlateau()[$cible];
                unset($carteCiblePlayer->plateau[$cible]);
                $carteCiblePlayer->defausse[$cible]->setLocalisation(GameCard::LOC_DEFAUSSE);
            }

        }
        if($carteAtt->getType()=='sort') {
            $this->defausse[$att] = $this->main[$att];
            $this->subMana($this->main[$att]->getMana());
            unset($this->main[$att]);
            $this->defausse[$att]->setLocalisation(GameCard::LOC_DEFAUSSE);
        }else{
            $carteAtt->setActive(0);
        }
        header('Location:?controller=game&action=play&jeton='.$jeton.'&ajax=1');
    }

/*** trouve et retourne une carte d'un id donné de la main ou du plateau du joueur ***/
    public function findCard($cardGameId){
        if (array_key_exists($cardGameId, $this->main)) {
            return $this->main[$cardGameId];
        }elseif(array_key_exists($cardGameId, $this->plateau)){
            return $this->plateau[$cardGameId];
        }else{
            return false;
        }
    }
}