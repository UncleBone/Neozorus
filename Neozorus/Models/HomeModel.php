<?php

class HomeModel extends CoreModel{

	public function verifyUser($user){
		$sql = 'SELECT * FROM user WHERE u_id = '. $user['u_id'];
		if(!empty($results = $this->MakeSelect($sql))){
			$mydata = array();
			foreach ($results as $value) {
				$mydata[] = new User($value);
			}
			return $mydata[0];
		}else{
			return false;
		}	
	}
}