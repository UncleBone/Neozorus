<?php
	foreach ($mesCartes as $value) {
		echo '<div class="carte '.$value->getC_type().'"><img src='.IMG_PATH . DS . 'gabarit' . DS . $value->getC_type() . DS . $value->getC_id() . '.png />';
		echo $value->getC_type() != 'sort' ? '<span class="pv">'.$value->getC_pvMax().'</span>' : '';
		echo '<span class="puissance">'.$value->getC_puissance().'</span>';
		echo '<span class="manaCost">'.$value->getC_mana().'</span>';
		echo '</div>';
	}
?>	