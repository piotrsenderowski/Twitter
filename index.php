<?php

require_once 'src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php"); // Przekierowanie do strony logowania
}

$loggedUser = new User();
$loggedUser->loadFromDB($conn,  $_SESSION['loggedUserId']);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userId = $_SESSION['loggedUserId'];
    $tweetText = isset($_POST['tweet_text']) ? $conn->real_escape_string(trim($_POST['tweet_text'])) : null;
    
    if(strlen($tweetText) > 0) {
        if(strlen($tweetText) <= 140) {
            $newTweet = new Tweet();
            $newTweet->setUserId($userId);
            $newTweet->setTweetText($tweetText);
            $newTweet->saveToDB($conn);
            //$newTweet->show(); 
        }
        else {
            echo "<div class='alert alert-danger'>Your Tweet is too long. It cannot extend 140 characters.</div>";
        }
    }
    else {
        echo "<div class='alert alert-danger'>You cannot add empty Tweet.</div>";
    }
}

//todo walidacja formularzy w jquery
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Twitter</title>
</head>
<body>
    <div class="container">
        <h1>Hello <?php echo "{$loggedUser->getFullName()}" ?>!</h1><p><a href="logout.php">Logout</a></p>    
        <a href="message_box.php"><button type="button" class="btn btn-success">Message box</button></a><br><br>    
        <a href="user_edit.php?userId=<?php echo "{$_SESSION['loggedUserId']}" ?>"><button type="button" class="btn btn-success">Edit user data</button></a><br><br>   
        <a href="user_details.php?userId=<?php echo "{$loggedUser->getId()}" ?>"><button type="button" class="btn btn-success">My details page</button></a><br><br>
        <a href="users.php"><button type="button" class="btn btn-success">See all users</button></a><br><br>
        <form method="POST" action="#">
            <fieldset>
                <label>Add new Tweet</label><br>
                <textarea name="tweet_text" placeholder="Enter your Tweet here..." rows="4" cols="40" autofocus maxlength="140"></textarea><br>
                <input type="submit" class="btn btn-info" value="Send Tweet"/>
            </fieldset>
        </form>
        
        <?php
        $tweets = $loggedUser->getAllTweets($conn);
        foreach($tweets as $oneTweet){
            $oneTweet->show();
            $oneTweet->showLink();
        }

        $conn->close();
        $conn = null;
        ?>
        
    </div>    
</body>
</html>