<?php
class DeckController extends CoreController{

	public function __construct(){
		parent::__construct();
		$this->isSessionNeozorus();
	}

	/*** affichage de la page de sélection de deck ***/

	public function display(){
		$lang = 1 ;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		$playButtonTrad = $lang == 1 ? 'Jouer' : 'Play';

		$model = new DeckModel();
		$deckList = $model -> GetAllDecks($this->session['u_id'],$this->parameters['team'] == 'matrix' ? '1' : '2');

		/* Affichage des decks existants */
		if(!empty($deckList)){
			foreach ($deckList as $data) {
				$decks[] = new Deck($data['d_id'], $data['d_libelle'], $data['d_personnage_fk']);
			}

		/* Si l'utilisateur n'a pas de deck, création d'un deck par defaut */
		}else{		
			$this->buildDefaultDeck($this->session['u_id'],$this->parameters['team'] == 'matrix' ? '1' : '2');
			$this->display();
		}
		if(empty($this->parameters['team']) || ($this->parameters['team'] != 'matrix' && $this->parameters['team'] != 'dinos')){
			header('Location:.?controller=home&action=display');
		}
		$team = $this->parameters['team'];	// variable passée au script pour l'affichage
		$title = $team == 'matrix' ? 'La matrice' : 'Les dinos';
		$heros = $team == 'matrix' ? '1' : '2';
		// $theme = $this->parameters['team'] == 1 ? '"matrixtheme"' : '"dinotheme"';

		ob_start();
		include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
		$view = ob_get_contents();
		ob_clean();
		include(VIEWS_PATH . DS . 'Common' . DS . 'splitBackgroundLayout.php');	
	}

	/**
	 * Crée un deck par défaut spécifique à un utilisateur donné pour un héro donné
	 * @param  [type] $user ID du l'utilisateur
	 * @param  [type] $hero ID du héro
	 */
	public function buildDefaultDeck($user,$heros){
		$model = new DeckModel();
		// On crée d'abord un deck à l'utilisateur en fonction du héros dans la BDD
		$deckDefaultId = $model -> addDefaultDeck($user,$heros);
		// Si l'ajout du deck a fonctionné, on rempli le deck avec des cartes,puis on rappele la fonction d'affichage des decks
		if($deckDefaultId !== false){
			$defaultDeck = new Deck($deckDefaultId, 'Default', $heros);
			if(!$model -> fillDeckDefault($defaultDeck)){
				throw new Exception("Erreur de remplissage du deck par défaut", 1);
			}
		}
	}

/*** Réponse à une requête ajax de changement de nom d'un deck ***/

	public function changeName(){
		if(!empty($this->data['newName'])){
			$newName = $this->data['newName'];
			//On vérifie que le nouveau nom soit compris entre 1 et 16 caractères
			if(strlen($newName) >= DECK_NAME_MIN && strlen($newName) <= DECK_NAME_MAX){
				$model = new DeckModel;
				if($model->updateName($this->parameters['deckId'],$newName)){
					echo json_encode($newName);
				}
				else{
					echo json_encode([ 'error' => 'Erreur d\'écriture dans la base de données' ]);
				}
			}else{
				echo json_encode([ 'error' => 'Le nom doit être compris entre 1 et 16 caractères' ]);
			}
		}else{
			echo json_encode('');
		}
	}
}