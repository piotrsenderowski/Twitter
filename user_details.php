<?php

require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $newUser = new User();
    $newUser->loadFromDB($conn, $_GET['id']);
    $newUser->show();
    
    
    
    
    
    
}