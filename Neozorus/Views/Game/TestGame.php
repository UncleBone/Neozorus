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
            .message
            {
                position: absolute;
                left:50vw;
                top:0;
                transform: translateX(-50%);
                color: Black;
                background-color: lightgreen;
            }
            .defausse
            {
                border: 1px solid lightgrey;
                float: right;
            }
        </style>
    </head>
    <?php
    if(!empty($error)){
        displayError($error);
    }
    if(!empty($message)){
        displayMessage($message);
    }
    echo 'Tour n°'.$tour;
    if(!isset($att)){$att = null;}
    displayGame(0,$att,$visable,$eog,$jeton,$abilite,$pv,$mana,$main,$plateau,$defausse);

    echo '<hr>';
    displayGame(1,$att,$visable,$eog,$jeton,$abilite,$pv,$mana,$main,$plateau,$defausse);

    echo '<br>';
    if(!$eog){
        echo '<a href="?controller=game&action=play&jeton='.($jeton==0 ? 1 : 0).'">Fin de tour</a>';
    }
    echo '<br>';
    echo '<a href="?controller=game&action=quitter">Quitter la partie</a>';
    ?>
</html>

<?php

function displayGame($i,$att,$visable,$eog,$jeton,$abilite,$pv,$mana,$main,$plateau,$defausse){
    if(!empty($att) && $visable[$i] == 1 && !$eog){
        echo '<a href="?controller=game&action=play&jeton='.$jeton.'&att='.$att.'&cible=J'.($jeton==0 ? 1 : 0).'&abilite='.$abilite.'">
<h1>Joueur '.($i+1).':</h1></a>';
    }else{
        echo '<h1>Joueur '.($i+1).':</h1>';
    }
    echo 'PV = '.$pv[$i].'<br>';
    echo 'mana = '.$mana[$i];
    echo '<p>Main:</p>';
    displayHand($main[$i],$jeton,$i,$eog);
    echo '<p>Plateau:</p>';
    displayBoard($plateau[$i],$jeton,$att,$i,$eog,$abilite);
    displayDefausse($defausse[$i]);
}

function displayHand($tab,$jeton,$joueur,$eog){
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
            $ab = $carte->getAbilite();
            if(count($ab)==1){
                echo 'abilité = '.$ab[0];
            }else{
                for($i=0;$i<count($ab);$i++){
                    echo 'abilité '.($i+1).' = '.$ab[$i].'<br>';
                }
            }

            echo '</div>';
            if($jeton == $joueur && !$eog){
                echo '<a href="?controller=game&action=play&jeton='.$jeton.'&jouer='.$carte->getId().$carte->getIndice().'">
            <img src="' . $carte->getPath() . '"></a>';
            }else{
                echo '<img src="' . $carte->getPath() . '">';
            }
        }
    }
}
function displayBoard($tab,$jeton,$att,$joueur,$eog,$abilite){
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
            $ab = $carte->getAbilite();
            if(count($ab)==1){
                echo 'abilité = '.$ab[0];
            }else{
                for($i=0;$i<count($ab);$i++){
                    echo 'abilité '.($i+1).' = '.$ab[$i].'<br>';
                }
            }
            echo '<br>';
            echo 'active = '.$carte->getActive();
            echo '<br>';
            echo 'visable = '.$carte->getVisable();
            echo '</div>';
            if(!empty($att) && $att != $carte->getId().$carte->getIndice() && $carte->getVisable() == 1 && !$eog){
                echo '<a href="?controller=game&action=play&jeton='.$jeton.'&att='.$att.'&cible='.$carte->getId().$carte->getIndice().'&abilite='.$abilite.'">
                <img src="' . $carte->getPath() . '"></a>';
            }elseif($jeton == $joueur && $carte->getActive()==1 && !$eog){
                echo '<a href="?controller=game&action=play&jeton='.$jeton.'&att='.$carte->getId().$carte->getIndice().'&abilite='.$abilite.'">
                <img src="' . $carte->getPath() . '"></a>';
            }else{
                echo '<img src="' . $carte->getPath() . '">';
            }

        }
    }
}

function displayDefausse($defausse = null){
    echo '<div class="defausse">';
    echo 'Défausse:<br>';
    if($carte = end($defausse)){
        echo '<img src="' . $carte->getPath() . '">';
    }
    echo '</div>';
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

function displayMessage($message){
    echo '<div class="message">';
    echo $message;
    echo '</div>';
}
?>