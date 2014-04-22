<?php

class ULS {
	//public $db;
	public $uid;

	/*public function __construct() {
		$this->db = new mysqli("localhost", "root", "k13ju357", "ogoBase") 
							or die ("Database error: connection failed");
		$this->db->set_charset("UTF8");
	}*/
	
	public function checkParams() {
		if (isset($_POST['login'])) {
			if (isset($_POST['userLogin']) && isset($_POST['userPass'])) {
				$ulogin = $_POST['userLogin'];
				$upass = $_POST['userPass'];
				$this->login($ulogin, $upass);
				header("Location: index.php");
			}
		} elseif (isset($_POST['logout'])) {
			setcookie("UID", "");
			header("Location: index.php");
		}
	}

	
	public function login ($uname, $upass) {
		$dataSet = array();
		$query = "SELECT `fsalt`
					FROM `ogo_users`
					WHERE `flogin` = '".$uname."'"
					." LIMIT 0, 1";
		//echo $query;
		$data = $this->db->query($query) 
					or die ("Database error: query failed ".$this->db->error);
		//var_dump($data);
		if ($data->num_rows > 0) {
			while ($record = $data->fetch_assoc()) {
				$dataSet[] = $record;
			}
		}
		//var_dump($dataSet);
		foreach ($dataSet as $rec) {
			$salt = $rec['fsalt'];
		}
		$upass = $salt.$upass;
		$query = "SELECT `fid`, `fname`
					FROM `ogo_users`
					WHERE `flogin` = '".$uname."'"
					." AND `fpassword` = md5(md5('{$upass}'))"
					." LIMIT 0, 1";
		$data = $this->db->query($query) 
					or die ("Database error: query failed ".$this->db->error);
		$dataSet = array();
		if ($data->num_rows > 0) {
			while ($record = $data->fetch_assoc()) {
				$dataSet[] = $record;
			}
		}
		if (!empty($dataSet)) {
			$userId = $dataSet[0]['fid'];
			$key = $this->generateKey();
			$UID = md5($salt.$key);
			//$UID = md5($key);
			setcookie("UID", $UID);
			$query = "UPDATE `ogo_users`
						SET `fkey` = '".$key."'"
						." WHERE `fid` = ".$userId;
			$result = $this->db->query($query) 
					or die ("Database error: INSERT failed ".$this->db->error);
		} else {
			echo "Не верный логин или пароль!<br>";
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
	
	public function checkUser() {
		$dataSet = null;
		if (isset($_COOKIE['UID'])) {
			$cookieKey = $_COOKIE['UID'];
			$query = "SELECT `fid`, `fname`
						FROM `ogo_users`
						WHERE md5(CONCAT(`fsalt`, `fkey`)) = '".$cookieKey."'"
						." LIMIT 0, 1";
			$data = $this->db->query($query)
				or die ("Database error: INSERT failed ".$this->db->error);
			if ($data->num_rows > 0) {
				while ($record = $data->fetch_assoc()) {
				$dataSet[] = $record;
				}
			}
			return $dataSet;
		}
	}

	public function showComments($uid=null) {
		$dataSet = null;
		$query = "SELECT * FROM `ogo_comments`
					ORDER BY `fid`
					LIMIT 0, 30";
		$data = $this->db->query($query)
					or die ("Database error: INSERT failed ".$this->db->error);
		if ($data->num_rows > 0) {
			while ($record = $data->fetch_assoc()) {
			$dataSet[] = $record;
			}
		}
		foreach ($dataSet as $value) {
			echo "<form action='delete.php' method='POST'>";
			echo "<input type='hidden' name='cid' value='{$value['fid']}'>";
			echo "ID=".$value['fid']." | ";
			if ($value['fauthor_id'] == $uid) {
				echo "<input type='submit' value='Delete'>";
			}
			echo "<br>".$value['ftext']."<br><br>";
			echo "</form>";
		}
	}

	public function deleteComment() {
		$data = $this->checkUser();
		$uid = $data[0]['fid'];
		$cid = $_POST['cid'];
		$query = "DELETE FROM `ogo_comments`
					WHERE `fid`=".$cid." AND `fauthor_id`=".$uid;
		$this->db->query($query)
				or die ("Database error: DELETE failed ".$this->db->error);
		header("Location: index.php");
		/*
		if ($this->db->affected_rows > 0) {
			echo "Удалено!";
		} else {
			echo "Нахер грязый нигер!";
		}*/
	}
}

?>
