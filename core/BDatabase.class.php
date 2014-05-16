<?php
	include_once ("DataAccess.class.php");

	class BDatabase extends DataAccess {
		public $uid;
		/*public $db;
		
		public function __construct() {
			$host 		= "localhost";
			$user 		= "root";
			$password 	= "k13ju357";
			$dbName 	= "ogoBase";
			
			$this->db = new mysqli($host, $user, $password, $dbName) 
					or die("Database error: ". connect_error);
			$this->db->set_charset("UTF8");
		}
		
		public function __destruct() {
			$this->db->close();
		}*/

		public function __construct() {
			parent::__construct("localhost", "root", "k13ju357", "ogoBase");
		}

		public function dateConvert($dateString) {
			$month = array('01' => "января",
							'02' => "февраля",
							'03' => "марта",
							'04' => "апреля",
							'05' => "мая",
							'06' => "июня",
							'07' => "июля",
							'08' => "августа",
							'09' => "сентября",
							'10' => "октября",
							'11' => "ноября",
							'12' => "декабря");
			$extractedString = substr($dateString, 0, 10);
			$dateParts = explode("-", $extractedString);

			$dateParts[1] = $month[$dateParts[1]];
			return $dateParts;
		}

		public function getPopNews() {
			$data = null;
			$q = "SELECT 
					`ogo_news`.`fid`,
					`ogo_news`.`ftitle`,
					COUNT(`ogo_comments`.`fid`) AS `fcom_count` 
				FROM `ogo_news`
				LEFT JOIN `ogo_comments` ON `ogo_news`.`fid` = `ogo_comments`.`fnews_id`
				GROUP BY `ogo_news`.`fid`
				ORDER BY `fcom_count` DESC
				LIMIT 0, 3";
			$data = $this->selectBySql($q);
			return $data;
		}

		public function isAuthorized() {
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
}
?>
