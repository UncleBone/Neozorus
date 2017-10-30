<?php
class GameDeckModel extends coreModel{

    public function getCards($deckID){
        $req = 'SELECT c_id as id, c_libelle as libelle, c_type as type, c_puissance as puissance, c_pvMax as pvMax, c_mana as mana, d_c_nbExemplaire as nbExemplaire 
                FROM `carte` 
				INNER JOIN d_c_inclure ON d_c_carte_fk = c_id 
				WHERE d_c_deck_fk = :id';
        $param = [ 'id' => $deckID ];
        return $this->makeSelect($req,$param);
    }

    public function getHeros($deckId){
        $req = 'SELECT d_personnage_fk FROM deck WHERE d_id = :id';
        $param = [ 'id' => $deckId ];
        return $this->makeSelect($req,$param)[0]['d_personnage_fk'];
    }
}