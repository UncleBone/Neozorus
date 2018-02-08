    <?php

    $joueurActif = $currentPlayer;
    $joueurPassif = $joueurActif == 0 ? 1:0;
    if(!isset($att)){
        $att = null;
    }

    //On affiche le message d'erreur si il y en a un
    if(!empty($errorMssg)){
        echo '<p class="error">'.$errorMssg.'</p>';
    }
    //On affiche le message si il y en a un
    if(!empty($message)){
        echo '<p class="message">'.$message.'</p>';
    }
    ?>

    <!--DIV QUI COMPRENDS LES INFORMATIONS DU HERO PASSIF-->
    <?php
    if(!empty($att) && $visable[$joueurPassif] == 1 && $currentPlayer == $jeton && !$eog){
        echo '<div id="topHero">';
        echo '<a href="?controller=game&action=play&jeton='.$joueurActif.'&att='.$att.'&cible=J'.$joueurPassif.'&abilite='.$abilite.'"><img src="./assets/img/plateau/portrait/'.$heros[$joueurPassif].'.png"></a>';
        echo '<span class="vitaHeros">'.$pv[$joueurPassif].'</span>';
        echo '</div>';
    }
    else{
        echo '<div id="topHero">';
        echo '<img src="./assets/img/plateau/portrait/'.$heros[$joueurPassif].'.png">';
        echo '<span class="vitaHeros">'.$pv[$joueurPassif].'</span>';
        echo '</div>';
    }
    ?>
    <!--DIV QUI COMPRENDS LES 2 JAUGES DE MANA ET LES CARTES INVOQUEES-->
    <!-- <div id="blocCentral"> -->
        <!--DIV QUI COMPRENDS LA JAUGE DE MANA DU JOUEUR 1 (PILLULE BLEU)-->
        <div id="manaLeft">
            <?php
            for ($i=0; $i < 10-$mana[$joueurActif]; $i++) {
                echo '<div class="pilluleBleu"><img src="'. IMG_PATH . DS. 'plateau' . DS . 'pilluleBleueVide.png"></div>';
            }
            for ($i=0; $i < $mana[$joueurActif]; $i++) {
                echo '<div class="pilluleBleu"><img src="'. IMG_PATH . DS. 'plateau' . DS . 'pilluleBleue.png"></div>';
            }
            ?>
        </div>

<!--*********************************** Plateau (bloc central) *****************************************-->

        <div id="plateau">
            <div id="topPlateau">
                <?php
                foreach ($plateau[$joueurPassif] as $value){
                    //la carte est selectionnable si le joueur actif
                    
                    echo '<a class="carte '.$value->getType().'" data_visable="'.$value->getVisable().'"';
                    if(!empty($att) && $att != $value->getId().$value->getIndice() && $value->getVisable() == 1 && $currentPlayer == $jeton && !$eog){
                        echo 'href="?controller=game&action=play&jeton='.$jeton.'&att='.$att.'&cible='.$value->getId().$value->getIndice().'&abilite='.$abilite.'">';
                    }else{
                        echo '>';
                    }
                    echo '<img src="'.$value->getPath().'">';
                    echo '<span class="puissance">'.$value->getPuissance().'</span>';
                    echo '<span class="pv">'.$value->getPv().'</span>';
                    echo '<span class="mana">'.$value->getMana().'</span>';
                    echo '<div class="indice"><span>'.$value->getIndice().'</span></div>';
                    echo '</a>';
                }
                ?>
            </div>
            <div id="bottomPlateau">
                <?php
                foreach ($plateau[$joueurActif] as $key => $value){  
                    echo '<a class="carte '.$value->getType().'" data_active="'.$value->getActive().'" data_id="'.$value->getId().'"';
                    if($value->getActive() == 1 && $currentPlayer == $jeton && !$eog){
                        echo 'href="?controller=game&action=play&jeton='.$jeton.'&att='.$value->getId().$value->getIndice().'&abilite='.$abilite.'">';
                    }else{
                        echo '>';
                    }    
                    echo '<img src="'.$value->getPath().'">';
                    echo '<span class="puissance">'.$value->getPuissance().'</span>';
                    echo '<span class="pv">'.$value->getPv().'</span>';
                    echo '<span class="mana">'.$value->getMana().'</span>';
                    echo '<div class="indice"><span>'.$value->getIndice().'</span></div>';
                    echo '</a>';
                }
                ?>
            </div>
        </div>
       
        <div id="manaRight">
            <?php
            for ($i=0; $i < 10-$mana[$joueurPassif]; $i++) {
                echo '<div class="pilluleBleu"><img src="'. IMG_PATH . DS . 'plateau' . DS . 'pilluleRougeVide.png"></div>';
            }
            for ($i=0; $i < $mana[$joueurPassif]; $i++) {
                echo '<div class="pilluleBleu"><img src="'. IMG_PATH . DS . 'plateau' . DS . 'pilluleRouge.png"></div>';
            }
            ?>
        </div>
    <!-- </div> -->

<!--************************ zone du joueur actif ***************************-->

    <div id="bottomHero">
        <img src="<?= IMG_PATH . DS . 'plateau' . DS . 'portrait' . DS . $heros[$joueurActif] . '.png' ?>">
        <span class="vitaHeros"><?=$pv[$joueurActif]?></span>
        <p>Tour <?= $tour ?></p>
    </div>

<?php if(count($pioche) > 0){ ?>
    <div id="piocheBottom">
        <img src="<?= GABARIT_PATH . DS .'verso_alt.png' ?>">
        <p><?= count($pioche[$currentPlayer]) ?></p>
    </div>

<?php  }
if(count($defausse[$currentPlayer]) > 0){ ?>
    <div id="defausseBottom">
        <img src="<?= end($defausse[$currentPlayer]) ? end($defausse[$currentPlayer])->getPath() : ''?>">
    </div>
<?php  } ?>

<!--************************ zone de contrôle (bande inférieure du plateau) ***************************-->

    <div id="actionBar"> 

        <nav id="quitter">
            <a href="?controller=game&action=quitter">Quitter</a>
        </nav>

        <div id="main">
            <?php
            foreach($main[$joueurActif] AS $value){
                if ($currentPlayer == $jeton){
                    echo '<a class="carteMain '.$value->getType().'" href="?controller=game&action=play&jeton='.$jeton.'&jouer='.$value->getId().$value->getIndice().'">';
                }else{
                    echo '<a class="carteMain '.$value->getType().'">';
                }
                echo '<img src="'.$value->getPath().'" data_libelle="'.ucfirst(mb_strtolower($value->getLibelle())).'" data_abilite="'.
                    $value->getAbilite()[0].'" data_abilite_2="'.(count($value->getAbilite())==2 ? $value->getAbilite()[1] : '0').'">';
                switch($value->getType()){
                    case 'creature':
                    case 'speciale':
                        echo '<span class="pv">'.$value->getPv().'</span>';
                    case 'sort':                        
                        echo '<span class="puissance">'.$value->getPuissance().'</span>';
                        echo '<span class="mana">'.$value->getMana().'</span>';
                        break;
                }
                echo'</a>';
            }
            ?>
        </div>

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

    
    

   
