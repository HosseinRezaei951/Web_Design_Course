<?php
session_start();

require "Configs/config.php";

if(!isset($_SESSION['USER'])) {
    // header('Location: login.php');
}
else
{
    $u = unserialize($_SESSION['USER']);
}


include $SharedFolderPath."header.html";
include $SharedFolderPath."menu.html";
include $ViewsPath."index.html";
include $SharedFolderPath."footer.html";
