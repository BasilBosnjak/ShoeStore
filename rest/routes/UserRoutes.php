<?php

Flight::route('GET /users', function() {
  Flight::json(Flight::userService()->get_all());
});

Flight::route('GET /users/@id', function($id){
  Flight::json(Flight::userService()->get_by_id($id));
});

Flight::route('POST /users', function(){
  Flight::json(Flight::userService()->add(Flight::request()->data->getData()));
});

Flight::route('PUT /users/@id', function($id){
  Flight::json(Flight::userService()->update($id, Flight::request()->data->getData()));
});


Flight::route('DELETE /user/@id', function($id){
  Flight::json(Flight::userService()->delete($id));
});

?>
