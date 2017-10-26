<?php
class GameCard
{
    private $id;
    private $libelle;
    private $type;
    private $puissance;
    private $pvMax;
    private $mana;

    private $pv;
    private $localisation;
    private $indice;
    private $path;

    const LOC_DECK = 1;
    const LOC_MAIN = 2;
    const LOC_PLATEAU = 3;
    const LOC_DEFAUSSE = 4;

    function __construct($id,$libelle,$type,$puissance,$pvMax,$mana,$indice,$localisation = self::LOC_DECK){
        $this->id = $id;
        $this->libelle = $libelle;
        $this->type = $type;
        $this->puissance = $puissance;
        $this->pvMax = $pvMax;
        $this->pv = $pvMax;
        $this->mana = $mana;
        $this->localisation = $localisation;
        $this->indice = $indice;
        $this->setPath();
    }

    function getId(){
        return $this->id;
    }

    function getLibelle(){
        return $this->libelle;
    }

    function getType(){
        return $this->type;
    }

    function getPuissance(){
        return $this->puissance;
    }

    function getPv(){
        return $this->pv;
    }

    function getPvMax(){
        return $this->pvMax;
    }

    function setLocalisation($loc){
        $this->localisation = $loc;
    }

    function getLocalisation(){
        return $this->localisation;
    }

    function getIndice() {
        return $this->indice;
    }

    function getMana() {
        return $this->mana;
    }

    function getPath(){
        return $this->path;
    }
    function setPath(){
        $this->path = COMMON_PATH . DS . $this->getType() . DS . $this->getId() . '.png';
    }
}