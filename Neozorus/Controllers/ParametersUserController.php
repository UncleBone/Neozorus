<?php
class ParametersUserController extends CoreController{
	private $user;

	public function __construct(){
		$this->isSessionNeozorus();
		$this->getDataUser();
	}

	public function affichageParametresUtilisateur(){
		include(VIEWS_PATH . DS . 'ParametersUser' . DS . 'ParametersUserView.php');
	}

	private function getDataUser(){
		try{
			$model = new ParametersUserModel();
			$user = $model -> getDataUserDB($_SESSION['neozorus']['u_id']);
			$this->user = $user;
		}
		catch(Exception $e){
			$controller = new ErrorController();
			$controller->error($e->getMessage());
		}
	}

	public function changeDataUser(){	
		$model = new ParametersUserModel();
		$changeOn = null;
		$myChange = null;
		$user= $this->data['u_id'];
		if(!empty($this->data['newPseudo'])){
			$changeOn = 'u_pseudo';
			$myChange = $this->data['newPseudo'];
			if($model->makeChange($user,$changeOn, $myChange)){
				echo json_encode(array('newPseudo'=>$this->data['newPseudo']));
			}
		}
		else if(!empty($this->data['newNom'])){
			$changeOn = 'u_nom';
			$myChange = $this->data['newNom'];
			if($model->makeChange($user,$changeOn, $myChange)){
				echo json_encode(array('newNom'=>$this->data['newNom']));
			}
		}
		else if(!empty($this->data['newPrenom'])){
			$changeOn = 'u_prenom';
			$myChange = $this->data['newPrenom'];
			if($model->makeChange($user,$changeOn, $myChange)){
				echo json_encode(array('newPrenom'=>$this->data['newPrenom']));
			}
		}
		else if(!empty($this->data['newMail'])){
			if(!$model->issetMailDB($this->data['newMail'])){
				$changeOn = 'u_mail';
				$myChange = $this->data['newMail'];
				if($model->makeChange($user,$changeOn, $myChange)){
					echo json_encode(array('newMail'=>$this->data['newMail']));
				}
			}
			else{
				echo json_encode(array('newMail'=>$this->data['newMail'],'error'=>1));
			}
		}
	}
}