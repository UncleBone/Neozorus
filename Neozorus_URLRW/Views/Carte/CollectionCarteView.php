<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$titleTrad = $lang == 1 ? 'Les cartes' : 'The Cards';
	$helloTrad = $lang == 1 ? 'Bonjour ' : 'Hello ';
	$buttonPlayTrad = $lang == 1 ? 'Jouer' : 'Play';
	$filterTitleTrad = $lang == 1 ? 'Filtrer par:' : 'Filter by:';
	$labelManaTrad = $lang == 1 ? 'Cout en mana:' : 'Mana cost:';
	$labelAbilityTrad = $lang == 1 ? 'Pouvoir:' : 'Ability:';
	$labelOrderByTrad = $lang == 1 ? 'Trier par:' : 'Order by:';
	$powerTrad = $lang == 1 ? 'Puissance' : 'Power';
	$vitalityTrad = $lang == 1 ? 'Vitalite' : 'Vitality';
?>
<!DOCTYPE html>
<html class="theme">
<head>
	<title><?=$titleTrad?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/CarteCollection.css">
	<script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="./assets/js/CarteCollection.js"></script>
	<meta name="viewport" content="width=device-width" />
	<?php include(FAVICON) ?>
</head>
<body>
	<header>
		<?php include(MENU) ?>
		<img src="<?= IMG_PATH . DS . 'logoNeozorus.png' ?>" id="logoNeozorus">
		<h1><?=$titleTrad?></h1>
	</header>

	<main>
		
	<?= $view ?>

	</main>
</body>
</html>