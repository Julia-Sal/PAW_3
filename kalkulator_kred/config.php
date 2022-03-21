<?php
define('_SERVER_NAME', 'localhost:80');
define('_SERVER_URL', 'http://'._SERVER_NAME);
define('_APP_ROOT', '/kalkulator_kred');
define('_APP_URL', _SERVER_URL._APP_ROOT);
define("_ROOT_PATH", dirname(__FILE__));

<<<<<<< HEAD
?>
=======
function out(&$param){
	if (isset($param)){
		echo $param;
	}
}
?>
>>>>>>> fd83b69a30277a949bd52bcdea636d891448196f
