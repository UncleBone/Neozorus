<?php
class GameController extends CoreController{

	private $id;                    // identifiant de la partie
    private $players = array();     // tableau de deux objets de type Joueur
	private $tour;                  // compteur de tour
    private $t;                      // timestamp
	private $EoG = false;           // End of Game, la partie est terminée si = true
	private $jeton = 0;             // 0 = tour du joueur 1, 1 = tour du joueur 2
	private $piocheEtMana = 0;      // détermine si l'étape pioche + augmentation de mana a eu lieu pour le joueur courant d'un tour donné

	public function setPlayer($p = Joueur){
		$this->players[] = $p;
	}

	function getPlayer($n){
	    return $this->players[$n];
    }

    function getId(){
        return $this->id;
    }

    function setId($id = int){
        $this->id = $id;
    }

    /*
     * initialise l'ID de la partie (ID joueur 1 . ID joueur 2 . time())
     */
    function initId(){
        $this->id = $this->players[0]->getId() . $this->players[1]->getId() . time();
    }

	public function setTour($t = int){
		$this->tour = $t;
	}

	public function tourPlus(){
		$this->tour++;
	}

	public function getTour(){
	    return $this->tour;
    }

    public function getT(){
	    return $this->t;
    }

    public function setT(){
        $this->t = time();
    }

    public function setEog($eog = bool){
        $this->EoG = $eog;
    }
    public function getEog(){
        return $this->EoG;
    }

    public function setPiocheEtMana($p){
        $this->piocheEtMana = $p;
    }
    public function getPiocheEtMana(){
        return $this->piocheEtMana;
    }

    public function setJeton($j){
        $this->jeton = $j;
    }
    public function getJeton(){
        return $this->jeton;
    }

    /*
     * Sauvegarde d'un nouvelle partie dans la BDD
     */
    public function saveNewGame(){
        $gameModel = new GameModel();
        $gameModel->saveNewGame($this);
    }

    /*
     * Sauvegarde d'une partie existante
     */
    public function saveGame(){
	    $gameModel = new GameModel();
	    $gameModel->saveGame($this);
    }

    /*
     * Chargement d'une partie existante ou lancement de l'initialisation d'une nouvelle partie
     */
    public function loadGame(){
        $gameModel = new GameModel();
        if(!empty($_SESSION['neozorus']['GAME'])){
            $load = $gameModel->load($_SESSION['neozorus']['GAME'])[0]['g_data'];
            $clone = unserialize($load);
            $this->setId($clone->getId());
            $this->setPlayer($clone->getPlayer(0));
            $this->setPlayer($clone->getPlayer(1));
            $this->setTour($clone->getTour());
            $this->setT();
            $this->setEog($clone->getEog());
            if(!empty($this->parameters['jeton'])){
                $this->setJeton($this->parameters['jeton']);
            }
            if($this->getJeton()!=$clone->getJeton()) {
                $this->setPiocheEtMana(0);
                $this->activateCards($this->getPlayer($this->getJeton()));
                if($this->getJeton()==0) {
                    $this->tourPlus();
                }
            }else{
                $this->setPiocheEtMana($clone->piocheEtMana);
            }
        }else {
            $this->init(1, 1, 2, 2);
        }
    }

