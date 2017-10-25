<?php
class HeroModel extends CoreModel{
	public function GetListHeros(){
		$Heros=array();
		$sql = 'SELECT p_id, p_libelle, p_pvMax FROM personnage ORDER BY p_id DESC';
		$datas=$this->MakeSelect($sql);
		foreach ($datas as  $data) {
			$Heros[]=new Hero ($data);
		}
		return $Heros;
	}
}