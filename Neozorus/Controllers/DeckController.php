<?php
class DeckController extends CoreController{
	public function affichageDeck(){
		$model = new DeckModel();
		$decks = $model -> GetAllDecks($this->session['u_id'],$this->parameters['hero']);
		if(empty($decks)){
			$this->buildDefaultDeck($this->session['u_id'],$this->parameters['hero']);
		}
		else{
			$hero = $this->parameters['hero'];
			$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
			include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
		}	
	}

	public function affichageCarte($deckID){
		$model = new DeckModel();
		$decks = $model -> GetDeck($deckID);
		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
		include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
	}


	
	public function deconnexion(){
	unset($_SESSION['neozorus']);
	header('Location:.');
	exit;

	}

	private function buildDefaultDeck($user,$hero){
		$model = new DeckModel();
		$deckDefaultId = $model -> addDeckDb($user,$hero);
		if($deckDefaultId != false){
			if($model -> fillDeckDefault($deckDefaultId)){
				$this -> affichageDeck();
			}
			else{
				//générer une page d'erreur pour dire que le deck par defaut n'a pas ete cree
			}
		}
	}

	public function supprimerDeck(){
		$model = new DeckModel();
		if($model-> deleteDeck($this->parameters['deck'])){
			header('Location:index.php?controller=deck&action=affichageDeck&hero='.$this->parameters['hero']);
		}
		else{
			//inclure une page d'erreur qui explique qu'il y a eu un probleme lors de la supression d'un deck
		}
	}

	public function changeNameDeck(){
		if(!empty($this->data['newName'])){
			$newName = htmlentities($this->data['newName']);
			if(preg_match("#^[a-zA-Z0-9-_]{3,60}$#", $newName)){
				$model = new DeckModel;
				if($model->updateName($this->parameters['deck'],$newName)){
					echo $newName;
				}
				else{
					echo '';
				}
			}
			else{
				echo '';
			}
		}
		else{
			echo '';
		}
	}
}