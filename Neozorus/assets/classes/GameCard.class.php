<?php
class GameCard
{
    private $id;
    private $type;
    private $puissance;
    private $pvMax;
    private $mana;
    private $abilite = array();

    private $pv;                    // pv actuels de la carte
    private $localisation;          // localisation (pioche, main, plateau ou défausse)
    private $indice;
    private $path;                  // chemin du gabarit
    private $active = 0;            // 1: peut attaquer, 0: ne peut pas attaquer
    private $visable;               // 1: peut être attaqué, 0: ne peut pas être attaqué

    const LOC_PIOCHE = 1;
    const LOC_MAIN = 2;
    const LOC_PLATEAU = 3;
    const LOC_DEFAUSSE = 4;

    const ABILITE_AUCUNE = 0;
    const ABILITE_BOUCLIER = 1;
    const ABILITE_PIOCHE_1 = 2;
    const ABILITE_PIOCHE_2 = 3;

    function __construct($id,$type,$puissance,$pvMax,$mana,$indice,$abilite,$localisation = self::LOC_PIOCHE){
        $this->id = $id;
        $this->type = $type;
        $this->puissance = $puissance;
        $this->pvMax = $pvMax;
        $this->pv = $pvMax;
        $this->mana = $mana;
        $this->localisation = $localisation;
        $this->indice = $indice;
        if(is_null($abilite)){
            $this->abilite[0] = self::ABILITE_AUCUNE;
        }elseif(!strpos($abilite,',')){
            $this->abilite[0] = trim($abilite);
        }else{
            $tab = explode(',', $abilite);
            for($i=0;$i<count($tab);$i++){
                $this->abilite[$i] = trim($tab[$i]);
            }
        }
        $this->setPath();
        $this->setVisable(1);
    }

    function getId(){
        return $this->id;
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

    function setPv($pv){
        $this->pv = $pv;
    }

    /*
     * diminue les pv d'une certaine valeur et retourne la nouvelle valeur
     */
    function subPv($val){
        $a = $this->getPv() - $val;
        if($a <0 ){
            $a = 0;
        }
        $this->setPv($a);
        return $a;
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

    function getAbilite(){
        return $this->abilite;
    }

    function getPath(){
        return $this->path;
    }
    function setPath(){
        $this->path = COMMON_PATH . DS . $this->getType() . DS . $this->getId() . '.png';
    }

    function getActive(){
        return $this->active;
    }
    function setActive($a = int){
        $this->active = $a;
    }

    function getVisable(){
        return $this->visable;
    }

    function setVisable($a = int){
        $this->visable = $a;
    }
}