<?php

function loadData($array){
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
    $sql = "SELECT * FROM factor_prouduct WHERE factorid =:factorid ";
    $q = $conn->prepare($sql);
    $q->execute(['factorid'=>$array['factorid']]);
    $data= $q->fetchAll();
    for($i=0 ; $i<count($data);$i++){
        $data[$i]['rowFee']=$data[$i]['fee']*$data[$i]['number'];
    }
    echo json_encode($data);
}
loadData($_POST);