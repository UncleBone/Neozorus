<?php
class HeroController extends CoreController{

	/**
	 * récupère la liste des héros dans la BDD et invoque la view pour l'affichage
	 * @return [type] [description]
	 */
	public function affichageListeHero(){
		$model = new HeroModel();
		$heros = $model -> GetListHeros();	
		include('./Views/Hero/SelectHeroView.php');
	}
}