<!DOCTYPE html>
<html class="theme">
<head>
	<title>Neozorus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/CarteCollection.css">
	<script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="./assets/js/CarteCollection.js"></script>
</head>
<body>
	<?php include(MENU) ?>
	<h1>Collection de cartes</h1>
	<div id="conteneur">
		<div class="affichageCarte">
			<!--Contenu genere par une requete AJAX -->
		</div>
		<div id="menu">
			<h2>Filtrer par:</h2>
			<table>
				<tr>
					<th>Hero:</th>
					<td>
						<select id="hero">
							<option value="null" selected>-</option>
							<?php
							foreach ($mesHeros as $key => $value) {
								echo '<option value="'.$value -> getH_id().'">'.$value -> getH_libelle().'</option>';
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
								echo '<option value="'.$mesTypes[$i].'">'.$mesTypes[$i].'</option>';
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Cout en mana:</th>
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
					<th>Pouvoir:</th>
					<td><select id="pouvoir">
						<option value="null" selected>-</option>
							<?php
							for ($i = 0; $i < count($mesPouvoirs); $i++) {
								echo '<option value="'.$mesPouvoirs[$i]['a_id'].'">'.$mesPouvoirs[$i]['a_libelle'].'</option>';
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th>Trier par:</th>
					<td>
						<select id="tri">
							<option value="valMana" selected >Mana</option>
							<option value="valPuissance">Puissance</option>
							<option value="valVitalite">Vitalité</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
	</div>	
</body>
</html>