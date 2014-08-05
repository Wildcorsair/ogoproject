<?php

class UserModel extends BDatabase {

	public $tableName = "ogo_users";
	public $primaryKey = "fid";
	
	public function userCheckPermissions($userId) {
		if(is_numeric($userId)) {
			$query = "SELECT `fperm_type` , gps.`fgroup_name`
						FROM `ogo_group_permissions` gp
						LEFT JOIN `ogo_groups` gps ON gp.`fgroup_id` = gps.`fid`
						LEFT JOIN `ogo_users` usr ON gps.`fid` = usr.`fgroup_id`
						WHERE usr.`fid` = :i
						LIMIT 0 , 30";
			$cond = array($userId);
			$dataSet = $this->selectBySql($query, $cond);
			return $dataSet;
		};
	}
}

?>