<?php
include './connectDatabase.php';
function factor(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE factor (
        id INT(32) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        number int(32) ,
        totalfee VARCHAR(30) NOT NULL,
        factorid VARCHAR(32) NOT NULL UNIQUE,
        img VARCHAR(512) ,
        user VARCHAR(512),
        status ENUM ('active','diactive','delete'),
        finish ENUM ('active','diactive','block','accept'),
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
}
factor();