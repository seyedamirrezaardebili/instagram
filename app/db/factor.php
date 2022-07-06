<?php
include './connectDatabase.php';
function factor(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE factor (
        id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        number int(32) NOT NULL,
        totalfee VARCHAR(30) NOT NULL,
        factorid VARCHAR(255) NOT NULL UNIQUE,
        status ENUM ('active','deactive','delete''block','accept'),
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
}
factor();