<?php
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header('Location: adminLogin.php');
} else {
    $u = unserialize($_SESSION['ADMIN']);
}

require "Configs/config.php";
require "Models/barberShop.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

include $ViewsPath . "adminSeeReservation.html";
include $SharedFolderPath . "footer.html";



