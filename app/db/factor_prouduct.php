<?php
include './connectDatabase.php';
function factor_prouduct(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE factor_prouduct (
        id INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        name VARCHAR(128) NOT NULL ,
        factorid VARCHAR(255) NOT NULL,
        fee INT(32) NOT NULL,
        number INT(32) NOT NULL,
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        // use exec() because no results are returned
        $conn->exec($sql);
}
factor_prouduct();