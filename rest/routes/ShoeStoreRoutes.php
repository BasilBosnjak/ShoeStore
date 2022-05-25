<?php
require_once '../vendor/autoload.php';
require_once "dao/UserDao.class.php";

/**
 * @OA\Get(path="/users", tags={"todo"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all users from the API. ",
 *         @OA\Response( response=200, description="List of users.")
 * )
 */

Flight::register("userDao", "UserDao");

Flight::route('GET /users', function() {
  Flight::json(Flight::userDao()->get_all());
});

Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::userDao()->get_by_id($id));
});

Flight::route('POST /users', function(){
  Flight::json(Flight::userDao()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /users/@id', function($id){
  Flight::json(Flight::userDao()->update($id, Flight::request()->data->getData()));
});


Flight::route('DELETE /user/@id', function($id){
  Flight::json(Flight::userDao()->delete($id));
});

?>
