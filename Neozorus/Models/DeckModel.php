<?php
class DeckModel extends CoreModel{

	/**
	 * Récupère dans la BDD tous les deck d'un utilisateur en fonction du héros
	 * @param [int] $UserID       ID de l'utilisateur
	 * @param [int] $personnageID ID du héros
	 * @return [array] Tableau qui contient les données des Decks
	 */
	public function GetAllDecks($UserID,$personnageID){
		$req = 'SELECT d_id, d_libelle,d_nbMaxCarte,d_personnage_fk FROM deck 
				WHERE d_user_fk =:user AND d_personnage_fk = :heros';
		$param = [ 'user' => $UserID, 'heros' => $personnageID ];

		return $this->MakeSelect($req,$param);
	}

	/**
	 * Vérifie l'éxistence d'un deck dans la BDD et qu'il soit bien associé au bon utilisateur et au bon héro
	 * @param [int] $d_ID ID du deck
	 * @param [int] $u_ID ID de l'utilisateur
	 * @param [int] $h_ID ID du héro
	 * @return [bool] true si tout est Ok
	 */
	public function IssetDeck($d_ID,$u_ID,$h_ID){
		$sql='SELECT d_id, d_libelle,d_nbMaxCarte FROM deck WHERE d_id = :deckID AND d_user_fk = :userID AND d_personnage_fk =:heroID';
		$params = array('deckID'=>$d_ID,'userID'=>$u_ID, 'heroID'=>$h_ID);
		$datas=$this->MakeSelect($sql, $params);
		$issetDeck = $datas != NULL ? true : false ;
		return $issetDeck;
	}

	/**
	 * Ajoute un deck par défaut dans la BDD associé à un héros et un utilisateur
	 * @param [int] $user ID de l'utilisateur
	 * @param [int] $hero ID du héros
	 * @return [false|int] retourne false si l'ajout du deck a échoué, et l'id du deck si l'ajout a réussi
	 */
	public function addDefaultDeck($user,$heros){
		$req = 'INSERT INTO deck (d_libelle,d_nbMaxCarte, d_personnage_fk, d_user_fk, d_waiting) 
				VALUES ("Default", 20, :personnage, :user,0)';

        $param = [ 'personnage' => $heros, 'user' => $user ];

        if($this->makeStatement($req,$param)){
        	$id = $this->GetAllDecks($user,$hero)[0]['d_id'];
        	return $id;
        }
        return false;
	}

	/**
	 * Rempli le deck passé en paramètre de cartes afin de constituer un deck par default
	 * @param  Deck   $deck Instance de Deck
	 * @return [bool]       retourne true si le deck a été rempli, sinon false
	 */
	public function fillDeckDefault(Deck $deck){
		$id = $deck->getD_id();
		//En fonction du héro associé au deck , on établit une liste de carte différents
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

	/**
	 * Supprime un deck de la BDD en fonction de son Identifiant
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function deleteDeck($id){
		$sql = 'DELETE FROM deck WHERE d_id=:id';
		$param = array('id'=>$id);

        if($this->makeStatement($sql,$param)){
        	return true;
        }
        return false;
	}

	/**
	 * Modifie le nom d'un deck dans la BDD
	 * @param  [int] $id      Identifiant du deck à renommer
	 * @param  [string] $newName Nouveau nom du deck
	 * @return [bool]          renvoi true si le nom a bien été modifié, sinon false
	 */
	public function updateName($id,$newName){
		$sql = 'UPDATE deck SET d_libelle=:name WHERE d_id=:id';
		$params = array(
            'name' => $newName,
            'id' => $id
        );
        if($this->makeStatement($sql,$params)){
        	return true;
        }
        return false;
	}
}