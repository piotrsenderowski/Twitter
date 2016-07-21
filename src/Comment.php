<?php

class Comment {
    
    static public function getAllCommentsByPostId(mysqli $conn, $postId) {
        $ret = [];
        $sql = "SELECT Comment.id, Comment.userId, Comment.postId, Comment.creationDate, Comment.commentText, User.fullName FROM Comment LEFT JOIN User ON Comment.userId = User.id WHERE Comment.postId = $postId ORDER BY creationDate ASC";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newComment = new Comment();
                $newComment->id = $row['id'];
                $newComment->userId = $row['userId'];
                $newComment->postId = $row['postId'];
                $newComment->creationDate = $row['creationDate'];
                $newComment->commentText = $row['commentText'];
                $newComment->fullName = $row['fullName'];
                $ret[] = $newComment;
            }
        }
        return $ret;
    }
    
    private $id;
    private $userId;
    private $postId;
    private $creationDate;
    private $commentText;
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
    
    public function setPostId($newPostId) {
        $this->postId = is_numeric($newPostId) ? $newPostId : 0;
    }
    
    public function getPostId() {
        return $this->postId;
    }
    
    public function setCreationDate($newCreationDate) {
        $this->creationDate = is_string($newCreationDate) ? $newCreationDate : '';
    }
    
    public function getCreationDate() {
        return $this->creationDate;
    }
    
    public function setCommentText($newCommentText) {
        $this->commentText = is_string($newCommentText) ? $newCommentText : '';
    }
    
    public function getCommentText() {
        return $this->commentText;
    }
    
    public function __construct() {
        $this->id = -1;
        $this->userId = 0;
        $this->postId = 0;
        $this->creationDate = '';
        $this->commentText = '';
    }
    
    public function loadFromDB(mysqli $conn, $id) {
        $sql = "SELECT * FROM Comment WHERE id = $id";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->userId = $row['userId'];
            $this->postId = $row['postId'];
            $this->creationDate = $row['creationDate'];
            $this->commentText = $row['commentText'];
            return true;
        }
        return false;
    }
    
    public function saveToDB(mysqli $conn) {
        $sql = '';
        if($this->id == -1) {
            $sql = "INSERT INTO Comment(userId, postId, creationDate, commentText)
                    VALUES ($this->userId,
                    $this->postId,
                    '$this->creationDate',
                    '$this->commentText')";
            if($conn->query($sql)) {
//                $sql2 = "SELECT fullName FROM User WHERE id = $this->userId";
//                if($conn->query($sql2)) {
//                    $result = $conn->query($sql2);
//                    if($result->num_rows > 0) {
//                        $row = $result->fetch_assoc();
//                        $this->fullName = $row['fullName'];
//                    }   
//                }
                $this->id = $conn->insert_id;
                return true;
            }
        }
        else {
            $sql = "UPDATE Comment SET
                    userId = $this->userId,
                    postId = $this->postId,
                    creationDate = '$this->creationDate',
                    commentText = '$this->commentText'
                    WHERE id = $this->id";
            if($conn->query($sql)) {
                return true;
            }
        }
        return false;
    }
    
    public function show() {
        echo "Comment: $this->commentText <br>";
        echo "Added on: $this->creationDate <br>";
        echo "Added to postID: $this->postId by $this->fullName<br><br>";
        //$myUser = new User();
        //$myUser->loadFromDB($conn, $this->userId);
        //
    }
}