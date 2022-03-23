<?php
require_once '../vendor/autoload.php';
require_once "dao/ProjectDao.class.php";

Flight::register("shoeDao", "ProjectDao");

Flight::route('GET /shoes', function() {
  Flight::json(Flight::shoeDao()->get_all());
});

Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::shoeDao()->get_by_id($id));
});

Flight::route('POST /users', function(){
  Flight::json(Flight::shoeDao()->add(Flight::request()->data->getData()));
});



Flight::start();
?>
