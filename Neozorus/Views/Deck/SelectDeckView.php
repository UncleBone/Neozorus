
<header id="deckHeader">
	<a href=".?controller=home&action=display"><nav>Retour</nav></a>
	<h1> - <?= $title ?> - </h1>
</header>

<main id="decks">
	<div id="teamCard">
		<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'personnage' . DS . $heros .'.png' ?>">
	</div>

	<form>
		<label>Decks:</label>
		<select>
			<?php
			foreach ($decks as $deck) {
				echo '<option value="'.$deck->getId().'">'.$deck->getLibelle().'</option>';
			}
			?>
		</select>
		<div class="bottomButtons">
			<input type="submit" value="Voir">
			<input type="submit" value="Jouer">
		</div>
	</form>
</main>
<!-- 
<div id="headerDecks">
		
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
				    	<p><?= $value->getLibelle();?></p>
				    </div>
						<?php
						echo '<a class="info" href="index.php?controller=game&action=wait&id='.$value->getId().'">'.$playButtonTrad.'</a>';
						?>
						<a class="info" href=""><?=$modifyButtonTrad?></a>
						<a class="info" href=<?= '"index.php?controller=carte&action=afficherCarte&deck='.$value->getId().'&hero='.$hero.'"'?>><?=$detailsButtonTrad?></a>	
			    </div>
			</div>
		</div>
		<?php } ?>


		
	</div>
	</article> -->