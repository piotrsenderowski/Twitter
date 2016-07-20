<?php

require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';


if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $newTweet = new Tweet();
    $newTweet->loadFromDB($conn, $_GET['tweetId']);
    var_dump($newTweet);
    $newTweet->show();
    
    
    
    
    
    
}