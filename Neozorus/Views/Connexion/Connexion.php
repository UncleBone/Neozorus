<?php
	if(empty($_SESSION['neozorus']['u_id'])){
?>
	<form id="connexion" method="POST" action=".?controller=user&action=traitementConnexion">
		<a href="." title="retour"><div class="back"></div></a>
		<input type="email" name="email" placeholder="E-mail" value=<?= !empty($email) ? "\"".$email."\"" : "";?>>
		<input type="password" name="mdp" placeholder="Mot de passe" value=<?= !empty($mdp) ? "\"".$mdp."\"" : "";?>>
		<span>[<a href=".?controller=user&action=connectAsGuest">Se connecter en tant qu'invité</a>]</span>
		<input type="submit" name="Connexion" value="Se connecter">
	</form>

<?php
	}
	else{ 
	?>
		<form method="POST" action=".?controller=home&action=deconnexion">
		<a href="." title="retour"><div class="back"></div></a>
		<p>Une session est deja ouverte, veuillez fermer cette page et continuer sur la bonne page. Sinon, deconnectez-vous à partir d'ici et reconnectez-vous</p>
		<input type="submit" name="Connexion" value="Se deconnecter">
		</form>
	<?php
	}

	if(!empty($error)){
		echo "<div class=\"error\"><p>";
		echo $errorMessage;
		echo "</p></div>";
	}
?>