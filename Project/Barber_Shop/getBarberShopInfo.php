<?php

require_once "Configs/config.php";
require_once "Models/barberShop.php";

$_barberShopInfo = new barberShop();
$_barberShopInfoList = $_barberShopInfo-> GetInfoAngular();
echo json_encode($_barberShopInfoList);