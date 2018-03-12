<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="<?= CSS_PATH . DS . 'Home_CardsAndRules.css' ?>"/>
	<script type="text/javascript" src="<?= JS_PATH . DS . 'jquery-3.2.1.min.js' ?>"></script>
	<script src="<?= JS_PATH . DS . 'checkOrientation.js' ?>"></script>
	<?php
	if($title == 'Les cartes'){
		echo '<script type="text/javascript" src="' . JS_PATH . DS . 'CarteCollection.js"></script>';
	}elseif ($title == 'Paramètres') {
		echo '<script type="text/javascript" src="' . JS_PATH . DS . 'Parameters.js"></script>';
	}
	include(FAVICON);
	?>
</head>
<body>

	<header>
		<a href="<?= empty($deckId) ? '.?controller=home&action=display' : '.?controller=deck&action=display&team='.$team ?>"><nav><?= $lang == 1 ? 'Retour' : 'Back' ?></nav></a>
		<img src="<?= IMG_PATH . DS . 'logoNeozorus.png' ?>" id="logoNeozorus">
		<h1> - <?= $title ?> - </h1>
	</header>

	<?= $view ?>
</body>
</html>