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
    

<div id='showFile'>

</div>

<script>
     $(document).ready(function(e){
        var cont=0;
        $('#cont').val(cont);
            $.ajax({
                        url:"../app/function/factorDeactive.php",
                        method: 'post',
                                success:function(result){
                                    var array = JSON.parse(result);
                                    for(let i=0 ;i<array.length ;i++){
                                        console.log(i);
                                        $('#showFile').append("<div id='"+i+"'><div>");
                                        var txt1= $("<img>").attr('src',array[i]['img']);
                                        var txt2=$('<form ><input>serial<button>send</button></form>');
                                        var txt3= $('<button></button>').text('delet').val(i);
                                        $('#totalfee').val(array[i]['totalfee']);
                                        t='#'+i
                                        $(t).append(txt2,txt1);
                                    }
                                },  
                    });
        });
</script>


</body>
</html>