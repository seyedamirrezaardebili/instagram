<?php


function userPhone($array){
    $phone=$array['phone'];
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
        'phone'=>$phone
      ];
      $sql = "SELECT * FROM phone Where phone = :phone ";
      $q = $conn->prepare($sql);
      $q->execute($data);
      $add= $q->fetch();
      $code=strval( rand(0,9) ) .strval( rand(0,9) ) .strval( rand(0,9) ) .strval( rand(0,9) )   ;
      $time=time();
      if(isset($add[0]) && time() > $add['time']+120){
        $datas=[
          'phone'=>$phone,
          'code'=>$code,
          'time'=>$time
        ];
        $sql = 'UPDATE phone
        SET code = :code , time=:time
        WHERE phone = :phone';
        $statement = $conn->prepare($sql);
        $statement->execute($datas);
        echo '../public/smsCode.php';
        return 'ok';
      }elseif(isset($add[0]) && time() <= $add['time']+120){
        echo 'please wait';
        return 'please wait';
      }else{                           
        $sql = "INSERT INTO phone (phone, status ,code , time)
        VALUES ('".$phone."', 'deactive','".$code."','".$time."')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo '../public/smsCode.php';
        return 'ok';
      }
}
if(isset($_COOKIE['phone'])){
  $data=$_COOKIE['phone'];
}else{
  $data=$_POST['phone'];
}
$data=$_POST['phone'];
$cookie_name='phone';
$cookie_value=$data;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
$pattern = "'^(\\+98|0|098)?9\\d{9}$'";
if(preg_match($pattern,$data) && isset($_COOKIE['phone'])){
  userPhone($_POST);
}else{
  echo 'no';
  return 'no';
}