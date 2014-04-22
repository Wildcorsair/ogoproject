<?php


if (isset($_SESSION['entered']) && isset($_SESSION['userName'])) {
	echo $_SESSION['entered'];
	echo $_SESSION['userName'];
} else {
	//$_SESSION['var'] = 1;
	echo "Session not started!";
}

?>