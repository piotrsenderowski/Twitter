<?php

require_once 'src/common.php';

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php"); // Przekierowanie do strony logowania
}


$senderId = (int)$_GET['senderId'];
$receiverId = (int)$_GET['receiverId'];
$newMessage = new Message();
$newMessage->setSenderId($senderId);
$newMessage->setReceiverId($receiverId);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $messageText = $_POST['message_text'];
    $messageStatus = 1;
    $sendDate = date('Y-m-d H:m:s');
    $newMessage->setMessageText($messageText);
    $newMessage->setMessageStatus($messageStatus);
    $newMessage->setSendDate($sendDate);
    $newMessage->saveToDB($conn);
    header("Location: message_info.php?messageId={$newMessage->getId()}");
    //header("Location: messages.php?senderId={$_SESSION['loggedUserId']}&receiverId={$newMessage->getReceiverId()}");
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