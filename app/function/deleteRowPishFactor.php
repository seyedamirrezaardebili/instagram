<?php

function deleteRowPishFactor($array){
$json=file_get_contents('../../stronge/json/pishfactor.json');
$json=json_decode($json , true);
fOR($i=$array['id'] ; $i<count($json) ; $i++){
    $json[$i]['totalfee']-=$json[$array['id']]['rowFee'];
}
array_splice($json, $array['id'], 1);
$json=json_encode($json);
file_put_contents('../../stronge/json/pishfactor.json',$json);
return $json;
}
echo deleteRowPishFactor($_POST);