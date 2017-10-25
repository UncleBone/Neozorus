	<form method="POST" id="inscription" action=".?controller=user&action=traitementInscription">
		<a href="." title="retour"><div class="back"></div></a>

		<input type="text" name="prenom" placeholder="Prénom" value=<?= !empty($param['prenom']) ? "\"".$param['prenom']."\"" : "";?> >
		<input type="text" name="nom" placeholder="Nom" value=<?= !empty($param['nom']) ? "\"".$param['nom']."\"" : "";?> >

		<input type="date" name="date_naissance" placeholder="Date de naissance (jj/mm/aaaa)" value=<?= !empty($param['date_naissance']) ? "\"".$param['date_naissance']."\"" : "";?> >

		<input type="email" name="mail" placeholder="E-mail" value=<?= !empty($param['mail']) ? "\"".$param['mail']."\"" : "";?>>

		<input type="email" name="confirm_mail" placeholder="Confirmer E-mail" value=<?= !empty($param['confirm_mail']) ? "\"".$param['confirm_mail']."\"" : "";?>><br>

		<input type="password" name="mdp" placeholder="Mot de passe" value=<?= !empty($param['mdp']) ? "\"".$param['mdp']."\"" : "";?>>

		<input type="password" name="confirm_mdp" placeholder="Confirmer mot de passe"  value=<?= !empty($param['confirm_mdp']) ? "\"".$param['confirm_mdp']."\"" : "";?>>
		<input type="text" name="question" placeholder="Question secrète" value=<?= !empty($param['question']) ? "\"".$param['question']."\"" : "";?> >

		<input type="text" name="reponse" placeholder="Réponse secrète" value=<?= !empty($param['reponse']) ? "\"".$param['reponse']."\"" : "";?>>

		<input type="checkbox" name="actu" placeholder="actu" <?= !empty($param['actu']) ? 'checked' : "";?>><label>Recevoir les actualités et des offres spéciales (optionnel)</label><br>

		<input type="checkbox" name="accepter" placeholder="accepter" <?= !empty($param['accepter']) ? 'checked' : "";?>><label>J'accepte les conditions d'utilisation</label>

		<input id="creer" type="submit" value="Créer un compte (gratuit)">

	</form>

	<?php
	if(!empty($error)){
		echo "<div class=\"error\"><p>";
		echo $errorMessage;
		echo "</p></div>";
	}
	?>