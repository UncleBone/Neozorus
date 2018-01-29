<main id="parameters">
	
	<article>
		<section>
			<h3>Détails du compte</h3>
			<hr>
			<h4>Email</h4>
			<p><?= $mail ?> <span>[<a id="changeEmail" href=".?controller=parameters&action=changeEmail">Modifier</a>]<span></p>
			<br>
			<h4>Nom</h4>
			<p><?= $prenom . ' ' . $nom ?></p>
			<br>
			<h4>Pseudo</h4>
			<p><?= $pseudo ?> <span>[<a id="changePseudo" href=".?controller=parameters&action=changePseudo">Modifier</a>]<span></p>
			<br>
			<h4>Langue</h4>	
			<form>
				<select>
					<option>English</option>
					<option>Français</option>
				</select>
				<input type="submit" value="Changer langue">
			</form>	
			<br>
		</section>

		<section>
			<h3>Sécurité</h3>
			<hr>
			<h4>Mot de passe</h4>
			<p><span>[<a href=".?controller=parameters&action=changePassword">Modifier</a>]<span></p>
			<br>
			<h4>Question secrète</h4>
			<p><span>[<a href=".?controller=parameters&action=changeQuestion">Modifier</a>]<span></p>
			<br>
		</section>
	</article>
	
</main>