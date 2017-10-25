<!DOCTYPE html>
<html class=<?= $theme ?>>
<head>
	<title>Neozorus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/SelectDeck.css">
</head>
<body>
	<div id="container">
		<h1>Decks</h1>
		<div class="affichageMenu">
			<div id="choix">
				<p>Mes decks</p>
			</div>
			<div>
				<?php foreach ($decks as $key => $value) { ?>
					<p><?= $value->getD_libelle()?></a>||<a href="">Jouer</a>||<a href="">Modifier</a>||<a href=<?= '"index.php?controller=carte&action=afficherCarte&deck='.$value->getD_ID().'&hero='.$hero.'"'?>>Détail</a></p>
				<?php } ?>
			</div>
			<p>
				<a href="">Créer un deck</a>
			</p>
			<p>
				<a href="index.php?controller=hero&action=affichageListeHero">Changer de Héro</a>
			</p>			
		</div>
	</div>
</body>
</html>