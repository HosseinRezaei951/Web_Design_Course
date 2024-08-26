<?php
session_start();

if(!isset($_COOKIE["modelID"])){
    $cookie_name = "modelID";
    $cookie_data = $_GET['ModelID'];
    setcookie($cookie_name,$cookie_data,time()+86400*30);
}

if (!isset($_SESSION['USER'])) {
    header('Location: login.php');
} else {
    $u = unserialize($_SESSION['USER']);
}

require "Configs/config.php";
require "Models/reserveTime.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

$htmlData = "";
$uiDate1_cv = "";
$uiDate2_cv = "";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiSearch'])) {

        $uiDate1_cv = $_POST['uiDate1'];
        $uiDate2_cv = $_POST['uiDate2'];

        $validationMessage = validation();
        if ($validationMessage == "") {
            $_model = new reserveTime();
            $times = $_model->GetByDate($_POST['uiDate1'] . ' ' . '00:00:00', $_POST['uiDate2'] . ' ' . '23:59:00');

            $htmlData .= '
                        <div class="container-fluid">
                            <div class="row">                
                    ';

            for ($i = 0; $i < count($times); $i++) {
                $htmlData .= '<div class="col-md-4 col-sm-6">
                                <div class="text-center">
                                
                                <a href="setReserve.php?ModelID='.$_COOKIE['modelID'].'&SelectedTime='.$times[$i]->getDate().'">
                                <div class="card-time">'. $times[$i]->getDate() .'</div>
                                </a>
                                
                                </div>
                                </div>';
            }
            $htmlData .= '        
                            </div> 
                        </div>
                    ';

            // if ($_model->Save() == TRUE)
            //     $Message = 'You have successfully added.';
            // else
            //     $Message = 'This Date&Time is used.';
        } else
            $Message = $validationMessage;
    }
}

include $ViewsPath . "searchTime.html";
include $SharedFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST['uiDate1'] == "")
        $Message = 'Enter your start date' . "<br/>";
    if ($_POST['uiDate2'] == "")
        $Message .= 'Enter your end date' . "<br/>";


    return $Message;
}
