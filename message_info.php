<?php

require_once 'src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['messageId'])) {
        $newMessage = new Message();
        $newMessage->loadFromDB($conn, (int)$_GET['messageId']);
        if($newMessage->getMessageStatus() == 1 && $_SESSION['loggedUserId'] == $newMessage->getReceiverId()) {
            $newMessage->setMessageStatus(0);
            $newMessage->saveToDB($conn);
        }
        echo "<strong>Message details: </strong><br>";
        echo "<table><tr><th>Sender</th><th>Recipient</th><th>Date received</th><th>Content</th></tr>";
        $newMessage->show();
        echo "</table><br>";
    }
}

echo "<a href='index.php'><button type='button' class='btn btn-success'>Back to main page</button></a><br><br>";

$conn->close();
$conn = null;

?>