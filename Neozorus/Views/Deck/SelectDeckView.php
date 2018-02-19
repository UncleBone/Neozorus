
<header id="deckHeader">
	<nav>Accueil</nav>
	<h1> - <?= $title ?> - </h1>
</header>

<main id="deck">
	<div id="teamCard">
		<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'personnage' . DS . $heros .'.png' ?>">
		<span class="pvMax">20</span>
	</div>

	<form>
		<label>Deck:</label>
		<select name="id">
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
