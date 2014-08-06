<?php

class UserModel extends BDatabase {

	public $tableName = "ogo_users";
	public $primaryKey = "fid";
	
	public function getAuthorizedUserData() {
		$dataSet = null;
		if (isset($_COOKIE['UID'])) {
			$cookieKey = $_COOKIE['UID'];
			$query = "SELECT `fid`, `fname`
						FROM `ogo_users`
						WHERE md5(CONCAT(`fsalt`, `fkey`)) = :s
						LIMIT 0, 1";
			$args = array($cookieKey);
			$dataSet = $this->selectBySql($query, $args);
			$userData = $dataSet[0];
			return $userData;
		}
	}
	
	public function userCheckPermissions($permission, $userId) {
		if(is_numeric($userId)) {
			$query = "SELECT `fperm_type` , gps.`fgroup_name`
						FROM `ogo_group_permissions` gp
						LEFT JOIN `ogo_groups` gps ON gp.`fgroup_id` = gps.`fid`
						LEFT JOIN `ogo_users` usr ON gps.`fid` = usr.`fgroup_id`
						WHERE usr.`fid` = :i AND gp.`fperm_type` = :s
						LIMIT 0 , 1";
			$cond = array($userId, $permission);
			$dataSet = $this->selectBySql($query, $cond);
			if (!empty($dataSet) && $dataSet[0]->fperm_type === $permission) {
				return true;
			} else {
				return false;	
			}
		} 
		return false;
	}
}

?>