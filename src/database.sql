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