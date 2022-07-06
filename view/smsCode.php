<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/local.css">
    <title>Document</title>
</head>
<body>

    <div class="loginWrap d-flex justify-content-center"  >
        <form class='LoginForm'  name="smsform" onsubmit="return validateSms()" id='phoneConfig'>
            <h3 class='d-flex justify-content-center align-items-center'>ارسال پیامک</h3>
            <div class='w-100 d-flex justify-content-center align-items-center mb-3'>
              <label for="sms"></label>
              <input class='form-inp' type="number" id='sms' placeholder='1234' dir='ltr' name="smsCode"/>
             <span class='red'></span>
            <div class='txt d-flex justify-content-between'>
              <a href="./index.php">تغییر شماره</a>
              <span id="countDown"></span>
              <span onclick=" _Resend()" id="resend"></span>
              </div>
            </div>
            <button type='submit'>ادامه</button>
            <div class='process d-flex justify-content-between align-items-center px-5'>
                <span></span>
                <span></span>
                <span class='black'></span>
                <span></span>
            </div>
        </form>
      </div>
</body>
<script>
// get the number in previous page with local storage********

    let inputTest = localStorage['objectToPass'];
      localStorage.removeItem( 'objectToPass' );
      document.getElementsByTagName('label')[0].innerHTML = `کد ارسال شده به شماره <?php echo $_COOKIE['phone'] ?> را وارد نمایید.`

//Timerrrrr *********************************************

    let CounDown = document.getElementById('countDown')
    CounDown.innerHTML = 2+ ":" + 00;
    startTimer();

function _Resend(){
        resend.style.display = "none"
        CounDown.style.display = "block";
        CounDown.innerHTML = 2 + ":" + 00;
    startTimer();
}

function startTimer() {
  var timeArray =  CounDown.innerHTML.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  if(m<0){
    return
  }
  
  CounDown.innerHTML= m + ":" + s;

  setTimeout(startTimer, 1000);


  function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; 
  if (sec < 0) {sec = "59"};
  return sec;
}
if(m==0 && s==00){
    CounDown.style.display = "none";
    let resend = document.getElementById('resend')
    resend.style.display = "block"
    resend.innerHTML = 'ارسال مجدد'
  }
}
//validation *********************************************

function validateSms() {
  let smsCode = document.forms["smsform"]["smsCode"].value;
  let error =  document.getElementsByClassName("red")[0]
  if (smsCode == "") {
    error.innerHTML = "تایید شماره موبایل اجباری است."
    return false;
  } else{
      
  }

}
$('#resend').click(function(e){
                e.preventDefault();
                    $.ajax({
                        url:"../app/function/userPhone.php",
                                method: 'post',

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
                            var code=$('#sms').val();
                            if(true){
                                $.ajax({
                                    url:"../app/function/configCode.php",
                                            method: 'post',
                                            data:{
                                                'code':code,
                                            },
                                            success:function(result){
                                                if(result=='ok'){
                                                    window.location.replace('./mainForm.php');
                                                }
                                            },  
                                });
                            }
                            else{
                                alert('ja kalaii ezaf kon khooo');
                            }
                 });
        </script>

</script>
</html>