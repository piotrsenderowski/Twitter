<?php

class Tweet {
    
    static public function getAllTweetsByUserId(mysqli $conn, $userId) {
        $ret = [];
        $sql = "SELECT Tweet.id, Tweet.userId, Tweet.tweetText, User.fullName FROM Tweet LEFT JOIN User ON Tweet.userId = User.id WHERE Tweet.userId = $userId ORDER BY Tweet.id DESC";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newTweet = new Tweet();
                $newTweet->id = $row['id'];
                $newTweet->userId = $row['userId'];
                $newTweet->tweetText = $row['tweetText'];
                $newTweet->fullName = $row['fullName'];
                $ret[] = $newTweet;
            }
            //zostaje pusta tablica
        }
        return $ret;
    }
    
    private $id;
    private $userId;
    private $tweetText;
    private $fullName;
    
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
                    tweetText = '$this->tweetText'
                    WHERE id = $this->id";
            if($conn->query($sql)) {
                return true;
            }
        }
        return false;
    }
    
//    public function getFullName() {
//        $this->loadFromDB($conn, $this->id);
//        return $this->FullName;
//    }
    
    public function show() {
        echo "Tweet: $this->tweetText<br>";
        echo "Author: $this->fullName<br>";
    }
    
    public function showLink(){
        echo "<a href='tweet_details.php?tweetId=$this->id'>Tweet details</a><br><br>";
    }
    
    public function loadFromDB(mysqli $conn, $id) {
        $sql = "SELECT Tweet.id, Tweet.userId, Tweet.tweetText, User.fullName FROM Tweet LEFT JOIN User ON Tweet.userId = User.id WHERE Tweet.id = $id";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->userId = $row['userId'];
            $this->tweetText = $row['tweetText'];
            $this->fullName = $row['fullName'];
            return true;
        }
        return false;
    }
    
    public function getAllComments(mysqli $conn) {
        return Comment::getAllCommentsByPostId($conn, $this->id);
    }
    
}