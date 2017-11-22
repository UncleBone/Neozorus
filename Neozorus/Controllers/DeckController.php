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
}