<?php

require_once dirname(__FILE__) . 'src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if($_SESSION['loggedUserId'] == $_GET['userId']) {
        $newUser = new User();
        $newUser->loadFromDB($conn, $_GET['userId']);
        $newUser->show();
    }
    else {
        echo "<div class='alert alert-danger'>Nie możesz edytować danych innego użytkownika</div>";
    }
    echo "<br><br>";
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_SESSION['loggedUserId'] == $_GET['userId']) {
        $userId = $_GET['userId'];
        $newPassword = isset($_POST['new_password']) ? $conn->real_escape_string(trim($_POST['new_password'])) : null;
        $newPassword2 = isset($_POST['new_password2']) ? trim($_POST['new_password2']) : null;
        $oldPassword = isset($_POST['old_password']) ? $conn->real_escape_string(trim($_POST['old_password'])) : null;
        $newFullName = isset($_POST['new_full_name']) ? $conn->real_escape_string($_POST['new_full_name']) : null;
        
        $newUser = new User();
        $newUser->loadFromDB($conn, $userId);
        
        if((strlen($newPassword) > 0 && strlen($newPassword2) > 0 && $newPassword === $newPassword2) && strlen($newFullName) > 0) {
            if(($newUser->changePassword($conn, $userId, $oldPassword, $newPassword)) && ($newUser->changeFullName($conn, $userId, $newFullName))) {
                echo "All new data have been set successfuly.";
            }
        }
        elseif((strlen($newPassword) > 0 && strlen($newPassword2) > 0 && $newPassword === $newPassword2) && strlen($newFullName) === 0) {
            if($newUser->changePassword($conn, $userId, $oldPassword, $newPassword)) {
                echo "New password has been set successfuly.";
            }
        }
        elseif((strlen($newPassword) === 0 && strlen($newPassword2) === 0 && $newPassword === $newPassword2) && strlen($newFullName) > 0) {
            if($newUser->changeFullName($conn, $userId, $newFullName)) {
                echo "New user name has been set successfuly.";
            }
        }
        else {
            echo "Something went wrong. Please try again.";
        }
    }
}

$conn->close();
$conn = null;

?>

<form method="POST" action="#">
    <fieldset>
        <label>New password: </label>
        <input type="password" name="new_password" placeholder="Enter your new password here..."/><br>
        <label>Re-enter new password: </label>
        <input type="password" name="new_password2" placeholder="Enter your new password here..."/><br>
        <label>Old password: </label>
        <input type="password" name="old_password" placeholder="Enter your old password here..."/><br>
        <label>New name: </label>
        <input type="text" name="new_full_name" placeholder="Enter your new user name here..."/><br>
        <input type="submit" class="btn btn-info" value="Zapisz nowe dane!"/>
    </fieldset>
</form>
<button type='button' class='btn btn-success' onclick='goBack()'>Back to user details</button><br><br>
    
    
    
    
