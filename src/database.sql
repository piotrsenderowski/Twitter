/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
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