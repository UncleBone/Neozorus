<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Game</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/Waiting.css">
    <?php include(FAVICON) ?>

</head>
<body>
<div class="message" data_id=<?= $id ?>>
    <p >En attente...</p>
</div>
<script src="<?= JS_PATH . DS . 'gameWaitingLine.js' ?>"></script>
</body>
</html>

