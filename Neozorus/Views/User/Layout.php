<!DOCTYPE html>
<html>
<head>
	<title>Neozorus - <?=$title?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?=CSS_PATH?>/ConnexionInscription.css">
	<meta name="viewport" content="width=device-width">
	<?php include(FAVICON) ?>
</head>
<body>
	<!-- images de background --> 
	<div id="haut" class="haut_bas">
		<img src="<?=IMG_PATH?>/background_jungle.jpg" id="imageHaut">
	</div>
	<div id="bas" class="haut_bas">
		<img src="<?=IMG_PATH?>/background_matrix.jpg" id="imageBas">
	</div>
	
	<!-- logo --> 
	<header>
		<img src="<?=IMG_PATH?>/logoNeozorus.png" id="logoNeozorus">
	</header>

	<?= $view ?>
	
	<script src="<?=JS_PATH?>/Landing_Page_common.js"></script> <!-- script de mise en forme du background --> 

</body>

</html>