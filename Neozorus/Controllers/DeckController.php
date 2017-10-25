<?php
class DeckController extends CoreController{
	public function affichageDeck(){
		$model = new DeckModel();
		$decks = $model -> GetAllDecks($this->session['u_id'],$this->parameters['hero']);
		$hero = $this->parameters['hero'];
		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
		include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
	}

	public function affichageCarte($deckID){
		$model = new DeckModel();
		$decks = $model -> GetDeck($deckID);
		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
		include(VIEWS_PATH . DS . 'Deck' . DS . 'SelectDeckView.php');
	}

}