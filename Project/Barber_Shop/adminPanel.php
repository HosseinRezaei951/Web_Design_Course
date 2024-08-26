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

$_OldbarberShope = new barberShop();
$_OldbarberShope->GetInfo();

$uiLicenseNumber_cv = $_OldbarberShope->getLicenseNumber();
$uiName_cv = $_OldbarberShope->getName();
$uiPhoneNumber_cv = $_OldbarberShope->getPhonenumber();
$uiPhoto_cv = "";
$uiLogo_cv = "";
$uiAddress_cv = $_OldbarberShope->getAddress();

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiUpdate'])) {
        
        $uiLicenseNumber_cv = $_POST['uiLicenseNumber'];
        $uiName_cv = $_POST['uiName'];
        $uiPhoneNumber_cv = $_POST['uiPhoneNumber'];
        $uiAddress_cv = $_POST['uiAddress'];

        $validationMessage = validation();
        if ($validationMessage == "") {
            $_barberShope = new barberShop();
            $_barberShope->GetInfo();
            $_barberShope->setName($_POST['uiName']);
            $_barberShope->setPhonenumber($_POST['uiPhoneNumber']);
            $_barberShope->setPhoto($_FILES['uiPhoto']);
            $_barberShope->setLogo($_FILES['uiLogo']);
            $_barberShope->setAddress($_POST['uiAddress']);

            if ($_barberShope->Update($_POST['uiLicenseNumber']))
                $Message = 'You have successfully updated Info.';
            else
                $Message = 'Error ...';
        } else
            $Message = $validationMessage;
    }
}

include $ViewsPath . "adminPanel.html";
include $SharedFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST['uiLicenseNumber'] == "")
        $Message = 'Enter your license number' . "<br/>";
    if ($_POST['uiName'] == "")
        $Message .= 'Enter your name' . "<br/>";
    if ($_POST["uiPhoneNumber"] == "")
        $Message .= 'Enter your phone number.' . "<br/>";
    if ($_POST["uiAddress"] == "")
        $Message .= 'Enter your address.' . "<br/>";

    return $Message;
}
