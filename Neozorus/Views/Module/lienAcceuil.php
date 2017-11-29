<?php
if(isset($_SESSION['neozorus'])){
	echo '<a href="index.php?controller=home&action=affichagePageAccueil">Acceuil</a>';
}
else{
	echo '<a href="index.php">Acceuil</a>';
}
?>