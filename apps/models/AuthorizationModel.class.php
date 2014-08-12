<?php

class AuthorizationModel extends BDatabase {
	public $tableName = "ogo_users";
	public $primaryKey = "fid";	

	public function getBackRoute() {
		var_dump($_POST['backRoute']);
		if (isset($_POST['backRoute'])) {
			return strip_tags(trim($_POST['backRoute']));
		} else {
			return "/";
		}
	}
	
	public function login() {
		if (isset($_POST['loginButton'])) {
			$login = $_POST['userEmail'];
			$email = $_POST['userEmail'];
			$password = $_POST['userPassword'];
			$this->checkUser($login, $email, $password);
		} else {
			echo "Fuck you dirty niger!";
		}
	}

	public function logout() {
		if (isset($_COOKIE['UID'])) {
			setcookie("UID", "", 0, "/");
		}
		$backRoute = $this->getBackRoute();
		header("Location: /{$backRoute}");
		exit();
	}

	public function checkUser($login, $email, $password) {
		$fields = array("fsalt");
		$condition = array("`flogin` = :s OR `fuserMail` = :s", array($login, $email));
		$data = $this->select($fields, $condition);
		if (!empty($data)) {
			$rec = $data[0];
			$fields = array("fid", "flogin", "fsalt", "fname", "fbanned", "factivation");
			$condition = array("(`flogin` = :s OR `fuserMail` = :s) AND `fpassword` = md5(md5(CONCAT(:s, :s)))",
						array($login, $email, $rec->fsalt, $password));
			$limit = "0, 1";
			$data = $this->select($fields, $condition, $limit);
			if (!empty($data)) {
				$rec = $data[0];
				if ($rec->factivation != 33) {
					header("Location: /error/message/12");
					exit;
				} else if ($rec->fbanned == 1) {
					header("Location: /error/message/13");
					exit;
				} else {
					$key = $this->generateKey();
					$UID = md5($rec->fsalt.$key);
					setcookie("UID", $UID, time()+3600, '/');
					
					$this->fkey = $key;
					$this->updateById($rec->fid);
					if (isset($_COOKIE['currRoute'])) {
						if (substr($_COOKIE['currRoute'], 0, 5) == 'error') {
							header("Location: /");
							exit;
						}
						$backRoute = $this->getBackRoute();
						header("Location: /{$backRoute}");
						exit();
					} else {
						header("Location: /");
						exit();
					}
				}
			} else {
				header("Location: /error/message/11");
				exit;
			}
		} else {
			header("Location: /error/message/11");
			exit;
		}
	}

	public function generateKey() {
		$a = array("az", "yb", "cx", "wd", "ev", "uf", "gt", "sh", "ir", "qj");
		$key = null;
		
		$tmp = rand(10000000, 99999999);
		$tmp .= rand(10000000, 99999999);
		
		$order = substr(time(), 9, 1);
		
		if ($order % 2 == 0) {
			for ($i = 0; $i < 16; $i++) {
				$key .= $tmp{$i}.$a[$tmp{$i}];
			}
		} else {
			for ($i = 15; $i >= 0; $i--) {
				$key .= $tmp{$i}.$a[$tmp{$i}];
			}
		}
		return $key;
	}
}
?>