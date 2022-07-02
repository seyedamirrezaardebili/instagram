<?php

function configCode($array){
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
    $data=[
        'phone'=>$array['phone'],
    ];
    $sql = "SELECT * FROM phone Where phone= :phone ";
    $q = $conn->prepare($sql);
    $q->execute($data);
    $admin= $q->fetch();
    if($admin['code']==$array['code'] && time()<=$admin['time']+180){
        $data=[
            'phone'=>$array['phone'],
            'status'=>'active'
        ];
        $sql = "UPDATE phone set status=:status WHERE phone = :phone;";
        $q = $conn->prepare($sql)->execute($data);
        echo '../view/userData.php?phone='.$array['phone'].'&factorid='.$array['factorid'];
    }
    elseif(time()>$admin['time']+180){
        echo 'time filed';
    }
    else{
        echo 'eshtab';
    }
}
configCode($_POST);
