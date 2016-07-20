<?php
require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';

$newComment = new Comment();
$newComment->setUserId(3);
$newComment->setPostId(5);
$date = date('Y-m-d H:m:s');
$newComment->setCreationDate($date);
$newComment->setCommentText('Testowy komentarz');
var_dump($newComment);
$newComment->saveToDB($conn);
$newComment->loadFromDB($conn, 1);
var_dump($newComment);

$tweet = new Tweet();
$tweet->loadFromDB($conn, 5);

$comments = $tweet->getAllComments($conn);
$comments->show();
