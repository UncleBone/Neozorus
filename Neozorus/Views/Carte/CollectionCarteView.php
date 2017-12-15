<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$titleTrad = $lang == 1 ? 'Collection de Cartes' : 'Card Collection';
	$helloTrad = $lang == 1 ? 'Bonjour ' : 'Hello ';
	$buttonPlayTrad = $lang == 1 ? 'Jouer' : 'Play';
	$filterTitleTrad = $lang == 1 ? 'Filtrer par:' : 'Filter by:';
	$labelManaTrad = $lang == 1 ? 'Cout en mana:' : 'Mana cost:';
	$labelAbilityTrad = $lang == 1 ? 'Pouvoir:' : 'Ability:';
	$labelOrderByTrad = $lang == 1 ? 'Trier par:' : 'Order by:';
	$powerTrad = $lang == 1 ? 'Puissance' : 'Power';
	$vitalityTrad = $lang == 1 ? 'Vitalite' : 'Vitality';
?>
<!DOCTYPE html>
<html class="theme">
<head>
	<title><?=$titleTrad?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/CarteCollection.css">
	<script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="./assets/js/CarteCollection.js"></script>
	<meta name="viewport" content="width=device-width" />
	<?php include(FAVICON) ?>
</head>
<body>
	<div id="menuResponsive"><?php include(ACCEUIL);?></div>
	<div id="allContenu">
		<?php include(MENU) ?>
		<h1><?=$titleTrad?></h1>
		<div id="conteneur">
			<div class="affichageCarte">
				<!--Contenu genere par une requete AJAX -->
			</div>
			<div id="menu">
				<h2><?=$filterTitleTrad?></h2>
				<table>
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
				</table>
			</div>
		</div>
	</div>
</body>
</html>