<?php
require 'vendor/autoload.php';

Flight::route('/', function() {
    echo "Creating a new branch!";
});

Flight::start();
?>
