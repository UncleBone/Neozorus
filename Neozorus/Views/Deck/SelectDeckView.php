
<header id="deckHeader">
	<a href=".?controller=home&action=display"><nav>Retour</nav></a>
	<h1> - <?= $title ?> - </h1>
</header>


<!-- 
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
	</article> -->