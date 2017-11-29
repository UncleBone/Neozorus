<?php
if(count($mesCartes) > 0){
	foreach ($mesCartes AS  $value){
	 ?>
		<div class="mesGabarits">
			<img src=<?='"'.$value->GetC_gabarit().'"'?>>
			<?php
			if($value->getC_type() != 'speciale'){
			echo '<span class="PuissanceCarteSortCreature" data-speciale="non">'.$value->GetC_puissance().'</span>';
			}
			else{
			echo '<span class="PuissanceCarteSpeciale" data-speciale="oui">'.$value->GetC_puissance().'</span>';	
			}						
			if($value->getC_type() ==  'sort'){
			echo '<span class="ManaSortOuVitaCreature" data-speciale="non">'.$value->GetC_mana().'</span>';
			}
			else if($value->getC_type() ==  'creature'){
				echo '<span class="ManaSortOuVitaCreature" data-speciale="non">'.$value->getC_PvMax().'</span>';
			}
			else{
				echo '<span class="VitaCarteSpeciale" data-speciale="oui">'.$value->getC_PvMax().'</span>';
			}

			if ($value->getC_type() ==  'creature') {
				echo '<span class="ManaCarteCreature" data-speciale="non">'.$value->GetC_mana().'</span>';
			}
			else if ($value->getC_type() ==  'speciale') {
				echo '<span class="ManaCarteSpeciale" data-speciale="oui">'.$value->GetC_mana().'</span>';
			}
			?>
		</div>
	<?php
	}
}
else{
	echo'<div>';
	echo '<p class="messageNoResult">Il n\'éxiste aucun résultat pour votre recherche!</p>';
	echo '</div>';
}						
?>