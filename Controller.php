<?php

include 'config/Conection.php';

$start = null;
$exit_lunch = null;
$back_lunch = null;
$exit = null;

$db = new Conection();

$sql = "select *from point_register where created_at LIKE  '%" . date('Y-m-d') . "%';";
$ret = $db->query($sql);
$register = $ret->fetchArray(SQLITE3_ASSOC);
$db->close();

$beats = null;
if ($register) {

//    $beats = [
//        'id' => $register['id'],
//        'start' => $register['hour_start'],
//        'exit_lunch' => $register['exit_lunch'],
//        'back_lunch' => $register['back_lunch'],
//        'exit' => $register['exit'],
//    ];

    echo json_encode(['status' => true, 'data' => $register]);
}

//function calc($value1, $value2)
//{
//    $Start = new \DateTime($value1);
//    $end = new \DateTime($value2);
//    $dateDiff = $Start->diff($end);
//    $result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';
//
//    return $result;
//}




