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
<table>
    <thead>
        <tr>

            <th>
                name
            </th>
            <th>
                number
            </th>
            <th>
                fee
            </th> 
            <th>
                rowFee
            </th>  
        <tr>
    </thead>
    <tbody  id="showFile">
    <p id='total'></p>
    </tbody>
    </table>
    <form   enctype="multipart/form-data" id="dataForm">
        <input type="hidden" id="factorid" name="factorid" value="<?php echo $_GET['factorid']  ?>">
        <input type="hidden" id="phone" name="phone" value="<?php echo $_GET['phone']  ?>">
        <input type="text" id='name' name='name'  >
        <input type="text" id='family' name='family' >
        <input type="text"  id='adrress' name='adrress'>
        <input type="text" id='city' name="city">
        <input type="text" id='state' name="state">
        <input type="file" id="file" name="file">
        <button type="submit">send data</button>
    </form>
    <script>
        $(document).ready(function(e){
            $.ajax({
                        url:"../app/function/loadFactor.php",
                        method: 'post',
                        data:{
                            factorid:$("#factorid").val(),
                            phone:$("#phone").val(),
                        },
                                success:function(result){
                                   var array = JSON.parse(result);
                                    $('#showFile').empty();
                                    var total=0;
                                    for(let i=0 ;i<array.length ;i++){
                                        $('#showFile').append("<tr id='"+i+"'><tr>");
                                        var txt1= $("<td></td>").text(array[i]['name']);
                                        var txt2= $("<td></td>").text(array[i]['number']);
                                        var txt3= $("<td></td>").text(array[i]['fee']);
                                        var txt4= $("<td></td>").text(array[i]['rowFee']);
                                        total += array[i]['rowFee'];
                                        t='#'+i
                                        $(t).append(txt1,txt2,txt3,txt4);
                                    }
                                    $("#total").text(total);
                                },  
                    });
        });

    </script>
        <script>

                $('#dataForm').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '../app/function/uploadeData.php',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        
                        success: function(result){ 
                            console.log(result);
                        }
                        
                  });
                 
                });                
    </script>
</body>
</html>