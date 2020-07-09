<?php

include 'controller/PointController.php';

$params = $_REQUEST;

$point = new PointController();
$checkPoint = $point->checkPoint();

echo $checkPoint;




