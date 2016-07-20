<?php

class Message {
    
    static public function getAllMessagesBySenderId(mysqli $conn, $senderId) {
        $ret = [];
        $sql = "SELECT * FROM Message WHERE senderId = $senderId";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newMessage = new Message();
                $newMessage->id = $row['id'];
                $newMessage->senderId = $row['senderId'];
                $newMessage->receiverId = $row['receiverId'];
                $newMessage->messageText = $row['messageText'];
                $newMessage->messageStatus = $row['messageStatus'];
                $ret[] = $newMessage;
            }
        }
        return $ret;
    }
    
    static public function getAllMessagesByReceiverId(mysqli $conn, $receiverId) {
        $ret = [];
        $sql = "SELECT * FROM Message WHERE senderId = $receiverId";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newMessage = new Message();
                $newMessage->id = $row['id'];
                $newMessage->senderId = $row['senderId'];
                $newMessage->receiverId = $row['receiverId'];
                $newMessage->messageText = $row['messageText'];
                $newMessage->messageStatus = $row['messageStatus'];
                $ret[] = $newMessage;
            }
        }
        return $ret;
    }
    
    private $id;
    private $senderId;
    private $receiverId;
    private $messageText;
    private $messageStatus;
    
    public function __construct() {
        $this->id = -1;
        $this->senderId = 0;
        $this->receiverId = 0;
        $this->messageText = '';
        $this->messageStatus = 0;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setSenderId($newSenderId) {
        $this->senderId = is_numeric($newSenderId) ? $newSenderId : 0;
    }
    
    public function getSenderId() {
        return $this->senderId;
    }
    
    public function setReceiverId($newReceiverId) {
        $this->receiverId = is_numeric($newReceiverId) ? $newReceiverId : 0;
    }
    
    public function getReceiverId() {
        return $this->receiverId;
    }
    
    public function setMessageText($newMessageText) {
        $this->messageText = is_string($newMessageText) ? $newMessageText : 0;
    }
    
    public function getMessageText() {
        return $this->messageText;
    }
    
    public function setMessageStatus($newMessageStatus) {
        $this->messageStatus = is_numeric($newMessageStatus) ? $newMessageStatus : 1;
    }
    
    public function getMessageStatus() {
        return $this->messageStatus;
    }
    
    public function saveToDB(mysqli $conn) {
        $sql = '';
        if($this->id == -1) {
            $sql = "INSERT INTO Message(senderId, receiverId, messageText, messageStatus)
                    VALUES ($this->senderId,
                    $this->receiverId,
                    '$this->messageText',
                    $this->messageStatus)";
            var_dump($sql);
            if($conn->query($sql)) {
                $this->id = $conn->insert_id;
                return true;
            }
        }
        else {
            $sql = "UPDATE Message SET
                    senderid = $this->senderId,
                    receiverId = $this->receiverId,
                    messageText = '$this->messageText',
                    messageStatus = $this->messageStatus
                    WHERE id = $this->id";
            if($conn->query($sql)) {
                return true;
            }
        }
        return false;
    }
    
    public function loadFromDB() {
        $sql = "SELECT * FROM Message WHERE id = $this->id";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->senderId = $row['senderId'];
            $this->receiverId = $row['receiverId'];
            $this->messageText = $row['messageText'];
            $this->messageStatus = $row['messageStatus'];
            return true;
        }
        return false;
    }
    
    public function show() {
        echo "ID wiadomości: $this->id";
        echo "ID nadawcy: $this->senderId";
        echo "ID odbiorcy: $this->receiverId";
        echo "Treść wiadomości: $this->messageText";
        if($this->messageStatus == 1) {
            echo "Wiadomość nieprzeczytana";
        }
        else {
            echo "Wiadomość przeczytana";
        }
    }
}