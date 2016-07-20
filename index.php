<meta charset="utf-8">
<?php
require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';

session_start();

if(!$_SESSION['loggedUserId']) {
    header("Location: login.php"); // Przekierowanie do strony logowania
}
$loggedUser = new User();
$loggedUser->loadFromDB($conn,  $_SESSION['loggedUserId']);
echo "Witaj " . $loggedUser->getFullName() . "! <br> <a href='logout.php'>Logout</a><br><br>";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    $userId = $_SESSION['loggedUserId'];
    $tweetText = isset($_POST['tweet_text']) ? $conn->real_escape_string(trim($_POST['tweet_text'])) : null;
    
    if(strlen($tweetText) > 0) {
        if(strlen($tweetText) <= 140) {
            $newTweet = new Tweet();
            $newTweet->setUserId($userId);
            $newTweet->setTweetText($tweetText);
            $newTweet->saveToDB($conn);
            $newTweet->show();
        }
        else {
            echo "Twój Tweet ma za dużo znaków. Możesz użyć maksymalnie 140.<br>";
        }
    }
    else {
        echo "Nie możesz dodać pustego Tweeta.<br>";
    }
}
//TODO - zapytać Jacka czy praktykuje się, aby przy takiej ilości $_SESSION['loggedUserId'], podstawić tę zmienną pod jakąś krótszą zmienną.
echo "<a href='user_details.php?id={$loggedUser->getId()}'>Strona użytkownika</a><br>";

?>

<form method="POST" action="#">
    <fieldset>
        <label>Dodaj Tweeta</label><br>
        <textarea name="tweet_text" placeholder="Treść Tweeta wpisz tutaj..." rows="4" cols="40" autofocus=""></textarea><br>
        <input type="submit"/>
    </fieldset>
</form>

<?php
$tweets = $loggedUser->getAllTweets($conn);
foreach($tweets as $oneTweet){
    $oneTweet->showLink();
}

$conn->close();
$conn = null;
?>