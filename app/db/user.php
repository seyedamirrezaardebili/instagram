<?php
include './connectDatabase.php';
function user(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE user (
        id INT(32) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        fullname VARCHAR(256) NOT null,
        address VARCHAR(30) NOT NULL,
        phone VARCHAR(32) NOT NULL UNIQUE,
        img VARCHAR(512) NOT Null,
        factorId VARCHAR(512),
        status ENUM ('active','diactive','block'),
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
}
user();