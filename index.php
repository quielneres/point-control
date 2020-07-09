<?php
//
//include 'controller.php';
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
        body {
            background-color: powderblue;
        }

        h1 {
            color: blue;
        }

        p {
            color: red;
        }

        .main {
            background-color: yellow;
            margin: 30px;
            width: 50%;
        }

        .blocos {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;

        }

        .bloco {
            z border: 1px solid black;
            margin: 10px 40px 10px 40px;
        }
    </style>
</head>
<body>
<div class="main">
    Necessario = 08:00
    <hr>
    <div id="empty-view"></div>
    <div class="blocos">
        <div class="bloco">
            Entrada: <br>
            <input type="time" name="start" value="" id="input_start">
            <button id="btnStart">Entrada</button>
            <br>
            Saida Almoco: <br>
            <input type="time" name="start" value="" id="input_exit_lunch">
            <button id="">Saida Almoco</button>
            <br>
            Volta Almoco: <br>
            <input type="time" name="start" id="imput_back_lunch">
            <button id="">Entrada Almoco</button>
            <br>
            Saida: <br>
            <input type="time" name="start" id="input_exit">
            <button id="">Saida</button>
            <br>
        </div>
        <div class="bloco">
            <div id="view_start"></div>
            <div id="hour_exit_lunch"></div>
            <div id="hour_back_lunch"></div>
            <div id="hour_exit"></div>
        </div>
        <div class="bloco">
            Necessario = 08:00 <br>
            <div id="view_hours_done"></div>
            <div id="view_hours_left"></div>
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
            $('#view_start').append("Entrada: " + val_start)
        });

        $.ajax({
            type: 'post',
            url: 'router.php',
            data: {
                start: start
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status === true) {
                    beatVefify(response.data)
                    timeControll(response.time_control)
                }
                if (response.status === false) {
                    $('#empty-view').append(response.message)
                }
            },

            error: function (xhr, status, error) {
                console.log(xhr, status, error);//Captura o erro e envia ao console
            }

        });
    });

    function timeControll(time_control) {

        $('#view_hours_done').append('Horas feitas: ' + time_control.hours_done)
        if (time_control.end_day) {
            $('#view_hours_left').append('Horas em debitos: ' + time_control.hours_left)
        } else {
            $('#view_hours_left').append('Horas Restantes: ' + time_control.hours_left)
        }

    }

    function beatVefify(data) {
        if (data.hour_start) {
            $('#input_start').val(data.hour_start)
            $('#view_start').append('Entrada: ' + data.hour_start)
        }

        if (data.hour_exit_lunch) {
            $('#input_exit_lunch').val(data.hour_exit_lunch)
            $('#hour_exit_lunch').append('Saida Almoco: ' + data.hour_exit_lunch)
        }

        if (data.hour_back_lunch) {
            $('#imput_back_lunch').val(data.hour_back_lunch)
            $('#hour_back_lunch').append('Volta do almoco: ' + data.hour_back_lunch)
        }

        if (data.hour_exit) {
            $('#input_exit').val(data.hour_exit)
            $('#hour_exit').append('Saida: ' + data.hour_exit)
        }
    }
</script>

