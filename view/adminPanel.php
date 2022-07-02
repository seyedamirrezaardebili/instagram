<?php 
session_start();
if($_SESSION['adminUser']){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
<p id='number'></p>
<a href="./addFactor.php">addFactor</a>
<a href="./confirmFactor.php">confirmFactor</a>
<script>
     $(document).ready(function(e){
            $.ajax({
                        url:"../app/function/factorDeactive.php",
                        method: 'post',
                                success:function(result){
                                    var array = JSON.parse(result);
                                    $('#number').text(array.length).attr('style',' color: red');
                                },  
                    });
        });
</script>
</body>
</html>

<?php
}else{
    header("location:./loginAdmin.php");
}
?>