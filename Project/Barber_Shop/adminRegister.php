<?php

require "Configs/config.php";
require "Models/user.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";


$uiName_cv = "";
$uiFamily_cv = "";
$uiPhoneNumber_cv = "";
$uiUsername_cv = "";


$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiRegister'])) {
        $uiName_cv = $_POST['uiName'];
        $uiFamily_cv = $_POST['uiFamily'];
        $uiPhoneNumber_cv = $_POST['uiPhoneNumber'];
        $uiUsername_cv = $_POST['uiUsername'];
        
        $validationMessage = validation();
        if ($validationMessage == "") {
            $_admin = new admin();
            $_admin->setFirstname($_POST['uiName']);
            $_admin->setLastname($_POST['uiFamily']);
            $_admin->setPhonenumber($_POST['uiPhoneNumber']);
            $_admin->setPhotoUrl($_FILES);
            $_admin->setUsername($_POST['uiUsername']);
            $_admin->setPassword($_POST['uiPassword']);

            if ($_admin->Save())
                $Message = 'You have successfully registed.';
            else
                $Message = 'The username already exists. Please use a different username.';
        } else
            $Message = $validationMessage;
    }
}


include $ViewsPath . "adminRegister.html";
include $SharedFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST["uiName"] == "")
        $Message = 'Enter your name' . "<br/>";
    if ($_POST["uiFamily"] == "")
        $Message .= 'Enter your family' . "<br/>";
    if ($_POST["uiPhoneNumber"] == "")
        $Message .= 'Enter your phone number.' . "<br/>";
    if ($_POST["uiUsername"] == "")
        $Message .= 'Enter your username.' . "<br/>";
    if ($_POST["uiPassword"] == "")
        $Message .= 'Enter your password' . "<br/>";

    if ($_POST["uiPassword"] != $_POST["uiConfirmPassword"])
        $Message .= 'Password and confirmation password do not match.' . "<br/>";

    return $Message;
}
