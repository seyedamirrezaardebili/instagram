<?php
function checkRegin($user,$password){
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
    $sql = "SELECT * FROM admin Where id= :id ";
    $q = $conn->prepare($sql);
    $q->execute(array(':id' => "1"));
    $admin= $q->fetch();
    $erorrs=[];
    if($user==$admin['user']){
           if($password==$admin['password']) {
                session_start();
                $_SESSION['adminUser']=true;
                return 'ok';
           }else{
                $erorrs[]='password is  ';
           }
    }else{
        $erorrs[]='user not found';
    }
    $text='';
    foreach ($erorrs as $erorr){
        $text .='     '.$erorr;
    }
    return $erorr;
}

echo checkRegin($_POST['user'],$_POST['password']);