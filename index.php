<meta charset="utf-8">
<?php

session_start();

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php"); // Przekierowanie do strony logowania
}

?>

Id użytkownika: <?php echo $_SESSION['loggedUserId']?>
<br>
<a href="logout.php">Logout</a>