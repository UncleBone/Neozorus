<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$titleTrad = $lang == 1 ? 'Accueil' : 'Home';
	$helloTrad = $lang == 1 ? 'Bienvenue ' : 'Welcome ';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$titleTrad?></title>
	<meta name="viewport" content="width=device-width" />
	<script type="text/javascript" src="<?= JS_PATH . DS . 'jquery-3.2.1.min.js' ?>"></script>
	<script src="<?= JS_PATH . DS . 'splitBackground.js' ?>"></script> <!-- script de mise en forme du background --> 
	<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="<?= CSS_PATH . DS . 'HomeViewStyle.css' ?>"/>
	<?php include(FAVICON) ?>
</head>

<body>
	<section id="haut" class="haut_bas">
		<img src="<?= IMG_PATH . DS . 'background_jungle.jpg' ?>" id="imageHaut">
	</section>

	<section id="bas" class="haut_bas">
		<img src="<?= IMG_PATH . DS . 'background_matrix.jpg' ?>" id="imageBas">
	</section>

	<!-- <main> -->
		<header>
			<?php include(MENU) ?>
			<div class="welcome">
				<p><?=$helloTrad?><?=$user?></p>
			</div>
		</header>

		<nav id="logo">
			<div id="btnDinos" class="btn">Les Dinos</div>
			<img src="<?= IMG_PATH . DS . 'logoNeozorus.png' ?>" id="logoNeozorus">
			<div id="btnMatrix" class="btn">La Matrice</div>
		</nav>


		<ul class="links">
			<li><a href="#" alt="logo facebook" title="Facebook"><img src="<?= IMG_PATH . DS . 'logo_facebook_matrix.png' ?>"></a></li>
			<li><a href="#" alt="logo twitter" title="Twitter"><img src="<?= IMG_PATH . DS . 'logo_twitter_matrix.png' ?>"></a></li>
			<li><a href="#" alt="logo youtube" title="YouTube"><img src="<?= IMG_PATH . DS . 'logo_youtube_matrix.png' ?>"></a></li>
		</ul>


	<!-- </main> -->
</body>
</html>
