<?php
session_start();

require "config.php";
require "model/user.php";
require "captchaConfig.php";

unset($_SESSION['USER']);
include $ShareFolderPath . "header.html";
// include $ShareFolderPath."menu.html";

$Message = '';
$uiName_cv = "";
$uiFamily_cv = "";
$uiUsername_cv = "";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiResetPassword'])) {
        // Call the function post_captcha
        $res = post_captcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if ($res['success'] == "true") {
            // If CAPTCHA is successfully completed...

            $uiName_cv = $_POST['uiName'];
            $uiFamily_cv = $_POST['uiFamily'];
            $uiUsername_cv = $_POST['uiUsername'];

            $validationMessage = validation();
            if ($validationMessage == "") {
                $u = new user();
                $u->setName($_POST['uiName']);
                $u->setFamily($_POST['uiFamily']);
                $u->setUsername($_POST['uiUsername']);
                if ($u->IsUserExist()) {
                    $Message = 'You have an account.';
                    $_SESSION['USER'] = serialize($u);
                    header('Location: changePassword.php');
                } else {
                    $Message = 'Invalid name or family or username .';
                }
            } else
                $Message = $validationMessage;
        } else {
            // What happens when the CAPTCHA wasn't checked
            $Message = 'Please make sure you check the security CAPTCHA box.';
        }
    }
}

include $ViewPath . "forgetPassword.html";

include $ShareFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST["uiName"] == "")
        $Message = 'Enter your name' . "<br/>";
    if ($_POST["uiFamily"] == "")
        $Message .= 'Enter your family' . "<br/>";
    if ($_POST["uiUsername"] == "")
        $Message .= 'Enter your username.' . "<br/>";

    return $Message;
}
