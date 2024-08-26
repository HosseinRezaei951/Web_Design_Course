<?php

require_once "Configs/config.php";
require_once "Models/reservation.php";

$_reservation = new reservation();
$_reservationList = $_reservation-> GetAllAngular();
echo json_encode($_reservationList);