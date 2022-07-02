<?php
function saveData($file,$post){
    $type=explode('/',$file['file']['type']) ;
    $target_dir = "../../stronge/img/factor/";
    $target_file = $target_dir .$post['factorid'].'.'.strtoupper($type[1]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $erorr=[];
    $check = getimagesize($file["file"]["tmp_name"]);
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
    if ($file["file"]["size"] > 500000) {
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
    //user
    $data=[
        'fullname'=>$post['name'].'  '.$post['family'],
        'address'=>$post['state'].'  '.$post['city'].'  '.$post['adrress'],
        'phone'=>$post['phone'],
        'img'=>$target_file,
        'factorId'=>$post['factorid'],
        'status'=>'deactive',
        'finish'=>'deactive'
    ];
    $sql = "INSERT INTO user (fullname , address ,phone ,img ,factorId ,status,finish ) VALUES ( :fullname , :address ,:phone ,:img ,:factorId ,:status,:finish)";
    $conn->prepare($sql)->execute($data);

    //img

    $imgData=[
        'factorId'=>$post['factorid'],
        'address'=>$target_file,
        'status'=>'diactive',
        'phone'=>$post['phone'],
    ];
    $sql = "INSERT INTO img ( address ,factorId ,status,phone ) VALUES ( :address  ,:factorId ,:status,:phone)";
    $conn->prepare($sql)->execute($imgData);

    //update factor

    $update=[
        'img'=>$target_file,
        'user'=>$post['phone'],
        'factorid'=>$post['factorid']
    ];
    $sql = 'UPDATE factor SET img = :img , user=:user  WHERE factorid = :factorid';
    $conn->prepare($sql)->execute($update);
    //updata phone 
    $update=[
        'phone'=>$post['phone'],
    ];
    $sql = 'UPDATE phone SET status = "deactive" WHERE phone = :phone';
    $conn->prepare($sql)->execute($update);

    if ($uploadOk == 0) {
        $erorr[]= "Sorry, your file was not uploaded.";
        return json_encode($erorr);
        } else {
    
        if (move_uploaded_file($file["file"]["tmp_name"], $target_file)) {
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