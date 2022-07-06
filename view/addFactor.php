<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
        <img
          src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
          height="15"
          alt="MDB Logo"
          loading="lazy"
        />
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="./addFactor.php">addFactor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./confirmFactor.php">confirmFactor</a>
        </li>

      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
        <i class="fas fa-shopping-cart"></i>

      <!-- Notifications -->
      <div class="dropdown">
    
      <a
          class="text-reset me-3 dropdown-toggle hidden-arrow"
          href="./confirmFactor.php"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
        <!-- //TODO:please set svg   -->
        <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger" id='numbers'></span>
        </a>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</br>
</br>
<form id="addFactor">
  <div class="row">
    <div class="col-5">
      <input type="text" class="form-control" placeholder="name" id="name">
    </div>
    <div class="col-2">
      <input type="number" class="form-control" placeholder="number" id="number" value="1">
    </div>
    <div class="col-3">
      <input type="number" class="form-control" placeholder="fee" id="fee">
    </div>
    <input type="hidden" name="totalfee" id="totalfee"  value="0">
    <input type="hidden" name="count" id="count" value="0" >
    </br></br>
    <button type="submit" class="btn btn-primary btn-lg btn-block">افزودن کالا</button>
    </br></br>
  </div>
</form>
</br></br>

    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">number</th>
                <th scope="col">fee</th>
                <th scope="col">rowfee</th>
                <th scope="col">DELET</th>
            </tr>

        </thead>
        <tbody  id="showFile">
           



        </tbody>
        <tr>
                <th id='total'>

                </th>
        </tr>
    </table>

    <button type="button" class="btn btn-success"  id='taid' name='taid'>ثبت فاکتور</button>

    <div id='showFactorId'>

    </div>
    <script>
        $("#addFactor").submit(function(e){
          $("#showFactorId").empty();
            e.preventDefault();
            var count=parseInt($('#count').val());
            var totalfee=parseInt($('#totalfee').val());
            var number =parseInt($("#number").val());
            var name=$("#name").val();
            var fee=parseInt($("#fee").val());
            var t ='';
             if($("#name").val() !='' && $("#number").val() !='' && $("#fee").val() !='' )
             {              
                            $.ajax({
                            url:"../app/function/pishfactor.php",
                            method: 'post',
                            data:{
                                "name":name,
                                "fee":fee,
                                "number":number,
                                "totalfee":totalfee,
                                "count":count,
                            },
                            success:function(result){
                                var array = JSON.parse(result);
                                $('#showFile').empty();
                                for(let i=0 ;i<array.length ;i++){
                                    $('#showFile').append("<tr id='"+i+"'><tr>");
                                    var txt1= $("<td></td>").text(parseInt(i)+1);
                                    var txt2= $("<td></td>").text(array[i]['name']);
                                    var txt3= $("<td></td>").text(array[i]['number']);
                                    var txt4= $("<td></td>").text(array[i]['fee']);
                                    var txt5= $("<td></td>").text(array[i]['rowFee']);
                                    var txt6= $('<button type="button" class="btn btn-link btn-sm px-3 bg-danger text-white" data-ripple-color="dark "></button>').text('Delete').val(i);
                                    $('#totalfee').val(array[i]['totalfee']);
                                     t='#'+i
                                    $(t).append(txt1,txt2,txt3,txt4,txt5,txt6);
                                }
                                $("#count").val(array[array.length - 1]['count']);
                                console.log(array[array.length - 1]['count']);
                                $("#total").text($("#totalfee").val());
                                $("#number").val(1);
                                $("#name").val("");
                                $("#fee").val(0);
                            },  

                });     
            } 
            
            else{
                                alert('please Complete input' );
                            }
        });

        </script>
        <script>


        $('#showFile').on('click','button',function(e){
                e.preventDefault();
                $("#showFactorId").empty();
                var delate = $(this).val() ;
                $.ajax({
                    url:"../app/function/deleteRowPishFactor.php",
                            method: 'post',
                            data:{
                                "id":delate,
                            },
                            success:function(result){
                                var array = JSON.parse(result);
                                $('#showFile').empty();
                                for(let i=0 ;i<array.length ;i++){
                                    $('#showFile').append("<tr id='"+i+"'><tr>");
                                    var txt1= $("<td></td>").text(parseInt(i)+1);
                                    var txt2= $("<td></td>").text(array[i]['name']);
                                    var txt3= $("<td></td>").text(array[i]['number']);
                                    var txt4= $("<td></td>").text(array[i]['fee']);
                                    var txt5= $("<td></td>").text(array[i]['rowFee']);
                                    var txt6= $('<button type="button" class="btn btn-link btn-sm px-3 bg-danger text-white" data-ripple-color="dark "></button>').text('Delete').val(i);
                                    $('#totalfee').val(array[i]['totalfee']);
                                     t='#'+i
                                    $(t).append(txt1,txt2,txt3,txt4,txt5,txt6);
                                }
                                $("#count").val(array[array.length - 1]['count']);
                                $("#total").text($("#totalfee").val());
                            },  
                });
        });


        </script>
        <script>
            $('#taid').click(function(e){
                e.preventDefault();
                $("#showFactorId").empty();
                if($('#count').val()!='0'){
                    $.ajax({
                        url:"../app/function/addFactor.php",
                                method: 'post',
                                success:function(result){
                                        console.log(result);
                                        $('#count').val(0);
                                        $('#totalfee').val(0);
                                        $("#number").val(1);
                                        $("#name").val("");
                                        $("#fee").val(0);
                                        $('#showFile').empty();
                                        $('#total').val(0);
                                        $("#total").text(0);
                                        var text=$("<h1></h1>").text(result);
                                        $("#showFactorId").append(text);
                                },  
                    });
                }
                else{
                    alert('plase add yek kalaii ezaf kon khooo');
                }
            });
        </script>
        
<script>
     $(document).ready(function(e){
            $.ajax({
                        url:"../app/function/factorDeactive.php",
                        method: 'post',
                                success:function(result){
                                    var array = JSON.parse(result);
                                    $('#numbers').text(array.length);
                                },  
                    });
        });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>