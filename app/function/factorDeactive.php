<?php
include ('../db/connectDatabase.php');


function factorDeactive(){
    $servername = "localhost";
    $username = "root";
    $password = "";
  
    // Create connection
    try {
        $conn = new PDO("mysql:host=$servername;dbname=instagram", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        die($e->getMessage());
      }
      $sql = 'SELECT * FROM factor Where status= :status';
      $q = $conn->prepare($sql);
      $q->execute(array(':status' => "active"));
      $admin= $q->fetchAll();
      return json_encode( $admin);



}
echo factorDeactive();