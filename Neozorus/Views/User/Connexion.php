	<form method="POST" action=".?controller=user&action=traitementConnexion">
		<a href="." title="retour"><div class="back"></div></a>
		<input type="email" name="email" placeholder="E-mail" value=<?= !empty($email) ? "\"".$email."\"" : "";?>>
		<input type="password" name="mdp" placeholder="Mot de passe" value=<?= !empty($mdp) ? "\"".$mdp."\"" : "";?>>
		<input type="submit" name="Connexion" value="Se connecter">
	</form>

	<?php
	if(!empty($error)){
		echo "<div class=\"error\"><p>";
		echo $errorMessage;
		echo "</p></div>";
	}
	?>