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

    // public function saveGame($game = GameController){
    //     $id = $game->getId();
    //     $req = 'UPDATE game SET g_data = :data WHERE g_id = :id';
    //     $param = [ 'id' => $id, 'data' =>serialize($game) ];
    //     $this->makeStatement($req,$param);
    // }

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

    // public function load($gameId){
    //     $req = 'SELECT g_data FROM game WHERE g_id = :id';
    //     $param = [ 'id' => $gameId ];
    //     return $this->makeSelect($req,$param);
    // }

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

    // public function getGameId($userId){
    //     $req = 'SELECT g_id FROM game WHERE g_running = 1 AND (g_player1 = :uid OR g_player2 = :uid)';
    //     $param = [ 'uid' => $userId];
    //     return $this->makeSelect($req,$param);
    // }

    public function getGameId_v2($userId){
        $req = 'SELECT p_id FROM partie WHERE p_etat = 1 AND (p_joueur1 = :uid OR p_joueur2 = :uid)';
        $param = [ 'uid' => $userId];
        return $this->makeSelect($req,$param);
    }

/****************************** Gestion de l'historique *********************************/

    public function addEvent($tour, $gameId, $player, $eventId){
        $req = 'INSERT INTO historique (h_tour, h_partie, h_joueur, h_event)
                VALUES (:tour, :gameId, :player, :eventId)';
        $param = [ 'tour' => $tour,
                    'gameId' => $gameId,
                    'player' => $player,
                    'eventId' => $eventId ];

        return $this->makeStatement($req,$param);
    }

    public function addEventPlay($carte, $historique){
        $req = 'INSERT INTO event_play (ep_carte, ep_hist)
                VALUES (:carte, :historique)';
        $param = [ 'carte' => $carte, 'historique' => $historique ];

        return $this->makeStatement($req,$param);
    }

    public function addEventAttCard($att, $cible, $mortAtt, $mortCible, $hist){
        $req = 'INSERT INTO event_att_card (eac_att, eac_cible, eac_mort_att, eac_mort_cible, eac_hist)
                VALUES (:att, :cible, :mortAtt, :mortCible, :hist)';
        $param = [ 'att' => $att, 
                    'cible' => $cible, 
                    'mortAtt' => $mortAtt,
                    'mortCible' => $mortCible,
                    'hist' => $hist ];

        return $this->makeStatement($req,$param);
    }

    public function addEventAttPlayer($att, $cible, $mortCible, $hist){
        $req = 'INSERT INTO event_att_player (eap_att, eap_cible, eap_mort_cible, eap_hist)
                VALUES (:att, :cible, :mortCible, :hist)';
        $param = [ 'att' => $att, 
                    'cible' => $cible, 
                    'mortCible' => $mortCible,
                    'hist' => $hist ];

        return $this->makeStatement($req,$param);
    }
   
/* Retourne l'id de la dernière entrée du tableau historique ayant les paramètres donnés */
    public function getIdHistorique($tour, $gameId, $player, $eventId){
        $req = 'SELECT h_id FROM historique
                WHERE h_tour = :tour AND h_partie = :gameId AND h_joueur = :player AND h_event = :eventId
                ORDER BY h_id DESC LIMIT 1';
        $param = [ 'tour' => $tour,
                    'gameId' => $gameId,
                    'player' => $player,
                    'eventId' => $eventId ];

        return $this->makeSelect($req, $param);
    }

    // public function getEventTableName($historiqueId){
    //     $req = 'SELECT e_nom FROM event
    //             INNER JOIN historique ON h_event = e_id
    //             WHERE h_id = :histId';
    //     $param = [ 'histId' => $historiqueId ];
    //     $event = $this->makeSelect($req,$param)[0];
    //     $tableName = 'event_'.$event;
        
    //     return $tableName; 
    // }

/* Retourne le type de l'évènement */
    public function getEventType($historiqueId){
        $req = 'SELECT h_event FROM historique
                WHERE h_id = :histId';
        $param = [ 'histId' => $historiqueId ];

        return $this->makeSelect($req,$param)[0]['h_event'];
    }

/* Retourne l'identifiant de l'évènement dans le tableau correspondant à son type */
    public function getEventId($historiqueId, $eventType){
        switch ($eventType) {
            case 1:
                $table = 'event_play';
                $id = 'ep_id';
                $hist = 'ep_hist';
                break;
            case 2:
                $table = 'event_att_card';
                $id = 'eac_id';
                $hist = 'eac_hist';
                break;
            case 3:
                $table = 'event_att_player';
                $id = 'eap_id';
                $hist = 'eap_hist';
                break;
        }
        $req = 'SELECT '.$id.' FROM '.$table.' WHERE '.$hist.' = :histId ORDER BY '.$id.' DESC LIMIT 1';
        $param = [ 'histId' => $historiqueId ];

        return $this->makeSelect($req, $param)[0][$id];
    }

/* Enregistre l'id de clé étrangère d'un évènement d'après son id d'historique */
    public function setEventIdInHistorique($historiqueId){
        $eventType = $this->getEventType($historiqueId);
        $eventId = $this->getEventId($historiqueId, $eventType);
        switch ($eventType) {
            case 1:
                $req = 'UPDATE historique SET h_ep_id = :eventId WHERE h_id = :histId';
                break;
            case 2:
                $req = 'UPDATE historique SET h_eac_id = :eventId WHERE h_id = :histId';
                break;
            case 3:
                $req = 'UPDATE historique SET h_eap_id = :eventId WHERE h_id = :histId';
                break;
        }
        $param = [ 'eventId' => $eventId,
        'histId' => $historiqueId ];

        return $this->makeStatement($req, $param);
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