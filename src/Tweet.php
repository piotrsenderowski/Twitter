<?php

class Tweet {
    
    static public function getAllTweetsByUserId(mysqli $conn, $userId) {
        $ret = [];
        $sql = "SELECT * FROM Tweet WHERE userId = $userId";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newTweet = new Tweet();
                $newTweet->id = $row['id'];
                $newTweet->userId = $row['userId'];
                $newTweet->tweetText = $row['tweetText'];
                $ret[] = $newTweet;
            }
            //zostaje pusta tablica
        }
        return $ret;
    }
    
    private $id;
    private $userId;
    private $tweetText;
    
    public function getId() {
        return $this->id;
    }
    
    public function setUserId($newUserId) {
        $this->userId = is_numeric($newUserId) ? $newUserId : 0;
        return $this;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function setTweetText($newTweetText) {
        $this->tweetText = is_string($newTweetText) ? $newTweetText : '';
        return $this;
    }
    
    public function getTweetText() {
        return $this->tweetText;
    }
    
    public function __construct() {
        $this->id = -1;
        $this->userId = 0;
        $this->tweetText = '';
    }
    
    public function saveToDB(mysqli $conn) {
        $sql = '';
        if($this->id == -1) {
            $sql = "INSERT INTO Tweet(userId, tweetText)
                    VALUES ($this->userId,
                    '$this->tweetText')";
            if($conn->query($sql)) {
                $this->id = $conn->insert_id;
                return true;
            }
        }
        else {
            $sql = "UPDATE Tweet SET
                    userId = $this->userId,
                    tweetText = '$this->tweetText',
                    WHERE id = $this->id";
            if($conn->query($sql)) {
                return true;
            }
        }
        return false;
    }
    
    public function show() {
        echo "Dodano Tweet o treści:<br>";
        echo "<strong>{$this->tweetText}</strong><br><br>";
    }
    
    public function showLink(){
        echo("<a href='tweet_details.php?tweetId={$this->id}'>{$this->tweetText}</a><br>");
    }
    
    public function loadFromDB(mysqli $conn, $id) {
        $sql = "SELECT * FROM Tweet WHERE id = $id";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->userId = $row['userId'];
            $this->tweetText = $row['tweetText'];
            return true;
        }
        return false;
    }
    
    public function getAllComments(mysqli $conn) {
        return Comment::getAllCommentsByPostId($conn, $this->id);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}