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
    <form id='phoneConfig'>
        <input type="hidden" name="phone" value="<?php echo $_GET['phone'] ?>"  id="phone">
        <input type="hidden" name="factorid" value="<?php echo $_GET['factorid'] ?>" id="factorid">
        <input type="text" name="code" id='code'>
        <button type='submit'>submit</button>
    </form>
    <button type='submit' id="recode">recode</button>
    <script>
     $('#recode').click(function(e){
                e.preventDefault();
                var phone=$('#phone').val();
                var factorid=$('#factorid').val();
                    $.ajax({
                        url:"../app/function/userPhone.php",
                                method: 'post',
                                data:{
                                    'phone':phone,
                                    'factorid':factorid
                                },
                                success:function(result){
                                    if(result=='no'){
                                        alert(result);
                                    }
                                    else if(result=='please wait'){
                                        alert(result);
                                    }
                                    else{
                                        console.log('ok');
                                    }
                                },  
                    });
            });
        </script>
            <script>
     $('#phoneConfig').submit(function(e){
                e.preventDefault();
                var phone=$('#phone').val();
                var factorid=$('#factorid').val();
                var code=$('#code').val();
                if(true){
                    $.ajax({
                        url:"../app/function/configCode.php",
                                method: 'post',
                                data:{
                                    'phone':phone,
                                    'factorid':factorid,
                                    'code':code
                                },
                                success:function(result){
                                    window.location.replace(result);
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