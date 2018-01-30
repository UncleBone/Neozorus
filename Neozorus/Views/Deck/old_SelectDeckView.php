<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$createDeckTrad = $lang == 1 ? 'Créer un deck' : 'Create a deck';
	$changeHeroTrad = $lang == 1 ? 'Changer de héros' : 'switch hero';
	$myDeckTrad = $lang == 1 ? 'mes Decks' : 'my Decks';
	$playButtonTrad = $lang == 1 ? 'Jouer' : 'Play';
	$modifyButtonTrad = $lang == 1 ? 'Modifier' : 'Modify';
	$detailsButtonTrad = $lang == 1 ? 'Détails' : 'Details';
?>
<!DOCTYPE html>
<html class=<?= $theme ?>>
<head>
	<title>Neozorus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/SelectDeckStyle.css" />
	<?php include(FAVICON) ?>

</head>
<body>
<header>
	<?php include(MENU) ?>
	<div id="headerDecks">
		<div id="action">

			<div id="creer">
				<a href="#"><p><?=$createDeckTrad?></p></a>
			</div>

			<div id="imageHeros" class="anime rebond">
				<?php
				$source = $theme == '"matrixtheme"' ? "'assets/img/headshot_neo.png'" : "'assets/img/headshot_rex.png'";
				?>
				<img src=<?=$source?>>
			</div>

			<div id="modifier">
				<a href="index.php?controller=hero&action=affichageListeHero"><p><?=$changeHeroTrad?></p></a>
			</div>
			<p class="decksExistants"><?=$myDeckTrad?></p>

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
				$imagedeck = $theme == '"matrixtheme"' ? "'assets/img/neo_deck.png'" : "'assets/img/rex_deck.png'"
				?>
			    <img src=<?=$imagedeck?>>
			    <div class="mask">
				    <div class="nomdeck">
				    	<p><?= $value->getD_libelle();?></p>
				    </div>
						<?php
						echo '<a class="info" href="index.php?controller=game&action=wait&id='.$value->getD_id().'">'.$playButtonTrad.'</a>';
						?>
						<a class="info" href=""><?=$modifyButtonTrad?></a>
						<a class="info" href=<?= '"index.php?controller=carte&action=afficherCarte&deck='.$value->getD_ID().'&hero='.$hero.'"'?>><?=$detailsButtonTrad?></a>	
			    </div>
			</div>
		</div>
		<?php } ?>


		
	</div>
	</article>
	
</body>
</html>