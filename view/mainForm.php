<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/local.css">
    <link rel="stylesheet" href="css/master.css">
    <title>Document</title>
</head>
<body>
    <div class='form-main'>
        <h2 class='deskTitle'>ثبت سفارش / گالری نویر نگین</h2>
    <form class='form-wrapper' id="dataForm" name="MainForm" onsubmit="return validateMainForm()" >
        <h2 class='mobTitle w-100'>ثبت سفارش / گالری نویر نگین</h2>
        <div class="inForm">
            <div class='form-box'>
                <label class='form-label' for="fullName">نام و نام خانوادگی</label>
                <input class='form-inp' type="text" id='fullName' name='fullName' />
                <p class='red'></p>
            </div>
            <div class='form-box'>
                <label class='form-label' for="mail">پست الکترونیک (اختیاری)</label>
                <input class='form-inp' type="email" id='mail' name='mail' placeholder='example@gmail.com' dir='ltr' />
                <p class='red'></p>
            </div>
            <div class='form-box'>
                <label class='form-label' for="province">استان / شهر</label>
                <input class='form-inp' type="text" id='province' name='province' />
                <input class='form-inp' type="text" id='town' name='town' />
                 <p class='red'></p>
                <p class='red'></p>
            </div>


            <div class='form-box'>
                <label class='form-label' for="postalCode">کد پستی</label>
                <input class='form-inp' type="number" id='postalCode' name='postalCode' placeholder='123456789' dir='ltr' />
                <p class='red'></p>
            </div>
            <div class='address-box'>
                <label for="textarea" class='form-label'>آدرس</label>
                <textarea name="textarea" id="textarea" cols="30" rows="10"></textarea>
               <p class='red'></p>
            </div>
            <div class='btn-box my-5'>
                <button type='submit'> ادامه</button>
            </div>
            <div class='process d-flex justify-content-between align-items-center px-5'>
                <span></span>
                <span class='black'></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </form>
      </div>
</body>

<script>
    function validateMainForm() {
  let fullName = document.forms["MainForm"]["fullName"].value;
  let mail = document.forms["MainForm"]["mail"].value;
  let province = document.forms["MainForm"]["province"].value;
  let town = document.forms["MainForm"]["town"].value;
  let postalCode = document.forms["MainForm"]["postalCode"].value;
  let textarea = document.forms["MainForm"]["textarea"].value;
  let error =  document.getElementsByClassName("red")

  if(
    (fullName == null || fullName =='')){
    error[0].innerHTML="این فیلد اجباری است."
    return false
  }else if(
    (fullName.length<4)
  ){
    error[0].innerHTML="نام و نام خانوادگی را کامل وارد کنید."
    return false
  }else{
    error[0].innerHTML=""
  }

  if((mail.search('script') >= 0 )){
    error[1].innerHTML="ایمیل نامعتبر است"
    return false
  }else{
    error[1].innerHTML=""
  }

  if((province == null || province =='')){
    error[2].innerHTML="استان را وارد کنید."
    return false
  }else{
    error[2].innerHTML=""
  }
// ************

// ************
  if((postalCode == null || postalCode =='')){
    error[4].innerHTML="کد پستی  اجباری است."
    return false
  }else if((postalCode.length) !== 10){
    error[4].innerHTML="کد پستی نامعتبر است."
    return false
  }else{
    error[4].innerHTML=""
  }


  if((textarea == null || textarea =='')){
    error[5].innerHTML="آدرس  اجباری است."
    return false
  }else if((textarea.length)< 10){
    error[5].innerHTML="آدرس را کامل وارد کنید.."
    return false
  }else{
    error[5].innerHTML=""
  }

  

  }
</script>
<script>






$('#dataForm').submit(function(e){
    e.preventDefault();
    var fullName=$("#fullName").val();
    var mail=$("#mail").val();
    var province=$("#province").val();
    var town=$("#town").val();
    var postalCode=$("#postalCode").val();
    var address=$("#textarea").val();
    if(!(fullName == null || fullName =='') &&  !(fullName.length<4) && !(mail.search('script') >= 0 ) && !(province == null || province =='') && !(postalCode == null || postalCode =='') && !((postalCode.length) !== 10) && !(textarea == null || textarea =='') && !((textarea.length)< 10)){
    $.ajax({
        url:"../app/function/loadUserData.php",
                method: 'post',
                data:{
                    'fullName':fullName,
                    'mail':mail,
                    'province':province,
                    'town':town,
                    'postalCode':postalCode,
                    'address':address
                },
                success:function(result){
                    if(result=='no'){
                        alert(result);
                    }
                    else if(result=='please wait'){
                        alert(result);
                    }
                    else{
                        
                        window.location.replace('./uploade.php');
                    }
                },  
    });
  }     
});    
       
</script>
<script>
$(document).ready(function(e){
$.ajax({
        url:"../app/function/phoneDataAjax.php",
        method: 'post',

                success:function(result){
                    var array = JSON.parse(result);
                    $('#fullName').val(array['fullname']);
                    $('#mail').val(array['mail']);
                    $('#province').val(array['province']);
                    $('#town').val(array['town']);
                    $('#postalCode').val(array['postalCode']);
                     $('#textarea').val(array['address']);
                },  
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</html>