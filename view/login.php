<!DOCTYPE html>
<html lang="en" dir="rtl" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/local.css">
    <title>PhoneValidation</title>
</head>
<body>
    <div class="loginWrap d-flex justify-content-center">
        <form class='LoginForm'  name="loginForm" onsubmit="return validateForm()" id='loginForm'>
            <h3 class='d-flex justify-content-center align-items-center'>ورود یا ثبت نام</h3>
            <div class='w-100 d-flex justify-content-center align-items-center mb-3'>
                <label for="tel">شماره موبایل خود را وارد کنید</label>
            <input class='form-inp' type="number" id='phone' placeholder='09121234567' dir='ltr' name="phone"/>
            <span class="red"></span>
            </div>
            <button type='submit' value="submit">ورود</button>
            <div class='process d-flex justify-content-between align-items-center px-5 py-2'>
                <span></span>
                <span></span>
                <span></span>
                <span class='black'></span>
            </div>
        </form>
    </div>
</body>
<script>
function validateForm() {
  let telValue = document.forms["loginForm"]["phone"].value;
  let error =  document.getElementsByClassName("red")[0]
  if (telValue == "") {
    error.innerHTML = "شماره موبایل اجباری است."
    return false;
  } else if(telValue.length !=11 ){
    error.innerHTML = "شماره موبایل نامعتبر است."
    return false;
  }
  console.log(telValue)
}
</script>
<script>
     $('#loginForm').submit(function(e){
                e.preventDefault();
                var phone=$('#phone').val();
                if(true){
                    $.ajax({
                        url:"../app/function/userPhone.php",
                                method: 'post',
                                data:{
                                    'phone':phone,
                                },
                                success:function(result){
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
</html>