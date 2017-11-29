<!DOCTYPE html>
<html class=<?= $theme ?>>
<head>
	<title>Neozorus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/SelectCarte.css">
	<script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		let id = <?= $monDeck -> getD_id()?>;
	</script>
	<script type="text/javascript" src="./assets/js/DeckDetails.js"></script>
</head>
<body>
	<h1><?= $monDeck -> getD_libelle()?></h1>
	<div id="conteneur">
		<div class="affichageCarte">
			<?php
			foreach ($mesCartes AS  $value){
			 ?>
				<div class="mesGabarits">
					<img src=<?='"'.$value->GetC_gabarit().'"'?>>
					<?php
					if($value->getC_type() != 'speciale'){
					echo '<span class="PuissanceCarteSortCreature"  data-speciale="non">'.$value->GetC_puissance().'</span>';
					}
					else{
					echo '<span class="PuissanceCarteSpeciale"  data-speciale="oui">'.$value->GetC_puissance().'</span>';	
					}						
					if($value->getC_type() ==  'sort'){
					echo '<span class="ManaSortOuVitaCreature"  data-speciale="non">'.$value->GetC_mana().'</span>';
					}
					else if($value->getC_type() ==  'creature'){
						echo '<span class="ManaSortOuVitaCreature"  data-speciale="non">'.$value->getC_PvMax().'</span>';
					}
					else{
						echo '<span class="VitaCarteSpeciale"  data-speciale="oui">'.$value->getC_PvMax().'</span>';
					}

					if ($value->getC_type() ==  'creature') {
						echo '<span class="ManaCarteCreature"  data-speciale="non">'.$value->GetC_mana().'</span>';
					}
					else if ($value->getC_type() ==  'speciale') {
						echo '<span class="ManaCarteSpeciale"  data-speciale="oui">'.$value->GetC_mana().'</span>';
					}
					if ($value->getC_type() ==  'creature') {
						echo '<span class="IndiceCarteCreature"  data-speciale="non"><p>'.$value->GetC_indice().'</p></span>';
					}
					?>
				</div>
			<?php
			}						
			?>
		</div>
		<div id="menu">
			<?php
			echo '<a class="info" href="index.php?controller=game&action=wait&id='.$monDeck->getD_id().'">Jouer</a>';
			?>
			<p><a href="#">Modifier</a></p>
			<p><a href=<?='"index.php?controller=deck&action=supprimerDeck&deck='.$monDeck->getD_id().'&hero='.$hero.'"'?>>Supprimer</a></p>
			<p><input id="nameDeck" type="text" value=<?='"'.$monDeck->getD_libelle().'"'?>><button id="nameButton"></button></p>
			<p><a href=<?='"index.php?controller=deck&action=affichageDeck&hero='.$hero.'"'?>>Retour</a></p>
		</div>
	</div>	
</body>
</html>