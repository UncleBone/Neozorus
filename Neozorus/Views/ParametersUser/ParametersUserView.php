<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$titleTrad = $lang == 1 ? 'Parametres utilisateurs' : 'User parameters';
	$pseudoTrad = $lang == 1 ? 'Pseudo' : 'Nickname';
	$mailTrad = $lang == 1 ? 'Mail' : 'Mail';
	$nomTrad = $lang == 1 ? 'Nom' : 'Last name';
	$prenomTrad = $lang == 1 ? 'Prenom' : 'First name';
	$changePasswordTrad = $lang == 1 ? 'Modifier le mot de passe' : 'Change password';
	$actualPasswordTrad = $lang == 1 ? 'Mot de passe actuel' : 'actual password';
	$newPasswordTrad = $lang == 1 ? 'Nouveau mot de passe' : 'New password';
	$passwordTrad = $lang == 1 ? 'Mot de passe' : 'Password';
	$newQuestionTrad = $lang == 1 ? 'Nouvelle question' : 'New Question';
	$newAnswerTrad = $lang == 1 ? 'Nouvelle reponse' : 'New Answer';
	$changeQuestionTrad = $lang == 1 ? 'Changer de question secrete' : 'Change secrect question';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$titleTrad?></title>
	<meta charset="utf-8">
	<?php include(FAVICON) ?>
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

		const QUESTION_MIN = <?=QUESTION_MIN?>;
		const QUESTION_MAX = <?=QUESTION_MAX?>;

		const ANSWER_MIN = <?=ANSWER_MIN?>;
		const ANSWER_MAX = <?=ANSWER_MAX?>;

		const LANG = <?=$lang?>;
	</script>
	<script type="text/javascript" src="./assets/js/ParametersUser.js"></script>
	<link rel="stylesheet" type="text/css" href="./assets/css/ParametersUser.css">
</head>
<body>
	<?php include(MENU);?>
	<div class="bloc_menu2">
		<ul id="langue">
			<li><a href="#">
					<?php
					foreach ($this->languages as $key => $value) {
						if($this->user->getU_langue() == $value['l_id']){
							echo ucfirst($value['l_libelle']);
						}
					}
					?>
				</a>
				<ul id="menu2">
					<?php
					foreach ($this->languages as $key => $value) {
						if($this->user->getU_langue() != $value['l_id']){
							echo '<li><a class="language" href="index.php?controller=parametersUser&action=switchLanguage&language='.$value['l_id'].'" id="'.$value['l_id'].'">'.ucfirst($value['l_libelle']).'</a></li>';
						}
					}
					?>
				</ul>
			</li>
		</ul>		
	</div>
		<h1><?=$titleTrad?></h1>
		<div id="conteneur">
			<table id="tab">
				<tr>
					<th><?=$pseudoTrad?></th>
					<td class="tdValue"><input id="pseudo" value="<?=$this->user->getU_pseudo()?>"></td>
					<td class = "tdButton"><button class="circle" id="pseudoButton"></button></td>
				</tr>
				<tr>
					<th><?=$mailTrad?></th>
					<td class="tdValue"><input id="mail" value="<?=$this->user->getU_mail()?>"></td>
					<td class = "tdButton"><button class="circle" id="mailButton"></button></td>
				</tr>
				<tr>
					<th><?=$nomTrad?></th>
					<td class="tdValue"><input id="nom" value="<?=$this->user->getU_nom()?>"></td>
					<td class = "tdButton"><button class="circle" id="nomButton"></button></td>
				</tr>
				<tr>
					<th><?=$prenomTrad?></th>
					<td class="tdValue"><input id="prenom" value="<?=$this->user->getU_prenom()?>"></td>
					<td class = "tdButton"><button class="circle" id="prenomButton"></button></td>
				</tr>
			</table>
		</div>
		<div id="bottomMenu">
			<table id="tab2">
				<tr>
					<th><button id="passwordButton"><?=$changePasswordTrad?></button></th>
					<td rowspan="2" class="tdValue" id= "contenuDynamique">
						<!--ON AFFICHE SOIT CE BLOC-->
						<div id="blocPassword">
							<table id="tableDynamique">
								<tr>
									<th><?=$actualPasswordTrad?></th>
									<td><input type="password" class="password input" id="actualPassword"></td>
									<td id="bigButton" rowspan="3"><button class="circle" id="passwordValidForm"></button></td>
								</tr>
								<tr>
									<th><?=$newPasswordTrad?></th>
									<td><input type="text" class="password input" id="newPassword"></td>
								</tr>
								<tr>
									<th><?=$newPasswordTrad?></th>
									<td><input type="text" class="password input" id="conformNewPassword"></td>
								</tr>
							</table>
						</div>
						<!--OU CE BLOC-->
						<div id="blocQuestion">
							<table id="tableDynamique2">
								<tr>
									<th><?=$passwordTrad?></th>
									<td><input  type="password" id="passwordQuestion"></td>
									<td id="bigButton" rowspan="4"><button class="circle" id="questionValidForm"></button></td>
								</tr>
								<tr>
									<th><?=$this->user->getU_question()?>:</th>
									<td><input  type="text" id="actualAnswer"></td>
								</tr>
								<tr>
									<th><?=$newQuestionTrad?></th>
									<td><input type="text" id="newQuestion"></td>
								</tr>
								<tr>
									<th><?=$newAnswerTrad?></th>
									<td><input type="text" id="newAnswer"></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<th><button id="questionButton"><?=$changeQuestionTrad?></button></th>
				</tr>
			</table>
		</div>
</body>
</html>