<?php

class Message {
    
    static public function getAllMessagesBySenderId(mysqli $conn, $senderId) {
        $ret = [];
        $sql = "SELECT Message.id, Message.senderId, Message.receiverId, Message.messageText, Message.messageStatus, Message.sendDate, User.fullName AS senderFullName, User2.fullName AS receiverFullName
                FROM Message
                LEFT JOIN User ON Message.senderId = User.id
                LEFT JOIN User AS User2 ON Message.receiverId = User2.id
                WHERE Message.senderId = $senderId";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newMessage = new Message();
                $newMessage->id = $row['id'];
                $newMessage->senderId = $row['senderId'];
                $newMessage->receiverId = $row['receiverId'];
                $newMessage->messageText = $row['messageText'];
                $newMessage->messageStatus = $row['messageStatus'];
                $newMessage->sendDate = $row['sendDate'];
                $newMessage->senderFullName = $row['senderFullName'];
                $newMessage->receiverFullName = $row['receiverFullName'];
                $ret[] = $newMessage;
            }
        }
        return $ret;
    }
    
    static public function getAllMessagesByReceiverId(mysqli $conn, $receiverId) {
        $ret = [];
        $sql = "SELECT Message.id, Message.senderId, Message.receiverId, Message.messageText, Message.messageStatus, Message.sendDate, User.fullName AS senderFullName, User2.fullName AS receiverFullName
                FROM Message
                LEFT JOIN User ON Message.senderId = User.id
                LEFT JOIN User AS User2 ON Message.receiverId = User2.id
                WHERE Message.receiverId = $receiverId";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $newMessage = new Message();
                $newMessage->id = $row['id'];
                $newMessage->senderId = $row['senderId'];
                $newMessage->receiverId = $row['receiverId'];
                $newMessage->messageText = $row['messageText'];
                $newMessage->messageStatus = $row['messageStatus'];
                $newMessage->sendDate = $row['sendDate'];
                $newMessage->senderFullName = $row['senderFullName'];
                $newMessage->receiverFullName = $row['receiverFullName'];
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
    private $sendDate;
    private $senderFullName;
    private $receiverFullName;
    
    public function __construct() {
        $this->id = -1;
        $this->senderId = 0;
        $this->receiverId = 0;
        $this->messageText = '';
        $this->messageStatus = 0;
        $this->sendDate = '';
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
    
    public function setSendDate($newSendDate) {
        $this->sendDate = is_string($newSendDate) ? $newSendDate : '';
    }
    
    public function getSendDate() {
        return $this->sendDate;
    }
    
//    public function getSenderFullName() {
//        return $this->senderFullName;
//    }
//    
//    public function getReceiverFullName() {
//        return $this->receiverFullName;
//    }
    
    public function saveToDB(mysqli $conn) {
        $sql = '';
        if($this->id == -1) {
            $sql = "INSERT INTO Message(senderId, receiverId, messageText, messageStatus, sendDate)
                    VALUES ($this->senderId,
                    $this->receiverId,
                    '$this->messageText',
                    $this->messageStatus,
                    '$this->sendDate')";
            if($conn->query($sql)) {
                $this->id = $conn->insert_id;
                return true;
            }
        }
        else {
            $sql = "UPDATE Message SET
                    senderId = $this->senderId,
                    receiverId = $this->receiverId,
                    messageText = '$this->messageText',
                    messageStatus = $this->messageStatus,
                    sendDate = '$this->sendDate'
                    WHERE id = $this->id";
            if($conn->query($sql)) {
                return true;
            }
        }
        return false;
    }
    
    public function loadFromDB(mysqli $conn, $id) {
        $sql = "SELECT * FROM Message WHERE id = $id";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->senderId = $row['senderId'];
            $this->receiverId = $row['receiverId'];
            $this->messageText = $row['messageText'];
            $this->messageStatus = $row['messageStatus'];
            $this->sendDate = $row['sendDate'];
            $sql2 = "SELECT * FROM User WHERE id = $this->senderId";
            if($conn->query($sql2)) {
                $result = $conn->query($sql2);
                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $this->senderFullName = $row['fullName'];
                }
            }
            $sql3 = "SELECT * FROM User WHERE id = $this->receiverId";
            if($conn->query($sql3)) {
                $result = $conn->query($sql3);
                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $this->receiverFullName = $row['fullName'];
                }
            }
            return true;
        }
        return false;
    }
    
    public function showOutbox() {
        $shortMessage = substr($this->messageText, 0, 30) . "...";
        echo "<tr onclick=\"location.href='message_info.php?messageId={$this->id}'\"><td>{$this->receiverFullName}</td><td>{$this->sendDate}</td><td>$shortMessage</td></tr></a>";
    }
    
    public function showInbox() {
        $shortMessage = substr($this->messageText, 0, 30) . "...";
        if($this->messageStatus == 1) {
            //herdoc
            echo "<tr onclick=\"location.href='message_info.php?messageId={$this->id}'\"><td><strong>{$this->senderFullName}</strong></td><td><strong>{$this->sendDate}</strong></td><td><strong>$shortMessage</strong></td></a></tr>";
        }
        else {
            echo "<tr onclick=\"location.href='message_info.php?messageId={$this->id}'\"><td>{$this->senderFullName}</td><td>{$this->sendDate}</td><td>$shortMessage</td></a></tr>";
        }
    }
    
    public function show() {
        echo "<tr><td>{$this->senderFullName}</td><td>{$this->receiverFullName}</td><td>{$this->sendDate}</td><td>{$this->messageText}</td></a></tr>";
    }
    
}