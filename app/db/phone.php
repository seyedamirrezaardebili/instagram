<?php
include './connectDatabase.php';
function phone(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE phone (
        id INT(32) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        phone VARCHAR(256) NOT NULL UNIQUE,
        code VARCHAR(12) NOT NULL,
        time VARCHAR(256) NOT NULL,
        status ENUM ('active','deactive','block'),
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
}
phone();