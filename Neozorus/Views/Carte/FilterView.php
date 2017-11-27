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
		?>
	</div>
<?php
}						
?>