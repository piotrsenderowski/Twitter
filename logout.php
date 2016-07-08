<?php

session_start();

if(isset($_SESSION['loggedUserId'])) {
    unset($_SERVER['loggedUserId']);
}
header("Location: index.php");
