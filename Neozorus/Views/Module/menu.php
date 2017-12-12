<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$linkCardsTrad = $lang == 1 ? 'Les cartes' : 'The Cards';
	$linkRulesTrad = $lang == 1 ? 'Regles du jeu' : 'Game\'s rules';
	$linkParametersTrad = $lang == 1 ? 'Parametres' : 'Parameters';
	$linkDecoTrad = $lang == 1 ? 'Se deconnecter' : 'Deconnexion';
?>
<div class="bloc_menu">
	<ul id="menu_jouer">
		<li><a href="#">Menu</a>
			<ul id="menu">
				<li><?php include(ACCEUIL) ?></li>
				<li><a href="index.php?controller=carte&action=afficherCollectionCarte"><?=$linkCardsTrad?></a></li>
				<li><a href="index.php?controller=home&action=affichagePageRegles"><?=$linkRulesTrad?></a></li>
				<li><a href="#">Forum</a></li>
				<?php
				if(isset($_SESSION['neozorus'])){			
					echo '<li><a href="index.php?controller=parametersUser&action=affichageParametresUtilisateur">'.$linkParametersTrad.'</a></li>';
					echo '<li><a href="index.php?controller=home&action=deconnexion">'.$linkDecoTrad.'</a></li>';
				}
				?>
			</ul>
		</li>
	</ul>
</div>
