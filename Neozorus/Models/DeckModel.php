<?php
class DeckModel extends CoreModel{
	public function GetAllDecks($UserID,$personnageID){
		$Decks = array();
		$datas=$this->MakeSelect('SELECT d_id, d_libelle,d_nbMaxCarte FROM deck WHERE d_user_fk ='.$UserID.' AND d_personnage_fk = '.$personnageID);
		foreach ($datas as $key => $data) {
			$Decks[]=new Deck ($data);
		}
		return $Decks;
	}

	public function IssetDeck($d_ID,$u_ID,$h_ID){
		$datas=$this->MakeSelect('SELECT d_id, d_libelle,d_nbMaxCarte FROM deck WHERE d_id = '.$d_ID.' AND d_user_fk = '.$u_ID.' AND d_personnage_fk ='.$p_ID );
		$issetDeck = $datas != NULL ? true : false ;
		return $issetDeck;
	}
}