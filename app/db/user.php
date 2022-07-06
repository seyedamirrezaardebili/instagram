<?php
include './connectDatabase.php';
function user(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE user (
        id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        fullname VARCHAR(255) NOT null,
        phone VARCHAR(32) NOT NULL UNIQUE ,
        mail VARCHAR(255) ,
        status ENUM ('active','deactive','block','accept','delete'),
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
}
user();