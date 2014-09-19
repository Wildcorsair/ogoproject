<?php

class CpanelModel extends BDatabase {
	

	public function usersList() {
		$q = "SELECT `ogo_users`.`fid`,
						`flogin`,
						`fname`,
						`fuserMail`,
						`fcreateAccount`,
						`ogo_groups`.`fgroup_name`
				FROM `ogo_users`
				LEFT JOIN `ogo_groups` ON `ogo_users`.`fgroup_id` = `ogo_groups`.`fid`
				LIMIT 0, 50";
		$dataSet = $this->selectBySql($q);
		return $dataSet;
	}
}

?>