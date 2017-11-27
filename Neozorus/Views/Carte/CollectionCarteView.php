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
	<h1>Collection de cartes</h1>
	<div id="conteneur">
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
					?>
				</div>
			<?php
			}						
			?>
		</div>
		<div id="menu">
			<h2>Filtrer par:</h2>
			<label>Hero:</label>
			<select id="hero">
				<option value="null" selected>-</option>
				<?php
				foreach ($mesHeros as $key => $value) {
					echo '<option value="'.$value -> getH_id().'">'.$value -> getH_libelle().'</option>';
				}
				?>
			</select><br />
			<label>Type:</label>
			<select id="type">
				<option value="null" selected>-</option>
				<?php
				for ($i = 0; $i < count($mesTypes); $i++) {
					echo '<option value="'.$mesTypes[$i].'">'.$mesTypes[$i].'</option>';
				}
				?>
			</select><br />
			<label>Coût en mana:</label>
			<select id="mana">
				<option value="null" selected>-</option>
				<?php
				for ($i = 0; $i < count($mesCoutsMana); $i++) {
					echo '<option value="'.$mesCoutsMana[$i].'">'.$mesCoutsMana[$i].'</option>';
				}
				?>
			</select><br />
			<label>Pouvoir:</label>
			<select id="pouvoir">
				<option value="null" selected>-</option>
				<?php
				for ($i = 0; $i < count($mesPouvoirs); $i++) {
					echo '<option value="'.$mesPouvoirs[$i]['a_id'].'">'.$mesPouvoirs[$i]['a_libelle'].'</option>';
				}
				?>
			</select><hr />
			<label>Trier par:</label>
			<select id="tri">
				<option value="valMana" selected >Mana</option>
				<option value="valPuissance">Puissance</option>
				<option value="valVitalite">Vitalité</option>
			</select><br />
			<p><a href="index.php?controller=home&action=affichagePageAccueil">Acceuil</a></p>
		</div>
	</div>	
</body>
</html>