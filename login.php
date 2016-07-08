<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'src/connection.php';
    require_once 'src/User.php';
    
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : null; //zabezpieczamy sie przed sql injection
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    
    if(strlen($email) >= 5 && strlen($password) > 0) {
        if($userId = User::logIn($conn, $email, $password)) {
            $_SESSION['loggedUserId'] = $userId;
            header("Location: index.php");
        }
        else {
            echo "Niepoprawne dane logowanie.<br>";
        }
        
    }
} 

?>

<html>
    <meta charset="utf-8">
    <head>
        
    </head>
    <body>
        <form method="POST">
            <fieldset>
                <label>
                    E-mail:<br>
                    <input type="text" name="email">
                </label>
                <br>
                <label>
                    Password:<br>
                    <input type="password" name="password">
                </label>
                <br>
            </fieldset>
            <br>
            <input type="submit" value="Login">
        </form>
        <br>
        <a href="register.php">Registration</a>
    </body>
</html>