<?php
class HeroController extends CoreController{
	public function affichageListeHero(){
		$model = new HeroModel();
		$heros = $model -> GetListHeros();	
		include('./Views/Hero/SelectHeroView.php');
	}


}