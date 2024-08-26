<?php
session_start();

require "model/user.php";
require "config.php";
require "captchaConfig.php";

unset($_SESSION['USER']);

include $ShareFolderPath . "header.html";
//include $ShareFolderPath."menu.html";

$Message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['uiLogin'])) {
        // Call the function post_captcha
        $res = post_captcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if ($res['success'] == "true") {
            // If CAPTCHA is successfully completed...

            $validationMessage = validation();
            if ($validationMessage == "") {
                $u = new user();
                $u->setUsername($_POST['uiUsername']);
                $u->setPassword($_POST['uiPassword']);

                if ($u->checkUserPass()) {
                    $_SESSION['USER'] = serialize($u);
                    header('Location: home.php');
                }
                $Message = 'Invalid username or password.';
            } else {
                $Message = $validationMessage;
            }
        } else {
            // What happens when the CAPTCHA wasn't checked
            $Message = 'Please make sure you check the security CAPTCHA box.';
        }
    }
}


include $ViewPath . "login.html";

include $ShareFolderPath . "footer.html";

function validation()
{
    $Message = "";
    if ($_POST["uiUsername"] == "")
        $Message .= 'Enter your username.' . "<br/>";
    if ($_POST["uiPassword"] == "")
        $Message .= 'Enter your password' . "<br/>";
    return $Message;
}
