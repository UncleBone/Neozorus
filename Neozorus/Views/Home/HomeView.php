<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$titleTrad = $lang == 1 ? 'Acceuil' : 'Home';
	$helloTrad = $lang == 1 ? 'Bonjour ' : 'Hello ';
	$buttonPlayTrad = $lang == 1 ? 'Jouer' : 'Play';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$titleTrad?></title>
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="./assets/css/HomeViewStyle.css"/>
	<?php include(FAVICON) ?>
</head>

<body>
<header>
	<?php include(MENU) ?>

	<div class="bonjour">
		<p><?=$helloTrad?><?=$user?></p>
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
				<input type="submit" value="<?=$buttonPlayTrad?>"  id="Jouer" />
		</form>
	</article>

	<div class="liens_media_sociaux">
		<ul class="links">
			<li><a href="#" alt="logo facebook"><img src="./assets/img/logo_facebook_matrix.png"></a></li>
			<li><a href="#" alt="logo twitter"><img src="./assets/img/logo_twitter_matrix.png"></a></li>
			<li><a href="#" alt="logo youtube"><img src="./assets/img/logo_youtube_matrix.png"></a></li>
		</ul>

	</div>
</main>
</body>
</html>
