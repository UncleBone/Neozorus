<?php
class DeckModel extends CoreModel{
	public function GetAllDecks($UserID,$personnageID){
		$Decks = array();
		$datas=$this->MakeSelect('SELECT d_id, d_libelle,d_nbMaxCarte,d_personnage_fk FROM deck WHERE d_user_fk ='.$UserID.' AND d_personnage_fk = '.$personnageID);
		foreach ($datas as $key => $data) {
			$Decks[]=new Deck ($data);
		}
		return $Decks;
	}

	public function IssetDeck($d_ID,$u_ID,$h_ID){
		$datas=$this->MakeSelect('SELECT d_id, d_libelle,d_nbMaxCarte,d_personnage_fk FROM deck WHERE d_id = '.$d_ID.' AND d_user_fk = '.$u_ID.' AND d_personnage_fk ='.$p_ID );
		$issetDeck = $datas != NULL ? true : false ;
		return $issetDeck;
	}

	public function addDeckDb($user,$hero){
		$sql = 'INSERT INTO deck (d_libelle,d_nbMaxCarte, d_personnage_fk, d_user_fk, d_waiting) VALUES ("Default", 20, :personnage, :user,0)';

            $params = array(
                'personnage' => $hero,
                'user' => $user
            );

        if($this->makeStatement($sql,$params)){
        	$id = $this->GetAllDecks($user,$hero)[0];
        	return $id;
        }
        return false;
	}

	public function fillDeckDefault(Deck $deck){
		$id = $deck->getD_id();
		if($deck->getD_personnage() == 1){
			$sql=
			"INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 1 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 2 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 3 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 12 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 4 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 5 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 6 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 7 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 8 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 9 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 10 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 11 )";
		}
		else if($deck->getD_personnage() == 2){
			$sql=
			"INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 13 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 14 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 15 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 1 , ". $id .", 24 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 16 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 17 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 18 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 19 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 20 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 21 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 22 );
			INSERT INTO d_c_inclure (d_c_nbExemplaire, d_c_deck_fk, d_c_carte_fk) VALUES ( 2 , ". $id .", 23 )";
		}
		if($this->makeStatement($sql)){
			return true;
		}
		return false;
	}
}