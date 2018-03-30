<?php
define('PREFIX',substr($_SERVER['PHP_SELF'],0,-10));
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

//Parametres de connexion à la BDD
define('DB_HOST', 'localhost');
define('DB_NAME', 'neozorus');
define('DB_USER', 'root');
define('DB_PASS','');

//Chemins d'accès aux données
define('IMG_PATH', PREFIX . DS . 'assets' . DS . 'img');
// define('CSS_PATH', 'assets' . DS . 'css');
define('CSS_PATH', PREFIX . DS . 'assets' . DS . 'css');
define('JS_PATH', PREFIX . DS . 'assets' . DS . 'js');

//Acces aux Gabarits des cartes
define('GABARIT_PATH', IMG_PATH . DS . 'gabarit');
// define('COMMON_PATH','.' . DS .'assets' . DS . 'img' . DS . 'gabarit');
// define('CREATURE_PATH', COMMON_PATH . DS . 'creature');
// define('HERO_PATH', COMMON_PATH . DS . 'personnage');
// define('SORT_PATH', COMMON_PATH . DS . 'sort');
// define('SPECIAL_PATH', COMMON_PATH . DS . 'speciale');

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

//Constante acces Module Favicon
define('FAVICON', '.' . DS . 'Views' . DS . 'Module' . DS .'favicon.php');

//Constante des tailles des differents types de string
define('PSEUDO_MIN',1);
define('PSEUDO_MAX',60);

define('NOM_MIN',2);
define('NOM_MAX',60);

define('PRENOM_MIN',2);
define('PRENOM_MAX',60);

define('MAIL_MIN',5);
define('MAIL_MAX',60);

define('PASSWORD_MIN',5);
define('PASSWORD_MAX',60);

define('DECK_NAME_MIN',1);
define('DECK_NAME_MAX',16);

define('QUESTION_MIN',1);
define('QUESTION_MAX',255);

define('ANSWER_MIN',1);
define('ANSWER_MAX',255);