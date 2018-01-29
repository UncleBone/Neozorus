<?php
if(empty($success)){
?>
<form class="formChange" method="POST" action=".?controller=parameters&action=changeQuestion">
	<h3>Changement de question secrète</h3>
	<input type="text" name="newQuestion" placeholder="Nouvelle question secrète">
	<input type="text" name="newAnswer" placeholder="Réponse">
	<input type="password" name="password" placeholder="Mot de passe">
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