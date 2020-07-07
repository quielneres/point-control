<?php

$asda = 123;

function calc($value1, $value2)
{
    $Start = new \DateTime($value1);
    $end   = new \DateTime($value2);
    $dateDiff = $Start->diff($end);
    $result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';

    return $result;
}

echo json_encode();

