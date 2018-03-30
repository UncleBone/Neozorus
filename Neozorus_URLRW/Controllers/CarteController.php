<?php
class CarteController extends CoreController{

	/**
	 * Récupere les cartes en fonction du héro, du deck, et de l'utilisateur
	 */
	public function afficherCarte(){
		$this->isSessionNeozorus();
		$model = new CarteModel();
		$hero = $this->parameters['hero'];
		//On définit le theme de la page en fonction du héro
		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
		//On vérifie que le deck recherché existe bien
		$issetDeck = $model -> IssetDeck($this->parameters['deck'],$this->session['u_id'],$this->parameters['hero']);
		//Si le deck existe, on recupere les cartes du deck
		if($issetDeck){
			$monDeck = $model -> GetDeck($this->parameters['deck']);
			$mesCartes = $model -> GetCartes($monDeck);
			include(VIEWS_PATH . DS . 'Carte' . DS . 'SelectCarteView.php');
		}
	}

	
/************************ Affiche les cartes du jeu *********************************/
	 
	public function displayCards(){
		$title = 'Les cartes';
		//On verifie si il y a une requete ajax ou non
		if(!isset($this->parameters['ajax'])){
			//Si ce n'est pas une requete ajax, on va chercher dans la BDD toutes les cartes.
			$carteModel = new CarteModel();
			$mesCartes = $carteModel -> GetCartesByFilter();

			$lang = 1 ;
			if(isset($_SESSION['neozorus']['u_language'])){
				$lang = $_SESSION['neozorus']['u_language'];
			}
			$titleTrad = $lang == 1 ? 'Les cartes' : 'The Cards';

			ob_start();
			include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsView.php');
			$view = ob_get_contents();
			ob_clean();

			include(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
		}
		else{
			//Si c'est une requete ajax, on va chercher uniquement les cartes sélectionnées
			$team = empty($this->parameters['team']) ? null : $this->parameters['team'];
			$type = empty($this->parameters['type']) ? null : $this->parameters['type'];
			$mana = empty($this->parameters['mana']) ? null : $this->parameters['mana'];
			$idPouvoir = empty($this->parameters['idPouvoir']) == 'null' ? null : $this->parameters['idPouvoir'];
			$tri = 'c_mana';//par defaut les cartes sont triées par cout en mana

			$model = new CarteModel();
			$mesCartes = $model->GetCartesByFilter($team, $type, $mana, $idPouvoir, $tri);

			include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsFiltered.php');
		}
	}

	/************************ Affiche les cartes d'un deck *********************************/
	 
	public function displayDeckCards(){
		$title = 'Les cartes';
		$deckId = $this->parameters['deckId'];

		$deckModel = new DeckModel();
		$deckData = $deckModel->getDeckById($deckId)[0];
		$heros = $deckData['d_personnage_fk'];
		$deck = new Deck($deckData['d_id'], $deckData['d_libelle'], $heros);

		$team = $heros == '1' ? 'matrix' : 'dinos';
		
		//On verifie si il y a une requete ajax ou non
		if(!isset($this->parameters['ajax'])){
			//Si ce n'est pas une requete ajax, on va chercher dans la BDD toutes les cartes du deck
			
			$deck->setCartes();
			$mesCartes = $deck->getCartes();
			// $carteModel = new CarteModel();
			// $data = $carteModel -> GetCardsByDeck($this->parameters['deckId']);
			// foreach ($data as $value){
			// 	$mesCartes[]=new Carte($value['c_id'], $value['c_libelle'], $value['c_type'], $value['c_puissance'], $value['c_pvMax'], $value['c_mana']);
			// }	

			$lang = 1 ;
			if(isset($_SESSION['neozorus']['u_language'])){
				$lang = $_SESSION['neozorus']['u_language'];
			}
			$titleTrad = $lang == 1 ? 'Les cartes' : 'The Cards';

			ob_start();
			include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsView.php');
			$view = ob_get_contents();
			ob_clean();

			include(VIEWS_PATH . DS . 'Home' . DS . 'Layout_CardsAndRules.php');
		}
		else{
			//Si c'est une requete ajax, on va chercher uniquement les cartes sélectionnées
			$team = $deck->getPersonnage();
			$type = empty($this->parameters['type']) ? null : $this->parameters['type'];
			$mana = empty($this->parameters['mana']) ? null : $this->parameters['mana'];

			$model = new CarteModel();
			$mesCartes = $model->GetCardsByDeckByFilter($deckId, $type, $mana);

			include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsFiltered.php');
		}
	}
}