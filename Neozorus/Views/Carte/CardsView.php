
<main>

		<div class="affichageCarte">
			
			<?php
			foreach ($mesCartes as $value) {
				echo '<div class="carte '.$value->getC_type().'"><img src='.IMG_PATH . DS . 'gabarit' . DS . $value->getC_type() . DS . $value->getC_id() . '.png /></div>';
			}
			?>
		
		</div>

		<div id="filter">
		<!-- <h2><?=$filterTitleTrad?></h2> -->
		<div>
			<div id="btnDinos" class="btn">Les Dinos</div>
			<div id="btnMatrix" class="btn">La Matrice</div>
		</div>
		<div><hr></div>
		<div id="logo">
			<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'logo' . DS .  'logoCreature_3.png' ?>">
			<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'logo' . DS .  'logoSort_3.png' ?>">
			<img src="<?= IMG_PATH . DS . 'gabarit' . DS . 'logo' . DS .  'logoSpeciale_3.png' ?>">
		</div>
		<div><hr></div>
		<ul id="mana">
		<?php
		// echo '<ul>';
		for($i=1;$i<10;$i++){
			echo '<li>'.$i.'<br><img src="'.IMG_PATH . DS . 'plateau' . DS .'pilluleBleueVide.png"></li>';
		}
		// echo '</ul>';
		?>
		</ul>
		<!-- <table>
			<tr>
				<th>Hero:</th>
				<td>
					<select id="hero">
						<option value="null" selected>-</option>
						<?php
						foreach ($mesHeros as $key => $value) {
							if($lang == 1){
								echo '<option value="'.$value -> getH_id().'">'.$value -> getH_libelle().'</option>';
							}
							else if($lang == 2){
								if($value -> getH_id() == 2){
									echo '<option value="'.$value -> getH_id().'">TYRANNAUSAURUS REX</option>';
								}
								else{
									echo '<option value="'.$value -> getH_id().'">'.$value -> getH_libelle().'</option>';
								}
							}	
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th>Type:</th>
				<td>
					<select id="type">
						<option value="null" selected>-</option>
						<?php
						for ($i = 0; $i < count($mesTypes); $i++) {
							if($lang == 1){
								echo '<option value="'.$mesTypes[$i].'">'.$mesTypes[$i].'</option>';
							}
							else if($lang == 2){
								if($mesTypes[$i] == 'sort'){
									echo '<option value="'.$mesTypes[$i].'">spell</option>';
								}
								else if($mesTypes[$i] == 'speciale'){
									echo '<option value="'.$mesTypes[$i].'">special</option>';
								}
								else{
									echo '<option value="'.$mesTypes[$i].'">'.$mesTypes[$i].'</option>';
								}
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th><?=$labelManaTrad?></th>
				<td>
					<select id="mana">
						<option value="null" selected>-</option>
						<?php
						for ($i = 0; $i < count($mesCoutsMana); $i++) {
							echo '<option value="'.$mesCoutsMana[$i].'">'.$mesCoutsMana[$i].'</option>';
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th><?=$labelAbilityTrad?></th>
				<td><select id="pouvoir">
					<option value="null" selected>-</option>
						<?php
						for ($i = 0; $i < count($mesPouvoirs); $i++) {
							if($lang == 1){
								echo '<option value="'.$mesPouvoirs[$i]['a_id'].'">'.$mesPouvoirs[$i]['a_libelle'].'</option>';
							}
							else if($lang == 2){
								if($mesPouvoirs[$i]['a_id'] == 1){
									echo '<option value="'.$mesPouvoirs[$i]['a_id'].'">Shield</option>';
								}
								else if($mesPouvoirs[$i]['a_id'] == 2){
									echo '<option value="'.$mesPouvoirs[$i]['a_id'].'">Pick1</option>';
								}
								else if($mesPouvoirs[$i]['a_id'] == 3){
									echo '<option value="'.$mesPouvoirs[$i]['a_id'].'">Pick2</option>';
								}
								else{
									echo '<option value="'.$mesPouvoirs[$i]['a_id'].'">'.$mesPouvoirs[$i]['a_libelle'].'</option>';
								}
							}
							
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th><?=$labelOrderByTrad?></th>
				<td>
					<select id="tri">
						<option value="valMana" selected >Mana</option>
						<option value="valPuissance"><?=$powerTrad?></option>
						<option value="valVitalite"><?=$vitalityTrad?></option>
					</select>
				</td>
			</tr>
		</table> -->
	</div>

	</main>

