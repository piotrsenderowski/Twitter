<?php
require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/Message.php';

$newMessage = new Message();
$newMessage->setSenderId(4);
$newMessage->setReceiverId(3);
$newMessage->setMessageText('Przykładowa treść wiadomości');
$newMessage->setMessageStatus(0);
var_dump($newMessage);
$newMessage->saveToDB($conn);
var_dump($newMessage);

$user = new User();
$user->loadFromDB($conn, 5);
$messages = $user->getAllReceivedMessages($conn);
foreach($messages as $oneMessage) {
    $oneMessage->show();
    echo "<br>";
}
$messages = Message::getAllMessagesBySenderId($conn, 3);
foreach($messages as $oneMessage) {
    $oneMessage->show();
    echo "<br>";
}

//$newComment = new Comment();
//$newComment->setUserId(3);
//$newComment->setPostId(5);
//$date = date('Y-m-d H:m:s');
//$newComment->setCreationDate($date);
//$newComment->setCommentText('Testowy komentarz');
//var_dump($newComment);
//$newComment->saveToDB($conn);
//$newComment->loadFromDB($conn, 1);
//var_dump($newComment);
//
//$tweet = new Tweet();
//$tweet->loadFromDB($conn, 5);
//
//$comments = $tweet->getAllComments($conn);
//$comments->show();
