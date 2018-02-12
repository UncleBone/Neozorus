<?php
class GameModel extends CoreModel{

    // public function saveNewGame($game = GameController){

    //     $player1 = $game->getPlayer(0)->getId();
    //     $player2 = $game->getPlayer(1)->getId();

    //     $req = 'INSERT INTO game (g_data,g_player1,g_player2,g_running) VALUES (:data,:p1,:p2,1)';
    //     $param = [ 'data' => serialize($game), 'p1' => $player1, 'p2' => $player2 ];

    //     $this->makeStatement($req,$param);
    // }

    public function saveNewGame_v2($tabGame){
        $req = 'INSERT INTO partie (p_tour, p_jeton, p_etat, p_joueur1, p_joueur2, p_piocheEtMana) 
                VALUES (:tour, :jeton, :etat, :joueur1, :joueur2, :PeM)';
        $param = [ 'tour' => $tabGame['tour'],
                    'jeton' => $tabGame['jeton'],
                    'etat' => $tabGame['running'],
                    'joueur1' => $tabGame['joueur1'],
                    'joueur2' => $tabGame['joueur2'],
                    'PeM' => $tabGame['PeM'] ];

        return $this->makeStatement($req,$param);
    }

    public function saveNewJoueur($tabJoueur){
        $req = 'INSERT INTO partie_joueur (pj_pvPersonnage, pj_manaPersonnage, pj_visable, pj_personnage_fk, pj_user_fk, pj_partie_fk, pj_deck_fk) 
                VALUES (:pv,:mana,:visable, :personnage,:userId,:gameId,:deck)';
        $param = [ 'pv' => $tabJoueur['pv'],
                    'mana' => $tabJoueur['mana'],
                    'visable' => $tabJoueur['visable'],
                    'personnage' => $tabJoueur['personnage'],
                    'userId' => $tabJoueur['id'],
                    'gameId' => $tabJoueur['partie'],
                    'deck' => $tabJoueur['deck'] ];

        return $this->makeStatement($req,$param);
    }

    public function saveJoueur($tabJoueur){
        $req = 'UPDATE partie_joueur 
                SET pj_pvPersonnage = :pv, 
                    pj_manaPersonnage = :mana, 
                    pj_visable = :visable
                WHERE pj_user_fk = :userId AND pj_partie_fk = :gameId';
        $param = [ 'pv' => $tabJoueur['pv'],
            'mana' => $tabJoueur['mana'],
            'visable' => $tabJoueur['visable'],
            'userId' => $tabJoueur['id'],
            'gameId' => $tabJoueur['partie'] ];

        return $this->makeStatement($req,$param);
    }

    public function saveNewCarte($tabCarte){
        $req = 'INSERT INTO partie_carte (pc_cid_fk, pc_indice, pc_pv, pc_lieu, pc_visable, pc_active, pc_user_fk, pc_partie_fk) 
                VALUES (:id,:indice,:pv,:lieu,:visable,:active,:userId,:partie)';
        $param = [ 'id' => $tabCarte['id'],
                    'indice' => $tabCarte['indice'],
                    'pv' => $tabCarte['pv'],
                    'lieu' => $tabCarte['lieu'],
                    'visable' => $tabCarte['visable'],
                    'active' => $tabCarte['active'],
                    'userId' => $tabCarte['user'],
                    'partie' => $tabCarte['partie'] ];

        return $this->makeStatement($req,$param);
    }

    public function getCardGameId($gameId,$playerId,$cardId,$cardIndex){
        $req = 'SELECT pc_id FROM partie_carte 
                WHERE pc_partie_fk = :gameId AND pc_user_fk = :playerId AND pc_cid_fk = :cardId AND pc_indice = :cardIndex';
        $param = [ 'gameId' => $gameId, 'playerId' => $playerId, 'cardId' => $cardId, 'cardIndex' => $cardIndex ];

        return $this->makeSelect($req,$param);
    }

    public function saveCarte($tabCarte){
        $req = 'UPDATE partie_carte 
                SET pc_pv = :pv, 
                    pc_lieu = :lieu, 
                    pc_visable = :visable,
                    pc_active = :active
                WHERE pc_cid_fk = :id AND pc_indice = :indice AND pc_user_fk = :userId AND pc_partie_fk = :partie';
        $param = [ 'id' => $tabCarte['id'],
            'indice' => $tabCarte['indice'],
            'pv' => $tabCarte['pv'],
            'lieu' => $tabCarte['lieu'],
            'visable' => $tabCarte['visable'],
            'active' => $tabCarte['active'],
            'userId' => $tabCarte['user'],
            'partie' => $tabCarte['partie'] ];

        return $this->makeStatement($req,$param);
    }

