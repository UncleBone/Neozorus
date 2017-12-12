<!DOCTYPE html>
<html>
<head>
	<title><?=$titre?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="./assets/css/Error.css">
</head>
<body>
	<?php include(MENU) ?>
	<div id="cadre">
		<p class="messageError"><?=$errorMessage?></p>
		<p class="messageError">Cette page n'existe pas ni dans la matrice, ni à l'ère mésozoïque.</p>
	</div>
</body>
</html>