<?php

require "Configs/config.php";
require "Models/user.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

$Message = '';
$uiName_cv = "";
$uiFamily_cv = "";
$uiUsername_cv = "";
$uiPhoneNumber_cv = "";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiRegister'])) {
        $uiName_cv = $_POST['uiName'];
        $uiFamily_cv = $_POST['uiFamily'];
        $uiUsername_cv = $_POST['uiUsername'];

        $validationMessage = validation();
        if ($validationMessage == "") {
            $_customer = new customer();
            $_customer->setFirstname($_POST['uiName']);
            $_customer->setLastname($_POST['uiFamily']);
            $_customer->setPhonenumber($_POST['uiPhoneNumber']);
            $_customer->setUsername($_POST['uiUsername']);
            $_customer->setPassword($_POST['uiPassword']);

            if ($_customer->Save())
                $Message = 'You have successfully registed.';
            else
                $Message = 'The username already exists. Please use a different username.';
        } else
            $Message = $validationMessage;
    }
}


include $ViewsPath . "register.html";
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
