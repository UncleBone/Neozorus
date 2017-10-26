<!DOCTYPE html>
<html>
    <head>
        <title>Game</title>
        <style type="text/css">
            img
            {
                width: 100px;
            }
            .carte{
                display: inline-block;
            }
        </style>
    </head>
    <?php
    echo 'Tour n°'.$tour;
    echo '<h1>Joueur 1:</h1>';
    echo 'PV = '.$pv1.'<br>';
    echo 'mana = '.$mana1;
    echo '<p>Main:</p>';
    displayHand($main1,$jeton);
    echo '<p>Plateau:</p>';
    displayBoard($plateau1);
    echo '<h1>Joueur 2:</h1>';
    echo 'PV = '.$pv2.'<br>';
    echo 'mana = '.$mana2;
    echo '<p>Main:</p>';
    displayHand($main2,$jeton);
    echo '<p>Plateau:</p>';
    displayBoard($plateau2);
    echo '<br>';
    echo '<a href="?controller=game&action=jeu&jeton='.($jeton==0 ? 1 : 0).'">Fin de tour</a>';
    echo '<br>';
    echo '<a href="?controller=game&action=quitter">Quitter la partie</a>';
    ?>
</html>

<?php
function displayHand($tab,$jeton){
    if(!empty($tab)) {
        foreach ($tab as $carte) {
            echo '<div class="carte">';
            echo '<br>';
            echo 'ID = '.$carte->getId();
            echo '<br>';
            echo 'indice = '.$carte->getIndice();
            echo '<br>';
            echo 'mana = '.$carte->getMana();
            echo '<br>';
            echo 'puissance = '.$carte->getPuissance();
            echo '<br>';
            echo 'PV = '.$carte->getPvMax();
            echo '</div>';
            echo '<a href="?controller=game&action=jeu&jeton='.$jeton.'&jouer='.$carte->getId().$carte->getIndice().'"><img src="' . $carte->getPath() . '"></a>';
        }
    }
}
function displayBoard($tab){
    if(!empty($tab)) {
        foreach ($tab as $carte) {
            echo '<div class="carte">';
            echo '<br>';
            echo 'ID = '.$carte->getId();
            echo '<br>';
            echo 'indice = '.$carte->getIndice();
            echo '<br>';
            echo 'mana = '.$carte->getMana();
            echo '<br>';
            echo 'puissance = '.$carte->getPuissance();
            echo '<br>';
            echo 'PV = '.$carte->getPvMax();
            echo '</div>';
            echo '<img src="' . $carte->getPath() . '">';
        }
    }
}
?>