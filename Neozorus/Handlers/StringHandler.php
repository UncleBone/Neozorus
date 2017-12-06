<?php
/**
 * Classe qui comporte uniquement des methodes utilitaires pour tester des variables de type string
 * Toutes les methodes sont statiques, et renvoie un booleen
 */
class StringHandler{
	/**
	 * Verifie si un string est un mail
	 * @param  [string]  $mail string a tester
	 * @return boolean      
	 */
	static public function isValidEmail($mail){
		//On verifie si le string est vide
		if (!empty($mail)){
			//On verifie si l'email est standard
			if(preg_match('#^[a-z0-9\._-]+@[a-z0-9\._]{2,}\.[a-z]{2,4}$#', $mail)){
				//On verifie si  il est compris entre les bornes min et max
				if($valid =self::isStringIntervalValid($mail,5,60)){
					//Si tout est ok on retourne true
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}	
		}
		else{
			return false;
		}
	}

	/**
	 * Verifie si un string est composé uniquement de caracteres alpha, avec des tirets
	 * @param  [string]  $string string a tester
	 * @param  [int]  $min    taille minimale autorise du string
	 * @param  [int]  $max    taille maximale autorise du string
	 * @return boolean        
	 */
	static public function isAlpha($string,$min = 1,$max = 'infinite'){
		//On verifie si le string est vide
		if(!empty($string)){
			//On verifie si il n'y a que des lettres et/ou tirets
			if(preg_match('#^[A-Za-z-]+$#', $string)){
				//On verifie la taille
				if(self::isStringIntervalValid($string,$min,$max)){
					//Si tout est ok on retourne true
					return true;
				}
				return false;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	/**
	 * Verifie si un string est composé uniquement de caracteres alphanumeriques, avec des tirets
	 * @param  [string]  $string [description]
	 * @param  [int]  $min    taille minimale autorise du string
	 * @param  [int]  $max    taille maximale autorise du string
	 * @return boolean         
	 */
	static public function isAlphaNumeric($string,$min= 1,$max = 'infinite'){
		//On verifie si le string est vide
		if(!empty($string)){
			//On verifie si il n'y a que des lettres, chiffres et/ou tirets
			if(preg_match('#^[0-9A-Za-z_-]+$#', $string)){
				//On verifie la taille
				if(self::isStringIntervalValid($string,$min,$max)){
					//Si tout est ok on retourne true
					return true;
				}
				return false;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	/**
	 * Verifie si un string est compris entre une borne min et une borne max
	 * @param  [string]  $string string a tester
	 * @param  [int]  $min    taille minimale autorise du string, 1 par defaut
	 * @param  [int]  $max    taille maximale autorise du string, pas de borne MAX par defaut
	 * @return boolean         
	 */
	static public function isStringIntervalValid($string, $min= 1,$max = 'infinite'){
		if(self::isSuperiorOrEqualTo($string, $min) && self::isInferiorOrEqualTo($string, $max)){
			return true;
		}
		return false;
	}

	/**
	 * Verifie si le string est supérieur ou égal à un nombre donné
	 * @param  string  $string string a tester
	 * @param  int  $min    borne MIN
	 * @return boolean         
	 */
	static public function isSuperiorOrEqualTo($string, $min){
		if(strlen($string)<$min){
			return false;
		}
		return true;
	}

	/**
	 * Verifie si le string est inférieur ou égal à un nombre donné
	 * @param  [type]  $string string a tester
	 * @param  [type]  $max    borne MAX
	 * @return boolean        
	 */
	static public function isInferiorOrEqualTo($string, $max){
		if($max == 'infinite'){
			return true;
		}
		if(strlen($string)>$max){
			return false;
		}
		return true;
	}

	/**
	 * Verifie si une variable est vide ou non
	 * @param  string  $string string a tester
	 * @return boolean         
	 */
	static public function isEmpty($string){
		if(empty($string)){
			return true;
		}
		return false;
	}

	/**
	 * Verifie si un string est une question secrete ou non
	 * @param  [type]  $string string a tester
	 * @return boolean         
	 */
	static public function isQuestionValid($string){
		if(preg_match('#^[a-zA-Z0-9 "\'-]+\??$#', $string)){
			return true;
		}
		return false;
	}
}