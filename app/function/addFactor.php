<?php
include ('../db/connectDatabase.php');
include "./crateFactorId.php";

function addFactor(){
    $conn=connectDatabase();
    $id=crateFactorId();
    $json=file_get_contents('../../stronge/json/pishfactor.json');
    $array=json_decode($json,true);
    $totalfee=0;
    $number=0;
    foreach($array as $row ){
        $totalfee+=$row['rowFee'];
        $number+=$row['number'];
    }
    //createFactor_product colum in factor_product table
    foreach($array as $rows){
        $datas=[
            'name'=>$rows['name'],
            'number'=>$rows['number'],
            'fee'=>$rows['fee'],
            'factorid'=>$id
        ];
        $sql = "INSERT INTO factor_prouduct (name, number,factorid,fee) VALUES (  :name , :number ,:factorid,:fee)";
        // use exec() because no results are returned
        $add=$conn->prepare($sql)->execute($datas);
    }


    $data=[
        'number'=>$number,
        'totalfee'=>$totalfee,
        'factorid'=>$id
    ];

    $sql = "INSERT INTO factor (number, totalfee,factorid) VALUES (  :number , :totalfee ,:factorid)";
    // use exec() because no results are returned
    $add=$conn->prepare($sql)->execute($data);
    file_put_contents('../../stronge/json/pishfactor.json',json_encode([]));
    return  '../view/userPhoneConfig.php?factorid='.$id;
}

echo addFactor();


