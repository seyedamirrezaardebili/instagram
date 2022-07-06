<?php

if(!empty($_COOKIE['phone']))
{
    include_once '../view/smsCode.php';
}
else{
    header('location:./index.php');
}