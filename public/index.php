<?php
define("SERVER_NAME", $_SERVER['SERVER_NAME']);
define("ROOT_DIR", str_replace(array('/public', '\public'), array('', ''), dirname(__FILE__)));
define("APP_DIR", ROOT_DIR . '/app');

include_once('../app/views/includes/header.php');
include_once('../app/views/clients.php');
include_once('../app/views/includes/footer.php');