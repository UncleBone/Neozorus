<?php
	// foreach ($mesCartes as $value) {
	// 	echo '<div class="carte '.$value->getC_type().'"><img src='.IMG_PATH . DS . 'gabarit' . DS . $value->getC_type() . DS . $value->getC_id() . '.png />';
	// 	echo $value->getC_type() != 'sort' ? '<span class="pv">'.$value->getC_pvMax().'</span>' : '';
	// 	echo '<span class="puissance">'.$value->getC_puissance().'</span>';
	// 	echo '<span class="manaCost">'.$value->getC_mana().'</span>';
	// 	echo '</div>';
	// }
	foreach ($mesCartes as $value) {
		echo '<div class="carte '.$value->getType().'"><img src='.IMG_PATH . DS . 'gabarit' . DS . $value->getType() . DS . $value->getId() . '.png />';
		echo $value->getType() != 'sort' ? '<span class="pv">'.$value->getPvMax().'</span>' : '';
		echo '<span class="puissance">'.$value->getPuissance().'</span>';
		echo '<span class="manaCost">'.$value->getMana().'</span>';
		if($value->getNbExemplaire() > 1){
			echo '<span class="nbExemplaire">x'.$value->getNbExemplaire().'</span>';
		}
		echo '</div>';
	}
?>	