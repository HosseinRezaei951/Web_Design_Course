<?php
session_start();

require "Configs/config.php";
require "Models/user.php";

include $SharedFolderPath . "header.html";
include $SharedFolderPath . "menu.html";

unset($_SESSION['ADMIN']);

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['uiLogin'])) {
        $validationMessage = validation();
        if ($validationMessage == "") {
            $_admin = new admin();
            $_admin->setUsername($_POST['uiUsername']);
            $_admin->setPassword($_POST['uiPassword']);

            if ($_admin->checkUserPass()) {
                $_SESSION['ADMIN'] = serialize($_admin);
                header('Location: adminPanel.php');
            }
            $Message = 'Invalid username or password.';
        } else {
            $Message = $validationMessage;
        }
    }
}


include $ViewsPath . "adminLogin.html";
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
