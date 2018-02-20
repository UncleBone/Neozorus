<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Game</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/GameLayout.css">
    <?php include(FAVICON) ?>
    <script src="<?= JS_PATH . DS . 'jquery-3.2.1.min.js' ?>"></script>
     <script src="<?= JS_PATH . DS . 'checkOrientation.js' ?>"></script>
    <script type="application/javascript">
            var tour = '<?=$tour?>';
            var pv = ['<?=$pv[0]?>', '<?=$pv[1]?>'];
            var mana = ['<?=$mana[0]?>', '<?=$mana[1]?>'];
            var main = JSON.parse('<?=$jMain?>');
            var plateau = JSON.parse('<?=$jPlateau?>');
            var defausse = JSON.parse('<?=$jDefausse?>');
            var visable = ['<?=$visable[0]?>', '<?=$visable[1]?>'];
            var heros = ['<?=$heros[0]?>', '<?=$heros[1]?>'];
            var jeton = '<?=$jeton?>';
            var currentPlayer = '<?=$currentPlayer?>';
            var eog = '<?=$eog?>';
            var att = '<?=$att?>';
            var manaJoueurActif = '<?= $mana[$jeton]?>';
            var cible = '<?=$cible?>';
            var abilite = '<?=$abilite?>';
            var error = '<?=$error?>';
            var message = '<?=$message?>';     
     </script>
     <script src="<?= JS_PATH . DS . 'gamePlay.js' ?>"></script>
</head>
<body>
    <!-- <img id="plateau" src="<?= IMG_PATH . DS . 'plateau' . DS . 'plateau.png' ?>"> -->
    <main id="contenu">
        <?= $gameView ?>
    </main>
     
</body>
</html>