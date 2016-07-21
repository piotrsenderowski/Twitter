<?php
require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/Message.php';
require_once 'src/bootstrap.html';

session_start();

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php");
}

echo "<a href='index.php'><button type='button' class='btn btn-success'>Back to main menu</button></a><br><br>";

$active = 1;
$users = User::getUsersByActive($conn, $active);
foreach($users as $oneUser) {
    $oneUser->showWithLink();
}
