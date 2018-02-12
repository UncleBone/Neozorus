<?php
class GameController extends CoreController{

	private $id;                    // identifiant de la partie
    private $players = array();     // tableau de deux objets de type Joueur
	private $tour;                  // compteur de tour
	private $EoG = false;           // End of Game, la partie est terminée si = true
	private $jeton;                 // 0 = tour du joueur 1, 1 = tour du joueur 2
	private $piocheEtMana = 0;      // détermine si l'étape pioche + augmentation de mana a eu lieu pour le joueur courant d'un tour donné

    public function __construct(){
        parent::__construct();
        $this->isSessionNeozorus();
    }

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

    /*
     * Renvoie l'objet 'joueur' du joueur associé à cette session
     */
    public function getCurrentPlayer(){
        for($i=0;$i<2;$i++){
            $id = $this->getPlayer($i)->getId();
            if($id == $_SESSION['neozorus']['u_id']) {
                return $this->getPlayer($i);
            }
        }
        return null;
    }

    /*
     * Renvoie l'identifiant (0 ou 1) du joueur associé à cette session
     */
    public function getCurrentPlayerJeton(){
        for($i=0;$i<2;$i++){
            $id = $this->getPlayer($i)->getId();
            if($id == $_SESSION['neozorus']['u_id']) {
                return $i;
            }
        }
        return null;
    }

    /*
     * Attente si aucun autre joueur disponible
     */
    public function wait(){
        if(empty($this->parameters['id'])){
            $this->redirect404();
        }else{
            $id = $this->parameters['id'];
            $deck = new GameDeckModel();
            if(empty($deck->checkId($id))){
                $this->redirect404();
            }else{
                $deck->setWaitingLine($id,1);
                $waitingLine = $deck->checkWaitingLine($id);
                if(!empty($waitingLine)){
                    $deck1 = $id;
                    shuffle($waitingLine);
                    $deck2 = $waitingLine[0]['d_id'];
                    $this->startGame($deck1,$deck2);
                }else{
                    require_once( VIEWS_PATH . DS . 'Game' . DS . 'waiting.php' );
                }
            }
        }
    }

