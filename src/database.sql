/*
 * Author:  Piotr
 * Created: 2016-07-08
 */

CREATE TABLE User (
    id INT AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(100),
    active TINYINT DEFAULT 1,
    PRIMARY KEY(id)
)

CREATE TABLE Tweet (
    id INT AUTO_INCREMENT,
    userId INT,
    tweetText VARCHAR(140) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(userId) REFERENCES User(id)
)

CREATE TABLE Comment (
    id INT AUTO_INCREMENT,
    userId INT,
    postId INT,
    creationDate DATETIME NOT NULL,
    commentText VARCHAR(60) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(postId) REFERENCES Tweet(id),
    FOREIGN KEY(userId) REFERENCES User(id)
)

CREATE TABLE Message (
    id INT AUTO_INCREMENT,
    senderId INT,
    receiverId INT,
    messageText TEXT NOT NULL,
    messageStatus TINYINT DEFAULT 0,
    PRIMARY KEY(id),
    FOREIGN KEY(senderId) REFERENCES User(id),
    FOREIGN KEY(receiverId) REFERENCES User(id)
)