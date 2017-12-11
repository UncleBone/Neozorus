<ul id="langue">
	<li><a href="#">
			<?php
			foreach ($languages as $key => $value) {
				if($this->user->getU_langue() == $value['l_id']){
					echo ucfirst($value['l_libelle']);
				}
			}
			?>
		</a>
		<ul id="menu2">
			<?php
			foreach ($languages as $key => $value) {
				if($this->user->getU_langue() != $value['l_id']){
					echo '<li><a class="language" href="#" id="'.$value['l_id'].'">'.ucfirst($value['l_libelle']).'</a></li>';
				}
			}
			?>
		</ul>
	</li>
</ul>