    /*
     * Vérification de la file d'attente
     */
    public function waitAjax(){
        if(!empty($this->parameters['id'])){
            $id = $this->parameters['id'];
            $deck = new GameDeckModel();
            if(!empty($deck->checkId($id))){
                $waitingLine = $deck->checkWaitingLine($id);
                if(!empty($waitingLine)) {
                    $gameModel = new GameModel();
                    $DIRG = $gameModel->checkDeckInRunningGame($id);
                    $res = !empty($DIRG) == 2 ? 'ok' : null;
                }else{
                    $res = null;
                }
            }else {
                $res = 'erreur: ce deck n\'existe pas';
            }
        }else{
            $res = 'erreur: aucun deck spécifié';
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($res);
    }

    /*
     * Démarrage de la partie et sauvegarde dans la bdd (fonction lancée par le 2ème joueur de la file d'attente)
     */
    public function startGame($deck1,$deck2){
        $deckModel = new gameDeckModel();
        $user1 = $deckModel->getUser($deck1);
        if($user1 == $_SESSION['neozorus']['u_id']){

            $user2 = $deckModel->getUser($deck2);
            $this->init($user1,$deck1,$user2,$deck2);
            $this->saveNewGame();
        }
//        $this->play();
        header('Location:?controller=game&action=play');
    }

    /*
    * Initialisation d'une partie
    * Paramètres: ID du joueur 1, ID du deck du joueur 1, ID du joueur 2, ID du deck du joueur 2
    */
    public function init($idP1,$idD1,$idP2,$idD2){
        $this->setTour(1);
        $this->setJeton(0);
        $p1 = new Joueur($idP1,$idD1);
        $p2 = new Joueur($idP2,$idD2);
        $this->setPlayer($p1);
        $this->setPlayer($p2);
        for($i = 0; $i < 2; $i++){
                $this->getPlayer($i)->getDeck()->fillDeck();
                $this->getPlayer($i)->getDeck()->shuffle();
                $this->getPlayer($i)->initPioche();
            }
    }

        /*
     * Sauvegarde d'un nouvelle partie dans la BDD
     */
/*/
    public function saveNewGame(){
        $gameModel = new GameModel();
        $gameModel->saveNewGame($this);
    }
/*/
    public function saveNewGame(){

        try {
            $tabPartie['tour'] = $this->getTour();
            $tabPartie['jeton'] = $this->getJeton();
            $tabPartie['running'] = true;
            $tabPartie['PeM'] = $this->getPiocheEtMana();
            for ($i = 1; $i <= 2; $i++) {
                $tabPartie['joueur' . $i] = $this->getPlayer($i - 1)->getId();
            }
            $model = new gameModel();
            $model->saveNewGame_v2($tabPartie);

            $gameId = $model->getGameId_v2($_SESSION['neozorus']['u_id'])[0]['p_id'];
            $_SESSION['neozorus']['game'] = $gameId;
            $this->id = $gameId;

            for ($i = 0; $i < 2; $i++) {
                $tabJoueur[$i]['pv'] = $this->getPlayer($i)->getPv();
                $tabJoueur[$i]['mana'] = $this->getPlayer($i)->getMana();
                $tabJoueur[$i]['personnage'] = $this->getPlayer($i)->getDeck()->getHeros();
                $tabJoueur[$i]['id'] = $this->getPlayer($i)->getId();
                $tabJoueur[$i]['visable'] = $this->getPlayer($i)->getVisable();
                $tabJoueur[$i]['partie'] = $gameId;
                $tabJoueur[$i]['deck'] = $this->getPlayer($i)->getDeck()->getId();
                $model->saveNewJoueur($tabJoueur[$i]);
                foreach ($this->getPlayer($i)->getDeck()->getCartes() as $carte) {
                    $tabCarte[$i]['id'] = $carte->getId();
                    $tabCarte[$i]['indice'] = $carte->getIndice();
                    $tabCarte[$i]['pv'] = $carte->getPv();
                    $tabCarte[$i]['lieu'] = $carte->getLocalisation();
                    $tabCarte[$i]['visable'] = $carte->getVisable();
                    $tabCarte[$i]['active'] = $carte->getActive();
                    $tabCarte[$i]['user'] = $this->getPlayer($i)->getId();
                    $tabCarte[$i]['partie'] = $gameId;
                    $model->saveNewCarte($tabCarte[$i]);
                    // $carte->setGameId($model->getCardGameId($gameId, $this->getPlayer($i)->getId(), $carte->getId(), $carte->getIndice())[0]);
                }
            }
        }
        catch(PDOException $e)
        {
            $controller = new ErrorController();
            $controller -> error($e->getMessage().'<br>File:'.$e->getFile().'<br>Line:'.$e->getLine().'<br>Trace:'.$e->getTraceAsString());
        }
    }
//*/

    /*
     * Sauvegarde d'une partie existante
     */
/*/
    public function saveGame(){
        $gameModel = new GameModel();
        $gameModel->saveGame($this);
    }
/*/
    public function saveGame(){

        try {
            $tabPartie['id'] = $this->getId();
            $tabPartie['tour'] = $this->getTour();
            $tabPartie['jeton'] = $this->getJeton();
            $tabPartie['running'] = ($this->getEog() == true ? false : true);
            $tabPartie['PeM'] = $this->getPiocheEtMana();
            $tabPartie['winner'] = $this->checkEog() ? $this->checkEog()->getId() : null;

            $model = new gameModel();
            $model->saveGame_v2($tabPartie);

            for ($i = 0; $i < 2; $i++) {
                $tabJoueur[$i]['pv'] = $this->getPlayer($i)->getPv();
                $tabJoueur[$i]['mana'] = $this->getPlayer($i)->getMana();
                $tabJoueur[$i]['id'] = $this->getPlayer($i)->getId();
                $tabJoueur[$i]['visable'] = $this->getPlayer($i)->getVisable();
                $tabJoueur[$i]['partie'] = $this->getId();
                $model->saveJoueur($tabJoueur[$i]);
                foreach ($this->getPlayer($i)->getDeck()->getCartes() as $carte) {
                    $tabCarte[$i]['id'] = $carte->getId();
                    $tabCarte[$i]['indice'] = $carte->getIndice();
                    $tabCarte[$i]['pv'] = $carte->getPv();
                    $tabCarte[$i]['lieu'] = $carte->getLocalisation();
                    $tabCarte[$i]['visable'] = $carte->getVisable();
                    $tabCarte[$i]['active'] = $carte->getActive();
                    $tabCarte[$i]['user'] = $this->getPlayer($i)->getId();
                    $tabCarte[$i]['partie'] = $this->getId();
                    $model->saveCarte($tabCarte[$i]);
                }
            }
        }
        catch(PDOException $e)
        {
            $controller = new ErrorController();
            $controller -> error($e->getMessage().'<br>File:'.$e->getFile().'<br>Line:'.$e->getLine().'<br>Trace:'.$e->getTraceAsString());
        }
    }
//*/

    /*
     * Chargement d'une partie existante ou lancement de l'initialisation d'une nouvelle partie
     */
/*/
    public function loadGame(){
        try {
            $gameModel = new GameModel();
            if (!empty($_SESSION['neozorus']['GAME'])) {
                $load = $gameModel->load($_SESSION['neozorus']['GAME'])[0]['g_data'];
                $clone = unserialize($load);
                $this->setId($_SESSION['neozorus']['GAME']);
                $this->setPlayer($clone->getPlayer(0));
                $this->setPlayer($clone->getPlayer(1));
                $this->setTour($clone->getTour());
                $this->setEog($clone->getEog());
                if (isset($this->parameters['jeton'])) {
                    $this->setJeton($this->parameters['jeton']);
                } else {
                    $this->setJeton($clone->getJeton());
                }
                if ($this->getJeton() != $clone->getJeton()) {
                    $this->setPiocheEtMana(0);
                    $this->activateCards($this->getPlayer($this->getJeton()));
                    if ($this->getJeton() == 0) {
                        $this->tourPlus();
                    }
                } else {
                    $this->setPiocheEtMana($clone->piocheEtMana);
                }
            } else {
                $gameId = $gameModel->getGameId($_SESSION['neozorus']['u_id'])[0]['g_id'];
                if (!empty($gameId)) $_SESSION['neozorus']['GAME'] = $gameId;
                $this->loadGame();
            }
        }catch (Exception $e){
            echo $e;
        }
    }
/*/
    public function loadGame(){
        try{
            $model = new GameModel();
            //** Si l'identifiant de la partie est déjà enregistré en session on charge les données, 
            //** sinon on initialise la session et on relance la fonction 
            if (!empty($_SESSION['neozorus']['game'])) {
                $remote_game = $model->loadGame($_SESSION['neozorus']['game'])[0];
                $this->id = $remote_game['p_id'];
                $this->setTour($remote_game['p_tour']);
                $this->setJeton($remote_game['p_jeton']);
                $this->setEog($remote_game['p_etat'] == 0 ? true : false);
                //** Si la valeur du jeton est spécifiée, on la prend, sinon on garde la valeur précédente
                if (isset($this->parameters['jeton'])) {
                    $this->setJeton($this->parameters['jeton']);
                } else {
                    $this->setJeton($remote_game['p_jeton']);
                }
                
                $this->loadPlayers($remote_game['p_joueur1'],$remote_game['p_joueur2']);

                //** Si le jeton a changé, on réinitialise la variable PiocheEtMana et 
                //** on active pour le joueur courant les éventuelles cartes jouées au tour précédent
                if ($this->getJeton() != $remote_game['p_jeton']) {
                    $this->setPiocheEtMana(0);    
                    $this->activateCards($this->getPlayer($this->getJeton()));
                    // Si le jeton passe de 1 à O, o incrémente le nombre de tour
                    if ($this->getJeton() == 0) {
                        $this->tourPlus();
                    }
                } else {
                    $this->setPiocheEtMana($remote_game['p_piocheEtMana']);
                }

            }else{
                $gameId = $model->getGameId_v2($_SESSION['neozorus']['u_id'])[0]['p_id'];
                if (!empty($gameId)){
                    $_SESSION['neozorus']['game'] = $gameId;
                    $this->loadGame();
                }else{
                    throw new Exception('Impossible de charger l\'identifiant de la partie');
                }                
            }
        }catch(Exception $e)
        {
            $controller = new ErrorController();
            $controller -> error($e->getMessage());
        }
    }

    public function loadPlayers($id1,$id2){
        $model = new GameModel();
        $remote_players = $model->loadPlayers($this->getId());
        for ($i = 0; $i < 2; $i++) {
            $this->players[$i] = new Joueur($remote_players[$i]['pj_user_fk'], $remote_players[$i]['pj_deck_fk']);
            $this->players[$i]->setPv($remote_players[$i]['pj_pvPersonnage']);
            $this->players[$i]->setMana($remote_players[$i]['pj_manaPersonnage']);
            $this->players[$i]->setVisable($remote_players[$i]['pj_visable']);
            $cartes = $model->loadCartes($this->getId(), $remote_players[$i]['pj_user_fk']);
            $this->players[$i]->getDeck()->fillDeckWith($cartes);
            $this->players[$i]->updateCardArrays();
        }
    }

//*/
     /*
      * Sauvegarde + chargement + affichage
      */
    public function saveAndRefreshView($message = null, $error = null){
        try {
            $this->checkVisable();
            $this->saveGame();
            $this->loadGame();
            $tour = $this->getTour();
            for ($i = 0; $i < 2; $i++) {
                $pv[$i] = $this->getPlayer($i)->getPv();
                $mana[$i] = $this->getPlayer($i)->getMana();
                $pioche[$i]= $this->getPlayer($i)->getPioche();
                $main[$i] = array_reverse($this->getPlayer($i)->getMain(),true);
                $plateau[$i] = $this->getPlayer($i)->getPlateau();
                $defausse[$i] = $this->getPlayer($i)->getDefausse();
                $visable[$i] = $this->getPlayer($i)->getVisable();
                $heros[$i] = $this->getPlayer($i)->getDeck()->getHeros();
            }
            $jMain = json_encode($main);
            $jPlateau = json_encode($plateau);
            $jDefausse = json_encode($defausse);
            $jeton = $this->getJeton();
            $currentPlayer = $this->getCurrentPlayerJeton();
            $eog = $this->getEog();
            $cible = !empty($this->parameters['cible']) ? $this->parameters['cible'] : '';
// var_dump($this->parameters);
            $att = !empty($this->parameters['att']) ? $this->parameters['att'] : '';
            $abilite = (!empty($this->parameters['abilite']) ? $this->parameters['abilite'] : 0);

            $errorMssg = $this->message($error);

            $ajax = (!empty($this->parameters['ajax']) ? $this->parameters['ajax'] : null);
            if ($ajax == null) {
                ob_start();
                require(VIEWS_PATH . DS . 'Game' . DS . 'gameView.php');
                $gameView = ob_get_contents();
                ob_clean();
                require_once(VIEWS_PATH . DS . 'Game' . DS . 'gameLayout.php');
                exit();
            } elseif ($ajax == '1') {
                ob_start();
                require_once(VIEWS_PATH . DS . 'Game' . DS . 'gameView.php');
                // $gameView = utf8_encode(ob_get_contents());
                $gameView = ob_get_contents();
                ob_clean();
                header('Content-Type: application/json; charset=utf-8');
                $data = ['view' => $gameView,
                        'jeton' => $jeton,
                        'eog' => $eog,
                        'cible' => $cible,
                        'att' => $att,
                        'abilite' => $abilite,
                        'errorJSON' => json_last_error_msg()];

                echo json_encode($data, JSON_UNESCAPED_UNICODE );
               // echo json_last_error_msg();
                exit();
            }
        }catch(Exception $e){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($e);
        }
    }

    /*
     * Rechargement de la vue en ajax pendant le mode 'attente'
     */
    public function refreshViewAjax(){
        $this->loadGame();
        $tour = $this->getTour();
        for($i=0;$i<2;$i++){
            $pv[$i] = $this->getPlayer($i)->getPv();
            $mana[$i] = $this->getPlayer($i)->getMana();
            $pioche[$i]= $this->getPlayer($i)->getPioche();
            $main[$i] = array_reverse($this->getPlayer($i)->getMain(),true);
            $plateau[$i] = $this->getPlayer($i)->getPlateau();
            $defausse[$i] = $this->getPlayer($i)->getDefausse();
            $visable[$i] = $this->getPlayer($i)->getVisable();
            $heros[$i] = $this->getPlayer($i)->getDeck()->getHeros();
        }
        $jMain = json_encode($main);
        $jPlateau = json_encode($plateau);
        $jDefausse = json_encode($defausse);
        $jeton = $this->getJeton();
        $currentPlayer = $this->getCurrentPlayerJeton();
        $eog = $this->getEog();
        $cible = !empty($this->parameters['cible']) ? $this->parameters['cible'] : '';
        $att = !empty($this->parameters['att']) ? $this->parameters['att'] : '';
        $abilite = (!empty($this->parameters['abilite']) ? $this->parameters['abilite'] : 0);
        $this->checkVisable();
        if($winner = $this->checkEog()){
            $this->setEog(true);
            if($winner->getId() == $_SESSION['neozorus']['u_id']){
                // $message = 'Partie terminée<br>Vainqueur: '.$winner->getPseudo();
                $message = 'Vous avez gagné!';
            }else{
                $message = 'Vous avez perdu!';
            }
        }
        ob_start();
        require(VIEWS_PATH . DS . 'Game' . DS . 'gameView.php');
        $gameView = ob_get_contents();
        ob_clean();
        header('Content-Type: application/json; charset=utf-8');
        $data = [ 'view' => $gameView, 'jeton' => $jeton, 'eog' => $eog ];

        echo json_encode($data, JSON_UNESCAPED_UNICODE );
//        echo json_last_error_msg();
        exit();
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
        $winner = $this->checkEog();
	    if(!$winner){
            $this->tour($this->jeton);
        }else{
            if($winner->getId() == $_SESSION['neozorus']['u_id']){
                // $message = 'Partie terminée<br>Vainqueur: '.$winner->getPseudo();
                $message = 'Vous avez gagné!';
            }else{
                $message = 'Vous avez perdu!';
            }
            
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

        /*  Si le joueur a cliqué sur une carte de sa main et qu'il a assez de mana pour la jouer,
         *  lance la fonction de la classe Joueur 'jouerCarte'
         *  renvoie un message d'erreur si pas assez de mana
         */
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
            /*
             * Si le joueur veut attaquer avec une carte mais n'a pas désigné de cible,
             * renvoie un message l'invitant à cliquer sur une cible,
             * si la cible a été désignée, lance la fonction de la classe joueur 'attaquer'
             */
        }elseif (!empty($this->parameters['att'])){
            if(!empty($this->parameters['cible'])){
                if(strpos($cible = $this->parameters['cible'],'J')!==false){    // si la cible est un joueur
                    $p = substr($cible,-1);
                    $player->attaquer('j',$this->parameters['att'],$this->getPlayer($p),$otherPlayer,$jeton);
                }else {     // sinon, la cible est une carte
                    $player->attaquer('c', $this->parameters['att'], $this->parameters['cible'],$otherPlayer,$jeton);
                }
                // si la carte jouée dispose d'une capacité de pioche -> pioche x cartes
                if(!empty($this->parameters['abilite']) && $this->parameters['abilite']>=2){
                    for($i=1;$i<$this->parameters['abilite'];$i++){
                        $player->pioche();
                    }
                }
            }else{
                $this->error("Choisissez la cible");
            }
        }
        $this->saveAndRefreshView($message);
    }

    /*
     * Renvoie vers un lien qui affiche un message d'erreur
     */
    public function error($e){
	    // $this->saveAndRefreshView(null,$e);
        header('Content-Type: application/json; charset=utf-8');
        $data = [ 'error' => $this->message($e) ];
        echo json_encode($data);
        exit();
    }

    /*
     * Pour quitter la partie, efface la variable de session, met à jour la bdd et redirige vers l'accueil
     */
/*/
    public function quitter(){
        $this->loadGame();
        $deck = new GameDeckModel();
        $deckId = $this->getCurrentPlayer()->getDeck()->getId();
        $deck->setWaitingLine($deckId,0);

        $game = new GameModel();
        $game->setRunning($_SESSION['neozorus']['GAME'],0);
        unset($_SESSION['neozorus']['GAME']);

	    header('Location:?controller=home&action=affichagePageAccueil');
    }
/*/
    public function quitter(){
        $this->loadGame();
        // Mise à jour de la table deck -> le deck utilisé pour la partie redevient libre 
        $deck = new GameDeckModel();
        $deckId = $this->getCurrentPlayer()->getDeck()->getId();
        $deck->setWaitingLine($deckId,0);

        $game = new GameModel();
        $gameId = $this->getId();
        $playerId = $this->getCurrentPlayer()->getId();

        $game->deletePlayerFromGame($playerId, $gameId);

        if(empty($game->playerStillInGame($gameId))){
            $game->deleteGame($_SESSION['neozorus']['game']);
        }
        
        unset($_SESSION['neozorus']['game']);

        header('Location:.?controller=home&action=display');
    }
//*/
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

    public function message($m){
        $retour = '';
        switch($m){
            case 'not_enough_mana':
                $retour = "Vous n'avez pas assez de mana!";
                break;
            default:
                $retour = $m;
        }
        return $retour;
    }
}