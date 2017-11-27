<?php
class CarteModel extends CoreModel{

	/**
	 * Verifie qu'un deck existe dans la BDD
	 * @param [int] $d_ID ID du deck
	 * @param [int] $u_ID ID de l'utilisateur
	 * @param [int] $h_ID Id du héro
	 * @return [bool] renvoie true si le deck existe dans la BDD , false dans le cas contraire
	 */
	public function IssetDeck($d_ID,$u_ID,$h_ID){
		$datas=$this->MakeSelect('SELECT d_id, d_libelle,d_nbMaxCarte FROM deck WHERE d_id = '.$d_ID.' AND d_user_fk = '.$u_ID.' AND d_personnage_fk ='.$h_ID );
		$issetDeck = $datas != NULL ? true : false ;
		return $issetDeck;
	}

	/**
	 * récupère et instancie un deck en fonction de son ID
	 * @param [int] $d_ID ID du deck
	 * @return  [Object] Instance de Deck
	 */
	public function GetDeck($d_ID){
		$Decks = array();
		$datas=$this->MakeSelect('SELECT * FROM deck WHERE d_id = '.$d_ID);
		foreach ($datas as $key => $data) {
			$Decks[]=new Deck ($data);
		}
		return $Decks[0];
	}

	/**
	 * Récupère et instancie les cartes appartenant au deck en paramètre
	 * @param Deck $deck Instance de Deck
	 * @return  [array] Tableau contenant des instances de Carte
	 */
	public function GetCartes(Deck $deck){
		$mesCartes = array();
		$data=$this->MakeSelect('SELECT carte.*,d_c_NbExemplaire AS NbExemplaire FROM carte INNER JOIN d_c_inclure ON c_id = d_c_carte_fk INNER JOIN deck ON d_c_deck_fk = d_id WHERE d_id = '.$deck -> GetD_id());

		foreach ($data as $key => $value){
			$NbExemplaire = $data[$key]['NbExemplaire'];//On récupère le nombre de fois qu'une carte est comprise dans un deck
			unset($data[$key]['NbExemplaire']);//On supprime le Nbre Exemplaire car cette cle n'existe pas dans une instance de Carte
			//on fait une boucle qui instancie une carte n fois en fonction du nombre d'exemplaire
			for ($i=0; $i < $NbExemplaire; $i++) { 
				$indice = $i+1;//indice est un attribut de la carte
				$mesCartes[]=new Carte($value,$indice);
			}		
		}
		return $mesCartes;
	}

	/**
	 * Récupère des cartes en BDD et les instancie en fonction des différents filtres appliqué et du mode de triage
	 * @param [null|int] $idHero  Ajoute un filtre en fonction de l'id du héro si $idHero n'est pas null
	 * @param [null|string] $type Ajoute un filtre en fonction du type de carte si $type n'est pas null
	 * @param [null|int] $mana    Ajoute un filtre en fonction du cout en mana de la carte si $mana n'est pas null
	 * @param [null|int] $pouvoir Ajoute un filtre en fonction du l'id du pouvoir de la carte si $pouvoir n'est pas null
	 * @param [string] $tri       Tri le résultat en fonction du parametre $tri (mana|puissance|vitalite)
	 * @return [array]            Tableau d'instances de Carte
	 */
	public function GetCartesByFilter($idHero = null, $type = null, $mana = null, $pouvoir = null, $tri = 'c_mana'){
		$mesCartes = array();

		$filterHero = $idHero == null ? 'WHERE 1' : 'WHERE c_personnage_fk='.$idHero;
		$filterType = $type == null ? '' : 'AND c_type="'.$type.'"';
		$filterMana = $mana == null ? '' : 'AND c_mana='.$mana;
		$filterPouvoir = $pouvoir == null ? '' : 'AND a_id='.$pouvoir;

		$data=$this->MakeSelect('SELECT DISTINCT carte.* FROM carte LEFT JOIN  c_a_inclure ON c_id = c_a_carte_fk LEFT JOIN abilite ON c_a_abilite_fk=a_id '.$filterHero.' '.$filterType.' '.$filterMana.' '.$filterPouvoir.' ORDER BY '. $tri);

		foreach ($data as $key => $value){
			$mesCartes[]=new Carte($value);				
		}
		
		return $mesCartes;
	}

	/**
	 * Retourne les différents types de cartes qui existent en BDD
	 * @return [array] contient les types de cartes
	 */
	public function getType(){
		$mesTypes = array();
		$data=$this->MakeSelect('SELECT DISTINCT c_type FROM carte');
		foreach ($data as $key => $value){
			$mesTypes[]=$value['c_type'];				
		}
		return $mesTypes;
	}

	/**
	 * Retourne les différents coût en mana qui existent en BDD
	 * @return [array] contient les différents coût en mana
	 */
	public function getCoutMana(){
		$mesCoutMana = array();
		$data=$this->MakeSelect('SELECT DISTINCT c_mana FROM carte ORDER BY c_mana');
		foreach ($data as $key => $value){
			$mesCoutMana[]=$value['c_mana'];				
		}
		return $mesCoutMana;
	}

	/**
	 * Retourne les différents pouvoirs qui existent en BDD
	 * @return [array] contient les différents pouvoirs(Id et libelle)
	 */
	public function getPouvoirs(){
		$mesPouvoirs = array();
		$data=$this->MakeSelect('SELECT DISTINCT a_libelle, a_id FROM abilite ORDER BY a_id');
		foreach ($data as $key => $value){
			$mesPouvoirs[]=$value;				
		}
		return $mesPouvoirs;
	}
}