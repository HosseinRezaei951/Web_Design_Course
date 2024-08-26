<?php
require_once "Models/user.php";
session_start();


$u = new customer();
if (!isset($_SESSION['USER'])) {
    header('Location: login.php');
} else {
    $u = unserialize($_SESSION['USER']);
}

require "Configs/config.php";
require "Models/reservation.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

$htmlData = "";

$_model = new reservation();
$_model->setUsername($u->getUsername());
$times = $_model->getReservationByUsername();
$htmlData .= '
            <div class="container-fluid">
                <div class="row">
                <div class="text-center"><h1>User Reservations</h1></div>
            ';

for ($i = 0; $i < count($times); $i++) {
    $htmlData .= '<div class="col-md-4 col-sm-6">
                    <div class="text-center">
                        <div class="card-time">'.
                            '<div class="text-container">'.$times[$i]->getdate().'</div>'.
                            '<a href="cancelReserve.php?date='.$times[$i]->getdate().'">Cancel Reservation</a>'.
                        '</div>
                    </div>                    
                </div>';
}
$htmlData .= '    
                          
                </div> 
            </div>
        ';
           

include $ViewsPath . "userReservations.html";
include $SharedFolderPath . "footer.html";




