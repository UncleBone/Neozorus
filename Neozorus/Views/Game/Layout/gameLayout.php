<?php
$joueurActif = $jeton;
$joueurPassif = $joueurActif == 0 ? 1:0;
if(!isset($att)){$att = null;}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Game</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/GameLayout.css">
</head>
<body>
    <img id="plateau" src="./assets/img/plateau/plateau.png">
    <div id="contenu">
        <?php
        if(!empty($error)){
            echo '<p class="message">'.$error.'</p>';
        }
        if(!empty($message)){
            echo '<p class="message">'.$message.'</p>';
        }
        ?>
        <!-- Ici l'image represente le heros adverse-->
        <div id="topHero">
            <!--<img src="">-->
            <span class="vitaHero"><?=$pv[$joueurPassif]?></span>
        </div>
        <div id="blocCentral">
            <div id="manaLeft">
                <!-- 
                    $n = mana restant:
                    on fait un foreach pour:
                    on affiche (10-n) div avec la pillule vide
                -->
                <?php
                for ($i=0; $i < 10-$mana[0]; $i++) { 
                    echo '<div id="pilluleBleu"><img src="./assets/img/plateau/pilluleBleuVide.png"></div>';
                }
                for ($i=0; $i < $mana[0]; $i++) { 
                    echo '<div id="pilluleBleu"><img src="./assets/img/plateau/pilluleBleu.png"></div>';
                }
                ?>
                
                
                <!-- 
                    et un autre forecah pour n div avec la pillule pleine
                -->
                
                
            </div>
            <div id="creatureBox">
                
                <div id="topCreature">
                    <?php
                    foreach ($plateau[$joueurPassif] as $key => $value){
                        if(!empty($att) && $att != $value->getId().$value->getIndice() && $value->getVisable() == 1 && !$eog){
                            echo '<a class="carte" href="?controller=game&action=play&jeton='.$jeton.'&att='.$att.'&cible='.$value->getId().$value->getIndice().'&abilite='.$abilite.'">';
                            ?>
                            <img src=<?='"'.$value->getPath().'"'?>>
                            <span class="stat1"><?=$value->getPuissance()?></span>
                            <span class="stat2"><?=$value->getPv()?></span>
                            <span class="stat3"><?=$value->getMana()?></span>
                            <?php if($value->getType() == 'creature'){?>
                            <div class="indice">
                                <span><?=$value->getIndice()?></span>
                            </div>
                            <?php } 
                            echo '</a>';
                        }
                        else{
                            ?>
                            <div class="carte">
                                <img src=<?='"'.$value->getPath().'"'?>>
                                <span class="stat1"><?=$value->getPuissance()?></span>
                                <span class="stat2"><?=$value->getPv()?></span>
                                <span class="stat3"><?=$value->getMana()?></span>
                                <?php if($value->getType() == 'creature'){?>
                                <div class="indice">
                                    <span><?=$value->getIndice()?></span>
                                </div>
                                <?php } ?>
                            </div>
                    <?php }   
                    }
                    ?>
                    <!-- Ici c'est les creatures de l'adversaire avec n carte donc faire un foreach
                    <div class="carte">
                        <img src="./assets/img/gabarit/creature/21.png">
                        <span class="stat1">5</span>
                        <span class="stat2">7</span>
                        <span class="stat3">9</span>
                        Uniquement pour les créatures
                        <div class="indice">
                            <span>1</span>
                        </div>
                    </div> -->
                    
                </div>
                
                <div id="bottomCreature">
                    <!-- Ici c'est les creatures du joueur avec n carte donc faire un foreach-->
                    <?php
                    foreach ($plateau[$joueurActif] as $key => $value){
                        if($value->getActive()==1 && !$eog){
                            echo '<a class="carte" href="?controller=game&action=play&jeton='.$jeton.'&att='.$value->getId().$value->getIndice().'&abilite='.$abilite.'">';
                            ?>
                            <img src=<?='"'.$value->getPath().'"'?>>
                            <span class="stat1"><?=$value->getPuissance()?></span>
                            <span class="stat2"><?=$value->getPv()?></span>
                            <span class="stat3"><?=$value->getMana()?></span>
                            <?php if($value->getType() == 'creature'){?>
                            <div class="indice">
                                <span><?=$value->getIndice()?></span>
                            </div>
                            <?php
                            echo '</a>'; } 
                        }
                        else{
                            ?>
                            <div class="carte">
                                <img src=<?='"'.$value->getPath().'"'?>>
                                <span class="stat1"><?=$value->getPuissance()?></span>
                                <span class="stat2"><?=$value->getPv()?></span>
                                <span class="stat3"><?=$value->getMana()?></span>
                                <?php if($value->getType() == 'creature'){?>
                                <div class="indice">
                                    <span><?=$value->getIndice()?></span>
                                </div>
                                <?php } ?>
                            </div>
                    <?php }   
                    }
                    ?>     
                </div>
            </div>
            <div id="manaRight">
                <!-- 
                    $n = mana restant:
                    on fait un foreach pour:
                    on affiche (10-n) div avec la pillule vide
                -->
                <?php
                for ($i=0; $i < 10-$mana[1]; $i++) { 
                    echo '<div id="pilluleBleu"><img src="./assets/img/plateau/pilluleRougeVide.png"></div>';
                }
                for ($i=0; $i < $mana[1]; $i++) { 
                    echo '<div id="pilluleBleu"><img src="./assets/img/plateau/pilluleRouge.png"></div>';
                }
                ?>
            </div>
        </div>
        <div id="bottomHero">
            <!--<img src="">-->
            <span class="vitaHero"><?=$pv[$joueurActif]?></span>
        </div>
        <div id="actionBar">
            <div id="main">
                <!-- Ici c'est la main du joueur avec n carte donc faut faire un foreach-->
                <?php foreach($main[$joueurActif] AS $cle=>$value){
                echo '<a class="carteMain" href="?controller=game&action=play&jeton='.$jeton.'&jouer='.$value->getId().$value->getIndice().'">';?>
                    <img src=<?='"'.$value->getPath().'"'?>>
                    <span class="stat1Miniature"><?=$value->getPuissance()?></span>
                    <span class="stat2Miniature"><?=$value->getPv()?></span>
                    <span class="stat3Miniature"><?=$value->getMana()?></span> 
                <?php echo'</a>'; } ?>
            </div>
        <!--<div id="main">
             Ici c'est la main du joueur avec n carte donc faut faire un foreach
            <div class="carteMain">
                <img src="./assets/img/gabarit/creature/5.png">
                <span class="stat1Miniature">2</span>
                <span class="stat2Miniature">9</span>
                <span class="stat3Miniature">3</span>
            </div>-->
        </div>
            <!-- Ici c'est le bouton passer le tour donc adapter la minature en fonction du hero-->
            <div id="end"><?='<a href="?controller=game&action=play&jeton='.($jeton==0 ? 1 : 0).'">'?><img src="./assets/img/plateau/neoTourSuivant.png"></a></div>
            <div id="quitter"><a href="?controller=game&action=quitter">Quitter</a></div>
        </div>
    </div>
</body>
</html>