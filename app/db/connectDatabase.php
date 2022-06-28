<?php
function connectDatabase(){
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
    return $conn;
}
