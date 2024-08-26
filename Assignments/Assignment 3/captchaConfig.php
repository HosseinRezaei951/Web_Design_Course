<?php
function post_captcha($user_response,$user_IP) {
    $secretKey = "6Ldp5sEUAAAAANoc4yWAuPIv-uR6ymO_DApopAH-";
    $responseKey = $user_response;
    $userIP = $user_IP;
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

    $result = file_get_contents($url);
    return json_decode($result, true);
}
?>
