<?php

$asda = 123;

class MyDB extends SQLite3 {
    function __construct() {
        $this->open('data\ponto.db');
    }
}
$db = new MyDB();
if(!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "Opened database successfully\n";
}

function calc($value1, $value2)
{
    $Start = new \DateTime($value1);
    $end   = new \DateTime($value2);
    $dateDiff = $Start->diff($end);
    $result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';

    return $result;
}

echo json_encode('23423');

