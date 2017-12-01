<?php
if(isset($_SESSION['neozorus'])){
	echo '<a href="index.php?controller=home&action=affichagePageAccueil">Accueil</a>';
}
else{
	echo '<a href="index.php">Accueil</a>';
}
?>