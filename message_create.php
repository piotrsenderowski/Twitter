<?php

require_once dirname(__FILE__) . '/src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php"); // Przekierowanie do strony logowania
}


$senderId = (int)$_GET['senderId'];
$receiverId = (int)$_GET['receiverId'];
$newMessage = new Message();
$newMessage->setSenderId($senderId);
$newMessage->setReceiverId($receiverId);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $messageText = isset($_POST['message_text']) ? $conn->real_escape_string(trim($_POST['message_text'])) : '';
    $sendDate = date('Y-m-d H:i:s');
    if(strlen($messageText) > 0) {
        $messageStatus = 1;
        $newMessage->setMessageText($messageText);
        $newMessage->setMessageStatus($messageStatus);
        $newMessage->setSendDate($sendDate);
        $newMessage->saveToDB($conn);
        header("Location: message_info.php?messageId={$newMessage->getId()}");
        //header("Location: messages.php?senderId={$_SESSION['loggedUserId']}&receiverId={$newMessage->getReceiverId()}");
    }
    else {
        echo "<div class='alert alert-danger'>You cannot send empty message.</div>";
    }
}

$newUser = new User();
$newUser->loadFromDB($conn, $_GET['receiverId']);
?>

<form method="POST">
    <fieldset>
        <label>Send a message to <?php echo "{$newUser->getFullName()}"; ?>:</label><br>
        <textarea name="message_text" placeholder="Enter your message here..." rows="4" cols="50" autofocus></textarea><br>
        <input type="submit" class="btn btn-success" value="Send message"/>
    </fieldset>
</form>

<button type='button' class='btn btn-success' onclick='goBack()'>Back to user details</button><br><br>
<a href='index.php'><button type='button' class='btn btn-success'>Back to main menu</button></a><br><br>

<?php

$conn->close();
$conn = null;

?>