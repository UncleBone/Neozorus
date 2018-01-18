	<form method="POST" action=".?controller=user&action=traitementInscriptionPseudo">
		<a href=".?controller=user&action=inscription" title="retour"><div class="back"></div></a>
		<label>Choisissez votre pseudo:</label>
		<input type="text" name="pseudo" placeholder="Pseudo">
		<input type="submit" name="" value="Valider">
	</form>
	
	<?php
	if(!empty($error)){
		echo "<div class=\"error\"><p>";
		echo $errorMessage;
		echo "</p></div>";
	}
	?>