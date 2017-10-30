<?php
class GameController extends CoreController{

	private $id;
    private $players = array();
	private $tour;
	private $EoG = false;
	private $jeton = 0;
	private $piocheEtMana = 0;

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

    public function saveNewGame(){
        $gameModel = new GameModel();
        $gameModel->saveNewGame($this);
    }

    public function saveGame(){
	    $gameModel = new GameModel();
	    $gameModel->saveGame($this);
    }

    public function loadGame(){
        $gameModel = new GameModel();
        if(!empty($_SESSION['neozorus']['GAME'])){
            $load = $gameModel->load($_SESSION['neozorus']['GAME'])[0]['g_data'];
            $clone = unserialize($load);
            $this->setId($clone->getId());
            $this->setPlayer($clone->getPlayer(0));
            $this->setPlayer($clone->getPlayer(1));
            $this->setTour($clone->getTour());
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

    public function saveAndRefreshView(){
        $this->saveGame();
        $this->loadGame();
        $tour = $this->getTour();
        $pv1 = $this->getPlayer(0)->getPv();
        $pv2 = $this->getPlayer(1)->getPv();
        $mana1 = $this->getPlayer(0)->getMana();
        $mana2 = $this->getPlayer(1)->getMana();
        $main1 = $this->players[0]->getMain();
        $main2 = $this->players[1]->getMain();
        $plateau1 = $this->players[0]->getPlateau();
        $plateau2 = $this->players[1]->getPlateau();
        $jeton = $this->getJeton();
        if(!empty($this->parameters['error'])){
            $error = $this->parameters['error'];
        }
        if(!empty($this->parameters['att'])){
            $att = $this->parameters['att'];
        }
        if(!empty($this->parameters['cible'])){
            $cible = $this->parameters['cible'];
        }
        require_once( VIEWS_PATH . DS . 'Game' . DS . 'TestGame.php' );
    }

	public function init($idP1,$idD1,$idP2,$idD2){
		$this->setTour(1);
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

	public function jeu(){

	    $this->loadGame();

//        if($this->getJeton()==0) {
//            $this->tourPlus();
//        }
        $this->tour($this->jeton);
	}

	public function tour($jeton){
	    $player = $this->getPlayer($jeton);
	    $otherPlayer = $this->getPlayer(($jeton==0 ? 1 : 0));
        if($this->getTour() == 1){
            if($this->piocheEtMana == 0){
                for($i=0;$i<3;$i++){$player->pioche();}
                $this->increaseMana($player);
                $this->piocheEtMana = 1;
                $this->saveAndRefreshView();
            }
        }else{
            if($this->piocheEtMana == 0){
                $player->pioche();
                $this->increaseMana($player);
                $this->piocheEtMana = 1;
                $this->saveAndRefreshView();
            }
        }
        if(!empty($this->parameters['jouer'])){
            if (!empty($player->getMain()[$this->parameters['jouer']])){
                $carte = $player->getMain()[$this->parameters['jouer']];
                if($carte->getMana() <= $player->getMana()) {
                    $player->jouerCarte($this->parameters['jouer'],$jeton);
                }else{
                    $error = 'not_enough_mana';
                    $this->error($error);
                }
            }
        }elseif (!empty($this->parameters['att'])){
            if(!empty($this->parameters['cible'])){
                if(strpos($cible = $this->parameters['cible'],'J')!==false){
                    $p = substr($cible,-1);
                    $player->attaquer('j',$this->parameters['att'],$this->getPlayer($p),$otherPlayer);
                }else {
                    $player->attaquer('c', $this->parameters['att'], $this->parameters['cible'],$otherPlayer);
                }
            }
        }
        $this->saveAndRefreshView();
    }

    public function error($e){
	    header('Location:?controller=game&action=jeu&jeton='.$this->getJeton().'&error='.$e);
    }

    public function quitter(){
	    unset($_SESSION['neozorus']['GAME']);
	    header('Location:?controller=game&action=jeu');
    }

    public function increaseMana($player){
        $tour = $this->getTour();
        if($tour<=10){
            $player->addMana($tour);
        }else{
            $player->addMana(10);
        }
    }

    public function activateCards($player){
        if(!empty($player->getPlateau())){
            foreach ($player->getPlateau()as $carte){
                if($carte->getActive() == 0){
                    $carte->setActive(1);
                }
            }
        }
    }
}