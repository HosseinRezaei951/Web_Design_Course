<?php
session_start();

require "Configs/config.php";
require "Models/user.php";
include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

unset($_SESSION['USER']);

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['uiLogin'])) {
        $validationMessage = validation();
        if ($validationMessage == "") {
            $_customer = new customer();
            $_customer->setUsername($_POST['uiUsername']);
            $_customer->setPassword($_POST['uiPassword']);

            if ($_customer->checkUserPass()) {
                $_SESSION['USER'] = serialize($_customer);
                header('Location: index.php');
            }
            $Message = 'Invalid username or password.';
        } else {
            $Message = $validationMessage;
        }
    }
}


include $ViewsPath . "login.html";
include $SharedFolderPath . "footer.html";

function validation()
{
    $Message = "";
    if ($_POST["uiUsername"] == "")
        $Message .= 'Enter your username.' . "<br/>";
    if ($_POST["uiPassword"] == "")
        $Message .= 'Enter your password' . "<br/>";
    return $Message;
}
