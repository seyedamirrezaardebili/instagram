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
                del
            </th>
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
    <form   id="addFactor">
        <input type="text" name="name" id="name">name<br>
        <input type="text" name="number" id="number"  value="1">number<br>
        <input type="text" name='fee' id='fee' >fee<br>
        <input type="hidden" name="totalfee" id="totalfee"  value="0">;
        <input type="hidden" name="count" id="count" value="0" >
        <button type="submit" >submit</button>
    </form>

    <button id='taid' name='taid'>sabte nahaii</button>
    <script>
        $("#addFactor").submit(function(e){
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
                                    var txt1= $("<td></td>").text(array[i]['name']);
                                    var txt2= $("<td></td>").text(array[i]['number']);
                                    var txt3= $("<td></td>").text(array[i]['fee']);
                                    var txt4= $("<td></td>").text(array[i]['rowFee']);
                                    var txt5= $('<button></button>').text('delet').val(i);
                                    $('#totalfee').val(array[i]['totalfee']);
                                     t='#'+i
                                    $(t).append(txt5,txt1,txt2,txt3,txt4);
                                }
                                $("#count").val(array[array.length - 1]['count']);
                                console.log(array[array.length - 1]['count']);
                                $("#total").text($("#totalfee").val());
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
                                    var txt1= $("<td></td>").text(array[i]['name']);
                                    var txt2= $("<td></td>").text(array[i]['number']);
                                    var txt3= $("<td></td>").text(array[i]['fee']);
                                    var txt4= $("<td></td>").text(array[i]['rowFee']);
                                    var txt5= $('<button></button>').text('delet').val(i);
                                    $('#totalfee').val(array[i]['totalfee']);
                                     t='#'+i
                                    $(t).append(txt5,txt1,txt2,txt3,txt4);
                                }
                                $("#count").val(array[array.length - 1]['count']);
                                console.log(array[array.length - 1]['count']);
                                $("#total").text($("#totalfee").val());
                            },  
                });
        });


        </script>
        <script>
            $('#taid').click(function(e){
                e.preventDefault();
                if($('#count').val()!='0'){
                    $.ajax({
                        url:"../app/function/addFactor.php",
                                method: 'post',
                                data:{
                                    
                                },
                                success:function(result){
                                    window.location.replace(result);
                                },  
                    });
                }
                else{
                    alert('plase add yek kalaii ezaf kon khooo');
                }
            });
        </script>

</body>
</html>