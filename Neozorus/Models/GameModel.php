<?php
class GameModel extends CoreModel{

    public function saveNewGame($game = GameController){

        $player1 = $game->getPlayer(0)->getId();
        $player2 = $game->getPlayer(1)->getId();

        $req = 'INSERT INTO game (g_data,g_player1,g_player2,g_running) VALUES (:data,:p1,:p2,1)';
        $param = [ 'data' => serialize($game), 'p1' => $player1, 'p2' => $player2 ];

        $this->makeStatement($req,$param);
    }

    public function saveNewGame_v2($game = GameController){

        $player1 = $game->getPlayer(0)->getId();
        $player2 = $game->getPlayer(1)->getId();

        $req = 'INSERT INTO game (g_data,g_player1,g_player2,g_running) VALUES (:data,:p1,:p2,1)';
        $param = [ 'data' => serialize($game), 'p1' => $player1, 'p2' => $player2 ];

        $this->makeStatement($req,$param);
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

    public function getGameId($userId){
        $req = 'SELECT g_id FROM game WHERE g_running = 1 AND (g_player1 = :uid OR g_player2 = :uid)';
        $param = [ 'uid' => $userId];
        return $this->makeSelect($req,$param);
    }

    public function setRunning($gid,$val){
        $req = 'UPDATE game SET g_running = :val WHERE g_id = :id';
        $param = [ 'id' => $gid, 'val' => $val ];
        return $this->makeStatement($req,$param);
    }
}