<?php
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header('Location: adminLogin.php');
} else {
    $u = unserialize($_SESSION['ADMIN']);
}

require "Configs/config.php";
require "Models/workSample.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

$uiModelName_cv = "";
$uiPhoto_cv = "";
$uiDescription_cv = "";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiAdd'])) {

        $uiModelName_cv = $_POST['uiModelName'];
        $uiDescription_cv = $_POST['uiDescription'];

        $validationMessage = validation();
        if ($validationMessage == "") {
            $_workSample = new workSample();
            $_workSample->setModelName($_POST['uiModelName']);
            $_workSample->setPhoto($_FILES['uiPhoto']);
            $_workSample->setDescription($_POST['uiDescription']);

            if ($_workSample->Save())
                $Message = 'You have successfully add.';
            else
                $Message = 'Error ...';
        } else
            $Message = $validationMessage;
    }
}

include $ViewsPath . "adminWorkSamples.html";
include $SharedFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST['uiModelName'] == "")
        $Message = 'Enter your model name' . "<br/>";
    if ($_POST['uiDescription'] == "")
        $Message .= 'Enter your description' . "<br/>";

    return $Message;
}
