<?php

require_once "Configs/config.php";
require_once "Models/workSample.php";

$_workSamples = new workSample();
$workSamplesList = $_workSamples-> GetAllAngular();
echo json_encode($workSamplesList);