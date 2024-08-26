<?php
session_start();

require "Configs/config.php";
require "Models/user.php";
require "Models/reservation.php";

$u = new customer();
 
if (!isset($_SESSION['USER'])) {
    header('Location: login.php');
} else {
    $u = unserialize($_SESSION['USER']);
}

if(!isset($_COOKIE["date"])){
    $cookie_name = "date";
    $cookie_data = $_GET['SelectedTime'];
    setcookie($cookie_name,$cookie_data,time()+86400*30);
}


include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

$uiDescription_cv = "";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiSetReserve'])) {

        $uiDescription_cv = $_POST['uiDescription'];

        $validationMessage = validation();
        if ($validationMessage == "") {
            $_reservation = new reservation();
            $_reservation->setDate($_COOKIE["date"]);
            $_reservation->setModelId($_COOKIE["modelID"]);
            $_reservation->setUsername($u->getUsername());
            $_reservation->setDescription($_POST['uiDescription']);

            setcookie("date",null,time()+1);
            setcookie("modelID",null,time()+1);
                        
            if ($_reservation->Save() == true)
            {
                $Message = 'You have successfully reserved.';
                header('Location: index.php');
            }
            else
                $Message = 'Error ...';
        } else
            $Message = $validationMessage;
    }
}

include $ViewsPath . "setReserve.html";
include $SharedFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST['uiDescription'] == "")
        $Message = 'Enter your description' . "<br/>";

    return $Message;
}
