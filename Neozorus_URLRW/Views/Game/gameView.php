    <?php

    $joueurActif = $currentPlayer;
    $joueurPassif = $joueurActif == 0 ? 1:0;
    if(!isset($att)){
        $att = null;
    }

/************************* Message d'erreur ou d'info **************************/

    if(!empty($errorMssg)){
        echo '<p class="error">'.$errorMssg.'</p>';
    }
    if(!empty($message)){
        echo '<p class="message'.($eog == true ? ' endGame' : '').'">'.$message.'</p>';
    }

/************************* Historique **************************/
    
    displayHistorique($historique, $currentPlayer);
    
/************************* Héros adverse **************************/

        echo '<div id="topHeros" class="Heros" data_visable='.$visable[$joueurPassif].' data_cible=J'.$joueurPassif.' data_otherplayer="'.$this->getPlayer(1-$currentPlayer)->getId().'"">';
        echo '<img src="./assets/img/plateau/portrait/'.$heros[$joueurPassif].'.png">';
        echo '<span class="pv">'.$pv[$joueurPassif].'</span>';
        echo '</div>';

    ?>

<!--************************** Jauge de mana du joueur actif **************************-->

        <div id="manaLeft">
            <?php
            for ($i=0; $i < 10-$mana[$joueurActif]; $i++) {
                echo '<div class="pillule"><img src="'. IMG_PATH . DS. 'plateau' . DS . 'pilluleBleueVide.png"></div>';
            }
            for ($i=0; $i < $mana[$joueurActif]; $i++) {
                echo '<div class="pillule"><img src="'. IMG_PATH . DS. 'plateau' . DS . 'pilluleBleue.png"></div>';
            }
            ?>
        </div>

