<?php

require_once dirname(__FILE__) . 'src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php");
}

echo "<a href='index.php'><button type='button' class='btn btn-success'>Back to main menu</button></a><br><br>";
echo "<button type='button' class='btn btn-success' onclick='goBack()'>Back to all users</button><br><br>";

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $newUser = new User();
    $newUser->loadFromDB($conn, $_GET['userId']);
    $newUser->show();
    if($_GET['userId'] !== $_SESSION['loggedUserId']) {
        echo "<a href='message_create.php?senderId={$_SESSION['loggedUserId']}&receiverId={$_GET['userId']}'><button type='button' class='btn btn-default'>Send message to this user</button></a><br><br>";
    }
    $tweets = $newUser->getAllTweets($conn);
    echo "<br><strong>List of all tweets from {$newUser->getFullName()}:</strong><br>";
    foreach($tweets as $oneTweet) {
        $oneTweet->show();
        $oneTweet->showLink();
        $commentsCount = count($oneTweet->getAllComments($conn));
        if($commentsCount === 0) {
            echo "<span class='badge' style='background-color:red'>$commentsCount</span> comments<br><br>";
        }
        else {
            echo "<span class='badge' style='background-color:green'>$commentsCount</span> comments<br><br>";
        }
    }
}

$conn->close();
$conn = null;

?>

