<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Game</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/GameLayout.css">
    <script>
        console.log('yaa');
        var tour = '<?=$tour?>';
        console.log(tour);
        console.log('youpi');
        var pv = ['<?=$pv[0]?>', '<?=$pv[1]?>'];
        var mana = ['<?=$mana[0]?>', '<?=$mana[1]?>'];
        var main = ['<?=$main[0]?>', '<?=$main[1]?>'];
        var plateau = ['<?=$plateau[0]?>', '<?=$plateau[1]?>'];
        var defausse = ['<?=$defausse[0]?>', '<?=$defausse[1]?>'];
        var visable = ['<?=$visable[0]?>', '<?=$visable[1]?>'];
        var heros = ['<?=$heros[0]?>', '<?=$heros[1]?>'];
        var jeton = '<?=$jeton?>';
        var currentPlayer = '<?=$currentPlayer?>';
        var eog = '<?=$eog?>';
        var att = '<?=$att?>';
        var cible = '<?=$cible?>';
        var abilite = '<?=$abilite?>';
        var error = '<?=$error?>';
        var message = '<?=$message?>';
    </script>
</head>
<body>
    <img id="plateau" src="./assets/img/plateau/plateau.png">
    <div id="contenu">
        <?= $gameView ?>
    </div>

    <?php
    if($currentPlayer != $jeton) {
        ?>
        <script src="<?= JS_PATH . DS . 'gameWaitingNextTurn.js' ?>"></script>
        <script src="<?= JS_PATH . DS . 'gamePlay.js' ?>"></script>
        <?php
    }?>
    ?>
</body>
</html>