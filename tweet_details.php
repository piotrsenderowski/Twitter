<?php

require_once dirname(__FILE__) . '/src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php");
}

$newTweet = new Tweet();
$newTweet->loadFromDB($conn, $_GET['tweetId']);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $userId = $_SESSION['loggedUserId'];
    $postId = $newTweet->getId();
    $creationDate = date('Y-m-d H-i-s');
    $commentText = isset($_POST['comment_text']) ? $conn->real_escape_string(trim($_POST['comment_text'])) : NULL;
    if(strlen($commentText) > 0) {
        if(strlen($commentText) <= 60) {
            $newComment = new Comment();
            $newComment->setUserId($userId);
            $newComment->setPostId($postId);
            $newComment->setCreationDate($creationDate);
            $newComment->setCommentText($commentText);
            $newComment->saveToDB($conn);
        }
        else {
            echo "<div class='alert alert-danger'>Your comment is too long. It cannot extend 60 characters.</div>";
        }
    }
    else {
        echo "<div class='alert alert-danger'>You cannot add empty comment.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Twitter</title>
</head>
<body>
    <div class="container">
        <?php
        $newTweet->show();

        $comments = $newTweet->getAllComments($conn);
        if(count($comments) == 0) {
            echo "No comments yet.<br><br>";
        }
        else {
            echo "<br>Comments made on Tweet: <br>";
            foreach($comments as $oneComment) {
                $oneComment->show();
            }
        }
        
        $conn->close();
        $conn = null;
        
        ?>
    </div>
    
    <div class="container">
        <form method="POST">
            <form method="POST">
            <fieldset>
                <label>Comment on this tweet:</label><br>
                <textarea name="comment_text" placeholder="Enter your comment here..." rows="2" cols="40" maxlength="60" autofocus></textarea><br>
                <input type="submit" class="btn btn-info" value="Add comment"/>
            </fieldset>
        </form>

        </form>
    </div>
 
</body>
</html>