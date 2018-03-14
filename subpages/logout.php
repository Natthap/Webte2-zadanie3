<?php
session_start();

include_once 'config/gpConfig.php';

if (isset($_SESSION['token'])) {
//Unset token and user data from session
    unset($_SESSION['token']);
    unset($_SESSION['userData']);

//Reset OAuth access token
    $gClient->revokeToken();
}

if(session_destroy()) {
    header("Location: index.php");
}
?>