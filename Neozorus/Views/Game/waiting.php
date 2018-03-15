<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Game</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH . DS . 'Waiting.css' ?>">
    <?php include(FAVICON) ?>
    <script src="<?= JS_PATH . DS . 'jquery-3.2.1.min.js' ?>"></script>
    <script src="<?= JS_PATH . DS . 'checkOrientation.js' ?>"></script>
    <script src="<?= JS_PATH . DS . 'gameWaitingLine.js' ?>"></script>
</head>
<body>
<div class="message" data_id=<?= $id ?>>
    <p>En attente d'un autre joueur</p>
</div>
<nav id="annuler">
    <a href="?controller=game&action=cancelWaiting&id=<?= $id ?>">Annuler</a>
</nav>
</body>
</html>

