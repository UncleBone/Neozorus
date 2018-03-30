<?php
if(empty($success)){
?>
<form class="formChange" method="POST" action=".?controller=parameters&action=changePassword">
	<h3>Changement de mot de passe</h3>
	<input type="password" name="password" placeholder="Mot de passe actuel">
	<input type="password" name="newPassword" placeholder="Nouveau mot de passe">
	<input type="password" name="confirmNewPassword" placeholder="Confirmez le nouveau mot de passe">
	<div class="bottomButtons">
		<input type="submit" value="Valider">
		<input type="submit" value="Annuler">
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