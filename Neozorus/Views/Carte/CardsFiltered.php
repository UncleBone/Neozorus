<?php
	foreach ($mesCartes as $value) {
		echo '<div class="carte '.$value->getC_type().'"><img src='.IMG_PATH . DS . 'gabarit' . DS . $value->getC_type() . DS . $value->getC_id() . '.png /></div>';
	}
?>	