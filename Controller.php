<?php

include 'config/Conection.php';

$db = new Conection();

$sql =<<<EOF
select * from point_register;
EOF;

$ret = $db->query($sql);

$db->close();

//function calc($value1, $value2)
//{
//    $Start = new \DateTime($value1);
//    $end   = new \DateTime($value2);
//    $dateDiff = $Start->diff($end);
//    $result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';
//
//    return $result;
//
//
//}


echo json_encode('23423');

