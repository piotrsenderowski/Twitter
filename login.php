<?php

require_once dirname(__FILE__) . 'src/common.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : null; //zabezpieczamy sie przed sql injection
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    
    if(strlen($email) >= 0 && strlen($password) > 0) {
        if($userId = User::logIn($conn, $email, $password)) {
            $_SESSION['loggedUserId'] = $userId;
            header("Location: index.php");
        }
        else {
            echo "Niepoprawne dane logowanie.<br>";
        }
    }

} 

$conn->close();
$conn = null;

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
                    <input type="text" name="email" autofocus>
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