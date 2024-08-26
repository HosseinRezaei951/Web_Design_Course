<?php
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header('Location: adminLogin.php');
} else {
    $u = unserialize($_SESSION['ADMIN']);
}

require "Configs/config.php";
require "Models/reserveTime.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

$uiDate_cv = "";
$uiTime_cv = "";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiAdd'])) {

        $uiDate_cv = $_POST['uiDate'];
        $uiTime_cv = $_POST['uiTime'];
         
        $validationMessage = validation();
        if ($validationMessage == "") {
            $_model = new reserveTime();
            $_model->setDate($_POST['uiDate'].' '. $uiTime_cv = $_POST['uiTime']);
            
            if ($_model->Save() == TRUE)
                $Message = 'You have successfully added.';
            else
                $Message = 'This Date&Time is used.';
        } else
            $Message = $validationMessage;
    }
}

include $ViewsPath . "adminAddReserveTimes.html";
include $SharedFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST['uiDate'] == "")
        $Message = 'Enter your date' . "<br/>";
    if ($_POST['uiTime'] == "")
        $Message .= 'Enter your time' . "<br/>";
    

    return $Message;
}
