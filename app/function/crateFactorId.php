<?php



function crateFactorId(){
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

    $sql = "SELECT id FROM factor ";
    $q = $conn->prepare($sql);
    $q->execute();
    $data= $q->fetchAll(PDO::FETCH_ASSOC);
    $id = (int)count($data)+1;
    return  $id;
    
}
