<?php
if(empty($success)){
?>
<form class="formChange" method="POST" action=".?controller=parameters&action=changeEmail">
	<h3><?= $lang == 1 ? 'Changement d\'adresse Email' : 'Email Change' ?></h3>
	<input type="email" name="newEmail" placeholder="<?= $lang == 1 ? 'Nouvelle adresse email' : 'New Email Adress' ?>">
	<input type="email" name="confirmNewEmail" placeholder="<?= $lang == 1 ? 'Confirmez la nouvelle adresse' : 'Confirm' ?>">
	<input type="password" name="password" placeholder="<?= $lang == 1 ? 'Mot de passe' : 'Password' ?>">
	<div class="bottomButtons">
		<input type="submit" value="<?= $lang == 1 ? 'Valider' : 'Submit' ?>">
		<input type="submit" value="<?= $lang == 1 ? 'Annuler' : 'Cancel' ?>">
	</div>
</form>

<?php
	if(!empty($error)){
		echo '<div class="error"><p>'.$error.'</p></div>';
	}
}else{
	echo '<div class="success"><p>'.$success.'</p>';
	echo '<a href=".?controller=parameters&action=display"><button>OK</button></a></div>';
}