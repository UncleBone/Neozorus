
<main>

	<div id="cartes">
		
		<?php
		include(VIEWS_PATH . DS . 'Carte' . DS . 'CardsFiltered.php')
		?>

	</div>

	<div id="filter">

		<?php
		if(empty($deckId)){
		?>

		<div id="team" class="select">
			<div id="btnDinos" class="btn" data="2">Les Dinos</div>
			<div id="btnMatrix" class="btn" data="1">La Matrice</div>
		</div>

		<?php
		}else{
		?>

		<div id="deckName" data_id="<?= $deckId ?>" data_user="<?= $_SESSION['neozorus']['u_id'] ?>">
			<p>Nom du Deck: </p>
			<span><?= $deck->getLibelle() ?></span>
			<button>[Modifier]</button>
		</div>

		<?php
		}
		?>
		<div><hr></div>
		
		<div id="type" class="select">
			<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'logo' . DS .  'logoCreature_3.png' ?>" data="creature">
			<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'logo' . DS .  'logoSort_3.png' ?>" data="sort">
			<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'logo' . DS .  'logoSpeciale_3.png' ?>" data="speciale">
		</div>
		
		<div><hr></div>

		<ul id="mana" class="select">
		<?php
		for($i=1;$i<10;$i++){
			echo '<li data="'.$i.'">'.$i.'<br><img src="'.IMG_PATH . DS . 'plateau' . DS .'pilluleBleueVide.png"></li>';
		}
		?>
		</ul>

	</div>

</main>

