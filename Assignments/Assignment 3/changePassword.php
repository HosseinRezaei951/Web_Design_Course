<?php
session_start();

require "model/user.php";
require "config.php";
require "captchaConfig.php";

$old_u = "";
if (!isset($_SESSION['USER'])) {
    header('Location: forgetPassword.php');
} else {
    $GLOBALS['old_u'] = unserialize($_SESSION['USER']);
}


include $ShareFolderPath . "header.html";
// include $ShareFolderPath."menu.html";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if ($res['success'] == "true") {
        // If CAPTCHA is successfully completed...

        $validationMessage = validation();
        if ($validationMessage == "") {
            $u = new user();
            $u->setName($old_u->getName());
            $u->setFamily($old_u->getFamily());
            $u->setUsername($old_u->getUsername());
            $u->setPassword($_POST['uiPassword']);

            if ($u->UpdatePassword())
                $Message = 'You have successfully change your password.';
            else
                $Message = 'Some thing went wrong.';
        } else {
            $Message = $validationMessage;
        }
    } else {
        // What happens when the CAPTCHA wasn't checked
        $Message = 'Please make sure you check the security CAPTCHA box.';
    }
}


include $ViewPath . "changePassword.html";

include $ShareFolderPath . "footer.html";


function validation()
{
    $Message = "";
    if ($_POST["uiPassword"] == "")
        $Message .= 'Enter your new password' . "<br/>";

    if ($_POST["uiConfirmPassword"] == "")
        $Message .= 'Enter your confirm password' . "<br/>";

    if ($_POST["uiPassword"] != $_POST["uiConfirmPassword"])
        $Message .= 'Password and confirmation password do not match.' . "<br/>";

    return $Message;
}
