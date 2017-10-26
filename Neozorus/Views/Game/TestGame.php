<!DOCTYPE html>
<html>
    <head>
        <title>Game</title>
        <style type="text/css">
            img
            {
                width: 100px;
            }
        </style>
    </head>
    <?php
    echo 'Tour n°'.$tour;
    echo '<h1>Joueur 1:</h1>';
    echo 'PV = '.$pv1.'<br>';
    echo 'mana = '.$mana1;
    echo '<p>Main:</p>';
    if(!empty($main1)) {
        foreach ($main1 as $carte) {
            echo '<img src="' . $carte->getPath() . '">';
        }
    }
    echo '<h1>Joueur 2:</h1>';
    echo 'PV = '.$pv2.'<br>';
    echo 'mana = '.$mana2;
    echo '<p>Main:</p>';
    if(!empty($main2)) {
        foreach ($main2 as $carte) {
            echo '<img src="' . $carte->getPath() . '">';
        }
    }
    echo '<br>';
    echo '<a href="?controller=game&action=jeu&jeton='.($jeton==0 ? 1 : 0).'">Fin de tour</a>';
    echo '<br>';
    echo '<a href="?controller=game&action=quitter">Quitter la partie</a>';
    ?>
</html>