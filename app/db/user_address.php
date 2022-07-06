<?php
include './connectDatabase.php';
function user_address(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE user_address (
        id INT(32) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        userid VARCHAR(256) NOT NULL,
        phone VARCHAR(32) NOT NULL ,
        address VARCHAR(128) NOT NULL ,
        status ENUM ('active','delete') not null,
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
}
user_address();