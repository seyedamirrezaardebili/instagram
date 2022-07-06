<?php

if(!empty($_COOKIE['phone'] ))
{
    include_once '../view/mainForm.php';
}
else{
    header('location:./index.php');
}