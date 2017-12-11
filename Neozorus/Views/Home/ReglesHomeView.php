<!DOCTYPE html>
<html>
<head>
	<title>Règles du jeu</title>
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="./assets/css/ReglesHomeViewStyle.css"/>
</head>
<body>
<header>
		<div class="retouraccueil">
			<?php include(MENU) ?>
		</div>
		<div class="bloc_logo">
			<img class="logo" src="./assets/img/logoNeozorus.png" id="logoNeozorus">
		</div>
</header>
	
	<div id="container">

		<h1>Règles du jeu</h1>

		<h2>Initialisation de la partie</h2>

			<ul>
				<li>Chacun des 2 joueurs choisit un héros</li>
				<li>Chaque héros dispose de cartes qui lui sont propres.<br>
				Chaque joueur créé un deck de 20 cartes parmis celles correspondant à son héros ou selectionne un deck sauvegardé. Un deck sauvegardé peu être modifié avant chaque partie.</li>
				<li>Lorsque les 2 joueurs ont constitué ou selectionner leur deck, la partie peut commencer.</li>
			</ul>

		<h2>Les cartes</h2>
			
			<p>Il existe 3 types de cartes :</p>
			<ol>
				<li>Les créatures :<br>
				De type simple ou de type bouclier, elles sont dotées de 3 caractéristiques : un coût en mana, un nombre de points de vie et un score d'attaque.</li>
				<li>Les sorts :<br>
				Ces cartes à usage unique sont dotées de 2 caractéristiques : un coût en mana et un score d'attaque.</li>
				<li>Les cartes spéciales :<br>
				Ce sont des cartes créatures ultra puissantes. Il en existe 1 par héros.</li>
			</ol>

		<h2>Début de partie</h2>

			<p>Le joueur qui commence la partie est désigné aléatoirement.</p>
			<ul>
				<li>Chaque joueur commence la partie avec 3 cartes en main</li>
				<li>Chacun des héros est doté de 3 points de vie</li>
				<li>Au tour 1, les joueurs ont 1 point de​ mana. A chaque tour supplémentaire, les joueurs commencent le tour suivant avec 1 point de ​mana supplémentaire, jusqu'à un maximum de 10 ​manas par tour.<br>
				Exemple : tour 1 : 1 mana, tour 2 : 2 manas, tour 3 : 3 manas...tour 10 : 10 manas).​ A la fin du tour, les points de ​mana non dépensés sont perdus.</li>
			</ul>

		<h2>Pendant la partie</h2>

			<p>Les joueurs jouent l'un après l'autre.</p>
			<ul>
				<li>Au début du tour, le joueur pioche une carte aléatoire dans son deck.</li>
				<li>Chaque tour, les joueurs peuvent dépenser leurs manas afin de jouer des cartes.<br>
				Ces dernières quittent alors la main du joueur et sont placées sur le plateau.</li>
				<li>Les créatures restent innactives le tour où elles sont jouées. Elles ne s'activent qu'au tour suivant.</li>
				<li>Les sorts sont à effets immédiats, après quoi ils sont retirés du plateau.</li>
				<li>Le joueur peut jouer autant de cartes qu'il souhaite tant qu'il lui reste assez de mana.</li>
				<li>Il n'y a pas de limite au nombre de créature invoqueés sur le plateau.</li>
				<li>Une créature active peut choisir d'attaquer le héros adverse ou une créature ennemie.</li>
				<li>Si un héros ou une créature subit une attaque, ses points de vie sont diminués d'un montant égal au score d'attaque de la créature attaquante.</li>
				<li>Si les points de vie d'une créature tombent à 0, elle est retirée du plateau.</li>
				<li>Une créature attaquée riposte en soustrayant ses points d'attaque aux points de vie de la créature attaquante.</li>
				<li>Une créature ne peut attaquer qu'une seule fois par tour;</li>
				<li>Les créatures de type bouclier attirent les attaques adverses et empêchent l'adversaire d'attaquer le héros ou les autres créatures.</li>
				<li>Le joueur termine son tour en appuyant sur le bouton "fin de tour".</li>
			</ul>

		<h2>Fin de la partie</h2>

			<p>La partie se termine si l'un des héros arrive à 0 point de vie ou si l'un des joueurs n'a plus de cartes à jouer.</p>

	</div>

</body>
</html>