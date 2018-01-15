<!DOCTYPE html>
<html>
<head>
	<title>Neozorus - Landing Page</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?= CSS_PATH . DS . 'landingPage.css' ?>">
	<meta name="viewport" content="width=device-width">
	<script type="text/javascript">
		var page = "<?= !empty($_GET['team']) ? htmlentities($_GET['team']) : 'noteam' ?>";
	</script>
	<script src='<?= JS_PATH . DS . 'landingPage.js' ?>'></script>
</head>

<body>

<?php 
	require(VIEW_PATH . DS . 'common.php');

	if(empty($_GET['team']) || (htmlentities($_GET['team']) != 'matrix' && htmlentities($_GET['team']) != 'dinos')){
		// echo '<script src="' . JS_PATH . DS . 'landingPageNoTeam.js"></script>';	
	}else{
		$team = htmlentities($_GET['team']);
		include(VIEW_PATH . DS . $team . '.php');
		// echo '<script src="' . JS_PATH . DS. 'landingPageTeam_'.$team.'.js" ></script>';
	}
?>

</body>
</html>
