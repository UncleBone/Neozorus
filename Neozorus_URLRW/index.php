<?php
session_start();

//session_destroy();
include('ini.php');
//Fonction d'autoload pour inclure nos classes, views, models et controllers
spl_autoload_register(function($className){
	$folder = CLASSES_PATH;
	$extension = CLASSES_EXTENSION;
	if (strpos($className, 'Controller') !== false) {
		$folder = CONTROLLERS_PATH;
		$extension = CONTROLLERS_EXTENSION;
	}
	else if (strpos($className, 'Model') !== false) {
		$folder = MODELS_PATH;
		$extension = MODELS_EXTENSION;
	}
	else if (strpos($className, 'Handler') !== false) {
		$folder = HANDLERS_PATH;
		$extension = HANDLERS_EXTENSION;
	}	
	$filename = $folder . DS . $className . $extension;
	if(file_exists($filename)){
		include($filename);
	}
});

try
{
	//On initialise nos paramètres avec un controller et un affichage par défaut
	$params = array('controller'=>'user','action'=>'connexionInscription');
	//On écrase les paramètres par défaut si on a des informations en GET
	$params = array_merge($params,$_GET);
	//On génère le nom du controller à appeler en fonction des paramètres
	$controllerName = ucfirst($params['controller']).'Controller';
	//On définit l'action en fonction des paramètres
	$action = $params['action'];
	//On teste l'existance du fichier controller, et si il existe on instancie notre controller
	if(file_exists(CONTROLLERS_PATH . DS . $controllerName . '.php')){	
		$controller = new $controllerName;
	}
	//Sinon on redirige l'utilisateur sur une page d'erreur
	else{
		$controller = new ErrorController();
		$controller -> error404();
	}
	//On entre nos parametres(GET) et nos données(POST) dans notre controleur.
	$controller->setParameters($_GET);
	$controller->setData($_POST);
	$controller->setSession(!empty($_SESSION['neozorus']) ? $_SESSION['neozorus'] : array());
	//On appelle la méthode correspondant à l'action
	if(method_exists($controller, $action)){	
		$controller->$action();
	}
	//Si la méthode n'existe pas, on redirige l'utilisateur sur une page d'erreur
	else{
		$controller = new ErrorController();
		$controller -> error404();
	}

}
catch(Exception $e)
{
	$controller = new ErrorController();
	$errorMssg = $e->getMessage().'<br><br>Fichier:'.$e->getFile().'<br><br>Ligne:'.$e->getLine().'<br><br>'.$e->getTraceAsString();
	// foreach ($e->getTrace() as $key => $value) {
	// 	$errorMssg .= $value.'<br>';
	// }
	$controller -> error($errorMssg);
}

