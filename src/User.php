<?php

class User {
    
    static public function logIn(mysqli $conn, $email, $password) {
        $sql = "SELECT * FROM User WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc(); // fetch_assoc -> zwraca $result jako tablicę asocjacyjną, gdzie kluczem jest nazwa kolumn
            // var_dump($row);
            if (password_verify($password, $row['password'])) {
                return $row['id'];
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    static public function getUserByEmail(mysqli $conn, $email) {
        $sql = "SELECT * FROM User WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $user = new User();
            $user->id = $row['id'];
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setFullName($row['fullName']);
            $user->setActive($row['active']);
            return $user;
        }
        return NULL;
    }
    
    private $id;
    private $email;
    private $password;
    private $fullName;
    private $active;
    
    public function __construct() {
        $this->id = -1;
        $this->email = '';
        $this->password = '';
        $this->fullName = '';
        $this->active = 0;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setEmail($newEmail) {
        $this->email = is_string($newEmail) ? $newEmail : '';
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setPassword($newPassword) {
        $this->password = is_string($newPassword) ? $newPassword : '';
    }
    
    public function setHashedPassword($newPassword) {
        $this->password = is_string($newPassword) ? password_hash($newPassword, PASSWORD_DEFAULT) : '';
    }
    
    public function setFullName($newFullName) {
        $this->fullName = is_string($newFullName) ? $newFullName : '';
    }
    
    public function getFullName() {
        return $this->fullName;
    }
    
    public function setActive($newActive) {
        $this->active = $newActive == 0 || $newActive == 1 ? $newActive : 0;
    }
    
    public function getActive() {
        return $this->active;
    }
    
    public function saveToDB(mysqli $conn) {
        $sql = '';
        if($this->id == -1) {
            $sql = "INSERT INTO User(email, password, fullName, active)
                    VALUES ('$this->email', 
                    '$this->password', 
                    '$this->fullName',
                    $this->active)";
            if($conn->query($sql)) {
                $this->id = $conn->insert_id;
                return true;
            }
            else {
                return false;
            }
        }
        else {
            $sql = "UPDATE User SET
                    email = '$this->email',
                    password = '$this->password',
                    fullName = '$this->fullName',
                    active = $this->active
                    WHERE id = $this->id";
            if($conn->query($sql)) {
                return true;
            }
            else {
                return false;
            }
        }
    }
    //TODO Zapytać Jacka czy tą metodę mam wywołać na stronie głównej? W treści zadania chyba jest inaczej.
    public function getAllTweets(mysqli $conn) {
        return Tweet::getAllTweetsByUserId($conn, $this->id);
    }
    
    public function loadFromDB(mysqli $conn, $id) {
        $sql = "SELECT * FROM User WHERE id = $id";
        $result = $conn->query($sql);
        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row['id'];
            $this->email = $row['email'];
            $this->fullName = $row['fullName'];
            $this->active = $row['active'];
            return true;
        }
        return false;
    }

    public function show() {
        echo "Nazwa użytkownika: $this->fullName<br>";
        echo "Id użytkownika: $this->id<br>";
        echo "Login: $this->email";
    }
    
    public function getAllReceivedMessages(mysqli $conn) {
        return Message::getAllMessagesByReceiverId($conn, $this->id);
    }
    
    public function getAllSendMessages(mysqli $conn) {
        return Message::getAllMessagesBySenderId($conn, $this->id);
    }
}