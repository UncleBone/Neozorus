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
}