    public function getLastTimeStamp(){
        $gameModel = new GameModel();
        $load = $gameModel->load($_SESSION['neozorus']['GAME'])[0]['g_data'];
        $clone = unserialize($load);
        return $clone->getT();
    }
     /*
      * Sauvegarde + chargement + affichage
      */
    public function saveAndRefreshView($message = null){
        echo 't='.$this->getT();
        echo '<br>';
        echo 'last t='.$this->getLastTimeStamp();
        echo '<br>';
        echo 'parameter t ='.(!empty($this->parameters['t']) ? $this->parameters['t'] : 0);
        if(isset($this->parameters['t']) && $this->parameters['t']>=$this->getLastTimeStamp()){
            $this->saveGame();
        }
        $this->loadGame();
        $tour = $this->getTour();
        $t = $this->getT();
        for($i=0;$i<2;$i++){
            $pv[$i] = $this->getPlayer($i)->getPv();
            $mana[$i] = $this->getPlayer($i)->getMana();
            $main[$i] = $this->getPlayer($i)->getMain();
            $plateau[$i] = $this->getPlayer($i)->getPlateau();
            $defausse[$i] = $this->getPlayer($i)->getDefausse();
            $visable[$i] = $this->getPlayer($i)->getVisable();
            $heros[$i] = $this->getPlayer($i)->getDeck()->getHeros();
        }
        $jeton = $this->getJeton();
        $eog = $this->getEog();
        if(!empty($this->parameters['error'])){
            $error = $this->parameters['error'];
        }
        if(!empty($this->parameters['att'])){
            $att = $this->parameters['att'];
        }
        $abilite = (!empty($this->parameters['abilite']) ? $this->parameters['abilite'] : 0);
        if(!empty($this->parameters['cible'])){
            $cible = $this->parameters['cible'];
        }
        $this->checkVisable();
        //require_once( VIEWS_PATH . DS . 'Game' . DS . 'gameLayout.php' );
        require_once( VIEWS_PATH . DS . 'Game' . DS . 'testGame.php' );
    }

    /*
     * Initialisation d'une partie
     * Paramètres: ID du joueur 1, ID du deck du joueur 1, ID du joueur 2, ID du deck du joueur 2
     */
	public function init($idP1,$idD1,$idP2,$idD2){
		$this->setTour(1);
		$this->setT();
		$this->parameters['t'] = $this->getT();
		$this->parameters['jeton']=$this->getJeton();
		$p1 = new Joueur($idP1,$idD1);
        $p2 = new Joueur($idP2,$idD2);
		$this->setPlayer($p1);
		$this->setPlayer($p2);
		$this->initId();
		$_SESSION['neozorus']['GAME'] = $this->getId();
		$this->getPlayer(0)->getDeck()->shuffle();
        $this->getPlayer(1)->getDeck()->shuffle();
        $this->getPlayer(0)->initPioche();
        $this->getPlayer(1)->initPioche();
        $this->saveNewGame();
	}

	/*
	 * Vérifie si les conditions de victoire d'un des joueurs sont vérifiées et retourne le vainqueur
	 */
	public function checkEog(){
	    $retour = false;
	    for($i=0;$i<2;$i++){
            if($this->players[$i]->getPv()<=0 || empty($this->players[$i]->getPioche())){
                $this->setEog(true);
                $retour = $this->players[($i==0 ? 1 : 0)];
            }
        }
        return $retour;
    }

    /*
     * Si la partie est terminée, affiche le vainqueur, sinon lance le tour du joueur courant
     */
	public function play(){

	    $this->loadGame();
	    if(!($winner = $this->checkEog())){
            $this->tour($this->jeton);
        }else{
            $message = 'Partie terminée<br>Vainqueur: '.$winner->getId();
            $this->saveAndRefreshView($message);
        }
	}

