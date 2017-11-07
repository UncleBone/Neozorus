<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width">
	<title>Game</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../../assets/css/GameLayout.css">
</head>
<body>
	<img id="plateau" src="../../../assets/img/plateau/plateau.png">
	<div id="contenu">
		<!-- Ici l'image represente le heros adverse-->
		<div id="topHero">
			<img src="../../../assets/img/plateau/portrait-dino.png">
			<span class="vitaHero">20</span>
		</div>
		<div id="blocCentral">
			<div id="manaLeft">
				<!-- 
					$n = mana restant:
					on fait un foreach pour:
					on affiche (10-n) div avec la pillule vide
				-->
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleuVide.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleuVide.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleuVide.png"></div>
				<!-- 
					et un autre forecah pour n div avec la pillule pleine
				-->
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleu.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleu.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleu.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleu.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleu.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleu.png"></div>
				<div id="pilluleBleu"><img src="../../../assets/img/plateau/pilluleBleu.png"></div>
			</div>
			<div id="creatureBox">
				
				<div id="topCreature">
					<!-- Ici c'est les creatures de l'adversaire avec n carte donc faire un foreach-->
					<div class="carte">
						<img src="../../../assets/img/gabarit/creature/21.png">
						<span class="stat1">5</span>
						<span class="stat2">7</span>
						<span class="stat3">9</span>
						<!-- Uniquement pour les créatures -->
						<div class="indice">
							<span>1</span>
						</div>
					</div>
					
				</div>
				
				<div id="bottomCreature">
					<!-- Ici c'est les creatures du joueur avec n carte donc faire un foreach-->
					<div class="carte">
						<img src="../../../assets/img/gabarit/creature/10.png">
						<span class="stat1">2</span>
						<span class="stat2">9</span>
						<span class="stat3">3</span>
						<!-- Uniquement pour les créatures -->
						<div class="indice">
							<span>2</span>
						</div>
					</div>
					
					
				</div>
			</div>
			<div id="manaRight">
				<!-- 
					$n = mana restant:
					on fait un foreach pour:
					on affiche (10-n) div avec la pillule vide
				-->
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div>
				 <div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div>
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div>
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div>
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div>
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div>
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div>
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRougeVide.png"></div> 
				<!-- 
					et un autre forecah pour n div avec la pillule pleine
				-->
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRouge.png"></div>
				<div id="pilluleRouge"><img src="../../../assets/img/plateau/pilluleRouge.png"></div>
			</div>
		</div>
		<div id="bottomHero">
			<img src="../../../assets/img/plateau/portrait-neo.png">
			<span class="vitaHero">20</span>
		</div>
		<div id="actionBar">
			<div id="main">
				<!-- Ici c'est la main du joueur avec n carte donc faut faire un foreach-->
				<div class="carteMain">
					<img src="../../../assets/img/gabarit/creature/5.png">
					<span class="stat1Miniature">2</span>
					<span class="stat2Miniature">9</span>
					<span class="stat3Miniature">3</span>
				</div>
			</div>
			<!-- Ici c'est le bouton passer le tour donc adapter la minature en fonction du hero-->
			<div id="end"><a href=""><img src="../../../assets/img/plateau/neoTourSuivant.png"></a></div>
		</div>
	</div>
</body>
</html>