
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
			<?php
			if($_SESSION['neozorus']['u_id'] != 2){
			?>
			<input type="submit" id="PvP" value="Jouer">
			<?php
			}
			?>
			<input type="submit" id="solo" value="Mode solo">
		</div>
	</form>
</main>
