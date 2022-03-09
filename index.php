<?php
require 'vendor/autoload.php';

Flight::route('/', function() {
    echo "Setup on the second machine";
});

Flight::start();
?>