<!DOCTYPE html>
<html class=<?= $theme ?>>
<head>
	<title>Neozorus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/SelectCarte.css">
</head>
<body>
	<h1><?= $monDeck -> getD_libelle()?></h1>
	<div class="affichageCarte">
			<?php
			foreach ($mesCartes AS  $value){
			 ?>
				<div class="mesGabarits">
					<img src=<?='"'.$value->GetC_gabarit().'"'?>>
					<?php
					if($value->getC_type() != 'speciale'){
					echo '<span class="PuissanceCarteSortCreature">'.$value->GetC_puissance().'</span>';
					}
					else{
					echo '<span class="PuissanceCarteSpeciale">'.$value->GetC_puissance().'</span>';	
					}						
					if($value->getC_type() ==  'sort'){
					echo '<span class="ManaSortOuVitaCreature">'.$value->GetC_mana().'</span>';
					}
					else if($value->getC_type() ==  'creature'){
						echo '<span class="ManaSortOuVitaCreature">'.$value->getC_PvMax().'</span>';
					}
					else{
						echo '<span class="VitaCarteSpeciale">'.$value->getC_PvMax().'</span>';
					}

					if ($value->getC_type() ==  'creature') {
						echo '<span class="ManaCarteCreature">'.$value->GetC_mana().'</span>';
					}
					else if ($value->getC_type() ==  'speciale') {
						echo '<span class="ManaCarteSpeciale">'.$value->GetC_mana().'</span>';
					}
					if ($value->getC_type() ==  'creature') {
						echo '<span class="IndiceCarteCreature"><p>'.$value->GetC_indice().'</p></span>';
					}
					?>
				</div>
			<?php
			}						
			?>
		</div>
		<p><a href=<?='"index.php?controller=deck&action=affichageDeck&hero='.$hero.'"'?>>Retour</a></p>
</body>
</html>