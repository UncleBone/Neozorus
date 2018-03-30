<?php
class GameDeck{
	private $id;                    // id du deck
	private $cartes = array();      // tableau d'objets de type cartes
	private $heros;                 // id du héros associé au deck

	public function __construct($id){
		$this->setId($id);
		$this->setHeros();
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
	    return $this->id;
    }

    public function getCartes(){
	    return $this->cartes;
    }

    public function setHeros(){
	    $deck = new GameDeckModel;
	    $this->heros = $deck->getHeros($this->getId());
    }

    public function getHeros(){
        return $this->heros;
    }

    /*
     * remplit le tableau cartes avec les cartes composant le deck
     */
    function fillDeck(){
        $testGame = new GameDeckModel;
        $data = $testGame->getCards($this->getId());
        foreach ($data as $value) {
            for($i=1;$i<=$value['nbExemplaire'];$i++){
                $this->cartes[] = new GameCard($value['id'],$value['libelle'],$value['type'],$value['puissance'],$value['pvMax'],$value['mana'],$i,$value['abilite']);
            }
        }
    }

    /*
     * remplit les tableau cartes avec les données en paramètre
     */
    function fillDeckWith($cartes){
        $carteModel = new CarteModel();             
        foreach ($cartes as $carte) {
            $data = $carteModel->getCardById($carte['pc_cid_fk'])[0];
            $gameCard = new GameCard($carte['pc_cid_fk'],$data['c_libelle'],$data['c_type'],$data['c_puissance'],$data['c_pvMax'],$data['c_mana'],$carte['pc_indice'],$data['c_abilite']);
            $gameCard->setPv($carte['pc_pv']);
            $gameCard->setLocalisation($carte['pc_lieu']);
            $gameCard->setVisable($carte['pc_visable']);
            $gameCard->setActive($carte['pc_active']);
            $gameCard->setGameId($carte['pc_id']);
            $this->cartes[] = $gameCard;
        }
    }

    /*
     * mélange les cartes
     */
    function shuffle(){
        shuffle($this->cartes);
    }
}