<?php
//
//include 'functions.php';
//
//$start = null;
//$exit_louch = null;
//$start = date('Y-m-d 10:11');


//$need = date('08:00:00');
//$exit_louch = date('Y-m-d 11:54');
//$back_louch = date('Y-m-d 12:27');
//
//$now = date('Y-m-d H:i');
//$date = date('Y-m-d 13:00:00');
//$calc = strtotime($now) - strtotime($date);

//function calc($value1, $value2)
//{
//    $Start = new \DateTime($value1);
//    $end   = new \DateTime($value2);
//    $dateDiff = $Start->diff($end);
//    $result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';
//
//    return $result;
//}

//echo 'Necessario => ' . $need . '<br>';
//echo  '<br>';
//echo 'Entrada => ' . $start . '<br>';
//echo  '<br>';
//echo 'Saida Almo�o => ' . $exit_louch . '<br>';
//echo  '<br>';
//echo 'Volta Almo�o => ' . $back_louch . '<br>';


//$worked = calc($now, $start);


//echo  $worked;
?>
<!DOCTYPE html>
<html>
    <head>
    <style>
        body {background-color: powderblue;}
        h1   {color: blue;}
        p    {color: red;}
        .main {
            background-color: yellow;
            margin: 30px
        }  
        .blocos{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        } 
        .bloco {z
            border: 1px solid black;
            margin: 10px;
            width: 300px
        }
    </style>
    </head>
    <body>
        <div class="main"> 
            Necessario = 08:00
            <hr>
            <div class="blocos">
                <div class="bloco">
                    Entrada: <br>
                    <input type="time" name="start" value="" id="start">
                    <button id="btnStart">Entrada</button><br>
                    Saida Almoco: <br>
                    <input type="time" name="start" value="">
                    <button id="">Saida Almoco</button><br>
                    Volta Almoco: <br>
                    <input type="time" name="start">
                    <button id="">Entrada Almoco</button><br>
                    Saida: <br>
                    <input type="time" name="start">
                    <button id="">Saida</button><br>
                </div>
                <div class="bloco">
                    <div id="view_start"></div>
                </div>
            </div>   
        </div> 
    </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {

        var start = 0;

        $('#btnStart').click(function () {
            var val_start = $('#start').val();
            $('#view_start').append( "Entrada: " + val_start)
        });

        $.ajax({
            type: 'post',
            url: 'functions.php',
            data: {
                start: start
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
            }

        });
    });
</script>

