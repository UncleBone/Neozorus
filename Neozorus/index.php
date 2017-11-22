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
	if(file_exists(CONTROLLERS_PATH . DS . $controllerName . '.php')){	
		$controller = new $controllerName;
	}else{
		http_response_code(404);
	    include(VIEWS_PATH . DS . '404.php');
	    exit;
	}
	//On entre nos parametres(GET) et nos données(POST) dans notre controleur.
	$controller->setParameters($_GET);
	$controller->setData($_POST);
	$controller->setSession(!empty($_SESSION['neozorus']) ? $_SESSION['neozorus'] : array());
	//On appelle la méthode correspondant à l'action
	if(method_exists($controller, $action)){	
		$controller->$action();
	}else{
		http_response_code(404);
	    include(VIEWS_PATH . DS . '404.php');
	    exit;
	}

}
catch(Exception $e)
{
	echo 'Error! : ' . $e->getMessage();
}