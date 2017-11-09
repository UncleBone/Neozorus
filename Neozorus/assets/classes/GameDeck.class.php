<?php
class GameDeck{
	private $id;                    // id du deck
	private $cartes = array();      // tableau d'objets de type cartes
	private $heros;                 // id du héros associé au deck

	public function __construct($id){
		$this->setId($id);
		$this->fillDeck();
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
                $this->cartes[] = new GameCard($value['id'],$value['type'],$value['puissance'],$value['pvMax'],$value['mana'],$i,$value['abilite']);
            }
        }
    }

    /*
     * mélange les cartes
     */
    function shuffle(){
        shuffle($this->cartes);
    }
}