<?php
class HeroController extends CoreController{


	public function __construct(){
		parent::__construct();
		$this->isSessionNeozorus();
	}
	/**
	 * récupère la liste des héros dans la BDD et invoque la view pour l'affichage
	 */
	public function affichageListeHero(){
		$model = new HeroModel();
		$heros = $model -> GetListHeros();	
		include('./Views/Hero/SelectHeroView.php');
	}
}