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
	<div class="cadre">
		<?php 
		if(isset($errorCode)){
			echo '<p class="errorCode">' . $errorCode . '</p>';
		}
		?>
		<p class="messageError"><?=$errorMessage?></p>
	</div>
</body>
</html>