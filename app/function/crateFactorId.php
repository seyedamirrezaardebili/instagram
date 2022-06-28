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
    $id=uniqid().rand(0,100000000);
    $sql = "SELECT * FROM factor WHERE factorid =:factorid ";
    $q = $conn->prepare($sql);
    $q->execute(['factorid'=>$id]);
    $data= $q->fetchAll();
    if(!isset($data[0])){
      return  $id;
    }
    crateFactorId();
}
