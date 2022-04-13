<?php
require_once '../vendor/autoload.php';
require_once "dao/UserDao.class.php";

require_once "services/UserService.class.php";

Flight::register("userService", "UserService");



require_once "routes/UserRoutes.php";


Flight::start();
?>
