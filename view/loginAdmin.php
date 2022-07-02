<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script></head>
<body>
    <form action=""  id='login' >
        <input type='text' name='user' id='user'>user
        <input type='text' name="password" id='password'>password
        <button type="submit" name='submit' id='submit'>submit</button>
    </form>
    <script>
        $("#login").submit(function(e){
            e.preventDefault();
            $.ajax({
                url:"../app/function/checkRegin.php",
                method: 'post',
                data:{
                    user:$("#user").val(),
                    password:$("#password").val(),
                },
                success:function(result){
                    if(result=='ok'){
                        window.location.replace("./adminPanel.php");
                    }
                },
            });
        });
    </script>

</body>
</html>
