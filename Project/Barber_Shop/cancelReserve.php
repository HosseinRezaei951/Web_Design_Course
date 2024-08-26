<?php 
session_start();
require_once 'Configs/config.php';
require 'Models/reservation.php';
require 'Models/user.php';
$u = new customer();
if(!isset($_SESSION['USER'])) {
    header('Location: login.php');
}
else
{
    
    $u = unserialize($_SESSION['USER']);
   




}

$date = $_GET["date"];
$model = new reservation();
$model->setUsername($u->getUsername());
$model->setDate($date);
$model->Cancel();
header('Location: userReservations.php');

?>
