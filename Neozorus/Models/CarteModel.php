<?php
class CarteModel extends CoreModel{
	public function GetAllCards(Deck $Deck){
	}

	public function IssetDeck($d_ID,$u_ID,$h_ID){
		$datas=$this->MakeSelect('SELECT d_id, d_libelle,d_nbMaxCarte FROM deck WHERE d_id = '.$d_ID.' AND d_user_fk = '.$u_ID.' AND d_personnage_fk ='.$h_ID );
		$issetDeck = $datas != NULL ? true : false ;
		return $issetDeck;
	}

	public function GetDeck($d_ID){
		$Decks = array();
		$datas=$this->MakeSelect('SELECT * FROM deck WHERE d_id = '.$d_ID);
		foreach ($datas as $key => $data) {
			$Decks[]=new Deck ($data);
		}
		return $Decks[0];
	}

	public function GetCartes(Deck $deck){
		$mesCartes = array();
		$data=$this->MakeSelect('SELECT carte.*,d_c_NbExemplaire AS NbExemplaire FROM carte INNER JOIN d_c_inclure ON c_id = d_c_carte_fk INNER JOIN deck ON d_c_deck_fk = d_id WHERE d_id = '.$deck -> GetD_id());
		foreach ($data as $key => $value){
			$NbExemplaire = $data[$key]['NbExemplaire'];
			unset($data[$key]['NbExemplaire']);
			for ($i=0; $i < $NbExemplaire; $i++) { 
				$indice = $i+1;
				$mesCartes[]=new Carte($value,$indice);
			}		
		}
		return $mesCartes;
	}

	public function GetCartesByFilter($idHero = null, $type = null, $mana = null, $pouvoir = null){
		$mesCartes = array();

		$filterHero = $idHero == null ? 'WHERE 1' : 'WHERE c_personnage_fk='.$idHero;
		$filterType = $type == null ? '' : 'AND c_type="'.$type.'"';
		$filterMana = $mana == null ? '' : 'AND c_mana='.$mana;
		$filterPouvoir = $pouvoir == null ? '' : 'AND a_id='.$pouvoir;

		$data=$this->MakeSelect('SELECT DISTINCT carte.* FROM carte LEFT JOIN  c_a_inclure ON c_id = c_a_carte_fk LEFT JOIN abilite ON c_a_abilite_fk=a_id '.$filterHero.' '.$filterType.' '.$filterMana.' '.$filterPouvoir);

		foreach ($data as $key => $value){
			$mesCartes[]=new Carte($value);				
		}
		
		return $mesCartes;
	}

	public function getType(){
		$mesTypes = array();
		$data=$this->MakeSelect('SELECT DISTINCT c_type FROM carte');
		foreach ($data as $key => $value){
			$mesTypes[]=$value['c_type'];				
		}
		return $mesTypes;
	}

	public function getCoutMana(){
		$mesCoutMana = array();
		$data=$this->MakeSelect('SELECT DISTINCT c_mana FROM carte ORDER BY c_mana');
		foreach ($data as $key => $value){
			$mesCoutMana[]=$value['c_mana'];				
		}
		return $mesCoutMana;
	}

	public function getPouvoirs(){
		$mesPouvoirs = array();
		$data=$this->MakeSelect('SELECT DISTINCT a_libelle, a_id FROM abilite ORDER BY a_id');
		foreach ($data as $key => $value){
			$mesPouvoirs[]=$value;				
		}
		return $mesPouvoirs;
	}
}