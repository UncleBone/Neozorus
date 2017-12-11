<?php 
 if(isset($_SESSION['neozorus']['u_language']) && $_SESSION['neozorus']['u_language'] == 2){
 ?>

 <!-- ANGLAIS -->
<?php
if(isset($_SESSION['neozorus'])){
	echo '<a href="index.php?controller=home&action=affichagePageAccueil">Home</a>';
}
else{
	echo '<a href="index.php">Home</a>';
}
?>


<?php
}else{
?>

 <!-- FRANCAIS -->
<?php
if(isset($_SESSION['neozorus'])){
	echo '<a href="index.php?controller=home&action=affichagePageAccueil">Accueil</a>';
}
else{
	echo '<a href="index.php">Accueil</a>';
}
?>


<?php
}
?>