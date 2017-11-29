    <?php
    //On definit les variables representant d'une part la joueur qui doit jouer (actif), et le joueur qui attend son tour(passif)
    //    $joueurActif = $jeton;
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
        echo '<span class="vitaHero">'.$pv[$joueurPassif].'</span>';
        echo '</div>';
    }
    else{
        echo '<div id="topHero">';
        echo '<img src="./assets/img/plateau/portrait/'.$heros[$joueurPassif].'.png">';
        echo '<span class="vitaHero">'.$pv[$joueurPassif].'</span>';
        echo '</div>';
    }
    ?>
    <!--DIV QUI COMPRENDS LES 2 JAUGES DE MANA ET LES CARTES INVOQUEES-->
    <div id="blocCentral">
        <!--DIV QUI COMPRENDS LA JAUGE DE MANA DU JOUEUR 1 (PILLULE BLEU)-->
        <div id="manaLeft">
            <?php
            for ($i=0; $i < 10-$mana[$joueurActif]; $i++) {
                echo '<div class="pilluleBleu"><img src="./assets/img/plateau/pilluleBleuVide.png"></div>';
            }
            for ($i=0; $i < $mana[$joueurActif]; $i++) {
                echo '<div class="pilluleBleu"><img src="./assets/img/plateau/pilluleBleu.png"></div>';
            }
            ?>
        </div>
        <!--DIV QUI COMPRENDS LES CARTES INVOQUEES DES 2 HEROS, EN HAUT CELLES DU JOUEUR PASSIF ET EN BAS CELLES DU JOUEUR ACTIF-->
        <div id="creatureBox">
            <!--DIV QUI COMPRENDS LES CREATURES DU JOUEUR PASSIF-->
            <div id="topCreature">
                <?php
                //Pour chaque carte sur le plateau du joueur passif on fait:
                foreach ($plateau[$joueurPassif] as $key => $value){
                    //la carte est selectionnable si le joueur actif
                    if(!empty($att) && $att != $value->getId().$value->getIndice() && $value->getVisable() == 1 && $currentPlayer == $jeton && !$eog){
                        echo '<a class="carte" href="?controller=game&action=play&jeton='.$jeton.'&att='.$att.'&cible='.$value->getId().$value->getIndice().'&abilite='.$abilite.'">';
                        if($value->getType()=='creature'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2">'.$value->getPv().'</span>';
                            echo '<span class="stat3">'.$value->getMana().'</span>';
                            echo '<div class="indice">';
                            echo'<span>'.$value->getIndice().'</span>';
                            echo '</div>';
                        }
                        else if($value->getType()=='speciale'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1Speciale">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2Speciale">'.$value->getPv().'</span>';
                            echo '<span class="stat3Speciale">'.$value->getMana().'</span>';
                        }
                        echo '</a>';
                    }
                    else{
                        echo '<div class="carte">';
                        if($value->getType()=='creature'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2">'.$value->getPv().'</span>';
                            echo '<span class="stat3">'.$value->getMana().'</span>';
                            echo '<div class="indice">';
                            echo'<span>'.$value->getIndice().'</span>';
                            echo '</div>';
                        }
                        else if($value->getType()=='speciale'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1Speciale">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2Speciale">'.$value->getPv().'</span>';
                            echo '<span class="stat3Speciale">'.$value->getMana().'</span>';
                        }
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div id="bottomCreature">
                <?php
                foreach ($plateau[$joueurActif] as $key => $value){
                    if($value->getActive()==1 && $currentPlayer == $jeton && !$eog){
                        echo '<a class="carte" href="?controller=game&action=play&jeton='.$jeton.'&att='.$value->getId().$value->getIndice().'&abilite='.$abilite.'">';
                        if($value->getType()=='creature'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2">'.$value->getPv().'</span>';
                            echo '<span class="stat3">'.$value->getMana().'</span>';
                            echo '<div class="indice">';
                            echo'<span>'.$value->getIndice().'</span>';
                            echo '</div>';
                        }
                        else if($value->getType()=='speciale'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1Speciale">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2Speciale">'.$value->getPv().'</span>';
                            echo '<span class="stat3Speciale">'.$value->getMana().'</span>';
                        }
                        echo '</a>';
                    }
                    else{
                        echo '<div class="carte">';
                        if($value->getType()=='creature'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2">'.$value->getPv().'</span>';
                            echo '<span class="stat3">'.$value->getMana().'</span>';
                            echo '<div class="indice">';
                            echo'<span>'.$value->getIndice().'</span>';
                            echo '</div>';
                        }
                        else if($value->getType()=='speciale'){
                            echo '<img src="'.$value->getPath().'">';
                            echo '<span class="stat1Speciale">'.$value->getPuissance().'</span>';
                            echo '<span class="stat2Speciale">'.$value->getPv().'</span>';
                            echo '<span class="stat3Speciale">'.$value->getMana().'</span>';
                        }
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div id="manaRight">
            <?php
            for ($i=0; $i < 10-$mana[$joueurPassif]; $i++) {
                echo '<div class="pilluleBleu"><img src="./assets/img/plateau/pilluleRougeVide.png"></div>';
            }
            for ($i=0; $i < $mana[$joueurPassif]; $i++) {
                echo '<div class="pilluleBleu"><img src="./assets/img/plateau/pilluleRouge.png"></div>';
            }
            ?>
        </div>
    </div>
    <div id="bottomHero">
        <img src="./assets/img/plateau/portrait/<?=$heros[$joueurActif]?>.png">
        <span class="vitaHero"><?=$pv[$joueurActif]?></span>
        <p>Tour <?= $tour ?></p>
    </div>
    <div id="piocheBottom">
        <img src="./assets/img/gabarit/verso.png">
        <p><?= count($pioche[$currentPlayer]) ?></p>
    </div>
    <div id="actionBar">
        <div id="main">
            <?php
            foreach($main[$joueurActif] AS $cle=>$value){
                if($value->getType()=='creature'){
                    if ($currentPlayer == $jeton){
                        echo '<a class="carteMain" href="?controller=game&action=play&jeton='.$jeton.'&jouer='.$value->getId().$value->getIndice().'">';
                    }else{
                        echo '<a class="carteMain">';
                    }
                    echo '<img src="'.$value->getPath().'" data_libelle="'.ucfirst(strtolower($value->getLibelle())).'" 
                    data_abilite="'.$value->getAbilite()[0].'" data_abilite_2="'.(count($value->getAbilite())==2 ? $value->getAbilite()[1] : '0').'">';
                    echo '<span class="stat1Miniature">'.$value->getPuissance().'</span>';
                    echo '<span class="stat2Miniature">'.$value->getPv().'</span>';
                    echo '<span class="stat3Miniature">'.$value->getMana().'</span>';
                    echo'</a>';
                }
                else if($value->getType()=='sort'){
                    if ($currentPlayer == $jeton){
                        echo '<a class="carteMain" href="?controller=game&action=play&jeton='.$jeton.'&jouer='.$value->getId().$value->getIndice().'">';
                    }else{
                        echo '<a class="carteMain">';
                    }

                    echo '<img src="'.$value->getPath().'" data_libelle="'.ucfirst(strtolower($value->getLibelle())).'"
                    data_abilite="'.$value->getAbilite()[0].'" data_abilite_2="'.(count($value->getAbilite())==2 ? $value->getAbilite()[1] : '0').'">';
                    echo '<span class="stat1Miniature">'.$value->getPuissance().'</span>';
                    echo '<span class="stat2Miniature">'.$value->getMana().'</span>';
                    echo'</a>';
                }
                else{
                    if ($currentPlayer == $jeton){
                        echo '<a class="carteMain" href="?controller=game&action=play&jeton='.$jeton.'&jouer='.$value->getId().$value->getIndice().'">';
                    }else{
                        echo '<a class="carteMain">';
                    }

                    echo '<img src="'.$value->getPath().'" data_libelle="'.ucfirst(strtolower($value->getLibelle())).'"
                    data_abilite="'.$value->getAbilite()[0].'" data_abilite_2="'.(count($value->getAbilite())==2 ? $value->getAbilite()[1] : '0').'">';
                    echo '<span class="stat1MiniatureSpeciale">'.$value->getPuissance().'</span>';
                    echo '<span class="stat2MiniatureSpeciale">'.$value->getPv().'</span>';
                    echo '<span class="stat3MiniatureSpeciale">'.$value->getMana().'</span>';
                    echo'</a>';
                }
            }
            ?>
        </div>
    </div>
    <!-- Ici c'est le bouton passer le tour donc adapter la minature en fonction du hero-->
    <div id="end">
    <?php
        if($jeton == $joueurActif){
            echo '<img src="./assets/img/plateau/bouttonTourSuivant/'. $heros[$joueurPassif] .'.png">';       
        }
        else{
            echo '<div id="mask"></div>';
        }
    ?>
    </div>
    <div id="quitter">
        <a href="?controller=game&action=quitter">Quitter</a>
    </div>

   
