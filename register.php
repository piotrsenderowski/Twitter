<?php

require_once dirname(__FILE__) . 'src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : null;
    $password = isset($_POST['password']) ? $conn->real_escape_string(trim($_POST['password'])) : null;
    $passwordConfirmation = isset($_POST['passwordConfirmation']) ? trim($_POST['passwordConfirmation']) : null;
    $fullName = isset($_POST['fullName']) ? $conn->real_escape_string(trim($_POST['fullName'])) : null;
    
    $user = User::getUserByEmail($conn, $email);
    if($email && $password && $password == $passwordConfirmation && !$user) {
        
        $newUser = new User();
        $newUser->setEmail($email);
        $newUser->setHashedPassword($password);
        $newUser->setFullName($fullName);
        $newUser->setActive(1);
        if($newUser->saveToDB($conn)) {
            $_SESSION['loggedUserId'] = $newUser->getId();
            header("Location: index.php");
        }
        else {
            echo "Registration failed.<br>";
        }
    }
    else {
        if($user) {
            echo "This e-mail is already in use.<br>";
        }
        else {
            echo "Data entered is incorrect.<br>";
        }
    }
    $conn->close();
    $conn = null;
}
?>

<html>
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
                <label>
                    Password confirmation:<br>
                    <input type="password" name="passwordConfirmation">
                </label>
                <br>
                <label>
                    Full name:<br>
                    <input type="text" name="fullName">
                </label>
            </fieldset>
            <br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>