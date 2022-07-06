<?php
function saveData($file,$post){
    $type=explode('/',$file['receipt']['type']) ;
    $target_dir = "../../stronge/img/factor/";
    $target_file = $target_dir .$post['factorId'].'.'.strtoupper($type[1]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $erorr=[];
    $check = getimagesize($file["receipt"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $erorr[]="File is not an image.";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (file_exists($target_file)) {
    $erorr[]= "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($file["receipt"]["size"] > 500000) {
    $erorr[]= "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $erorr[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    
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

    //img

    $imgData=[
        'factorId'=>$post['factorId'],
        'address'=>$target_file,
        'status'=>'diactive',
        'phone'=>$_COOKIE['phone'],
    ];
    $sql = "INSERT INTO img ( address ,factorId ,status,phone ) VALUES ( :address  ,:factorId ,:status,:phone)";
    $conn->prepare($sql)->execute($imgData);


    //updata phone 
    $update=[
        'phone'=>$_COOKIE['phone'],
    ];
    $sql = 'UPDATE phone SET status = "deactive" WHERE phone = :phone';
    $conn->prepare($sql)->execute($update);

    if ($uploadOk == 0) {
        $erorr[]= "Sorry, your file was not uploaded.";
        return json_encode($erorr);
        } else {
    
        if (move_uploaded_file($file["receipt"]["tmp_name"], $target_file)) {
            unset($_COOKIE['phone']);
            return "Uploeded";
        } else {
            return "Sorry, there was an error uploading your file.";
        }
        }

}

$data=saveData($_FILES,$_POST);
if($data=='Uploeded'){
    echo '1';
}
else{
    echo $data;
}