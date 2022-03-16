<?php
require 'vendor/autoload.php';
require_once("rest/dao/ProjectDao.class.php");

Flight::route('/', function() {

  $dao = new ProjectDao();
  $users = $dao->get_all();
  print_r($users);
    echo "Creating a new branch!";
});

Flight::start();
?>