	/*
	 * Deroulement du tour du joueur défini par le jeton
	 */
	public function tour($jeton){
	    $player = $this->getPlayer($jeton);
	    $otherPlayer = $this->getPlayer(($jeton==0 ? 1 : 0));
	    $message = null;

        /*
        *Pioche et augmentation de mana
        */
        if($this->getTour() == 1){      // Lors du premier tour de jeu, on pioche 3 cartes
            if($this->piocheEtMana == 0){
                for($i=0;$i<3;$i++){$player->pioche();}
                $this->increaseMana($player);
                $this->piocheEtMana = 1;
            }
        }else{
            if($this->piocheEtMana == 0){
                $player->pioche();
                $this->increaseMana($player);
                $this->piocheEtMana = 1;
            }
        }
        $this->saveAndRefreshView();

        /*  Si le joueur a cliqué sur une carte de sa main et qu'il a assez de mana pour la jouer,
         *  lance la fonction de la classe Joueur 'jouerCarte'
         *  renvoie un message d'erreur si pas assez de mana
         */
        if(!empty($this->parameters['jouer'])){
            if (!empty($player->getMain()[$this->parameters['jouer']])){
                $carte = $player->getMain()[$this->parameters['jouer']];
                if($carte->getMana() <= $player->getMana()) {
                    $player->jouerCarte($this->parameters['jouer'],$jeton,$this->getT());
                }else{
                    $error = 'not_enough_mana';
                    $this->error($error);
                }
            }
            $this->saveAndRefreshView();
            /*
             * Si le joueur veut attaquer avec une carte mais n'a pas désigné de cible,
             * renvoie un message l'invitant à cliquer sur une cible,
             * si la cible a été désignée, lance la fonction de la classe joueur 'attaquer'
             */
        }elseif (!empty($this->parameters['att'])){
            if(!empty($this->parameters['cible'])){
                if(strpos($cible = $this->parameters['cible'],'J')!==false){    // si la cible est un joueur
                    $p = substr($cible,-1);
                    $player->attaquer('j',$this->parameters['att'],$this->getPlayer($p),$otherPlayer,$jeton,$this->getT());
                }else {     // sinon, la cible est une carte
                    $player->attaquer('c', $this->parameters['att'], $this->parameters['cible'],$otherPlayer,$jeton,$this->getT());
                }
                // si la carte jouée dispose d'une capacité de pioche -> pioche x cartes
                if(!empty($this->parameters['abilite']) && $this->parameters['abilite']>=2){
                    for($i=1;$i<$this->parameters['abilite'];$i++){
                        $player->pioche();
                    }
                }
            }else{
                $message = "cliquez sur la cible";
            }
            $this->saveAndRefreshView($message);
        }
    }

    /*
     * Renvoie vers un lien qui affiche un message d'erreur
     */
    public function error($e){
	    header('Location:?controller=game&action=play&t='.$this->getT().'&jeton='.$this->getJeton().'&error='.$e);
    }

    /*
     * En théorie pour quitter la partie, en pratique reinitialise la partie
     */
    public function quitter(){
	    unset($_SESSION['neozorus']['GAME']);
	    header('Location:?controller=game&action=play');
    }

    /*
     * augmente le mana du joueur courant en fonction du n° du tour
     */
    public function increaseMana($player){
        $tour = $this->getTour();
        if($tour<10){
            $player->setMana($this->getTour());
        }else{
            $player->setMana(10);
        }

    }

    /*
     * Active les cartes du plateau inactives
     */
    public function activateCards($player){
        if(!empty($player->getPlateau())){
            foreach ($player->getPlateau()as $carte){
                if($carte->getActive() == 0){
                    $carte->setActive(1);
                }
            }
        }
    }

    /*
     * Vérifie si une carte bouclier se trouve sur le plateau,
     * si c'est le cas, rend les autres cartes non bouclier du même joueur non visables, ainsi que le joueur lui-même
     */
    public function checkVisable(){
        for($i=0;$i<2;$i++){
            $bouclier = 'off';

            if(!empty($this->getPlayer($i)->getPlateau())){

                foreach($this->getPlayer($i)->getPlateau() as $carte){
                    if (in_array(GameCard::ABILITE_BOUCLIER,$carte->getAbilite())){
                            $bouclier = 'on';
                            break;
                    }
                }
                if($bouclier == 'on'){
                    $this->getPlayer($i)->setVisable(0);
                    foreach($this->getPlayer($i)->getPlateau() as $carte){
                        if($carte->getVisable() == 1 && !in_array(GameCard::ABILITE_BOUCLIER,$carte->getAbilite())){

                            $carte->setVisable(0);

                        }
                    }
                }else{
                    $this->getPlayer($i)->setVisable(1);
                    foreach($this->getPlayer($i)->getPlateau() as $carte){
                        if($carte->getVisable() == 0){
                            $carte->setVisable(1);
                        }
                    }
                }
            }else{
                $this->getPlayer($i)->setVisable(1);
            }
        }
    }
}