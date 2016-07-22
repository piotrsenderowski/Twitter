<?php
require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/Message.php';
var_dump(dirname(__FILE__));
/*
$newMessage = new Message();
$newMessage->setSenderId(1);
$newMessage->setReceiverId(2);
$newMessage->setMessageText('Przykładowa treść wiadomości');
$newMessage->setMessageStatus(0);
$sendDate = date('Y-m-d H:m:s');
$newMessage->setSendDate($sendDate);
var_dump($newMessage);
$newMessage->setMessageStatus(1);
var_dump($newMessage);

$new = $newMessage->saveToDB($conn); //insert
var_dump($new); //true
$newMessage->loadFromDB($conn, 7);
$newMessage->setMessageStatus(0);
$newMessage->saveToDB($conn); //update
$new2 = $newMessage->saveToDB($conn);//update
var_dump($new2); //
var_dump($newMessage); //false
//$newMessage->loadFromDB($conn, $id);

//var_dump($newMessage);
//
//$user = new User();
//$user->loadFromDB($conn, 5);
//$messages = $user->getAllReceivedMessages($conn);
//foreach($messages as $oneMessage) {
//    $oneMessage->show();
//    echo "<br>";
//}
//$messages = Message::getAllMessagesBySenderId($conn, 3);
//foreach($messages as $oneMessage) {
//    $oneMessage->show();
//    echo "<br>";
//}
//
//    $sendDate = date('Y-m-d H:m:s');
//    var_dump($sendDate);
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
