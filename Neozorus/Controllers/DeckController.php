<?php
class DeckController extends CoreController{

	public function __construct(){
		parent::__construct();
		$this->isSessionNeozorus();
	}

	public function display(){
		$lang = 1 ;
		if(isset($_SESSION['neozorus']['u_language'])){
			$lang = $_SESSION['neozorus']['u_language'];
		}
		$myDeckTrad = $lang == 1 ? 'mes Decks' : 'my Decks';
		$playButtonTrad = $lang == 1 ? 'Jouer' : 'Play';
		$detailsButtonTrad = $lang == 1 ? 'Détails' : 'Details';

		$model = new DeckModel();
		$deckList = $model -> GetAllDecks($this->session['u_id'],$this->parameters['team'] == 'matrix' ? '1' : '2');
		if(!empty($deckList)){
			foreach ($deckList as $data) {
				$decks[] = new Deck($data['d_id'], $data['d_libelle'], $data['d_personnage_fk']);
			}
		}else{		//Si l'utilisateur n'a pas de deck, on invoque une fonction qui va créer un deck par defaut
			$this->buildDefaultDeck($this->session['u_id'],$this->parameters['team'] == 'matrix' ? '1' : '2');
		}

		$team = $this->parameters['team'];
		$title = $team == 'matrix' ? 'La matrice' : 'Les dinos';
		$heros = $team == 'matrix' ? '1' : '2';
		$theme = $this->parameters['team'] == 1 ? '"matrixtheme"' : '"dinotheme"';

		ob_start();
		include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
		$view = ob_get_contents();
		ob_clean();
		include(VIEWS_PATH . DS . 'Common' . DS . 'splitBackgroundLayout.php');	
	}

	/**
	 * Cette fonction va chercher les deck en fonction de l'utilisateur et du héro
	 */
	// public function affichageDeck(){
	// 	$model = new DeckModel();
	// 	$decks = $model -> GetAllDecks($this->session['u_id'],$this->parameters['heros']);
	// 	//Si l'utilisateur n'a pas de deck, on invoque une fonction qui va créer un deck par defaut
	// 	if(empty($decks)){
	// 		$this->buildDefaultDeck($this->session['u_id'],$this->parameters['hero']);
	// 	}
	// 	//On défini le theme de la page en fonction du héro et on invoque la view
	// 	else{
	// 		$hero = $this->parameters['hero'];
	// 		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
	// 		include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
	// 	}	
	// }


	/**
	 * On affiche un deck en fonction de son ID
	 * @param  [type] $deckID ID du deck
	 */
	// public function affichageCarte($deckID){
	// 	$model = new DeckModel();
	// 	$decks = $model -> GetDeck($deckID);
	// 	$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
	// 	include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
	// }


	/**
	 * deconnecte l'utilisateur et redirige sur la page de connexion
	 */
	public function deconnexion(){
	unset($_SESSION['neozorus']);
	header('Location:.');
	exit;

	}

	/**
	 * Crée un deck par défaut spécifique à un utilisateur donné pour un héro donné
	 * @param  [type] $user ID du l'utilisateur
	 * @param  [type] $hero ID du héro
	 */
	private function buildDefaultDeck($user,$heros){
		$model = new DeckModel();
		//On crée d'abord un deck à l'utilisateur en fonction du héros dans la BDD
		$deckDefaultId = $model -> addDefaultDeck($user,$heros);
		//Si l'ajout du deck a fonctionné, on rempli le deck avec des cartes,puis on rappele la fonction d'affichage des deck
		if($deckDefaultId !== false){
			$defaultDeck = new Deck($deckDefaultId, 'Default', $heros);
			if($model -> fillDeckDefault($defaultDeck)){
				// $this -> affichageDeck();
				$this->display();
			}
			else{
				//générer une page d'erreur pour dire que le deck par defaut n'a pas ete cree
				echo 'non';
			}
		}
	}

	/**
	 * Supprime un deck dans la BDD en fonction de l'ID du deck,puis redirige l'utilisateur sur la page de séléction des decks su la suppression a reussi
	 */
	public function supprimerDeck(){
		$model = new DeckModel();
		if($model-> deleteDeck($this->parameters['deck'])){
			header('Location:index.php?controller=deck&action=affichageDeck&hero='.$this->parameters['hero']);
		}
		else{
			//inclure une page d'erreur qui explique qu'il y a eu un probleme lors de la supression d'un deck
		}
	}

	/**
	 * Pour changer le nom d'un deck
	 */
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