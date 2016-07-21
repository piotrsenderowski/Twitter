<?php

require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/Message.php';
require_once 'src/bootstrap.html';

session_start();

if(!$_SESSION['loggedUserId']) {
    Header("Location: login.php");
}

echo "<a href='index.php'><button type='button' class='btn btn-success'>Back to main menu</button></a><br><br>";

$receivedMessages = Message::getAllMessagesByReceiverId($conn, $_SESSION['loggedUserId']);
echo "<strong>Received messages:</strong><br>";
echo "<table><tr><th>Sender</th><th>Date received</th><th>Content</th></tr>";
foreach($receivedMessages as $oneReceivedMessage) {
    $oneReceivedMessage->showInbox();
}
echo "</table><br>";

$sentMessages = Message::getAllMessagesBySenderId($conn, $_SESSION['loggedUserId']);
echo "<strong>Sent messages:</strong><br>";
echo "<table><tr><th>Recipient</th><th>Date sent</th><th>Content</th></tr>";
foreach($sentMessages as $oneSentMessage) {
    $oneSentMessage->showOutbox();
}
echo "</table><br>";




