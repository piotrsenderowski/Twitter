<?php

require_once 'src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php");
}

$active = 1;
$users = User::getUsersByActive($conn, $active);
foreach($users as $oneUser) {
    $oneUser->showWithLink();
}

echo "<a href='index.php'><button type='button' class='btn btn-success'>Back to main menu</button></a><br><br>";

$conn->close();
$conn = null;

?>