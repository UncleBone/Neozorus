<?php
	$lang = 1 ;
	if(isset($_SESSION['neozorus']['u_language'])){
		$lang = $_SESSION['neozorus']['u_language'];
	}
	$linkTrad = $lang == 1 ? 'Accueil' : 'Home';
?>

<?php 
if(isset($_SESSION['neozorus'])){
	echo '<a href="index.php?controller=home&action=affichagePageAccueil">'.$linkTrad.'</a>';
}
else{
	echo '<a href="index.php">'.$linkTrad.'</a>';
}
?>


