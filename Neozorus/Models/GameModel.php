<?php
class GameModel extends CoreModel{

    public function saveNewGame($game = GameController){

        $player1 = $game->getPlayer(0)->getId();
        $player2 = $game->getPlayer(1)->getId();

        $req = 'INSERT INTO game (g_data,g_player1,g_player2,g_running) VALUES (:data,:p1,:p2,1)';
        $param = [ 'data' => serialize($game), 'p1' => $player1, 'p2' => $player2 ];

        $this->makeStatement($req,$param);
    }

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

    public function saveJoueur($tabJoueur){
        $req = 'INSERT INTO u_p_jouer (u_p_pvPersonnage, u_p_manaPersonnage, u_p_visable, u_p_personnage_fk, u_p_user_fk, u_p_partie_fk, u_p_deck_fk) 
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

    public function saveCarte($tabCarte){
        $req = 'INSERT INTO saloncarte (s_cid_fk, s_indice, s_pv, s_lieu, s_visable, s_user_fk, s_partie_fk) 
                VALUES (:id,:indice,:pv,:lieu,:visable,:userId,:partie)';
        $param = [ 'id' => $tabCarte['id'],
                    'indice' => $tabCarte['indice'],
                    'pv' => $tabCarte['pv'],
                    'lieu' => $tabCarte['lieu'],
                    'visable' => $tabCarte['visable'],
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

    public function load($gameId){
        $req = 'SELECT g_data FROM game WHERE g_id = :id';
        $param = [ 'id' => $gameId ];
        return $this->makeSelect($req,$param);
    }

    public function loadGame($gameId){
        $req = 'SELECT * FROM partie WHERE p_id = :id';
        $param = [ 'id' => $gameId ];
        return $this->makeSelect($req,$param)[0];
    }

    public function loadPlayers($game){
        $req = 'SELECT * FROM u_p_jouer WHERE u_p_partie_fk = :game';
        $param = [ 'game' => $game ];
        return $this->makeSelect($req,$param);
    }

    public function loadCartes($game,$user){
        $req = 'SELECT * FROM saloncarte WHERE s_partie_fk = :game AND s_user_fk = :user';
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

    public function setRunning($gid,$val){
        $req = 'UPDATE game SET g_running = :val WHERE g_id = :id';
        $param = [ 'id' => $gid, 'val' => $val ];
        return $this->makeStatement($req,$param);
    }
}