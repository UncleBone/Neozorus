<?php
class GameDeck{
	private $id;
	private $cartes = array();
	private $heros;

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

    function fillDeck(){
        $testGame = new GameDeckModel;
        $data = $testGame->getCards($this->getId());
        foreach ($data as $value) {
            for($i=1;$i<=$value['nbExemplaire'];$i++){
                $this->cartes[] = new GameCard($value['id'],$value['libelle'],$value['type'],$value['puissance'],$value['pvMax'],$value['mana'],$i);
            }
        }
    }

    function shuffle(){
        shuffle($this->cartes);
    }
}