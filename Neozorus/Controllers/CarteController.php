<?php
class CarteController extends CoreController{
	public function afficherCarte(){
		$model = new CarteModel();
		$hero = $this->parameters['hero'];
		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
		$issetDeck = $model -> IssetDeck($this->parameters['deck'],$this->session['u_id'],$this->parameters['hero']);
		if($issetDeck){
			$monDeck = $model -> GetDeck($this->parameters['deck']);
			$mesCartes = $model -> GetCartes($monDeck);
			include(VIEWS_PATH . DS . 'Carte' . DS . 'SelectCarteView.php');
		}
	}

	public function afficherCollectionCarte(){
		if(!isset($this->parameters['ajax'])){
			$carteModel = new CarteModel();
			$mesCartes = $carteModel -> GetCartesByFilter();
			$mesTypes = $carteModel -> GetType();
			$mesCoutsMana = $carteModel -> GetCoutMana();
			$mesPouvoirs = $carteModel -> GetPouvoirs();

			$heroModel = new HeroModel();
			$mesHeros = $heroModel -> GetListHeros();

			include(VIEWS_PATH . DS . 'Carte' . DS . 'CollectionCarteView.php');
		}
		else{
			$idHero = htmlentities($this->parameters['idHero']) == 'null' ? null : htmlentities($this->parameters['idHero']);
			$type = htmlentities($this->parameters['type']) == 'null' ? null : htmlentities($this->parameters['type']);
			$mana = htmlentities($this->parameters['mana']) == 'null' ? null : htmlentities($this->parameters['mana']);
			$idPouvoir = htmlentities($this->parameters['idPouvoir']) == 'null' ? null : htmlentities($this->parameters['idPouvoir']);
			$model = new CarteModel();
			$mesCartes = $model->GetCartesByFilter($idHero, $type, $mana, $idPouvoir);
			include(VIEWS_PATH . DS . 'Carte' . DS . 'FilterView.php');
		}
	}
}