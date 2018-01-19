<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$linkHomeTrad = $lang == 1 ? 'Accueil' : 'Home';
	$linkCardsTrad = $lang == 1 ? 'Les cartes' : 'Cards';
	$linkRulesTrad = $lang == 1 ? 'Règles du jeu' : 'Game\'s rules';
	$linkParametersTrad = $lang == 1 ? 'Paramètres' : 'Parameters';
	$linkDecoTrad = $lang == 1 ? 'Se déconnecter' : 'Deconnexion';
?>
<nav id="bloc_menu">
	<div><p>Menu</p>
		<ul id="menu">
			<a href=".?controller=home&action=affichagePageAccueil"><li><?= $linkHomeTrad ?></li>
			<a href=".?controller=carte&action=afficherCollectionCarte"><li><?=$linkCardsTrad?></li></a>
			<a href=".?controller=home&action=affichagePageRegles"><li><?=$linkRulesTrad?></li></a>
			<a href="#"><li>Forum</li></a>
			<?php
			if(isset($_SESSION['neozorus']['u_id'])){			
				echo '<a href=".?controller=parametersUser&action=affichageParametresUtilisateur"><li>'.$linkParametersTrad.'</li></a>';
				echo '<a href=".?controller=home&action=deconnexion"><li>'.$linkDecoTrad.'</li></a>';
			}
			?>
		</ul>
	</div>
</nav>
