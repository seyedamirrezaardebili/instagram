<?php
include ('../db/connectDatabase.php');
function phoneDataAjax($phone){
    $conn=connectDatabase();
    $sql = "SELECT * FROM user Where phone= :phone ";
    $q= $conn->prepare($sql);
    $q->execute(array(':phone' => $phone));
    $data= $q->fetch();
    $address=explode('  ',$data['address']);
    $fullname=explode('  ',$data['fullname']);
    $data['state']=$address[0];
    $data['city']=$address[1];
    $data['address']=$address[2];
    $data['name']=$fullname[0];
    $data['family']=$fullname[1];
    unset($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data['fullname']);

    return json_encode($data);
}
echo  phoneDataAjax($_POST['phone']);