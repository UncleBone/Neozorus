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

		const PASSWORD_MIN = <?=PASSWORD_MIN?>;
		const PASSWORD_MAX = <?=PASSWORD_MAX?>;
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
				<td class = "tdButton"><button class="circle" id="pseudoButton"></button></td>
			</tr>
			<tr>
				<th>Mail:</th>
				<td class="tdValue"><input id="mail" value="<?=$this->user->getU_mail()?>"></td>
				<td class = "tdButton"><button class="circle" id="mailButton"></button></td>
			</tr>
			<tr>
				<th>Nom:</th>
				<td class="tdValue"><input id="nom" value="<?=$this->user->getU_nom()?>"></td>
				<td class = "tdButton"><button class="circle" id="nomButton"></button></td>
			</tr>
			<tr>
				<th>Prenom:</th>
				<td class="tdValue"><input id="prenom" value="<?=$this->user->getU_prenom()?>"></td>
				<td class = "tdButton"><button class="circle" id="prenomButton"></button></td>
			</tr>
		</table>
	</div>
	<div id="bottomMenu">
		<table id="tab2">
			<tr>
				<th><button id="passwordButton">Modifier le mot de passe</button></th>
				<td rowspan="2" class="tdValue" id= "contenuDynamique">
					<!--ON AFFICHE SOIT CE BLOC-->
					<div id="blocPassword">
						<table id="tableDynamique">
							<tr>
								<th>Mot de passe actuel:</th>
								<td><input type="password" class="password input" id="actualPassword"></td>
								<td id="bigButton" rowspan="3"><button class="circle" id="passwordValidForm"></button></td>
							</tr>
							<tr>
								<th>Nouveau mot de passe:</th>
								<td><input type="text" class="password input" id="newPassword"></td>
							</tr>
							<tr>
								<th>Confirmer le nouveau mot de passe:</th>
								<td><input type="text" class="password input" id="conformNewPassword"></td>
							</tr>
						</table>
					</div>
					<!--OU CE BLOC-->
					<div id="blocQuestion">
						<table id="tableDynamique2">
							<tr>
								<th>Mot de passe:</th>
								<td><input  id="passwordQuestion"></td>
								<td id="bigButton" rowspan="4"><button class="circle" id="questionValidForm"></button></td>
							</tr>
							<tr>
								<th><?=$this->user->getU_question()?>:</th>
								<td><input  id="actualAnswer"></td>
							</tr>
							<tr>
								<th>Nouvelle question:</th>
								<td><input id="newQuestion"></td>
							</tr>
							<tr>
								<th>Nouvelle reponse:</th>
								<td><input id="newAnswer"></td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<th><button id="questionButton">Modifier la question secrete</button></th>
			</tr>
		</table>
	</div>
</body>
</html>