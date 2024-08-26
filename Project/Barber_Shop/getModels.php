<?php

require_once "Configs/config.php";
require_once "Models/model.php";

$_models = new model();
$modelsList = $_models-> GetAllAngular();
echo json_encode($modelsList);