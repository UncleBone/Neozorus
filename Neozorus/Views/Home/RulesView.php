<main>
	<article>
		<?php
		if($reglesTrad = $lang == 1){
		?>

		<!-- <h1>Règles du jeu</h1> -->

		<h3>Initialisation de la partie</h3>

			<ul>
				<li>Chacun des 2 joueurs choisit un héros</li>
				<li>Chaque héros dispose de cartes qui lui sont propres.<br>
				Chaque joueur crée un deck de 20 cartes parmis celles correspondant à son héros ou selectionne un deck sauvegardé. Un deck sauvegardé peut être modifié avant chaque partie.</li>
				<li>Lorsque les 2 joueurs ont constitué ou selectionné leur deck, la partie peut commencer.</li>
			</ul>

		<h3>Les cartes</h3>
			
			<p>Il existe 3 types de cartes :</p>
			<ol>
				<li>Les créatures :<br>
				De type simple ou de type bouclier, elles sont dotées de 3 caractéristiques : un coût en mana, un nombre de points de vie et un score d'attaque.</li>
				<li>Les sorts :<br>
				Ces cartes à usage unique sont dotées de 2 caractéristiques : un coût en mana et un score d'attaque.</li>
				<li>Les cartes spéciales :<br>
				Ce sont des cartes créatures ultra puissantes. Il en existe 1 par héros.</li>
			</ol>

		<h3>Début de partie</h3>

			<p>Le joueur qui commence la partie est désigné aléatoirement.</p>
			<ul>
				<li>Chaque joueur commence la partie avec 3 cartes en main</li>
				<li>Chacun des héros est doté de 3 points de vie</li>
				<li>Au tour 1, les joueurs ont 1 point de​ mana. A chaque tour supplémentaire, les joueurs commencent le tour suivant avec 1 point de ​mana supplémentaire, jusqu'à un maximum de 10 ​manas par tour.<br>
				Exemple : tour 1 : 1 mana, tour 2 : 2 manas, tour 3 : 3 manas...tour 10 : 10 manas).​ A la fin du tour, les points de ​mana non dépensés sont perdus.</li>
			</ul>

		<h3>Pendant la partie</h3>

			<p>Les joueurs jouent l'un après l'autre.</p>
			<ul>
				<li>Au début du tour, le joueur pioche une carte aléatoire dans son deck.</li>
				<li>Chaque tour, les joueurs peuvent dépenser leurs manas afin de jouer des cartes.<br>
				Ces dernières quittent alors la main du joueur et sont placées sur le plateau.</li>
				<li>Les créatures restent inactives le tour où elles sont jouées. Elles ne s'activent qu'au tour suivant.</li>
				<li>Les sorts sont à effets immédiats, après quoi ils sont retirés du plateau.</li>
				<li>Le joueur peut jouer autant de cartes qu'il souhaite tant qu'il lui reste assez de mana.</li>
				<li>Il n'y a pas de limite au nombre de créature invoqueés sur le plateau.</li>
				<li>Une créature active peut choisir d'attaquer le héros adverse ou une créature ennemie.</li>
				<li>Si un héros ou une créature subit une attaque, ses points de vie sont diminués d'un montant égal au score d'attaque de la créature attaquante.</li>
				<li>Si les points de vie d'une créature tombent à 0, elle est retirée du plateau.</li>
				<li>Une créature ne peut attaquer qu'une seule fois par tour</li>
				<li>Les créatures de type bouclier attirent les attaques adverses et empêchent l'adversaire d'attaquer le héros ou les autres créatures.</li>
				<li>Le joueur termine son tour en appuyant sur le bouton en bas à droite avec l'image de l'adversaire</li>
			</ul>

		<h3>Fin de la partie</h3>

			<p>La partie se termine si l'un des héros arrive à 0 point de vie ou si l'un des joueurs n'a plus de cartes à jouer.</p>
			<?php
		}else{
		?>
		<h1>Game's rules</h1>

		<h3>Initialisation of the game</h3>

			<ul>
				<li>Each of the two players pick a hero</li>
				<li>Each hero has his own cards<br>
				Each player create a deck of 20 cards among the ones linked to the hero or select a saved deck. A saved deck can be modified before every game</li>
				<li>When two players have created or selected a deck, the game can start.</li>
			</ul>

		<h3>The cards</h3>

		<p>3 types of cards are available :</p>
		<ol>
		<li>The creatures :<br>
		Simple or shield type, they have 3 caracteristics : a cost in mana, a number of lives and an attack score.</li>
		<li>The spells :<br>
		These cards can be use only once and have 2 caracteristics : a cost in mana and an attack score.</li>
		<li>The special cards :<br>
		These are really powerful creatures cards. There is one by hero.</li>
		</ol>

		<h2>The beginning of the game</h2>

			<p>The player who start the game is selected randomly.</p>
			<ul>
				<li>Each player start the game with 3 cards in the hand</li>
				<li>Each player has 3 lives</li>
				<li>During the first round, the players have 1 mana.The players start the next round with one more mana, until they get maximum 10 mana at 	the 	10th round.<br>
				Example : round 1 : 1 mana, round 2 : 2 manas, round 3 : 3 manas ... round 10 : 10 manas. At the end of the round, the mana that weren't 	used 	are lost.</li>
			</ul>

		<h3>During the game</h3>

			<p>The players play one after the other.</p>
			<ul>
				<li>At the beginning of the round, the player pick a card randomly in his own deck</li>
				<li>During each round, the players can spend their manas by playing cards<br>Then the cards are not in the hand anymore but in the board</li>
				<li>The creatures stay inactives during the round they are played. They are going to be activated during the next round</li>
				<li>The spells works immediately and then they are gone from the board</li>
				<li>The player can play as many cards as he wants as long as he still has mana</li>
				<li>There is not a limited number of creatures that can be on the board</li>
				<li>An active creature can decide to attack the adverse hero or an enemy creature</li>
				<li>If a hero or a creature was attacked , its/his lives decrease depending on the attack score of the creature who attacked before</li>
				<li>A creature can attack only one time during a round</li>
				<li>The creatures type shield attract the adverse attacks so they protect the hero and the creatures of this hero from the enemy's attack</li>
				<li>The player end his round by pushing the button at the bottom right where is the picture of the enemy</li>
			</ul>

		<h3>End of the game</h3>

		<p>The game is over if one of the heroes lose all his lives or if one of the players doesn't have cards anymore.</p>

		<?php
	}
		?>
	</article>
</main>