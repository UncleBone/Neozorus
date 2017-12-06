<?php
class DeckController extends CoreController{


	public function __construct(){
		parent::__construct();
		$this->isSessionNeozorus();
	}
	/**
	 * Cette fonction va chercher les deck en fonction de l'utilisateur et du héro
	 */
	public function affichageDeck(){
		$model = new DeckModel();
		$decks = $model -> GetAllDecks($this->session['u_id'],$this->parameters['hero']);
		//Si l'utilisateur n'a pas de deck, on invoque une fonction qui va créer un deck par defaut
		if(empty($decks)){
			$this->buildDefaultDeck($this->session['u_id'],$this->parameters['hero']);
		}
		//On défini le theme de la page en fonction du héro et on invoque la view
		else{
			$hero = $this->parameters['hero'];
			$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
			include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
		}	
	}


	/**
	 * On affiche un deck en fonction de son ID
	 * @param  [type] $deckID ID du deck
	 */
	public function affichageCarte($deckID){
		$model = new DeckModel();
		$decks = $model -> GetDeck($deckID);
		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
		include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
	}


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
	private function buildDefaultDeck($user,$hero){
		$model = new DeckModel();
		//On crée d'abord un deck à l'utilisateur en fonction du héro dans la BDD
		$deckDefaultId = $model -> addDeckDb($user,$hero);
		//Si l'ajout du deck a fonctionné, on rempli le deck avec des cartes,puis on rappele la fonction d'affichage des deck
		if($deckDefaultId != false){
			if($model -> fillDeckDefault($deckDefaultId)){
				$this -> affichageDeck();
			}
			else{
				//générer une page d'erreur pour dire que le deck par defaut n'a pas ete cree
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
	 * permet de changer le nom d'un deck
	 */
	public function changeNameDeck(){
		//On vérifie que le nouveau nom ne soit pas vide,puis on le nettoie
		if(!empty($this->data['newName'])){
			$newName = htmlentities($this->data['newName']);
			//On vérifie que le nouveau nom soit compris entre 3 et 60 caractères, qu'il soit alphanumérique avec tirets et underscore
			if(StringHandler::isAlphaNumeric($this->data['newName'],DECK_NAME_MIN,DECK_NAME_MAX)){
				$model = new DeckModel;
				//Si tout est OK, on modifie le nom du deck dans la BDD et on renvoie le nouveau nom
				if($model->updateName($this->parameters['deck'],$newName)){
					echo json_encode($newName);
				}
				else{
					echo json_encode('');
				}
			}
			else{
				echo json_encode('');
			}
		}
		else{
			echo json_encode('');
		}
	}
}