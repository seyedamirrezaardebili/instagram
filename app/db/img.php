<?php
include './connectDatabase.php';
function img(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE img (
        id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        factorid VARCHAR(255) NOT NULL UNIQUE ,
        address VARCHAR(128) NOT NULL,
        phone VARCHAR(64) NOT NULL,
        status ENUM ('active','deactive'),
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
}
img();