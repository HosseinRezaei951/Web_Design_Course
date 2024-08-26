<?php
session_start();
if (!isset($_SESSION['ADMIN'])) {
    header('Location: adminLogin.php');
} else {
    $u = unserialize($_SESSION['ADMIN']);
}

require "Configs/config.php";
require "Models/model.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

$uiModelName_cv = "";
$uiModelCategory_cv = "";
$uiPhoto_cv = "";
$uiPrice_cv = "";
$uiDescription_cv = "";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiAdd'])) {

        $uiModelName_cv = $_POST['uiModelName'];
        $uiModelCategory_cv = $_POST['uiModelCategory'];
        $uiPrice_cv = $_POST['uiPrice'];
        $uiDescription_cv = $_POST['uiDescription'];

        $validationMessage = validation();
        if ($validationMessage == "") {
            $_model = new model();
            $_model->setModelName($_POST['uiModelName']);
            $_model->setModelType($_POST['uiModelCategory']);
            $_model->setPhotoUrl($_FILES['uiPhoto']);
            $_model->setPrice($_POST['uiPrice']);
            $_model->setDescription($_POST['uiDescription']);

            if ($_model->Save())
                $Message = 'You have successfully add.';
            else
                $Message = 'Error ...';
        } else
            $Message = $validationMessage;
    }
}

include $ViewsPath . "adminModel.html";
include $SharedFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST['uiModelName'] == "")
        $Message = 'Enter your model name' . "<br/>";
    if ($_POST['uiModelCategory'] == "")
        $Message .= 'Enter your model category' . "<br/>";
    if ($_POST['uiPrice'] == "")
        $Message .= 'Enter your price' . "<br/>";
    if ($_POST['uiDescription'] == "")
        $Message .= 'Enter your description' . "<br/>";

    return $Message;
}
