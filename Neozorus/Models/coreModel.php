<?php

class CoreModel{
	private static $pdo = NULL;//Notre objet PDO

    //La fonction __construct nous retourne notre objet PDO si il existe deja , sinon , il nous le crée
	public function __construct(){
		if(self::$pdo == NULL){
			self::$pdo = new PDO ('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$pdo;		
	}

    //Permet une requete de type DROP,INSERT,UPDATE
	protected function makeStatement($sql, $params = array())
    {
        if(count($params) == 0)
        {
            $statement = self::$pdo->query($sql);
        }
        else
        {
            if(($statement = self::$pdo->prepare($sql)) !== false)
            {
                foreach ($params as $placeholder => $value)
                {
                    switch(gettype($value))
                    {
                        case "integer":
                            $type = PDO::PARAM_INT;
                            break;

                        case "boolean":
                            $type = PDO::PARAM_BOOL;
                            break;

                        case "NULL":
                            $type = PDO::PARAM_NULL;
                            break;

                        default:
                            $type = PDO::PARAM_STR;
                    }
                    if($statement->bindValue($placeholder, $value, $type) === false)
                        return false;
                }
                if(!$statement->execute())
                {
                    return false;
                }
            }
        }

        return $statement;
    }

    /**
     * @param string $sql Your SELECT query
     * @param array $params An associative array with form : 'placeholder' => $value
     * @param int $fetchStyle
     * @param mixed $fetchArg
     * @return array|bool An array containing all result lines or false if an error occurred
     * @throws PDOException (Depending on PDO Config)
     */
    //Permet les requetes de type SELECT
    protected function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL)
    {
        $statement = $this->makeStatement($sql, $params);

        if($statement === false)
        {
            return false;
        }

        $data = is_null($fetchArg) ? $statement->fetchAll($fetchStyle) : $statement->fetchAll($fetchStyle, $fetchArg);
        $statement->closeCursor();

        return $data;
    }
}