<!--*********************************** Plateau (bloc central) *****************************************-->

        <div id="plateau">

            <!-- ********** zone du joueur adverse *********** -->
            <div id="topPlateau">
                <?php
                foreach ($plateau[$joueurPassif] as $key => $value){                    
                    echo '<a class="carte '.$value->getType().'" data_visable="'.$value->getVisable().'" data_id="'.$value->getId().'"  data_gameid="'.$value->getGameId().'" data="'.$att.'">';
                    echo '<img src="'.$value->getPath().'">';
                    echo '<span class="puissance">'.$value->getPuissance().'</span>';
                    echo '<span class="pv">'.$value->getPv().'</span>';
                    echo '<span class="mana">'.$value->getMana().'</span>';
                    echo '<span class="indice">'.$value->getIndice().'</span>';
                    echo '</a>';
                }
                ?>
            </div>

            <!-- ********** zone du joueur actif *********** -->
            <div id="bottomPlateau">
                <?php
                foreach ($plateau[$joueurActif] as $key => $value){  
                    echo '<a class="carte '.$value->getType().'" data_active="'.$value->getActive().'" 
                                                                data_id="'.$value->getId().'" 
                                                                data_gameid="'.$value->getGameId().'" 
                                                                data="'.$key.'">';
                    echo '<img src="'.$value->getPath().'">';
                    echo '<span class="puissance">'.$value->getPuissance().'</span>';
                    echo '<span class="pv">'.$value->getPv().'</span>';
                    echo '<span class="mana">'.$value->getMana().'</span>';
                    echo '<span class="indice">'.$value->getIndice().'</span>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>

<!--************************** Jauge de mana du joueur adverse **************************-->    

        <div id="manaRight">
            <?php
            for ($i=0; $i < 10-$mana[$joueurPassif]; $i++) {
                echo '<div class="pillule"><img src="'. IMG_PATH . DS . 'plateau' . DS . 'pilluleRougeVide.png"></div>';
            }
            for ($i=0; $i < $mana[$joueurPassif]; $i++) {
                echo '<div class="pillule"><img src="'. IMG_PATH . DS . 'plateau' . DS . 'pilluleRouge.png"></div>';
            }
            ?>
        </div>
    <!-- </div> -->

<!--************************ Héros du joueur actif ***************************-->

    <div id="bottomHeros" class="Heros">
        <img src="<?= IMG_PATH . DS . 'plateau' . DS . 'portrait' . DS . $heros[$joueurActif] . '.png' ?>">
        <span class="pv"><?=$pv[$joueurActif]?></span>
        <p>Tour <?= $tour ?></p>
    </div>

<!--************************ Pioche et défausse ***************************-->

<?php if(count($pioche) > 0){ ?>
    <div id="piocheBottom">
        <img src="<?= GABARIT_PATH . DS .'verso_alt.png' ?>">
        <p><?= count($pioche[$currentPlayer]) ?></p>
    </div>

<?php  }
if(!empty($defausse[$currentPlayer])){ 
    echo '<div id="defausseBottom" data="'.$lastDead[$currentPlayer][0]['pc_id'].'">';
    foreach ($defausse[$currentPlayer] as $value) {
        if($value->getGameId() == $lastDead[$currentPlayer][0]['pc_id']){
            echo '<img src="'.$value->getPath().'">';
        }
    }
    echo '</div>';
 } ?>

<!--************************ zone de contrôle (bande inférieure du plateau) ***************************-->

    <div id="actionBar"> 

        <!-- ************ bouton quitter ************* -->
        <nav id="quitter">
            <a href="?controller=game&action=quitter">Quitter</a>
        </nav>

        <!-- ************ Main du joueur ************* -->
        <div id="main">
            <?php
            foreach($main[$joueurActif] AS $key => $value){
                echo '<a class="carteMain '.$value->getType().'"  
                        data_libelle="'.ucfirst(mb_strtolower($value->getLibelle())).'" 
                        data_abilite="'.$value->getAbilite()[0].'" 
                        data_abilite_2="'.(count($value->getAbilite())==2 ? $value->getAbilite()[1] : '0').'" 
                        data_id="'.$value->getId().'" 
                        data_indice="'.$value->getIndice().'" 
                        data_gameid="'.$value->getGameId().'"';
                echo '>';
                
                echo '<img src="'.$value->getPath().'">';
                switch($value->getType()){
                    case 'creature':
                    case 'speciale':
                        echo '<span class="pv">'.$value->getPv().'</span>';
                    case 'sort':                        
                        echo '<span class="puissance">'.$value->getPuissance().'</span>';
                        echo '<span class="mana">'.$value->getMana().'</span>';
                        echo '<span class="indice">'.$value->getIndice().'</span>';
                        break;
                }
                echo'</a>';
            }
            ?>
        </div>

        <!-- ************ bouton fin de tour ************* -->
        <nav id="end">
        <?php
            if($jeton == $joueurActif){
                echo '<img class="anim" src="' . IMG_PATH . DS . 'plateau' . DS . 'bouton_valid1.png">';       
            }
            else{
                echo '<img src="' . IMG_PATH . DS . 'plateau' . DS . 'bouton_valid3.png">';
            }
        ?>
        </nav>

    </div>

<?php

/************ Fonction d'affichage de l'historique *************/

function displayHistorique($historique, $currentPlayer){
    $skull = IMG_PATH . DS . 'hist' . DS . 'skull_ter.png';
    echo '<div id="historique">';
    echo '<div id="events">';
    if(!empty($historique)){
        foreach ($historique as $event) {
            echo '<div class="event '.($event->getJoueur() == $_SESSION['neozorus']['u_id'] ? 'eActif' : 'ePassif').'" data_event_id="'.$event->getId().'" data_event="'.$event->getType().'" 
                    data_joueur="'.($event->getJoueur() == $_SESSION['neozorus']['u_id'] ? 0 : 1).'" ';
            switch($event->getType()){
                case Event::PLAY:
                    echo 'data_img="'.$event->getCarte()->getPath().'" >';
                    break;
                case Event::ATT_CARD:
                    echo 'data_mort_att="'.$event->getMortAtt().'" ';                
                case Event::ATT_PLAYER:
                    echo 'data_img="'.$event->getAtt()->getPath().'" data_type_carte="'.$event->getAtt()->getType().'">';
                    if($event->getAtt()->getType() == 'sort'){
                        echo '<img class="sort" src="'. IMG_PATH . DS . 'hist' . DS . 'sort_' . ($event->getJoueur() == $_SESSION['neozorus']['u_id'] ? '1' : '2').'_alt.png">';
                    }else{
                        echo '<span>VS</span>';
                        if($event->getMortAtt() == true){
                            echo '<img class= "skull" src="'.$skull.'">';
                        }
                    }
                    break;
            }
            echo '</div>';
        };
    }
    echo '</div>';
    echo '</div>';

    /*** event box ***/
    if(!empty($historique)){
        foreach ($historique as $event){
            echo '<div class="eventBox" data_event_id="'.$event->getId().'">';
            echo '<p>Tour '.$event->getTour().'</p>';
            if($event->getType() == Event::PLAY){
                echo '<div class="carte '.$event->getCarte()->getType().'">';
                echo '<img src="'.$event->getCarte()->getPath().'">';
                echo '<span class="puissance">'.$event->getCarte()->getPuissance().'</span>';
                echo '<span class="pv">'.$event->getCarte()->getPv().'</span>';
                echo '<span class="mana">'.$event->getCarte()->getMana().'</span>';
                echo '<span class="indice">'.$event->getCarte()->getIndice().'</span>';
                echo '</div>';
            }else{
                echo '<div class="carte '.$event->getAtt()->getType().'">';
                echo '<img src="'.$event->getAtt()->getPath().'">';
                echo '<span class="puissance">'.$event->getAtt()->getPuissance().'</span>';
                echo '<span class="pv">'.$event->getAtt()->getPv().'</span>';
                echo '<span class="mana">'.$event->getAtt()->getMana().'</span>';
                echo '<span class="indice">'.$event->getAtt()->getIndice().'</span>';
                if($event->getMortAtt() == true && $event->getAtt()->getType() != 'sort'){
                    echo '<img class="skull" src="' . IMG_PATH . DS . 'hist' . DS . 'skull_ter.png">';
                }elseif($event->getType() == Event::ATT_CARD && $event->getAtt()->getType() != 'sort'){
                    echo '<span class="damage">-'.$event->getCible()->getPuissance().'</span>';
                }
                echo '</div>';
                if($event->getAtt()->getType() == 'sort'){
                    echo '<img src="' . IMG_PATH . DS . 'hist' . DS . 'sort_3.png">';
                }else{
                    echo '<p>VS</p>';
                }
                if($event->getType() == Event::ATT_CARD){
                    echo '<div class="carte '.$event->getCible()->getType().'">';
                    echo '<img src="'.$event->getCible()->getPath().'">';
                    echo '<span class="puissance">'.$event->getCible()->getPuissance().'</span>';
                    echo '<span class="pv">'.$event->getCible()->getPv().'</span>';
                    echo '<span class="mana">'.$event->getCible()->getMana().'</span>';
                    echo '<span class="indice">'.$event->getCible()->getIndice().'</span>';
                    if($event->getMortCible() == true){
                        echo '<img class="skull" src="' . IMG_PATH . DS . 'hist' . DS . 'skull_ter.png">';
                    }else{
                        echo '<span class="damage">-'.$event->getAtt()->getPuissance().'</span>';
                    }
                    echo '</div>';
                }else{
                    echo '<div class="Heros">';
                    echo '<img src="'.IMG_PATH . DS . 'plateau' . DS . 'portrait' . DS . $event->getCible()->getDeck()->getHeros().'_bis.png">';
                    echo '<span class="pv">'.$event->getCible()->getPv().'</span>';
                    if($event->getMortCible() == true){
                        echo '<img class="skull" src="' . IMG_PATH . DS . 'hist' . DS . 'skull_ter.png">';
                    }else{
                        echo '<span class="damage">-'.$event->getAtt()->getPuissance().'</span>';
                    }
                    echo '</div>';
                }
            }
            echo '</div>';
        }
    }
}    
    

   
