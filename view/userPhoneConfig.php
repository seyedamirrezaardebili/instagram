<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <form id="phoneForm" >
        <input type="text" name="phone"  id='phone'>phone
        <input type='hidden' name="factorid" id='factorid' value="<?php echo $_GET["factorid"] ?>" >
        <button type='submit'>submit</button>
    </form>
    <script>
     $('#phoneForm').submit(function(e){
                e.preventDefault();
                var phone=$('#phone').val();
                var factorid=$('#factorid').val();
                if(true){
                    $.ajax({
                        url:"../app/function/userPhone.php",
                                method: 'post',
                                data:{
                                    'phone':phone,
                                    'factorid':factorid
                                },
                                success:function(result){
                                   console.log(result);
                                    if(result=='no'){
                                        alert(result);
                                    }
                                    else if(result=='please wait'){
                                        alert(result);
                                    }
                                    else{
                                        window.location.replace(result);
                                    }
                                },  
                    });
                }
                else{
                    alert('ja kalaii ezaf kon khooo');
                }
            });
        </script>
</body>
</html>