<!-- ANGLAIS -->
<?php 
 if(isset($_SESSION['neozorus']['u_language']) && $_SESSION['neozorus']['u_language'] == 2){
 ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>HomeView</title>
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="./assets/css/HomeViewStyle.css"/>
	</head>

	<body>
	<header>
		<?php include(MENU) ?>

		<div class="bonjour">
			<p>
				Hello
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
					<input type="submit" value="Play"  id="Jouer" />
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
<?php
}else{
?>
<!-- FRANCAIS -->
	<!DOCTYPE html>
	<html>
	<head>
		<title>Acceuil</title>
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="./assets/css/HomeViewStyle.css"/>
	</head>

	<body>
	<header>
		<?php include(MENU) ?>

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
<?php
}
?>