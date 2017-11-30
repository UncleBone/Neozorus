<!DOCTYPE html>
<html>
<head>
	<title>Parametres</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
		let u_id = <?= $this->user->getU_id()?>;

		const PSEUDO_MIN = <?=PSEUDO_MIN?>;
		const PSEUDO_MAX = <?=PSEUDO_MAX?>;

		const NOM_MIN = <?=NOM_MIN?>;
		const NOM_MAX = <?=NOM_MAX?>;

		const PRENOM_MIN = <?=PRENOM_MIN?>;
		const PRENOM_MAX = <?=PRENOM_MAX?>;

		const MAIL_MIN = <?=MAIL_MIN?>;
		const MAIL_MAX = <?=MAIL_MAX?>;
	</script>
	<script type="text/javascript" src="./assets/js/ParametersUser.js"></script>
	<link rel="stylesheet" type="text/css" href="./assets/css/ParametersUser.css">
</head>
<body>
	<?php include(MENU) ?>
	<h1>Parametres Utilisateur</h1>
	<div id="conteneur">
		<table id="tab">
			<tr>
				<th>Pseudo:</th>
				<td class="tdValue"><input id="pseudo" value="<?=$this->user->getU_pseudo()?>"></td>
				<td class = "tdButton"><button id="pseudoButton"></button></td>
			</tr>
			<tr>
				<th>Mail:</th>
				<td class="tdValue"><input id="mail" value="<?=$this->user->getU_mail()?>"></td>
				<td class = "tdButton"><button id="mailButton"></button></td>
			</tr>
			<tr>
				<th>Nom:</th>
				<td class="tdValue"><input id="nom" value="<?=$this->user->getU_nom()?>"></td>
				<td class = "tdButton"><button id="nomButton"></button></td>
			</tr>
			<tr>
				<th>Prenom:</th>
				<td class="tdValue"><input id="prenom" value="<?=$this->user->getU_prenom()?>"></td>
				<td class = "tdButton"><button id="prenomButton"></button></td>
			</tr>
		</table>
	</div>
</body>
</html>