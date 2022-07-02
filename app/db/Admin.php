<?php
include './connectDatabase.php';
function Admin(){
    $conn=connectDatabase();
    $sql = "CREATE TABLE admin (
        id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
        user VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        timecreate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
      
        // use exec() because no results are returned
        $conn->exec($sql);
        $sql = "INSERT INTO admin (user, password)
        VALUES ('admin', '12345')";
        // use exec() because no results are returned
        $conn->exec($sql);
}
Admin();