    public function saveGame($game = GameController){
        $id = $game->getId();
        $req = 'UPDATE game SET g_data = :data WHERE g_id = :id';
        $param = [ 'id' => $id, 'data' =>serialize($game) ];
        $this->makeStatement($req,$param);
    }

    public function saveGame_v2($tabGame){
        $req = 'UPDATE partie 
                SET p_tour = :tour, 
                    p_jeton = :jeton, 
                    p_etat = :etat, 
                    p_gagnant = :gagnant, 
                    p_piocheEtMana = :PeM 
                WHERE p_id = :id';
        $param = [ 'tour' => $tabGame['tour'],
            'jeton' => $tabGame['jeton'],
            'etat' => $tabGame['running'],
            'gagnant' => $tabGame['winner'],
            'PeM' => $tabGame['PeM'],
            'id' => $tabGame['id'] ];

        return $this->makeStatement($req,$param);
    }

    public function load($gameId){
        $req = 'SELECT g_data FROM game WHERE g_id = :id';
        $param = [ 'id' => $gameId ];
        return $this->makeSelect($req,$param);
    }

    public function loadGame($gameId){
        $req = 'SELECT * FROM partie WHERE p_id = :id';
        $param = [ 'id' => $gameId ];
        return $this->makeSelect($req,$param);
    }

    public function loadPlayers($game){
        $req = 'SELECT * FROM partie_joueur WHERE pj_partie_fk = :game';
        $param = [ 'game' => $game ];
        return $this->makeSelect($req,$param);
    }

    public function loadCartes($game,$user){
        $req = 'SELECT * FROM partie_carte WHERE pc_partie_fk = :game AND pc_user_fk = :user 
                ORDER BY pc_id ASC';
        $param = [ 'game' => $game, 'user' => $user ];
        return $this->makeSelect($req,$param);
    }

    public function getGameId($userId){
        $req = 'SELECT g_id FROM game WHERE g_running = 1 AND (g_player1 = :uid OR g_player2 = :uid)';
        $param = [ 'uid' => $userId];
        return $this->makeSelect($req,$param);
    }

    public function getGameId_v2($userId){
        $req = 'SELECT p_id FROM partie WHERE p_etat = 1 AND (p_joueur1 = :uid OR p_joueur2 = :uid)';
        $param = [ 'uid' => $userId];
        return $this->makeSelect($req,$param);
    }

    // public function setRunning($gid,$val){
    //     $req = 'UPDATE game SET g_running = :val WHERE g_id = :id';
    //     $param = [ 'id' => $gid, 'val' => $val ];
    //     return $this->makeStatement($req,$param);
    // }

    public function setRunning($gid,$val){
        $req = 'UPDATE partie SET p_etat = :val WHERE p_id = :id';
        $param = [ 'id' => $gid, 'val' => $val ];
        return $this->makeStatement($req,$param);
    }

    // public function isRunning($id){
    //     $req = 'SELECT p_etat FROM partie WHERE p_id = :id';
    //     $param = [ 'id' => $id, 'val' => $val ];
    //     return $this->makeStatement($req,$param);
    // }

    /*
     * Vérifie si le deck d'un joueur est actuellement dans une partie en cours
     */
    public function checkDeckInRunningGame($deckId){
        $req = 'SELECT * FROM partie_joueur
                INNER JOIN partie ON pj_partie_fk = p_id
                WHERE pj_deck_fk = :deck AND p_etat = 1';
        $param = [ 'deck' => $deckId ];
        return $this->makeSelect($req,$param);
    }

    public function deletePlayerFromGame($playerId, $gameId){
        $req = 'DELETE FROM partie_joueur WHERE pj_user_fk = :pid AND pj_partie_fk = :gid';
        $param = [ 'pid' => $playerId, 'gid' => $gameId ];
        return $this->makeStatement($req,$param);
    }

    public function playerStillInGame($gameId){
        $req = 'SELECT * FROM partie_joueur WHERE pj_partie_fk = :gid';
        $param = [ 'gid' => $gameId ];
        return $this->makeSelect($req,$param);
    }

    public function deleteGame($id){
        $req = 'DELETE FROM partie WHERE p_id = :id';
        $param = [ 'id' => $id ];
        return $this->makeStatement($req,$param);
    }
}