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
            .error
            {
                position: absolute;
                right:0;
                top:0;
                color: Black;
                background-color: rgb(200,100,100);
            }
        </style>
    </head>
    <?php
    if(!empty($error)){
        displayError($error);
    }
    echo 'Tour n°'.$tour;
    if(!isset($att)){$att = null;}
    if(!empty($att)){
        echo '<a href="?controller=game&action=jeu&jeton='.$jeton.'&att='.$att.'&cible=J'.($jeton==0 ? 1 : 0).'">
<h1>Joueur 1:</h1>';
    }else{
        echo '<h1>Joueur 1:</h1>';
        }
    echo 'PV = '.$pv1.'<br>';
    echo 'mana = '.$mana1;
    echo '<p>Main:</p>';
    displayHand($main1,$jeton);
    echo '<p>Plateau:</p>';
    displayBoard($plateau1,$jeton,$att);
    if(!empty($att)){
        echo '<a href="?controller=game&action=jeu&jeton='.$jeton.'&att='.$att.'&cible=J'.($jeton==0 ? 1 : 0).'">
<h1>Joueur 2:</h1>';
    }else{
        echo '<h1>Joueur 2:</h1>';
    }
    echo 'PV = '.$pv2.'<br>';
    echo 'mana = '.$mana2;
    echo '<p>Main:</p>';
    displayHand($main2,$jeton);
    echo '<p>Plateau:</p>';
    displayBoard($plateau2,$jeton,$att);
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
            echo 'PV = '.$carte->getPv();
            echo '</div>';
            echo '<a href="?controller=game&action=jeu&jeton='.$jeton.'&jouer='.$carte->getId().$carte->getIndice().'">
            <img src="' . $carte->getPath() . '"></a>';
        }
    }
}
function displayBoard($tab,$jeton,$att){
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
            echo 'PV = '.$carte->getPv();
            echo '<br>';
            echo 'active = '.$carte->getactive();
            echo '</div>';
            if(!empty($att)){
                echo '<a href="?controller=game&action=jeu&jeton='.$jeton.'&att='.$att.'&cible='.$carte->getId().$carte->getIndice().'">
                <img src="' . $carte->getPath() . '"></a>';
            }else{
                echo '<img src="' . $carte->getPath() . '">';
            }

        }
    }
}

function displayError($error){
    $errorMessage = 'Erreur!';
    if($error == 'not_enough_mana'){
        $errorMessage = 'Vous n\'avez pas assez de mana pour jouer cette carte!';
    }
    echo '<div class="error">';
    echo $errorMessage;
    echo '</div>';
}
?>