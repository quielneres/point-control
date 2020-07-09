<?php

include 'config/Connection.php';

$start = null;
$exit_lunch = null;
$back_lunch = null;
$exit = null;

$db = new Connection();

$sql = "select *from point_register where created_at LIKE  '%" . date('Y-m-d') . "%';";
$ret = $db->query($sql);
$registers = $ret->fetchArray(SQLITE3_ASSOC);

$db->close();



function calcTime($registers){

    if($registers['hour_start']){

        $now = date('H:i');
        $start = $registers['hour_start'];
        $end_day = false;

        $partial = calc($now, $start);

        if($registers['hour_exit_lunch']){
            $partial_exit_lunch = calc($registers['hour_exit_lunch'], $registers['hour_start']);
            $partial = $partial_exit_lunch;
        }

        if($registers['hour_back_lunch']){
            $partial_back = calc($now, $registers['hour_back_lunch']);
            $sum_partials =  str_replace(':', '.', $partial) + str_replace(':', '.', $partial_back);
            $partial = float_min($sum_partials);
        }

        if ($registers['hour_exit']){
            $first_period = calc($registers['hour_exit_lunch'], $registers['hour_start']);
            $second_period = calc($registers['hour_back_lunch'], $registers['hour_exit']);
            $sum_partials =  str_replace(':', '.', $first_period) + str_replace(':', '.', $second_period);
            $partial = float_min($sum_partials);
            $end_day = true;
        }
        return ['time' =>$partial, 'end_day' => $end_day];
    }
}

function float_min($num) {
    $num = number_format($num,2);
    $num_temp = explode('.', $num);
    $num_temp[1] = $num-(number_format($num_temp[0],2));
    $saida = number_format(((($num_temp[1]) * 60 / 100)+$num_temp[0]),2);
    $saida = strtr($saida,'.',':');
    return $saida;
    // By Alexandre Quintal - alexandrequintal@yahoo.com.br
}

function calc($value1, $value2)
{
    $Start = new \DateTime($value1);
    $end = new \DateTime($value2);
    $dateDiff = $Start->diff($end);
    $result = $dateDiff->format("%H:%I");

    return $result;
}




