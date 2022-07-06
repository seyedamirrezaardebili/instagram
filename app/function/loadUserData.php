<?php

function saveData($post){
 


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
    $sql="SELECT * FROM user WHERE phone=:phone;";
    $q=$conn->prepare($sql);
    $phone=$q->execute(['phone'=>$_COOKIE['phone']]);
    $dataPhone=$q->fetchAll();
   if(!isset($dataPhone[0])){
   
        //user
        $dataUser=[
            'fullName'=>$post['fullName'],
            'phone'=>$_COOKIE['phone'],
            'mail'=>$post['mail'],
            'status'=>'deactive'
        ];
        $sql = "INSERT INTO user (fullName  ,phone,mail ,status ) VALUES ( :fullName  ,:phone ,:mail  ,:status)";
        $conn->prepare($sql)->execute($dataUser);
    }
    else{
        $dataUser=[
            'fullName'=>$post['fullName'],
            'phone'=>$_COOKIE['phone'],
            'mail'=>$post['mail'],
            'status'=>'deactive',
        ];
        $sql = "UPDATE user SET fullName = :fullName , mail=:mail , status=:status  WHERE phone = :phone";
        $conn->prepare($sql)->execute($dataUser);
    }

    //set address
    $phone=[
        'phone'=>$_COOKIE['phone'],
    ];
    $sql = "SELECT * FROM user_address Where phone= :phone ";
    $q= $conn->prepare($sql);
    $q->execute($phone);
    $address= $q->fetch();   
    if(!isset($address[0])){

            $phone=[
                'phone'=>$_COOKIE['phone'],
            ];
            $sql = "SELECT id FROM user Where phone= :phone ORDER BY id ASC";
            $q= $conn->prepare($sql);
            $q->execute($phone);
            $dataId= $q->fetch(); 
            
            $dataAddress=[
                'userid'=>$dataId[0],
                'phone'=>$_COOKIE['phone'],
                'address'=>$post['province'].'***'.$post['town'].'***'.$post['address']."***".$post['postalCode'],
                'status'=>'active',
            ];
            $sql = "INSERT INTO user_address (userid,  phone , address ,status ) VALUES ( :userid  ,:phone , :address ,:status)";
            $conn->prepare($sql)->execute($dataAddress);
            echo 'Uploeded';

    }
    else{
        $phone=[
            'phone'=>$_COOKIE['phone'],
            'address'=>$post['province'].'***'.$post['town'].'***'.$post['address']."***".$post['postalCode'],    
            ];
        $sql = "SELECT * FROM user_address Where phone= :phone && address=:address ";
        $q= $conn->prepare($sql);
        $q->execute($phone);
        $address= $q->fetchAll();
        if(isset($address[0])){
            $sql = "UPDATE user_address SET status = 'delete'   WHERE phone = :phone";
            $conn->prepare($sql)->execute(['phone'=>$_COOKIE['phone']]);
            $dataUpdate=[
                'phone'=>$_COOKIE['phone'],
                'address'=>$post['province'].'***'.$post['town'].'***'.$post['address']."***".$post['postalCode'],       
                 ];
            $sql = "UPDATE user_address SET status = 'active'   WHERE phone = :phone && address=:address";
            $conn->prepare($sql)->execute($dataUpdate);
            echo 'Uploeded';


        }
        else{
            $sql = "UPDATE user_address SET status = 'delete'   WHERE phone = :phone";
            $conn->prepare($sql)->execute(['phone'=>$_COOKIE['phone']]);
            $phone=[
                'phone'=>$_COOKIE['phone'],
            ];
            $sql = "SELECT id FROM user Where phone= :phone ORDER BY id ASC";
            $q= $conn->prepare($sql);
            $q->execute($phone);
            $dataId= $q->fetch(); 
            
            $dataAddress=[
                'userid'=>$dataId[0],
                'phone'=>$_COOKIE['phone'],
                'address'=>$post['province'].'***'.$post['town'].'***'.$post['address']."***".$post['postalCode'],
                'status'=>'active',
            ];
            $sql = "INSERT INTO user_address (userid,  phone , address ,status ) VALUES ( :userid  ,:phone , :address ,:status)";
            $conn->prepare($sql)->execute($dataAddress);
            echo 'Uploeded';
        }
    }

    
    
    
}
$data=saveData($_POST);
if($data=='Uploeded'){
   echo '1';
}
else{
   echo $data;
}