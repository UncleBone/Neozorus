<!DOCTYPE html>
<html>
<head>
	<title>Neozorus - <?=$title?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?=CSS_PATH . DS . 'ConnexionInscription.css'?>">
	<meta name="viewport" content="width=device-width">
	<script type="text/javascript" src="<?= JS_PATH . DS . 'jquery-3.2.1.min.js' ?>"></script>
	<script src="<?= JS_PATH . DS . 'splitBackground.js' ?>"></script> <!-- script de mise en forme du background --> 
	<?php include(FAVICON) ?>
</head>
<body>
	<!-- images de background --> 
	<section id="haut" class="haut_bas">
		<img src="<?=IMG_PATH . DS . 'background_jungle.jpg' ?>" id="imageHaut">
	</section>
	<section id="bas" class="haut_bas">
		<img src="<?=IMG_PATH . DS . 'background_matrix.jpg' ?>" id="imageBas">
	</section>
	
	<!-- logo --> 
	<header>
		<img src="<?=IMG_PATH . DS . 'logoNeozorus.png' ?>" id="logoNeozorus">
	</header>

	<?= $view ?>
	
	

</body>

</html>