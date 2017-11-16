<!DOCTYPE html>
<html class=<?= $theme ?>>
<head>
	<title>Neozorus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/SelectDeckStyle.css" />

</head>
<body>
<header>
	<div class="bloc_menu">
		<ul id="menu_jouer">
			<li><a href="#">Menu</a>
				<ul id="menu">
						<li><a href="index.php?controller=home&action=afficherPageRegles">Règles du jeu</a></li>
						<li><a href="#">Forum</a></li>
						<li><a href="index.php?controller=home&action=parametres">Paramètres</a></li>
						<li><a href="index.php?controller=home&action=deconnexion">Se déconnecter</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<div id="headerDecks">



		<div id="action">

			<div id="creer">
				<a href="index.php?controller=hero&action="><p>Créer un deck</p></a>
			</div>

			<div id="t_rex">
				<?php
				$source = $theme == '"matrixtheme"' ? "'assets/img/headshot_neo.png'" : "'assets/img/headshot_rex.png'";
				?>
				<img src=<?=$source?>>
			</div>

			<div id="modifier">
				<a href="index.php?controller=hero&action=affichageListeHero"><p>Changer de Héros</p></a>
			</div>
			<p class="decksExistants">Mes Decks</p>

		</div>


			


	</div>
</header>

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