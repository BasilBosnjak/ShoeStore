<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::userDao()->get_user_by_email($login['email']);
    if (isset($user['id'])){
      if($user['password'] == $login['password']){
        unset($user['password']);
        $user['iat'] = time();
        $user['exp'] = $user['iat']+10;
        $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
        Flight::json(['token' => $jwt]);
      }else{
        Flight::json(["message" => "Wrong password"], 404);
      }
    }else{
      Flight::json(["message" => "User doesn't exist"], 404);
    }
  });

Flight::route('DELETE /user/@id', function($id){
  Flight::json(Flight::userService()->delete($id));
});

?>
