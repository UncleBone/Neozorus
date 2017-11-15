<?php
class GameModel extends CoreModel{

    public function saveNewGame($game = GameController){
        $id = $game->getId();
        $req = 'INSERT INTO game (g_id,g_data) VALUES (:id,:data)';
        $param = [ 'id' => $id, 'data' => serialize($game) ];
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
}