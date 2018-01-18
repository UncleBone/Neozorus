	<div class="confirmation">
	
	<?php
	if (empty($result)){
		unset($_SESSION['inscription']);
		echo "Inscription réussie.<br>Vous pouvez maintenant vous connecter avec vos identifiants.<br>";
		echo "<a href=\".?controller=user&action=connexion\" title=\"se connecter\"><div class=\"btn\">Se connecter</div></a>";
	}else{
		$errorController = new ErrorController();
		$errorController->error('Une erreur est survenue, veuillez réessayer plus tard');
	}
	?>
	
	</div>