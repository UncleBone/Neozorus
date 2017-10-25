<?php


?>

<!DOCTYPE html>
<html>
<head>
	<title>HomeView</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="./assets/css/HomeViewStyle.css"/>
</head>

<body>
<header>
	<div class="bloc_menu">
		<ul id="menu_jouer">
			<li><a href="#">Menu</a>
				<ul id="menu">
						<li><a href="index.php?controller=home&action=afficherPageRegles">Règles du jeu</a></li>
						<li><a href="#">Forum</a></li>
						<li><a href="index.php?controller=home&action=deconnexion">Paramètres</a></li>
						<li><a href="index.php?controller=home&action=deconnexion">Se déconnecter</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<div class="bonjour">
		<p>
			Bonjour
			<?=$user?>
		</p>
	</div>
		<div class="bloc_logo">
		<img class="logo" src="./assets/img/logoNeozorus.png" id="logoNeozorus">
	</div>
</header>
<main>
	<article>
		<form method="GET" action="index.php">
				<input type="hidden" name="controller" value="hero"  id="Jouer" />
				<input type="hidden" name="action" value="affichageListeHero">
				<input type="submit" value="Jouer"  id="Jouer" />
		</form>
	</article>

	<div class="liens_media_sociaux">
		<ul class="links">
			<li><a href="#' alt="logo facebook"><img src="./assets/img/logo_facebook_matrix.png"></a></li>
			<li><a href="#" alt="logo twitter"><img src="./assets/img/logo_twitter_matrix.png"></a></li>
			<li><a href="#" alt="logo youtube"><img src="./assets/img/logo_youtube_matrix.png"></a></li>
		</ul>

	</div>
</main>
</body>
</html>