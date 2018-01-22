<?php
class CarteController extends CoreController{

	/**
	 * Récupere les cartes en fonction du héro, du deck, et de l'utilisateur
	 */
	public function afficherCarte(){
		$this->isSessionNeozorus();
		$model = new CarteModel();
		$hero = $this->parameters['hero'];
		//On définit le theme de la page en fonction du héro
		$theme = $this->parameters['hero'] == 1 ? '"matrixtheme"' : '"dinotheme"';
		//On vérifie que le deck recherché existe bien
		$issetDeck = $model -> IssetDeck($this->parameters['deck'],$this->session['u_id'],$this->parameters['hero']);
		//Si le deck existe, on recupere les cartes du deck
		if($issetDeck){
			$monDeck = $model -> GetDeck($this->parameters['deck']);
			$mesCartes = $model -> GetCartes($monDeck);
			include(VIEWS_PATH . DS . 'Carte' . DS . 'SelectCarteView.php');
		}
	}

	/**
	 * Fonction qui, par defaut, récupère toutes les cartes du jeu. Si il y a un paramètre ajax, elle récupère les cartes en fonctions des filtres
	 */
	public function afficherCollectionCarte(){
		$title = 'Collection';
		//On verifie si il y a une requete ajax ou non
		if(!isset($this->parameters['ajax'])){
			//Si ce n'est pas une requete ajax, on va chercher dans la BDD toutes les cartes. Le nombre de types de carte differents, les différents coûts en mana des cartes, le nombre de heros différents ainsi que le nombre de pouvoirs différents qui vont nous servir à créer des select
			$carteModel = new CarteModel();
			$mesCartes = $carteModel -> GetCartesByFilter();
			$mesTypes = $carteModel -> GetType();
			$mesCoutsMana = $carteModel -> GetCoutMana();
			$mesPouvoirs = $carteModel -> GetPouvoirs();

			$heroModel = new HeroModel();
			$mesHeros = $heroModel -> GetListHeros();

			ob_start();
			include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsView.php');
			$view = ob_get_contents();
			ob_clean();

			include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsLayout.php');
		}
		else{
			//Si c'est une requete ajax, on va regarder les différents filtres
			$idHero = $this->parameters['idHero'] == 'null' ? null : $this->parameters['idHero'];
			$type = $this->parameters['type'] == 'null' ? null : $this->parameters['type'];
			$mana = $this->parameters['mana'] == 'null' ? null : $this->parameters['mana'];
			$idPouvoir = $this->parameters['idPouvoir'] == 'null' ? null : $this->parameters['idPouvoir'];
			$tri = 'c_mana';//par defaut les cartes sont trié par cout en mana
			if($this->parameters['tri'] == 'valPuissance'){
				$tri = 'c_puissance';
			}
			else if($this->parameters['tri'] == 'valVitalite'){
				$tri = 'c_pvMax';
			}
			$model = new CarteModel();
			$mesCartes = $model->GetCartesByFilter($idHero, $type, $mana, $idPouvoir, $tri);
			//on génère la view à injecter dans la page
			// include(VIEWS_PATH . DS . 'Carte' . DS . 'FilterView.php');
			include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsView.php');
		}
	}
}