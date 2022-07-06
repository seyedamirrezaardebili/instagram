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
        <div class='receiptBox col-11 col-md-8 col-lg-6 col-xl-4'>
            <h3>اطلاعات پرداختی</h3>
            <form  class='px-2' name="factorIdForm" onsubmit="return validateFactorId()" id="dataForm">
            <div class='savedAddress px-3 mt-2 d-none'>
                <div class='d-flex justify-content-between '>
                    <input class='mx-1' type="radio" id='savedAddress' name='savedAddress'/>
                    <label for="savedAddress">متن آدرس</label>
                </div>
                <div class='addressIcons'>
                <a href=""><ionIcon.IoTrashOutline class='mx-3' /></a>
                    <a href=""><ionIcon.IoCreateOutline /></a>
                </div>
            </div>
                <p class='text'>بارگذاری تصویر رسید پرداختی</p>
                <div class='fileWrap'>
                <figure id="file-preview"><img src="" alt=""><figcaption></figcaption></figure>
                    <label for="file">بارگذاری تصویر رسید بانکی</label>
                    <input onchange="showPreview(event)" type="file" id="file" accept="image/*" name="receipt">
                <span class='red px-2'></span>
                </div>
                <label class='text' for="factorId">شماره فاکتور دریافت شده</label>
                <input class='form-inp' type="number" id='factorId' dir='ltr' name="factorId"/>
                <span class='red'></span>
                <button type='submit'>ثبت نهایی سفارش</button>
                <div class='process d-flex justify-content-between align-items-center px-5 mt-2'>
                    <span class='black'></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </form>
        </div>            
    </div>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>

<script>
// Show image *********************************
let preview = document.getElementById("file-preview");
  function showPreview(event){
  if(event.target.files.length > 0){
    let src = URL.createObjectURL(event.target.files[0]);
    preview.firstChild.src = src;
    preview.style.display = "block";
    preview.lastChild.innerHTML = '<ion-icon onclick="removeItem()" name="close"></ion-icon>'
  }
}
function removeItem(){
      document.querySelector("figcaption ion-icon").parentElement.parentElement.remove()
  }


//validation *********************************************
function validateFactorId() {
  let receipt = document.forms["factorIdForm"]["receipt"].value;
  let factorId = document.forms["factorIdForm"]["factorId"].value;
  let error =  document.getElementsByClassName("red")
  if (receipt == "") {
    error[0].innerHTML = "رسید پرداختی خود را بارگذاری کنید."
    return false;
  } else{
    error[0].innerHTML = ""
  }

  if (factorId == "") {
    error[1].innerHTML = "شماره فاکتور دریافتی را وارد نمایید."
    return false;
  } else{
    error[1].innerHTML = ""
  }
  console.log(receipt)
}


</script>

        <script>

                $('#dataForm').submit(function(e){
                    e.preventDefault();
                    var factorid=$("#factorId").val();
                    $.ajax({
                        type: 'POST',
                        url: '../app/function/fileUplode.php',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(response){ 
                               if(response==1){
                                    window.location.replace("./success.html");
                               }
                        }
                  });
                 
                });                
    </script>

</html>