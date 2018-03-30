<main id="parameters">
	
	<article>
		<section>
			<h3><?= $lang == 1 ? 'Détails du compte' : 'Account information' ?></h3>
			<hr>
			<h4>Email</h4>
			<p><?= $mail ?> <span>[<a id="changeEmail" href=".?controller=parameters&action=changeEmail">Modif<?= $lang == 1 ? 'ier' : 'y' ?></a>]<span></p>
			<br>
			<h4><?= $lang == 1 ? 'Nom' : 'Name' ?></h4>
			<p><?= $prenom . ' ' . $nom ?></p>
			<br>
			<h4><?= $lang == 1 ? 'Pseudo' : 'Username' ?></h4>
			<p><?= $pseudo ?> <span>[<a id="changePseudo" href=".?controller=parameters&action=changePseudo">Modif<?= $lang == 1 ? 'ier' : 'y' ?></a>]<span></p>
			<br>
			<h4><?= $lang == 1 ? 'Langue' : 'Language' ?></h4>	
			<form method="POST" action="">
				<select name="langue">
					<option value="1" <?= $lang == 1 ? 'selected' : '' ?>>Français</option>
					<option value="2" <?= $lang == 2 ? 'selected' : '' ?>>English</option>					
				</select>
				<input type="submit" value="<?= $lang == 1 ? 'Changer langue' : 'Change Language' ?>">
			</form>	
			<br>
		</section>

		<section>
			<h3><?= $lang == 1 ? 'Sécurité' : 'Security' ?></h3>
			<hr>
			<h4><?= $lang == 1 ? 'Mot de passe' : 'Password' ?></h4>
			<p><span>[<a href=".?controller=parameters&action=changePassword">Modif<?= $lang == 1 ? 'ier' : 'y' ?></a>]<span></p>
			<br>
			<h4><?= $lang == 1 ? 'Question secrète' : 'Secret Question' ?></h4>
			<p><span>[<a href=".?controller=parameters&action=changeQuestion">Modif<?= $lang == 1 ? 'ier' : 'y' ?></a>]<span></p>
			<br>
		</section>
	</article>
	
</main>