<?php
include ('../db/connectDatabase.php');
function phoneDataAjax($phone){
    $conn=connectDatabase();
    $sql = "SELECT * FROM user Where phone= :phone ";
    $q= $conn->prepare($sql);
    $q->execute(array(':phone' => $phone));
    $data= $q->fetch();
    $sql = "SELECT address FROM user_address Where phone= :phone && status='active' ";
    $q= $conn->prepare($sql);
    $q->execute(array(':phone' => $phone));
    $a= $q->fetch();
    unset($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$a[0]);
    $b=explode('***',$a['address']);

    $data['province']=$b[0];
    $data['town']=$b[1];
    $data['address']=$b[2];
    $data['postalCode']=$b[3];

    return json_encode($data);
}
echo  phoneDataAjax($_COOKIE['phone']);