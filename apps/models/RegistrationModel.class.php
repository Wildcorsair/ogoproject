<?php

class RegistrationModel extends BDatabase {
	
	public $tableName = "ogo_users";
	public $primaryKey = "fid";
	
	public function getSalt() {
		$chars = array('p', 'g', 'q', 'z', 'f', 'm', 's', 'k', 'v', 'r');
		$counter = (string)rand(100000000, 999999999);
		$salt = null;
		for ($i = 0; $i < strlen($counter); $i++) {
			$salt .= $chars[$counter{$i}].$counter{$i};
		}
		return $salt;
	}
		
	public function getHashPassword($password, $salt) {
		$hashPass = md5(md5($salt.$password));
		return $hashPass;
	}
	
	public function regUser() {
		$errorCode = null;
		if (isset($_POST['regUser'])) {		
			$login = strip_tags(trim($_POST['login']));
			$pass = strip_tags(trim($_POST['pass']));
			$passConfirm = strip_tags(trim($_POST['passConfirm']));
			$userMail = strip_tags(trim($_POST['userMail']));
			$name = strip_tags(trim($_POST['name']));
			$sex = intval($_POST['sex']);
			$city = strip_tags(trim($_POST['city']));

			if (empty($login)) {
				$errorCode = 1;
			} else if (empty($pass)) {
				$errorCode = 2;
			} else if (empty($passConfirm)) {
				$errorCode = 3;
			} else if (empty($userMail)) {
				$errorCode = 4;
			} else if (empty($name)) {
				$errorCode = 5;
			} else if ($pass !== $passConfirm) {
				$errorCode = 6;
			} else if (!$this->loginValidate($login)) {
				$errorCode = 10;
			} else if (!$this->emailValidate($userMail)) {
				$errorCode = 9;
			}
			
			//Проверяем не зарегистрирован ли уже такой пользователь и EMail
			
			$this->flogin = $login;
			$this->fuserMail = $userMail;
			$fields = array('fid', 'flogin', 'fuserMail');
			$con = array('`flogin` LIKE :s OR `fuserMail` LIKE :s', array($this->flogin, $this->fuserMail));
			$limit = array(0, 1);
			$data = $this->select($fields, $con, $limit);
			if (!empty($data)) {
				foreach ($data as $rec) {
					if ($rec->flogin == $login) {
						$errorCode = 7;
					} else if ($this->fuserMail == $userMail) {
						$errorCode = 8;
					}
				}
			}
			if (!is_null($errorCode)) {
				setcookie("login", $login);
				setcookie("pass", $pass);
				setcookie("passConfirm", $passConfirm);
				setcookie("userMail", $userMail);
				setcookie("name", $name);
				setcookie("sex", $sex);
				setcookie("city", $city);
				header("Location: /registration/index/".$errorCode);
				exit;
			} else {
				isset($_COOKIE["login"]) ? setcookie("login", "") : "";
				isset($_COOKIE["pass"]) ? setcookie("pass", "") : "";
				isset($_COOKIE["passConfirm"]) ? setcookie("passConfirm", "") : "";
				isset($_COOKIE["userMail"]) ? setcookie("userMail", "") : "";
				isset($_COOKIE["name"]) ? setcookie("name", "") : "";
				isset($_COOKIE["sex"]) ? setcookie("sex", "") : "";
				isset($_COOKIE["city"]) ? setcookie("city", "") : "";
				
				//	Добавление пользователя
				$salt = $this->getSalt();
				$hashPass = $this->getHashPassword($pass, $salt);
				
				$this->flogin = $login;
				$this->fpassword = $hashPass;
				$this->fsalt = $salt;
				$this->fuserMail = $userMail;
				$this->fname = $name;
				$this->fsex = $sex;
				$this->fgroup = 0;
				$this->fbanned = 0;
				$affectedRows = $this->insert();
				$this->sendMail($userMail, $salt);
			}
			if ($affectedRows == 1) {
				header("Location: /registration/confirm");
				exit;
			}
		} else {
			$this->tableName = "ogo_log";
			$this->faction = "Запуск скрипта из адресной строки";
			$this->insert();
			header("Location: /");
			exit;

		}
	}
	
	public function checkRegError($code) {
		$errorList = array(
							1=>"Не заполнено поле 'Логин'",
							2=>"Не заполнено поле 'Пароль'",
							3=>"Не заполнено поле 'Подтверждение пароля'",
							4=>"Не заполнено поле 'EMail-адрес'",
							5=>"Не заполнено поле 'Ваше имя'",
							6=>"Не совпадение паролей. 'Пароль' и 'подтверждение' должны совпадать",
							7=>"Такой логин уже занят",
							8=>"Такой EMail-адрес уже использовался при регистрации",
							9=>"Не корректный EMail-адрес",
							10=>"Не корректный Логин"
							);
		
		if(is_numeric($code)){
			if ($code > 0 && $code <= count($errorList)) {
				echo "<div id='show-error-msg'>";
				echo $errorList[$code];
				echo "</div>";
			}
		}
	}
	
	public function sendMail($userMail, $userCode) {
		$subject = "Регистрация на сайте ОГО!Лысянка";
		$message = "Для подтверждения регистрации на нашем сайте, активируйте Вашу учетную запись.\r\n"
					."Для этого пройдите по ссылке: "
					."http://ogo.project.ua/registration/activation/".$userCode;

		$headers = "From: ОГО!Лысянка <admin@acs-storm.eu5.org>\r\n"; 
		$headers .="Reply-To: admin@acs-storm.eu5.org";
		if (mail($userMail, $subject, $message, $headers)) {
			$this->tableName = "ogo_log";
			$this->faction = "Send message with activation link for ".$userMail;
			$this->insert();
		} else {
			$this->tableName = "ogo_log";
			$this->faction = "Sending message error for ".$userMail;
			$this->insert();
		}
	}

	/*public function emailValidate($email) {
		//"|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i"
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}*/

	public function loginValidate($login) {
		if (preg_match("|^[0-9a-z]{1,16}$|i", $login)) {
			return true;
		} else {
			return false;
		}
	}

	public function activation($activationCode) {
		$activationCode = strip_tags(trim($activationCode));
		if (!empty($activationCode)) {
			$this->factivation = "33";
			$this->fsalt = $activationCode;
			$affectedRows = $this->update();
		}
		if ($affectedRows == 1) {
			header("Location: /registration/complite");
			exit;
		} else {
			header("Location: /registration/error");
			exit;
		}
	}
}
?>
