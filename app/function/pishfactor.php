<?php

function pishfactor($array){
if($array['count']==0){
    file_put_contents('../../stronge/json/pishfactor.json',json_encode([]));
}
$json=file_get_contents('../../stronge/json/pishfactor.json');
$json=json_decode($json , true);
$cont=count($array);
$data['name']=$array['name'];
$data['number']=$array['number'];
$data['fee']=$array['fee'];
$data['count']=(int)$array['count']+1;
$data['rowFee']=$array['fee']*$array['number'];
$data['totalfee']=$array['totalfee']+$data['rowFee'];
$json[]=$data;
$json=json_encode($json);
file_put_contents('../../stronge/json/pishfactor.json',$json);
return $json;
}
echo pishfactor($_POST);