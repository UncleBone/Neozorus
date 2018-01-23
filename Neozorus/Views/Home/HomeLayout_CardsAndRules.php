<!DOCTYPE html>
<html class="theme">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="<?= CSS_PATH . DS . 'Home_CardsAndRules.css' ?>"/>
	<script type="text/javascript" src="<?= JS_PATH . DS . 'jquery-3.2.1.min.js' ?>"></script>
	<script src="<?= JS_PATH . DS . 'checkOrientation.js' ?>"></script> 
	<script type="text/javascript" src="<?= JS_PATH . DS . 'CarteCollection.js' ?>"></script>
	<?php include(FAVICON) ?>
</head>
<body>

	<header>
		<?php include(MENU) ?>
		<img src="<?= IMG_PATH . DS . 'logoNeozorus.png' ?>" id="logoNeozorus">
		<h1> - <?= $title ?> - </h1>
	</header>

	<?= $view ?>
</body>
</html>