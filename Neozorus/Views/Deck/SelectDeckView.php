<!DOCTYPE html>
<html class=<?= $theme ?>>
<head>
	<title>Neozorus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/SelectDeckStyle.css" />

</head>
<body>
	<div id="headerDecks">

		<div id="logo">
			<img src="../../assets/img/logoNeozorus.png">
		</div>

		<div id="action">

			<div id="creer">
				<a href="index.php?controller=hero&action=">Créer un deck</a>
			</div>

			<div id="t_rex">
				<?php
				$source = $theme == '"matrixtheme"' ? "'assets/img/headshot_neo.png'" : "'assets/img/headshot_rex.png'";
				?>
				<img src=<?=$source?>>
			</div>

			<div id="modifier">
				<a href="index.php?controller=hero&action=affichageListeHero">Changer de Héros</a>
			</div>

		</div>


			<p class="decksExistants">Mes Decks</p>


	</div>

	<article>
	<div class="horizon1">
		<?php
		foreach ($decks as $key => $value) {
		?>
		<div class="all deck1">
			<div class="view view-first">
				<?php
				$imagedeck = $theme == '"matrixtheme"' ? "'assets/img/matrix.jpg'" : "'assets/img/dinofond.jpg'"
				?>
			    <img src=<?=$imagedeck?>>
			    <div class="mask">
				    <div class="nomdeck">
				    	<p><?= $value->getD_libelle();?></p>
				    </div>
						<a class="info" href="">Jouer</a>
						<a class="info" href="">Modifier</a>
						<a class="info" href=<?= '"index.php?controller=carte&action=afficherCarte&deck='.$value->getD_ID().'&hero='.$hero.'"'?>>Détail</a>
					
			    </div>
			</div>
		</div>
		<?php } ?>


		
	</div>
	</article>
	
</body>
</html>