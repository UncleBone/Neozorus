<!DOCTYPE html>
<html>
<head>
	<title><?=$titleTrad?></title>
	<meta name="viewport" content="width=device-width" />
	<script type="text/javascript" src="<?= JS_PATH . DS . 'jquery-3.2.1.min.js' ?>"></script>
	<script type="text/javascript">
		var page = "<?= !empty($team) ? $team : '' ?>";
	</script>
	<script src="<?= JS_PATH . DS . 'splitBackground.js' ?>"></script> <!-- script de mise en forme du background --> 
	<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="<?= CSS_PATH . DS . 'HomeDeckStyle.css' ?>"/>
	<?php include(FAVICON) ?>
</head>

<body>
	<section id="haut" class="haut_bas">
		<img src="<?= IMG_PATH . DS . 'background_jungle.jpg' ?>" id="imageHaut">
	</section>

	<section id="bas" class="haut_bas">
		<img src="<?= IMG_PATH . DS . 'background_matrix.jpg' ?>" id="imageBas">
	</section>

	<nav id="logo">
		<div id="btnDinos" class="btn">Les Dinos</div>
		<img src="<?= IMG_PATH . DS . 'logoNeozorus.png' ?>" id="logoNeozorus">
		<div id="btnMatrix" class="btn">La Matrice</div>
	</nav>

	<?= $view ?>

</body>
</html>