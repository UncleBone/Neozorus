<?php
//Constante à modifier pour l'autoload
define('DS',DIRECTORY_SEPARATOR);
define('CLASSES_PATH', 'assets' . DS . 'classes');
define('CLASSES_EXTENSION', '.class.php');
define('CONTROLLERS_PATH', 'Controllers');
define('CONTROLLERS_EXTENSION', '.php');
define('MODELS_PATH', 'Models');
define('MODELS_EXTENSION', '.php');
define('HANDLERS_PATH', 'Handlers');
define('HANDLERS_EXTENSION', '.php');
define('VIEWS_PATH', 'Views');

//Chemins d'accès aux données
define('IMG_PATH', 'assets' . DS . 'img');
define('CSS_PATH', 'assets' . DS . 'css');
define('JS_PATH', 'assets' . DS . 'js');

//Parametres de connexion à la BDD
define('DB_HOST', 'localhost');
define('DB_NAME', 'neozorus');
define('DB_USER', 'root');
define('DB_PASS','');

//Acces aux Gabarits des cartes
define('COMMON_PATH','.' . DS .'assets' . DS . 'img' . DS . 'gabarit');
define('CREATURE_PATH', COMMON_PATH . DS . 'creature');
define('HERO_PATH', COMMON_PATH . DS . 'personnage');
define('SORT_PATH', COMMON_PATH . DS . 'sort');
define('SPECIAL_PATH', COMMON_PATH . DS . 'speciale');

//Constante de Deck
define('NB_MAX_CARTE', 20);

//Constante de Carte
define('Nb_EXEMPLAIRE_CREATURE', 2);
define('Nb_EXEMPLAIRE_SORT', 1);
define('Nb_EXEMPLAIRE_SPECIALE', 1);

//Constante acces Module Menu Deroulant
define('MENU', '.' . DS . 'Views' . DS . 'Module' . DS .'menu.php');

//Constante acces Module Lien Acceuil
define('ACCEUIL', '.' . DS . 'Views' . DS . 'Module' . DS .'lienAcceuil.php');

//Constante vue des erreurs
define('VIEW_ERROR', VIEWS_PATH . DS . 'Error' . DS . 'Error.php');

//Constante des tailles des differents types de string
define('PSEUDO_MIN',1);
define('PSEUDO_MAX',60);

define('NOM_MIN',2);
define('NOM_MAX',60);

define('PRENOM_MIN',2);
define('PRENOM_MAX',60);

define('MAIL_MIN',5);
define('MAIL_MAX',60);